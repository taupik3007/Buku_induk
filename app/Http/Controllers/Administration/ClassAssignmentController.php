<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpdbSubmission;
use App\Models\Majors;
use App\Models\Ppdb;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Support\Facades\DB;




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
    $ppdb = Ppdb::find($selectedPpdb)->first();
    // dd($ppdb);
    // $major = Majors::with('ppdbSubmissions')->get();
    // dd($major);
    $studentCount =PpdbSubmission::where('ppsu_ppdb_id',$selectedPpdb->ppd_id)->where('ppsu_status',1)->count();

    return view('administration.class-assignment.index', compact('major', 'ppdbList', 'selectedPpdb','studentCount','ppdb'));
    }
   public function process(Request $request)
{
    $request->validate([
        'ppd_id'       => 'required|exists:ppdbs,ppd_id',
        'jumlah_kelas' => 'required|array',
    ]);

    $ppdbId          = $request->ppd_id;
    $ppdb            = Ppdb::with('academic')->where('ppd_id', $ppdbId)->first();
    $jumlahKelasInput = $request->jumlah_kelas;

    // Format tahun: 2024/2025 -> "2425"
    $tahun     = $ppdb->academic->acy_year;
    $tahunKode = substr($tahun, 2, 2) . substr($tahun + 1, 2, 2); // "2526"
    // dd($tahunKode);
    DB::beginTransaction();
    try {

        // ── 1. PEMBAGIAN KELAS (per jurusan) ──────────────────────
        foreach ($jumlahKelasInput as $mjrId => $jumlah) {
            $jumlah      = (int) $jumlah;
            $submissions = PpdbSubmission::with(['student.user'])
                ->where('ppsu_ppdb_id', $ppdbId)
                ->where('ppsu_major_id', $mjrId)
                ->where('ppsu_status', 1)
                ->get()
                ->sortBy(fn($s) => optional($s->student->user)->usr_name)
                ->values();

            if ($submissions->isEmpty()) continue;

            $major   = Majors::find($mjrId);
            $classes = [];

            for ($k = 1; $k <= $jumlah; $k++) {
                $kelas = Classes::updateOrCreate(
                    [
                        'cls_major_id' => $mjrId,
                        'cls_acy_id'   => $ppdb->ppd_academic_id,
                        'cls_number'   => $k,
                    ],
                    [
                        'cls_code'        => $major->mjr_abbr . '-' . $k,
                        'cls_level'       => '10',
                        'cls_homeroom_id' => 1,
                    ]
                );
                $classes[] = $kelas;
            }

            $perKelas = (int) ceil($submissions->count() / $jumlah);
            $chunks   = $submissions->chunk($perKelas);

            foreach ($chunks as $index => $chunk) {
                $kelas = $classes[$index] ?? $classes[count($classes) - 1];
                foreach ($chunk as $submission) {
                    Student::where('std_id', $submission->ppsu_student_id)
                        ->update(['std_classes_id' => $kelas->cls_id]);
                }
            }
        }
        // dd("awikwok");

        // ── 2. GENERATE NIS (urut abjad global semua siswa diterima) ──
        $semuaSiswa = PpdbSubmission::with(['student.user'])
            ->where('ppsu_ppdb_id', $ppdbId)
            ->where('ppsu_status', 1)
            ->get()
            ->sortBy(fn($s) => optional($s->student->user)->usr_name)
            ->values();

        // dd($semuaSiswa);
        // dd($semuaSiswa);
        foreach ($semuaSiswa as $urut => $submission) {
            $nomorUrut = str_pad($urut + 1, 3, '0', STR_PAD_LEFT); // 001, 002, dst
            $nis       = $tahunKode . '10' . $nomorUrut;          // 2526.10.001
            // dd($nis);
           $student= Student::where('std_id', $submission->ppsu_student_id)
                ->update(['std_nis'=> $nis]);
        dd($student->std_nis);


        }
        

        DB::commit();
        return redirect()->back()->with('success', 'Pembagian kelas dan NIS berhasil diproses.');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Gagal memproses: ' . $e->getMessage());
    }
}
}
