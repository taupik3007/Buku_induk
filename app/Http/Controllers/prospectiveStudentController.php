<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Religion;
use App\Models\Family;
use App\Models\StudentBiodata;
use Illuminate\Support\Facades\DB;



class prospectiveStudentController extends Controller
{
 
    public function biodata(){
        // dd(StudentBiodata::all());
            // $userId = auth()->user()->usr_id;
            // dd($userId);

        $religion = Religion::all();
        return view('prospectiveStudent.biodata',compact(['religion']));
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

            // // =====================
            // // student__biodatas
            // // =====================
            StudentBiodata::updateOrCreate(
                ['stb_usr_id' => $userId],
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
                ['fml_user_id' => $userId],
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
}
