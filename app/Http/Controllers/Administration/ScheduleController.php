<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Majors;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classes;
use App\Models\Academic_Year;
use App\Models\SubjectTeacher;
use App\Models\Schedule;
use App\Models\ScheduleSlot;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $academicYears = Academic_Year::orderByDesc('acy_id')->get();

        $activeAcademicYear = Academic_Year::where('acy_status', 1)
            ->firstOrFail();

        $academicYearId = $request->acy_id
            ?? $activeAcademicYear->acy_id;

        $day = (int) ($request->day ?? 1);

        $days = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
        ];

        /*
    |--------------------------------------------------------------------------
    | Semua kelas
    |--------------------------------------------------------------------------
    */

        $classes = Classes::with('cls_major')
            ->orderBy('cls_level')
            ->orderBy('cls_number')
            ->get();


        /*
    |--------------------------------------------------------------------------
    | Slot pada hari yang dipilih
    |--------------------------------------------------------------------------
    */

        $slots = ScheduleSlot::where('slt_day', $day)
            ->orderBy('slt_start_time')
            ->get();


        /*
    |--------------------------------------------------------------------------
    | Semua jadwal tahun ajaran yang dipilih
    |--------------------------------------------------------------------------
    */

        $schedules = Schedule::with([
            'subjectTeacher.subject',
            'subjectTeacher.teacher.user',
            'subjectTeacher.class.cls_major',
        ])
            ->whereHas('subjectTeacher', function ($query) use ($academicYearId) {
                $query->where(
                    'subt_academic_year_id',
                    $academicYearId
                );
            })
            ->whereHas('slot', function ($query) use ($day) {
                $query->where('slt_day', $day);
            })
            ->get();


        /*
    |--------------------------------------------------------------------------
    | Jadikan key: slot_id-class_id
    |--------------------------------------------------------------------------
    */

        $scheduleMap = $schedules->keyBy(function ($schedule) {

            return $schedule->sch_slot_id
                . '-' .
                $schedule->subjectTeacher->subt_class_id;
        });


        return view(
            'administration.schedule.index',
            compact(
                'academicYears',
                'academicYearId',
                'day',
                'days',
                'classes',
                'slots',
                'scheduleMap'
            )
        );
    }
    public function manual(Request $request)
    {
        $academicYears = Academic_Year::orderByDesc('acy_id')->get();

        $activeAcademicYear = Academic_Year::where('acy_status', 1)
            ->firstOrFail();

        $academicYearId = $request->acy_id
            ?? $activeAcademicYear->acy_id;

        $classes = Classes::with('cls_major')
            ->orderBy('cls_level')
            ->orderBy('cls_number')
            ->get();

        $classId = $request->class_id
            ?? $classes->first()?->cls_id;

        $scheduleSlots = ScheduleSlot::orderBy('slt_day')
            ->orderBy('slt_start_time')
            ->get()
            ->groupBy('slt_day');

        $timeRows = $scheduleSlots
            ->flatten()
            ->sortBy('slt_start_time')
            ->unique(function ($slot) {
                return $slot->slt_start_time . '-' . $slot->slt_end_time;
            })
            ->values();

        $subjectTeachers = SubjectTeacher::with([
            'subject',
            'teacher.user',
        ])
            ->where('subt_class_id', $classId)
            ->where('subt_academic_year_id', $academicYearId)
            ->get();

        $schedules = Schedule::with([
            'subjectTeacher.subject',
            'subjectTeacher.teacher.user',
            'slot',
        ])
            ->whereHas('subjectTeacher', function ($query) use ($classId, $academicYearId) {
                $query->where('subt_class_id', $classId)
                    ->where('subt_academic_year_id', $academicYearId);
            })
            ->get()
            ->keyBy('sch_slot_id');

        // Hitung jumlah JP yang sudah terpakai setiap pengampu
        $usedHours = Schedule::whereHas('subjectTeacher', function ($query) use ($classId, $academicYearId) {
            $query->where('subt_class_id', $classId)
                ->where('subt_academic_year_id', $academicYearId);
        })
            ->selectRaw('sch_subject_teacher_id, COUNT(*) as total')
            ->groupBy('sch_subject_teacher_id')
            ->pluck('total', 'sch_subject_teacher_id');

        return view(
            'administration.schedule.manual',
            compact(
                'academicYears',
                'academicYearId',
                'classes',
                'classId',
                'scheduleSlots',
                'timeRows',
                'subjectTeachers',
                'schedules',
                'usedHours'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'acy_id' => 'required|exists:academic_years,acy_id',
            'class_id' => 'required|exists:classes,cls_id',
            'sch_subject_teacher_id' => 'required|exists:subject_teachers,subt_id',
            'sch_slot_id' => 'required|exists:schedule_slots,slt_id',
        ], [
            'acy_id.required' => 'Tahun ajaran wajib dipilih.',
            'acy_id.exists' => 'Tahun ajaran tidak ditemukan.',

            'class_id.required' => 'Kelas wajib dipilih.',
            'class_id.exists' => 'Kelas tidak ditemukan.',

            'sch_subject_teacher_id.required' => 'Pengampu wajib dipilih.',
            'sch_subject_teacher_id.exists' => 'Pengampu tidak ditemukan.',

            'sch_slot_id.required' => 'Slot wajib dipilih.',
            'sch_slot_id.exists' => 'Slot tidak ditemukan.',
        ]);


        /*
    |--------------------------------------------------------------------------
    | Ambil Pengampu
    |--------------------------------------------------------------------------
    | Pastikan pengampu benar-benar milik:
    | - tahun ajaran yang dipilih
    | - kelas yang dipilih
    */
        $subjectTeacher = SubjectTeacher::with([
            'subject',
            'teacher',
        ])
            ->where('subt_id', $validated['sch_subject_teacher_id'])
            ->where('subt_academic_year_id', $validated['acy_id'])
            ->where('subt_class_id', $validated['class_id'])
            ->first();

        if (!$subjectTeacher) {

            Alert::error(
                'Gagal',
                'Pengampu tidak sesuai dengan tahun ajaran atau kelas yang dipilih.'
            );

            return redirect()->back()->withInput();
        }


        /*
    |--------------------------------------------------------------------------
    | Ambil Slot
    |--------------------------------------------------------------------------
    */
        $slot = ScheduleSlot::findOrFail(
            $validated['sch_slot_id']
        );


        /*
    |--------------------------------------------------------------------------
    | Jangan bisa memasukkan jadwal ke slot istirahat
    |--------------------------------------------------------------------------
    */
        if ($slot->slt_type === 'break') {

            Alert::error(
                'Gagal',
                'Slot tersebut merupakan jam istirahat.'
            );

            return redirect()->back()->withInput();
        }


        /*
    |--------------------------------------------------------------------------
    | Cek apakah pengampu sudah dijadwalkan di slot tersebut
    |--------------------------------------------------------------------------
    */
        $alreadyExists = Schedule::where(
            'sch_subject_teacher_id',
            $subjectTeacher->subt_id
        )
            ->where(
                'sch_slot_id',
                $slot->slt_id
            )
            ->exists();

        if ($alreadyExists) {

            Alert::error(
                'Gagal',
                'Pengampu tersebut sudah ditempatkan pada slot ini.'
            );

            return redirect()->back()->withInput();
        }


        /*
    |--------------------------------------------------------------------------
    | Cek bentrok Guru
    |--------------------------------------------------------------------------
    | Guru tidak boleh mengajar dua kelas pada slot yang sama.
    */
        $teacherConflict = Schedule::where(
            'sch_slot_id',
            $slot->slt_id
        )
            ->whereHas('subjectTeacher', function ($query) use ($subjectTeacher) {

                $query->where(
                    'subt_teacher_id',
                    $subjectTeacher->subt_teacher_id
                );
            })
            ->exists();

        if ($teacherConflict) {

            Alert::error(
                'Gagal',
                'Guru tersebut sudah memiliki jadwal pada slot ini.'
            );

            return redirect()->back()->withInput();
        }


        /*
    |--------------------------------------------------------------------------
    | Cek bentrok Kelas
    |--------------------------------------------------------------------------
    | Satu kelas tidak boleh memiliki dua pelajaran pada slot yang sama.
    */
        $classConflict = Schedule::where(
            'sch_slot_id',
            $slot->slt_id
        )
            ->whereHas('subjectTeacher', function ($query) use ($subjectTeacher) {

                $query->where(
                    'subt_class_id',
                    $subjectTeacher->subt_class_id
                );
            })
            ->exists();

        if ($classConflict) {

            Alert::error(
                'Gagal',
                'Kelas tersebut sudah memiliki jadwal pada slot ini.'
            );

            return redirect()->back()->withInput();
        }


        /*
    |--------------------------------------------------------------------------
    | Hitung JP yang sudah digunakan
    |--------------------------------------------------------------------------
    */
        $usedHours = Schedule::where(
            'sch_subject_teacher_id',
            $subjectTeacher->subt_id
        )->count();

        $totalHours = $subjectTeacher->subt_total_hours;


        /*
    |--------------------------------------------------------------------------
    | Jangan melebihi jumlah JP pengampu
    |--------------------------------------------------------------------------
    */
        if ($usedHours >= $totalHours) {

            Alert::error(
                'Gagal',
                'Jumlah JP pengampu tersebut sudah terpenuhi.'
            );

            return redirect()->back()->withInput();
        }


        /*
    |--------------------------------------------------------------------------
    | Simpan Jadwal
    |--------------------------------------------------------------------------
    */
        Schedule::create([
            'sch_subject_teacher_id' => $subjectTeacher->subt_id,
            'sch_slot_id' => $slot->slt_id,
            'sch_created_by' => auth()->id(),
        ]);


        /*
    |--------------------------------------------------------------------------
    | Berhasil
    |--------------------------------------------------------------------------
    */
        Alert::success(
            'Berhasil',
            'Jadwal berhasil ditambahkan.'
        );

        return redirect()->back();
    }


    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->update([
            'sch_deleted_by' => auth()->id(),
        ]);

        $schedule->delete();

        Alert::success(
            'Berhasil',
            'Jadwal berhasil dihapus.'
        );

        return redirect()->back();
    }









    private function generateScheduleRecursive(
        array $subjectTeachers,
        int $index,
        $lessonSlots,
        array $teacherBusy,
        array &$usedClassSlots,
        array &$usedTeacherSlots,
        array &$usedAssignmentDays,
        array &$generatedSchedules
    ) {
        /*
    |--------------------------------------------------------------------------
    | Semua pengampu sudah berhasil ditempatkan
    |--------------------------------------------------------------------------
    */

        if ($index >= count($subjectTeachers)) {
            return true;
        }


        $subjectTeacher = $subjectTeachers[$index];

        $teacherId = $subjectTeacher->subt_teacher_id;

        $requiredHours = (int) $subjectTeacher->subt_total_hours;


        /*
    |--------------------------------------------------------------------------
    | Ubah total JP menjadi blok
    |--------------------------------------------------------------------------
    |
    | 4 JP = 2 + 2
    | 5 JP = 2 + 2 + 1
    | 3 JP = 2 + 1
    |
    */

        $sessionSizes = [];

        while ($requiredHours >= 2) {
            $sessionSizes[] = 2;
            $requiredHours -= 2;
        }

        if ($requiredHours === 1) {
            $sessionSizes[] = 1;
        }


        /*
    |--------------------------------------------------------------------------
    | Tempatkan seluruh sesi pengampu
    |--------------------------------------------------------------------------
    */

        return $this->placeSubjectSessions(
            $subjectTeacher,
            $sessionSizes,
            0,
            $lessonSlots,
            $teacherBusy,
            $usedClassSlots,
            $usedTeacherSlots,
            $usedAssignmentDays,
            $generatedSchedules,
            $subjectTeachers,
            $index
        );
    }
    private function placeSubjectSessions(
        $subjectTeacher,
        array $sessionSizes,
        int $sessionIndex,
        $lessonSlots,
        array $teacherBusy,
        array &$usedClassSlots,
        array &$usedTeacherSlots,
        array &$usedAssignmentDays,
        array &$generatedSchedules,
        array $subjectTeachers,
        int $assignmentIndex
    ) {
        /*
    |--------------------------------------------------------------------------
    | Semua sesi pengampu berhasil ditempatkan
    |--------------------------------------------------------------------------
    */

        if ($sessionIndex >= count($sessionSizes)) {

            return $this->generateScheduleRecursive(
                $subjectTeachers,
                $assignmentIndex + 1,
                $lessonSlots,
                $teacherBusy,
                $usedClassSlots,
                $usedTeacherSlots,
                $usedAssignmentDays,
                $generatedSchedules
            );
        }


        $sessionSize = $sessionSizes[$sessionIndex];

        $teacherId = $subjectTeacher->subt_teacher_id;

        $assignmentId = $subjectTeacher->subt_id;


        /*
    |--------------------------------------------------------------------------
    | Buat daftar kandidat slot
    |--------------------------------------------------------------------------
    */

        $candidates = [];


        foreach ($lessonSlots as $day => $daySlots) {

            $daySlots = $daySlots->values();

            $count = $daySlots->count();


            /*
        |--------------------------------------------------------------------------
        | Satu pengampu maksimal satu sesi dalam satu hari
        |--------------------------------------------------------------------------
        */

            if (isset($usedAssignmentDays[$assignmentId][$day])) {
                continue;
            }


            /*
        |--------------------------------------------------------------------------
        | Cari blok
        |--------------------------------------------------------------------------
        */

            for ($i = 0; $i <= $count - $sessionSize; $i++) {

                $block = $daySlots
                    ->slice($i, $sessionSize)
                    ->values();


                $canUse = true;


                foreach ($block as $slot) {

                    $slotId = $slot->slt_id;

                    /*
                | Kelas bentrok
                */
                    if (isset($usedClassSlots[$slotId])) {
                        $canUse = false;
                        break;
                    }


                    /*
                | Guru bentrok dengan jadwal kelas lain
                */
                    if (isset($teacherBusy[$teacherId][$slotId])) {
                        $canUse = false;
                        break;
                    }


                    /*
                | Guru bentrok dengan hasil generate saat ini
                */
                    $teacherSlotKey = $teacherId . ':' . $slotId;

                    if (isset($usedTeacherSlots[$teacherSlotKey])) {
                        $canUse = false;
                        break;
                    }
                }


                if ($canUse) {

                    $candidates[] = [
                        'day' => $day,
                        'slots' => $block,
                    ];
                }
            }
        }


        /*
    |--------------------------------------------------------------------------
    | Randomisasi kandidat
    |--------------------------------------------------------------------------
    |
    | Supaya hasil generate tidak selalu sama.
    |
    */

        shuffle($candidates);


        /*
    |--------------------------------------------------------------------------
    | Coba setiap kandidat
    |--------------------------------------------------------------------------
    */

        foreach ($candidates as $candidate) {

            $day = $candidate['day'];
            $slots = $candidate['slots'];

            $addedSlots = [];


            /*
        |--------------------------------------------------------------------------
        | Tandai penggunaan
        |--------------------------------------------------------------------------
        */

            foreach ($slots as $slot) {

                $slotId = $slot->slt_id;

                $teacherSlotKey = $teacherId . ':' . $slotId;

                $usedClassSlots[$slotId] = true;

                $usedTeacherSlots[$teacherSlotKey] = true;

                $generatedSchedules[] = [
                    'subject_teacher_id' => $assignmentId,
                    'slot_id' => $slotId,
                ];

                $addedSlots[] = [
                    'slot_id' => $slotId,
                    'teacher_key' => $teacherSlotKey,
                ];
            }


            $usedAssignmentDays[$assignmentId][$day] = true;


            /*
        |--------------------------------------------------------------------------
        | Lanjut ke sesi berikutnya
        |--------------------------------------------------------------------------
        */

            $success = $this->placeSubjectSessions(
                $subjectTeacher,
                $sessionSizes,
                $sessionIndex + 1,
                $lessonSlots,
                $teacherBusy,
                $usedClassSlots,
                $usedTeacherSlots,
                $usedAssignmentDays,
                $generatedSchedules,
                $subjectTeachers,
                $assignmentIndex
            );


            if ($success) {
                return true;
            }


            /*
        |--------------------------------------------------------------------------
        | BACKTRACK
        |--------------------------------------------------------------------------
        |
        | Kandidat ini gagal. Kembalikan state sebelumnya.
        |
        */

            foreach ($addedSlots as $addedSlot) {

                unset(
                    $usedClassSlots[$addedSlot['slot_id']]
                );

                unset(
                    $usedTeacherSlots[$addedSlot['teacher_key']]
                );


                foreach ($generatedSchedules as $key => $generated) {

                    if (
                        $generated['subject_teacher_id'] === $assignmentId &&
                        $generated['slot_id'] === $addedSlot['slot_id']
                    ) {
                        unset($generatedSchedules[$key]);
                    }
                }
            }


            unset(
                $usedAssignmentDays[$assignmentId][$day]
            );

            $generatedSchedules = array_values($generatedSchedules);
        }


        return false;
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'acy_id' => 'required|exists:academic_years,acy_id',
            'class_id' => 'required|exists:classes,cls_id',
        ]);

        $academicYearId = $validated['acy_id'];
        $classId = $validated['class_id'];

        // Jangan generate di atas jadwal yang sudah ada
        $hasSchedule = Schedule::whereHas('subjectTeacher', function ($query) use ($academicYearId, $classId) {
            $query->where('subt_academic_year_id', $academicYearId)
                ->where('subt_class_id', $classId);
        })->exists();

        if ($hasSchedule) {
            Alert::error(
                'Gagal',
                'Kelas ini sudah memiliki jadwal. Hapus jadwal terlebih dahulu.'
            );

            return redirect()->back();
        }

        // Ambil pengampu
        $subjectTeachers = SubjectTeacher::where('subt_academic_year_id', $academicYearId)
            ->where('subt_class_id', $classId)
            ->where('subt_total_hours', '>', 0)
            ->orderByDesc('subt_total_hours')
            ->get();

        if ($subjectTeachers->isEmpty()) {
            Alert::error(
                'Gagal',
                'Belum ada pengampu untuk kelas tersebut.'
            );

            return redirect()->back();
        }

        // Slot pelajaran saja
        $slots = ScheduleSlot::where('slt_type', 'lesson')
            ->orderBy('slt_day')
            ->orderBy('slt_start_time')
            ->get();

        if ($slots->isEmpty()) {
            Alert::error(
                'Gagal',
                'Belum ada slot pelajaran.'
            );

            return redirect()->back();
        }

        // Ambil jadwal kelas lain pada tahun yang sama
        $existingSchedules = Schedule::with('subjectTeacher')
            ->whereHas('subjectTeacher', function ($query) use ($academicYearId) {
                $query->where('subt_academic_year_id', $academicYearId);
            })
            ->get();

        $teacherBusy = [];

        foreach ($existingSchedules as $schedule) {
            $teacherId = $schedule->subjectTeacher->subt_teacher_id;
            $slotId = $schedule->sch_slot_id;

            $teacherBusy[$teacherId][$slotId] = true;
        }

        $usedClassSlots = [];
        $usedTeacherSlots = [];
        $result = [];

        foreach ($subjectTeachers as $subjectTeacher) {

            $hours = (int) $subjectTeacher->subt_total_hours;

            // Cari kombinasi blok dari terbesar ke terkecil
            $blocks = $this->buildBlockOptions($hours);

            $placed = false;

            foreach ($blocks as $blockSizes) {

                $backupClassSlots = $usedClassSlots;
                $backupTeacherSlots = $usedTeacherSlots;
                $backupResult = $result;

                $success = true;

                foreach ($blockSizes as $blockSize) {

                    $block = $this->findAvailableBlock(
                        $slots,
                        $blockSize,
                        $subjectTeacher,
                        $teacherBusy,
                        $usedClassSlots,
                        $usedTeacherSlots
                    );

                    if (!$block) {
                        $success = false;
                        break;
                    }

                    foreach ($block as $slot) {

                        $slotId = $slot->slt_id;
                        $teacherId = $subjectTeacher->subt_teacher_id;

                        $usedClassSlots[$slotId] = true;

                        $usedTeacherSlots[$teacherId . ':' . $slotId] = true;

                        $result[] = [
                            'subject_teacher_id' => $subjectTeacher->subt_id,
                            'slot_id' => $slotId,
                        ];
                    }
                }

                if ($success) {
                    $placed = true;
                    break;
                }

                // Gagal → rollback percobaan blok ini
                $usedClassSlots = $backupClassSlots;
                $usedTeacherSlots = $backupTeacherSlots;
                $result = $backupResult;
            }

            if (!$placed) {

                Alert::error(
                    'Gagal Generate',
                    'Tidak ditemukan kombinasi slot untuk memenuhi kebutuhan JP '
                        . 'dari '
                        . ($subjectTeacher->subject?->sbj_name ?? 'mata pelajaran')
                );

                return redirect()->back();
            }
        }

        DB::transaction(function () use ($result) {

            foreach ($result as $item) {

                Schedule::create([
                    'sch_subject_teacher_id' => $item['subject_teacher_id'],
                    'sch_slot_id' => $item['slot_id'],
                    'sch_created_by' => auth()->id(),
                ]);
            }
        });

        Alert::success(
            'Berhasil',
            'Jadwal otomatis berhasil dibuat.'
        );

        return redirect()->route(
            'administration.schedule.manual',
            [
                'acy_id' => $academicYearId,
                'class_id' => $classId,
            ]
        );
    }

    private function buildBlockOptions(int $hours): array
    {
        $options = [];

        // Prioritas pertama: semua JP sekaligus
        $options[] = [$hours];

        // Coba pecah menjadi blok-blok yang lebih kecil
        if ($hours > 2) {

            for ($firstBlock = $hours - 1; $firstBlock >= 2; $firstBlock--) {

                $remaining = $hours - $firstBlock;

                if ($remaining === 1) {
                    $options[] = [$firstBlock, 1];
                } elseif ($remaining >= 2) {
                    $options[] = [$firstBlock, $remaining];
                }
            }
        }

        // Hilangkan kombinasi duplikat
        return collect($options)
            ->map(fn($item) => array_values($item))
            ->unique(fn($item) => implode('-', $item))
            ->values()
            ->toArray();
    }



    private function findAvailableBlock(
        $slots,
        int $blockSize,
        $subjectTeacher,
        array $teacherBusy,
        array $usedClassSlots,
        array $usedTeacherSlots
    ) {
        $teacherId = $subjectTeacher->subt_teacher_id;

        $slotsByDay = $slots->groupBy('slt_day');

        foreach ($slotsByDay as $day => $daySlots) {

            $daySlots = $daySlots
                ->sortBy('slt_start_time')
                ->values();

            $count = $daySlots->count();

            for ($i = 0; $i <= $count - $blockSize; $i++) {

                $candidate = $daySlots
                    ->slice($i, $blockSize)
                    ->values();

                $valid = true;

                foreach ($candidate as $slot) {

                    $slotId = $slot->slt_id;
                    $teacherKey = $teacherId . ':' . $slotId;

                    // Bentrok kelas
                    if (isset($usedClassSlots[$slotId])) {
                        $valid = false;
                        break;
                    }

                    // Bentrok guru dengan kelas lain
                    if (isset($teacherBusy[$teacherId][$slotId])) {
                        $valid = false;
                        break;
                    }

                    // Bentrok guru dengan hasil generate sekarang
                    if (isset($usedTeacherSlots[$teacherKey])) {
                        $valid = false;
                        break;
                    }
                }

                if ($valid) {
                    return $candidate;
                }
            }
        }

        return null;
    }
}
