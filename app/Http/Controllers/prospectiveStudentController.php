<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Religion;
use App\Models\Address;
use App\Models\Family;
use App\Models\StudentBiodata;
use Illuminate\Support\Facades\DB;



class prospectiveStudentController extends Controller
{
 
    public function biodata(){
        $studentId = auth()->user()->student->std_id;
        $biodata = StudentBiodata::where('stb_student_id',$studentId)->first();
        $family = Family::where('fml_student_id',$studentId)->first();
        $address = Address::where('adr_user_id',auth()->user()->usr_id)->first();
        // dd($address);
        // dd($studentId);
            // dd($userId);


        /*
            Step 2
        */
            

        $religion = Religion::all();
        return view('prospectiveStudent.biodata',compact(['religion','biodata','family','address']));
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
}
