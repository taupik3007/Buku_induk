<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Teach_History;
use App\Models\Teacher;
use App\Models\Teacher_Address;
use App\Models\Teacher_Bio;
use App\Models\Teacher_Partner;
use App\Models\TeacherEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class prospectiveTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function biodata()
{
    $user = Auth::user();

    $teacher = Teacher::where('tcr_user_id', $user->usr_id)->first();

    if (!$teacher) {
        abort(404, 'Data teacher tidak ditemukan');
    }

    $biodata = Teacher_Bio::where('tcb_teacher_id', $teacher->tcr_id)->first();

    if (!$biodata) {

        $address = null;
        $partner = null;
        $history = collect();
        $education = collect();
    
        return view(
            'teacher.prospectiveTeacher.biodata',
            compact(
                'user',
                'biodata',
                'address',
                'partner',
                'history',
                'education'
            )
        );
    }

    $biodata = Teacher_Bio::where('tcb_teacher_id', $teacher->tcr_id)->first();
    $address = Teacher_Address::where('tca_teacher_id', $teacher->tcr_id)->first();
    $partner = Teacher_Partner::where('tcp_teacher_id', $teacher->tcr_id)->first();
    $history = Teach_History::where('tcs_teacher_id', $teacher->tcr_id)->get();
    $education = TeacherEducation::where('tce_teacher_id', $teacher->tcr_id)->get();

    return view(
        'teacher.prospectiveTeacher.biodata',
        compact(
            'user',
            'biodata',
            'address',
            'partner',
            'history',
            'education'
        )
    );
}


    public function store_biodata(Request $request)
    {
        try {
            $request->validate([
                'usr_name'   => 'required',
                'tcb_birth_place' => 'required',
                'tcb_birth_date' => 'required|date',
                'tcb_religion'   => 'required',
                'tcb_mary_status'=> 'required',
                'tcb_gender'=> 'required',
                'tcb_telp'       => 'required'
            ]);
            $teacher = Teacher::where('tcr_user_id', Auth::user()->usr_id)->first();
            if (!$teacher) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data teacher tidak ditemukan.'
                ], 404);
            }

            Auth::user()->update([
                'usr_name' => $request->usr_name,
            ]);
            $teacherBio = Teacher_Bio::updateOrCreate(
                [
                    'tcb_teacher_id' => $teacher->tcr_id
                ],[
                    'tcb_birth_place' => $request->tcb_birth_place,
                    'tcb_birth_date'  => $request->tcb_birth_date,
                    'tcb_religion' => $request->tcb_religion,
                    'tcb_mary_status' => $request->tcb_mary_status,
                    'tcb_gender'      => $request->tcb_gender,
                    'tcb_telp'        => $request->tcb_telp,
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Biodata berhasil disimpan'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }

    public function store_address(Request $request)
    {
        try {
    
            $request->validate([ 
                'tca_province' => 'required',
                'tca_province_value'  => 'required|string',
                'tca_regency'     => 'required',
                'tca_regency_value'  => 'required|string',
                'tca_district' => 'required',
                'tca_district_value'  => 'required|string',
                'tca_village'  => 'required',
                'tca_village_value'  => 'required|string',
            ]);
    
            $teacher = Teacher::where('tcr_user_id', Auth::user()->usr_id)->first();

            if (!$teacher) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data teacher tidak ditemukan.'
                ], 404);
            }
    

            // Teacher_Address::where('tca_bio_id', $tcb_id)->delete();
    
            $address = Teacher_Address::updateOrCreate(
                [
                    'tca_teacher_id' => $teacher->tcr_id
                ],
                [
                    'tca_detail' => $request->tca_detail,
                    'tca_province' => $request->tca_province,
                    'tca_province_value' => $request->tca_province_value,
                    'tca_regency'     => $request->tca_regency,
                    'tca_regency_value' => $request->tca_regency_value,
                    'tca_district' => $request->tca_district,
                    'tca_district_value' => $request->tca_district_value,
                    'tca_village'  => $request->tca_village,
                    'tca_village_value' => $request->tca_village_value,
                    'tca_postalcode'  => $request->tca_postalcode,
                    'tca_distance'  => $request->tca_distance,
                ]
            );
    
            return response()->json([
                'success' => true,
                'message' => 'Alamat berhasil disimpan'
            ]);
    
        } catch (\Throwable $e) {
    
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
    
        }
    }
    

    public function store_partner(Request $request)
{
    try {

        $teacher = Teacher::where('tcr_user_id', Auth::user()->usr_id)->first();

        if (!$teacher) {
            return response()->json([
                'success' => false,
                'message' => 'Session biodata tidak ditemukan'
            ], 400);
        }

        $biodata = Teacher_Bio::where('tcb_teacher_id', $teacher->tcr_id)->first();

        if (!$biodata) {
            return response()->json([
                'success' => false,
                'message' => 'Data biodata tidak ditemukan'
            ], 400);
        }

        if ($biodata->tcb_mary_status == 1) {

            $request->validate([
                'tcp_name' => 'required|string',
                'tcp_nik'  => 'required',
                'tcp_work' => 'required|string',
                'tcp_nip'  => 'nullable'
            ]);

            Teacher_Partner::updateOrCreate(
                [
                    'tcp_teacher_id' => $teacher->tcr_id
                ],
                [
                    'tcp_name' => $request->tcp_name,
                    'tcp_nik'  => $request->tcp_nik,
                    'tcp_work' => $request->tcp_work,
                    'tcp_nip'  => $request->tcp_nip,
                ]
            );

        } else {

            // tetap create / update tapi isinya null
            Teacher_Partner::updateOrCreate(
                [
                    'tcp_teacher_id' => $teacher->tcr_id
                ],
                [
                    'tcp_name' => null,
                    'tcp_nik'  => null,
                    'tcp_work' => null,
                    'tcp_nip'  => null,
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Pasangan berhasil disimpan'
        ]);

    } catch (\Throwable $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
    // public function store_history(Request $request)
    // {
    //     try {
    
    //         $request->validate([
    //             'teach' => 'required|array',

    //      'teach.*.subject_name' => 'required',
    // 'teach.*.name_school'  => 'required',
    // 'teach.*.class'        => 'required',
    // 'teach.*.jp'           => 'required',
    // 'teach.*.year'         => 'required',
    // 'teach.*.status'       => 'required',
    //         ]);
    
    //         $teacher = Teacher::where('tcr_user_id', Auth::user()->usr_id)->get();;

    //         if (!$teacher) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Data teacher tidak ditemukan'
    //             ], 404);
    
    //         }
    //         Teach_History::where('tcs_teacher_id', $teacher->tcr_id)->delete();
    //         // Teach_History::where('tcs_bio_id', $tcb_id)->delete();
    //         foreach ($request->teach as $teach) {

    //             Teach_History::create([
    //                 'tcs_teacher_id'   => $teacher->tcr_id,
    //                 'tcs_subject_name'  => $teach['subject_name'],
    //                 'tcs_name_school'   => $teach['name_school'],
    //                 'tcs_class'         => $teach['class'],
    //                 'tcs_jp'            => $teach['jp'],
    //                 'tcs_year'          => $teach['year'],
    //                 'tcs_status'        => $teach['status'],
    //             ]);
            
    //         }
    
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data Pasangan berhasil disimpan'
    //         ]);
    
    //     } catch (\Throwable $e) {
    
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage()
    //         ], 500);
    
    //     }
    // }
    public function store_history(Request $request)
{
    try {

        $request->validate([
            'teach' => 'required|array',
            'teach.*.subject_name' => 'required',
            'teach.*.name_school'  => 'required',
            'teach.*.class'        => 'required',
            'teach.*.jp'           => 'required',
            'teach.*.year'         => 'required',
            'teach.*.status'       => 'required',
        ]);

        $teacher = Teacher::where(
            'tcr_user_id',
            Auth::user()->usr_id
        )->first();
 
        if (!$teacher) {
            return response()->json([
                'success' => false,
                'message' => 'Data teacher tidak ditemukan'
            ],404);
        }

        
        // Hapus dulu data lama
        Teach_History::where(
            'tcs_teacher_id',
            $teacher->tcr_id
        )->delete();
        // dd(
        //     $teacher->tcr_id,
        //     Teach_History::where('tcs_teacher_id', $teacher->tcr_id)->count()
        // );
        // Simpan ulang
        foreach ($request->teach as $teach) {

            Teach_History::updateOrCreate([
                'tcs_teacher_id'  => $teacher->tcr_id,
                'tcs_subject_name'=> $teach['subject_name'],
                'tcs_name_school' => $teach['name_school'],
                'tcs_class'       => $teach['class'],
                'tcs_jp'          => $teach['jp'],
                'tcs_year'        => $teach['year'],
                'tcs_status'      => $teach['status'],
            ]);

        }

        return response()->json([
            'success' => true,
            'message' => 'Riwayat mengajar berhasil disimpan'
        ]);

    } catch (\Throwable $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ],500);

    }
}
    public function store_education(Request $request)
    {
        try {   
            $teacher = Teacher::where('tcr_user_id', Auth::user()->usr_id)->first();

        if (!$teacher) {
            return response()->json([
                'success' => false,
                'message' => 'Data guru tidak ditemukan'
            ], 400);
                }
                // TeacherEducation::where('tce_bio_id', $tcb_id)->delete();
                TeacherEducation::where('tce_teacher_id', $teacher->tcr_id)->delete();
                foreach ($request->education as $edu) {
                    TeacherEducation::updateOrCreate([
                        'tce_teacher_id' => $teacher->tcr_id,
                        'tce_level' => $edu['level'] ?? null,
                        'tce_institution' => $edu['institution'] ?? null,
                        'tce_graduation_year' => $edu['graduation_year'] ?? null,
                        'tce_major' => $edu['major'] ?? null,
                        'tce_degree' => $edu['degree'] ?? null,
                    ]);
                }

            return response()->json([
                'success' => true,
                'message' => 'Riwayat pendidikan berhasil disimpan'
            ]);
    
        } catch (\Throwable $e) {
    
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
    
        }
    }
    
    public function finish()
{
    $teacher = Teacher::with('teacherBio')
        ->where('tcr_user_id', Auth::user()->usr_id)
        ->first();

    if (!$teacher || !$teacher->teacherBio) {
        return response()->json([
            'success' => false,
            'message' => 'Biodata belum ditemukan.'
        ], 404);
    }

    $teacher->teacherBio->update([
        'tcb_status' => 'pending'
    ]);

    return response()->json([
        'success' => true,
        'redirect' => route('teacher.prospectiveTeacher.waiting')
    ]);
//     $biodata = Teacher_Bio::find(session('tcb_id'));

// $biodata->tcb_status = 'pending';

// $biodata->save();
    // session()->forget('tcb_id');

    // return response()->json([
    //     'success' => true,
    //     'redirect' => route('teacher.prospectiveTeacher.waiting')
    // ]);
}



    /**
     * Show the form for creating a new resource.
     */
    public function waiting()
    {
        return view('halooo ini waiting');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
