<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Religion;
use App\Models\Address;
use App\Models\Family;
use App\Models\StudentBiodata;
use App\Models\PpdbRequirement;
use App\Models\PhysicalCondition;
use App\Models\Previous_Education;
use Illuminate\Support\Facades\DB;



class prospectiveStudentController extends Controller
{
 
    public function biodata(){
        $studentId = auth()->user()->student->std_id;
        $biodata = StudentBiodata::where('stb_student_id',$studentId)->first();
        $family = Family::where('fml_student_id',$studentId)->first();
        $address = Address::where('adr_user_id',auth()->user()->usr_id)->first();
        $physicalCondition = PhysicalCondition::where('phy_student_id',$studentId)->first();
        // dd($address);
        // dd($physicalCondition);

        // dd($studentId);
            // dd($userId);


        /*
            Step 2
        */
            

        $religion = Religion::all();
        return view('prospectiveStudent.biodata',compact(['religion','biodata','family','address','physicalCondition']));
    }
       public function StepOne(Request $request)
    {
        $request->validate([
            // student__biodatas
            'stb_gender'        => 'required|integer',
            'stb_birth_place'   => 'required|string',
            'stb_birth_date'    => 'required|date',
            'stb_religion_id'   => 'required|integer',
            'stb_nationality'   => 'required|string',
            'stb_language'      => 'required|string',
            'stb_telp'          => 'required|string',
            'stb_living_with'   => 'required|integer',

            // families
            'fml_birth_order'       => 'required|integer',
            'fml_sibling'           => 'required|integer',
            'fml_step_sibling'      => 'nullable|integer',
            'fml_adoptive_sibling'  => 'nullable|integer',
            'fml_status'            => 'required|integer',
        ]);
        // dd($request->all());
        // DB::beginTransaction();

        try {
            $userId = auth()->user()->usr_id;

            $studentId = auth()->user()->student->std_id;

            // // =====================
            // // student__biodatas
            // // =====================
            StudentBiodata::updateOrCreate(
                ['stb_student_id' => $studentId],
                [
                    'stb_gender'        => $request->stb_gender,
                    'stb_birth_place'   => $request->stb_birth_place,
                    'stb_birth_date'    => $request->stb_birth_date,
                    'stb_religion_id'   => $request->stb_religion_id,
                    'stb_nationality'   => $request->stb_nationality,
                    'stb_language'      => $request->stb_language,
                    'stb_telp'          => $request->stb_telp,
                    'stb_living_with'   => $request->stb_living_with,
                    'stb_created_by'    => $userId,
                    'stb_updated_by'    => $userId,
                ]
            );

            // // =====================
            // // families
            // // =====================
            Family::updateOrCreate(
                ['fml_student_id' => $studentId],
                [
                    'fml_birth_order'      => $request->fml_birth_order,
                    'fml_sibling'          => $request->fml_sibling,
                    'fml_step_sibling'     => $request->fml_step_sibling ?? 0,
                    'fml_adoptive_sibling' => $request->fml_adoptive_sibling ?? 0,
                    'fml_status'           => $request->fml_status,
                    'fml_created_by'       => $userId,
                    'fml_updated_by'       => $userId,
                ]
            );

            // // DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Step 1 berhasil disimpan'
            ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
          
    }




    public function stepTwo(Request $request){
        $userId = auth()->user()->usr_id;

         $validated = $request->validate([
        'adr_province'     => 'required|string',
        'adr_regency'      => 'required|string',
        'adr_district'     => 'required|string',
        'adr_village'      => 'required|string',
        'adr_postal_code'  => 'nullable|digits:5',
        'adr_distance'     => 'nullable|numeric',
        'adr_detail'       => 'required|string|max:500',
    ]);

    DB::beginTransaction();

    try {

        $student = Address::updateOrCreate(
    ['adr_user_id' => $userId],
    [
        'adr_province'     => $request->adr_province,
        'adr_regency'      => $request->adr_regency,
        'adr_district'     => $request->adr_district,
        'adr_village'      => $request->adr_village,
        'adr_postal_code'  => $request->adr_postal_code,
        'adr_distance'     => $request->adr_distance,
        'adr_detail'       => $request->adr_detail,
    ]
);


        DB::commit();

        return response()->json([
            'status'  => true,
            'message' => 'Data alamat berhasil disimpan.',
            // 'data'    => $student
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status'  => false,
            'message' => 'Terjadi kesalahan saat menyimpan data.',
            'error'   => $e->getMessage()
        ], 500);
    }
    }

    public function stepThree(Request $request){
          $userId = auth()->user()->usr_id;
        $studentId = auth()->user()->student->std_id;


    $validated = $request->validate([
        'phy_blood_type' => 'required|string|max:3',
        'phy_illness'    => 'nullable|string|max:255',
        'phy_disability' => 'nullable|string|max:255',
        'phy_height'     => 'required|numeric|min:0|max:300',
        'phy_weight'     => 'required|numeric|min:0|max:300',
    ]);

    DB::beginTransaction();

    try {

        $physical = PhysicalCondition::updateOrCreate(
            ['phy_student_id' => $studentId],
            [
                'phy_blood_type' => $request->phy_blood_type,
                'phy_illness'    => $request->phy_illness,
                'phy_disability' => $request->phy_disability,
                'phy_height'     => $request->phy_height,
                'phy_weight'     => $request->phy_weight,
            ]
        );

        DB::commit();

        return response()->json([
            'status'  => true,
            'message' => 'Data fisik berhasil disimpan.',
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status'  => false,
            'message' => 'Terjadi kesalahan saat menyimpan data.',
            'error'   => $e->getMessage()
        ], 500);
    }
    }

    public function stepFour(Request $request)
{
    $userId    = auth()->user()->usr_id;
    $studentId = auth()->user()->student->std_id;

    $validated = $request->validate([
        'fml_father_name'        => 'required|string|max:255',
        'fml_father_religion_id' => 'required|numeric',
        'fml_father_nationality' => 'required|string|max:255',
        'fml_father_education'   => 'required|string|max:255',
        'fml_father_occupation'  => 'required|string|max:255',
        'fml_father_income'      => 'required|numeric|min:0',
        'fml_father_address'     => 'required|string|max:1000',
        'fml_father_phone'       => 'required|string|max:20',
        // 'fml_father_status'      => 'required|numeric|max:100',
    ]);

    DB::beginTransaction();

    try {

        $family = Family::updateOrCreate(
            ['fml_student_id' => $studentId],
            $validated
        );

        DB::commit();

        return response()->json([
            'status'  => true,
            'message' => 'Data ayah berhasil disimpan.',
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status'  => false,
            'message' => 'Terjadi kesalahan saat menyimpan data.',
            'error'   => $e->getMessage()
        ], 500);
    }
}
public function stepFive(Request $request)
{
   $userId    = auth()->user()->usr_id;
$studentId = auth()->user()->student->std_id;

$validated = $request->validate([
    'fml_mother_name'        => 'required|string|max:255',
    'fml_mother_religion_id' => 'required|numeric',
    'fml_mother_nationality' => 'required|string|max:255',
    'fml_mother_education'   => 'required|string|max:255',
    'fml_mother_occupation'  => 'required|string|max:255',
    'fml_mother_income'      => 'required|numeric|min:0',
    'fml_mother_address'     => 'required|string|max:1000',
    'fml_mother_phone'       => 'required|string|max:20',
]);

DB::beginTransaction();

try {

    $family = Family::updateOrCreate(
        ['fml_student_id' => $studentId],
        $validated
    );

    DB::commit();

    return response()->json([
        'status'  => true,
        'message' => 'Data ibu berhasil disimpan.',
    ]);

} catch (\Exception $e) {

    DB::rollBack();

    return response()->json([
        'status'  => false,
        'message' => 'Terjadi kesalahan saat menyimpan data.',
        'error'   => $e->getMessage()
    ], 500);
}
}
public function stepSix(Request $request)
{
   $userId    = auth()->user()->usr_id;
$studentId = auth()->user()->student->std_id;

$validated = $request->validate([
    'fml_guardian_name'        => 'nullable|string|max:255',
    'fml_guardian_religion_id' => 'nullable|numeric',
    'fml_guardian_nationality' => 'nullable|string|max:255',
    'fml_guardian_education'   => 'nullable|string|max:255',
    'fml_guardian_occupation'  => 'nullable|string|max:255',
    'fml_guardian_income'      => 'nullable|numeric|min:0',
    'fml_guardian_address'     => 'nullable|string|max:1000',
    'fml_guardian_phone'       => 'nullable|string|max:20',
]);

DB::beginTransaction();

try {

    $family = Family::updateOrCreate(
        ['fml_student_id' => $studentId],
        $validated
    );

    DB::commit();

    return response()->json([
        'status'  => true,
        'message' => 'Data wali berhasil disimpan.',
    ]);

} catch (\Exception $e) {

    DB::rollBack();

    return response()->json([
        'status'  => false,
        'message' => 'Terjadi kesalahan saat menyimpan data.',
        'error'   => $e->getMessage()
    ], 500);
}
}
 public function ppdbRegistration(){
 
        // dd($address);
        // dd($physicalCondition);

        // dd($studentId);
            // dd($userId);


        /*
            Step 2
        */
            
        // $previous_education = Previous_Education::all();
    //  $studentId = auth()->user()->student->std_id;
// dd($studentId);
        // dd($previous_education);
        $requirements       = PpdbRequirement::all();
        $studentId = auth()->user()->student->std_id;

        // dd($requirements);
        $previousEducation = Previous_Education::where('prv_student_id',$studentId)->first();

        $religion = Religion::all();
        return view('prospectiveStudent.ppdb_registration.index',compact(['requirements','previousEducation']));
    }


    public function stepSeven(Request $request)
    {
     $studentId = auth()->user()->student->std_id;
    $validated = $request->validate([
        'prv_school_name'        => 'required|string|max:255',
        'prv_npsn'               => 'required|digits:8',
        'prv_certificate_number' => 'nullable|numeric',
    ], [
        'prv_school_name.required' => 'Nama sekolah wajib diisi.',
        'prv_npsn.required'        => 'NPSN wajib diisi.',
        'prv_npsn.digits'          => 'NPSN harus 8 digit angka.',
        'prv_certificate_number.numeric' => 'Nomor ijazah harus berupa angka.',
    ]);

    Previous_Education::updateOrCreate(
        ['prv_student_id' => $studentId],
        [
            'prv_school_name'        => $validated['prv_school_name'],
            'prv_npsn'               => $validated['prv_npsn'],
            'prv_certificate_number' => $validated['prv_certificate_number'] ?? null,
            'prv_created_by'         => auth()->id(),
            'prv_updated_by'         => auth()->id(),
        ]
    );

    return response()->json(['success' => true]);
}





}
