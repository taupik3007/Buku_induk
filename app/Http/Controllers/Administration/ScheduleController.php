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

        $classes = Classes::with('cls_major')
            ->orderBy('cls_level')
            ->orderBy('cls_number')
            ->get();

        $classId = $request->class_id
            ?? $classes->first()?->cls_id;

        $slots = ScheduleSlot::orderBy('slt_day')
            ->orderBy('slt_number')
            ->get()
            ->groupBy('slt_day');

        $schedules = Schedule::with([
            'subjectTeacher.subject',
            'subjectTeacher.teacher.user',
            'subjectTeacher.class',
            'slot',
        ])
            ->whereHas('subjectTeacher', function ($query) use ($academicYearId, $classId) {
                $query->where('subt_academic_year_id', $academicYearId)
                    ->where('subt_class_id', $classId);
            })
            ->get()
            ->keyBy('sch_slot_id');

        return view(
            'administration.schedule.index',
            compact(
                'academicYears',
                'academicYearId',
                'classes',
                'classId',
                'slots',
                'schedules'
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
}
