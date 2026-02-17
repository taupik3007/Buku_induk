<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Teach_History;
use App\Models\Teacher_Address;
use App\Models\Teacher_Bio;
use App\Models\Teacher_Partner;
use App\Models\TeacherEducation;
use Illuminate\Http\Request;

class prospectiveTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function biodata()
    {
        return view('teacher.prospectiveTeacher.biodata');
    }

    public function store_biodata(Request $request)
    {
        try {
            $request->validate([
                'tcb_user_name'   => 'required',
                'tcb_birth_place' => 'required',
                'tcb_birth_date' => 'required|date',
                'tcb_religion'   => 'required',
                'tcb_mary_status'=> 'required',
                'tcb_telp'       => 'required'
            ]);
            $teacher = Teacher_Bio::updateOrCreate([
                'tcb_id' => $request->tcb_id],
                [
                'tcb_user_name'   => $request->tcb_user_name,
                'tcb_birth_place' => $request->tcb_birth_place,
                'tcb_birth_date' => $request->tcb_birth_date,
                'tcb_religion'   => $request->tcb_religion,
                'tcb_mary_status'=> $request->tcb_mary_status,
                'tcb_telp'       => $request->tcb_telp,
            ]);
            session(['tcb_id' => $teacher->tcb_id]);
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
                'tca_regency'     => 'required',
                'tca_district' => 'required',
                'tca_village'  => 'required',
            ]);
    
            // ambil id biodata dari session step 1
            $tcb_id = session('tcb_id');
    
            if(!$tcb_id){
                return response()->json([
                    'success' => false,
                    'message' => 'Session biodata tidak ditemukan'
                ], 400);
            }
    
            $address = Teacher_Address::updateOrCreate(
                ['tca_bio_id' => $tcb_id], // kondisi
                [
                    'tca_detail' => $request->tca_detail,
                    'tca_province' => $request->tca_province,
                    'tca_regency'     => $request->tca_regency,
                    'tca_district' => $request->tca_district,
                    'tca_village'  => $request->tca_village,
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
    
            $request->validate([
                'tcp_name' => 'required',
                'tcp_nik'     => 'required',
                'tcp_work' => 'required',
                'tcp_nip'  => 'required',
            ]);
    
            // ambil id biodata dari session step 1
            $tcb_id = session('tcb_id');
    
            if(!$tcb_id){
                return response()->json([
                    'success' => false,
                    'message' => 'Session biodata tidak ditemukan'
                ], 400);
            }
    
            $address = Teacher_Partner::updateOrCreate(
                ['tcp_bio_id' => $tcb_id], // kondisi
                [
                    'tcp_name' => $request->tcp_name,
                    'tcp_nik' => $request->tcp_nik,
                    'tcp_work'     => $request->tcp_work,
                    'tcp_nip' => $request->tcp_nip,
                ]
            );
    
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
    
    public function store_history(Request $request)
    {
        try {
    
            $request->validate([
                'tcs_subject_name' => 'required',
                'tcs_name_school'     => 'required',
                'tcs_class' => 'required',
                'tcs_jp'  => 'required',
                'tcs_year'  => 'required',
                'tcs_status'  => 'required',
            ]);
    
            // ambil id biodata dari session step 1
            $tcb_id = session('tcb_id');
    
            if(!$tcb_id){
                return response()->json([
                    'success' => false,
                    'message' => 'Session biodata tidak ditemukan'
                ], 400);
            }
    
            $address = Teach_History::updateOrCreate(
                ['tcs_bio_id' => $tcb_id], // kondisi
                [
                    'tcs_subject_name' => $request->tcs_subject_name,
                    'tcs_name_school' => $request->tcs_name_school,
                    'tcs_class'     => $request->tcs_class,
                    'tcs_jp' => $request->tcs_jp,
                    'tcs_year' => $request->tcs_year,
                    'tcs_status' => $request->tcs_status,
                ]
            );
    
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
    
    public function store_education(Request $request)
    {
        try {
    
            foreach ($request->education as $edu) {
                $tcb_id = session('tcb_id');
    
                if(!$tcb_id){
                    return response()->json([
                        'success' => false,
                        'message' => 'Session biodata tidak ditemukan'
                    ], 400);
                }
                TeacherEducation::create([
                    'tce_bio_id' => $tcb_id,
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
    



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
