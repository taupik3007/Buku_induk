<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpdbSubmission;
use App\Models\Majors;
use App\Models\Ppdb;


class ClassAssignmentController extends Controller
{
    public function index(Request $request){
         $ppdbList = Ppdb::orderByDesc('ppd_id')->get();
    
    // Default: PPDB aktif atau yang pertama
    $selectedPpdb = $request->ppd_id 
        ? Ppdb::find($request->ppd_id) 
        : $ppdbList->first();
    // $studentCount = PpdbSubmission::where('ppsu_status',1)
    $major = Majors::withCount([
        'ppdbSubmissions as accepted_students_count' => fn($q) => $q
            ->where('ppsu_status', 1)
            ->where('ppsu_ppdb_id', $selectedPpdb->ppd_id)
    ])->get();
    // $major = Majors::with('ppdbSubmissions')->get();
    // dd($major);
    $studentCount =PpdbSubmission::where('ppsu_ppdb_id',$selectedPpdb->ppd_id)->where('ppsu_status',1)->count();

    return view('administration.class-assignment.index', compact('major', 'ppdbList', 'selectedPpdb','studentCount'));
    }
    public function process(Request $request)
{
    dd($request->ppd_id);

    $request->validate([
        'ppd_id'       => 'required|exists:ppdbs,ppd_id',
        // 'jumlah_kelas'  => 'required|array',
    ]);

    $ppdbId = $request->ppdb_id;
    $jumlahKelasInput = $request->jumlah_kelas; // ['mjr_id' => jumlah]

    // Ambil academic year dari ppdb
    $ppdb = Ppdb::findOrFail($ppdbId);

    DB::beginTransaction();
    try {
        foreach ($jumlahKelasInput as $mjrId => $jumlah) {
            $jumlah = (int) $jumlah;

            // Ambil siswa diterima di jurusan ini, urut abjad by nama user
            $submissions = PpdbSubmission::with(['student.user'])
                ->where('ppsu_ppdb_id', $ppdbId)
                ->where('ppsu_major_id', $mjrId)
                ->where('ppsu_status', 1)
                ->get()
                ->sortBy(fn($s) => $s->student->user->usr_name ?? '')
                ->values();

            if ($submissions->isEmpty()) continue;

            // Buat atau ambil kelas yang ada untuk jurusan ini
            $major = Majors::find($mjrId);
            $classes = [];

            for ($k = 1; $k <= $jumlah; $k++) {
                $clsCode = $major->mjr_abbr . '-' . $k;

                $kelas = Classes::updateOrCreate(
                    [
                        'cls_major_id' => $mjrId,
                        'cls_acy_id'   => $ppdb->ppd_acy_id, // sesuaikan nama kolom FK academic year di ppdb
                        'cls_number'   => $k,
                    ],
                    [
                        'cls_code'        => $clsCode,
                        'cls_level'       => '10', // sesuaikan
                        'cls_homeroom_id' => 1,    // default dulu, bisa diubah manual nanti
                    ]
                );

                $classes[] = $kelas;
            }

            // Bagi siswa ke kelas berdasarkan abjad
            $perKelas = ceil($submissions->count() / $jumlah);
            $chunks = $submissions->chunk($perKelas);

            foreach ($chunks as $index => $chunk) {
                $kelas = $classes[$index] ?? $classes[count($classes) - 1];
                foreach ($chunk as $submission) {
                    Student::where('std_id', $submission->ppsu_student_id)
                        ->update(['std_classes_id' => $kelas->cls_id]);
                }
            }
        }

        DB::commit();
        return redirect()->back()->with('success', 'Pembagian kelas berhasil diproses.');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Gagal memproses: ' . $e->getMessage());
    }
}
}
