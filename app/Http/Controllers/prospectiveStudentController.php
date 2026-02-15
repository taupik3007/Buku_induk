<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Religion;


class prospectiveStudentController extends Controller
{
 
    public function biodata(){
        $religion = Religion::all();
        return view('prospectiveStudent.biodata',compact(['religion']));
    }
      public function saveStep(Request $request, $step)
    {
        $id = $request->registration_id;

        $data = match ($step) {
            1 => $request->only([
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'agama',
                'anak_ke'
            ]),
            2 => $request->only([
                'provinsi',
                'kabupaten',
                'kecamatan',
                'desa',
                'kode_pos',
                'alamat'
            ]),
            3 => $request->only([
                'golongan_darah',
                'tinggi_badan',
                'berat_badan'
            ]),
            4 => $request->only([
                'nama',
                'pendidikan',
                'pekerjaan',
                'penghasilan'
            ]),
            5 => $request->only([
                'ibu_nama',
                'ibu_pendidikan',
                'ibu_pekerjaan'
            ]),
            6 => $request->only([
                'wali_nama',
                'wali_pekerjaan'
            ]),
        };

        $record = Registration::updateOrCreate(
            ['id' => $id],
            $data
        );

        return response()->json([
            'success' => true,
            'id' => $record->id
        ]);
    }
}
