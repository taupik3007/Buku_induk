<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Religion;
use App\Models\Address;
use App\Models\Family;
use App\Models\StudentBiodata;
use App\Models\PhysicalCondition;
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

], [

    // ========================
    // BIODATA
    // ========================

    'stb_gender.required'      => 'Jenis kelamin wajib dipilih.',
    'stb_gender.integer'       => 'Jenis kelamin tidak valid.',

    'stb_birth_place.required' => 'Tempat lahir wajib diisi.',
    'stb_birth_place.string'   => 'Tempat lahir tidak valid.',

    'stb_birth_date.required'  => 'Tanggal lahir wajib diisi.',
    'stb_birth_date.date'      => 'Format tanggal lahir tidak valid.',

    'stb_religion_id.required' => 'Agama wajib dipilih.',
    'stb_religion_id.integer'  => 'Agama tidak valid.',

    'stb_nationality.required' => 'Kewarganegaraan wajib dipilih.',
    'stb_nationality.string'   => 'Kewarganegaraan tidak valid.',

    'stb_language.required'    => 'Bahasa sehari-hari wajib diisi.',
    'stb_language.string'      => 'Bahasa tidak valid.',

    'stb_telp.required'        => 'Nomor telepon wajib diisi.',
    'stb_telp.string'          => 'Nomor telepon tidak valid.',

    'stb_living_with.required' => 'Status tempat tinggal wajib dipilih.',
    'stb_living_with.integer'  => 'Status tempat tinggal tidak valid.',


    // ========================
    // FAMILY
    // ========================

    'fml_birth_order.required' => 'Anak ke berapa wajib diisi.',
    'fml_birth_order.integer'  => 'Anak ke harus berupa angka.',

    'fml_sibling.required'     => 'Jumlah saudara kandung wajib diisi.',
    'fml_sibling.integer'      => 'Jumlah saudara kandung harus berupa angka.',

    'fml_step_sibling.integer' => 'Saudara tiri harus berupa angka.',

    'fml_adoptive_sibling.integer' => 'Saudara angkat harus berupa angka.',

    'fml_status.required'      => 'Status keluarga wajib dipilih.',
    'fml_status.integer'       => 'Status keluarga tidak valid.',
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
], [

    // ========================
    // REQUIRED
    // ========================

    'adr_province.required' => 'Provinsi wajib dipilih.',
    'adr_province.string'   => 'Provinsi tidak valid.',

    'adr_regency.required'  => 'Kabupaten / Kota wajib dipilih.',
    'adr_regency.string'    => 'Kabupaten / Kota tidak valid.',

    'adr_district.required' => 'Kecamatan wajib dipilih.',
    'adr_district.string'   => 'Kecamatan tidak valid.',

    'adr_village.required'  => 'Desa wajib dipilih.',
    'adr_village.string'    => 'Desa tidak valid.',

    'adr_detail.required'   => 'Alamat lengkap wajib diisi.',
    'adr_detail.string'     => 'Alamat lengkap tidak valid.',
    'adr_detail.max'        => 'Alamat lengkap maksimal 500 karakter.',

    // ========================
    // OPTIONAL FIELD VALIDATION
    // ========================

    'adr_postal_code.digits' => 'Kode pos harus terdiri dari 5 digit angka.',

    'adr_distance.numeric'   => 'Jarak rumah ke sekolah harus berupa angka.',
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
    'phy_illness'    => 'required|string|max:255',
    'phy_disability' => 'required|string|max:255',
    'phy_height'     => 'required|numeric|min:0|max:300',
    'phy_weight'     => 'required|numeric|min:0|max:300',
], [

    // Blood Type
    'phy_blood_type.required' => 'Golongan darah wajib diisi.',
    'phy_blood_type.string'   => 'Golongan darah harus berupa teks.',
    'phy_blood_type.max'      => 'Golongan darah maksimal 3 karakter.',

    // Illness
    'phy_illness.required' => 'Penyakit bawaan wajib diisi.',
    'phy_illness.string'   => 'Penyakit bawaan harus berupa teks.',
    'phy_illness.max'      => 'Penyakit bawaan maksimal 255 karakter.',

    // Disability
    'phy_disability.required' => 'Kelainan jasmani wajib diisi.',
    'phy_disability.string'   => 'Kelainan jasmani harus berupa teks.',
    'phy_disability.max'      => 'Kelainan jasmani maksimal 255 karakter.',

    // Height
    'phy_height.required' => 'Tinggi badan wajib diisi.',
    'phy_height.numeric'  => 'Tinggi badan harus berupa angka.',
    'phy_height.min'      => 'Tinggi badan tidak boleh kurang dari 0 cm.',
    'phy_height.max'      => 'Tinggi badan maksimal 300 cm.',

    // Weight
    'phy_weight.required' => 'Berat badan wajib diisi.',
    'phy_weight.numeric'  => 'Berat badan harus berupa angka.',
    'phy_weight.min'      => 'Berat badan tidak boleh kurang dari 0 kg.',
    'phy_weight.max'      => 'Berat badan maksimal 300 kg.',
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
    'fml_father_name'         => 'required|string|max:255',
    'fml_father_religion_id'  => 'required|integer',
    'fml_father_nationality'  => 'required|string|max:100',
    'fml_father_occupation'   => 'required|string|max:255',
    'fml_father_education'    => 'required|string|max:255',
    'fml_father_income'       => 'required|integer|in:1,2,3,4,5',
    'fml_father_address'      => 'required|string|max:500',
    'fml_father_phone'        => 'required|digits_between:10,15',
], [

    'fml_father_name.required' => 'Nama ayah wajib diisi.',
    'fml_father_name.max'      => 'Nama ayah maksimal 255 karakter.',

    'fml_father_religion_id.required' => 'Agama ayah wajib dipilih.',
    'fml_father_religion_id.integer'  => 'Agama tidak valid.',

    'fml_father_nationality.required' => 'Kewarganegaraan ayah wajib diisi.',
    'fml_father_nationality.max'      => 'Kewarganegaraan maksimal 100 karakter.',

    'fml_father_occupation.required' => 'Pekerjaan ayah wajib diisi.',
    'fml_father_education.required'  => 'Pendidikan terakhir ayah wajib diisi.',

    'fml_father_income.required' => 'Penghasilan ayah wajib dipilih.',
    'fml_father_income.in'       => 'Rentang penghasilan tidak valid.',

    'fml_father_address.required' => 'Alamat ayah wajib diisi.',
    'fml_father_address.max'      => 'Alamat maksimal 500 karakter.',

    'fml_father_phone.required'        => 'Nomor telepon ayah wajib diisi.',
    'fml_father_phone.digits_between'  => 'Nomor telepon harus 10–15 digit.',
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

$validated = $request->validate(

    [
        'fml_mother_name'        => 'required|string|max:255',
        'fml_mother_religion_id' => 'required|numeric',
        'fml_mother_nationality' => 'required|string|max:255',
        'fml_mother_education'   => 'required|string|max:255',
        'fml_mother_occupation'  => 'required|string|max:255',
        'fml_mother_income'      => 'required|numeric|min:0',
        'fml_mother_address'     => 'required|string|max:1000',
        'fml_mother_phone'       => 'required|digits_between:10,15',
    ],

    [
        'fml_mother_name.required'        => 'Nama ibu wajib diisi.',
        'fml_mother_name.max'             => 'Nama ibu maksimal 255 karakter.',

        'fml_mother_religion_id.required' => 'Agama ibu wajib dipilih.',
        'fml_mother_religion_id.numeric'  => 'Agama ibu tidak valid.',

        'fml_mother_nationality.required' => 'Kewarganegaraan ibu wajib diisi.',
        'fml_mother_nationality.max'      => 'Kewarganegaraan maksimal 255 karakter.',

        'fml_mother_education.required'   => 'Pendidikan ibu wajib diisi.',
        'fml_mother_education.max'        => 'Pendidikan maksimal 255 karakter.',

        'fml_mother_occupation.required'  => 'Pekerjaan ibu wajib diisi.',
        'fml_mother_occupation.max'       => 'Pekerjaan maksimal 255 karakter.',

        'fml_mother_income.required'      => 'Penghasilan ibu wajib diisi.',
        'fml_mother_income.numeric'       => 'Penghasilan harus berupa angka.',
        'fml_mother_income.min'           => 'Penghasilan tidak boleh kurang dari 0.',

        'fml_mother_address.required'     => 'Alamat ibu wajib diisi.',
        'fml_mother_address.max'          => 'Alamat maksimal 1000 karakter.',

        'fml_mother_phone.required'       => 'Nomor HP ibu wajib diisi.',
        'fml_mother_phone.digits_between'  => 'Nomor telepon harus 10–15 digit.',
    ]

);

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

$validated = $request->validate(

    [
        'fml_guardian_name'        => 'nullable|string|max:255',
        'fml_guardian_religion_id' => 'nullable|numeric',
        'fml_guardian_nationality' => 'nullable|string|max:255',
        'fml_guardian_education'   => 'nullable|string|max:255',
        'fml_guardian_occupation'  => 'nullable|string|max:255',
        'fml_guardian_income'      => 'nullable|numeric|min:0',
        'fml_guardian_address'     => 'nullable|string|max:1000',
        'fml_guardian_phone'       => 'nullable|string|max:20',
    ],

    [
        'fml_guardian_name.string'        => 'Nama wali harus berupa teks.',
        'fml_guardian_name.max'           => 'Nama wali maksimal 255 karakter.',

        'fml_guardian_religion_id.numeric'=> 'Agama wali tidak valid.',

        'fml_guardian_nationality.string' => 'Kewarganegaraan wali harus berupa teks.',
        'fml_guardian_nationality.max'    => 'Kewarganegaraan maksimal 255 karakter.',

        'fml_guardian_education.string'   => 'Pendidikan wali harus berupa teks.',
        'fml_guardian_education.max'      => 'Pendidikan maksimal 255 karakter.',

        'fml_guardian_occupation.string'  => 'Pekerjaan wali harus berupa teks.',
        'fml_guardian_occupation.max'     => 'Pekerjaan maksimal 255 karakter.',

        'fml_guardian_income.numeric'     => 'Penghasilan wali harus berupa angka.',
        'fml_guardian_income.min'         => 'Penghasilan wali tidak boleh kurang dari 0.',

        'fml_guardian_address.string'     => 'Alamat wali harus berupa teks.',
        'fml_guardian_address.max'        => 'Alamat maksimal 1000 karakter.',

        'fml_guardian_phone.string'       => 'Nomor HP wali harus berupa teks.',
        'fml_guardian_phone.max'          => 'Nomor HP maksimal 20 karakter.',
    ]

);

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



}
