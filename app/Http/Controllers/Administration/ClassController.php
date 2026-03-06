<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Academic_Year;
use App\Models\Classes;
use App\Models\Majors;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class = Classes::with(['cls_major', 'cls_academic', 'cls_homeroom'])->get();
        $title = 'Hapus Kelas!';
        $text = "Apakah Anda yakin ingin menghapus?";
        confirmDelete($title, $text);
        return view('administration.class.index', compact(['class']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $homeroom = User::role('teacher')->get();
        $academic_year = Academic_Year::all();
        $majors = Majors::all();
        return view('administration.class.create', compact('homeroom', 'academic_year', 'majors' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $major = Majors::find($request->cls_major_id);
        $academic_year = Academic_Year::find($request->cls_acy_id);

        $prefix = $major->mjr_abbr . '-' . $academic_year->acy_year . '-';

        $lastClass = Classes::where('cls_code', 'like', $prefix . '%')
        ->orderBy('cls_code', 'desc')
        ->first();

    if ($lastClass) {
        $lastNumber = (int) substr($lastClass->cls_code, -2);
        $newNumber  = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    $numberFormatted = str_pad($newNumber, 2, '0', STR_PAD_LEFT);

    $classCode = $prefix . $numberFormatted;

        $CreateClass = Classes::create([
            'cls_code' => $classCode,
            'cls_level' => $request->cls_level,
            'cls_major_id' => $request->cls_major_id,
            'cls_number' => $request->cls_number,
            'cls_homeroom_id' => $request->cls_homeroom_id,
            'cls_acy_id' => $request->cls_acy_id,
        ]); 
        Alert::success('Berhasil Menambah', 'Berhasil menambah data tahun ajaran');
        return redirect('/administration/classes');
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
        $edit_class = Classes::findOrFail($id);
        $homeroom = User::role('teacher')->get();
        $academic_year = Academic_Year::all();
        $majors = Majors::all();
        return view('administration.class.edit', compact(['edit_class','homeroom', 'academic_year', 'majors']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $class = Classes::findOrFail($id);

    // Ambil relasi baru dari request
    $major = Majors::find($request->cls_major_id);
    $academic_year = Academic_Year::find($request->cls_acy_id);

    // Prefix baru
    $prefix = $major->mjr_abbr . '-' . $academic_year->acy_year . '-';

    /*
    Cek apakah major / tahun berubah
    */
    if (
        $class->cls_major_id != $request->cls_major_id ||
        $class->cls_acy_id != $request->cls_acy_id
    ) {

        // Cari urutan terakhir di kombinasi baru
        $lastClass = Classes::where('cls_code', 'like', $prefix . '%')
            ->orderBy('cls_code', 'desc')
            ->first();

        if ($lastClass) {
            $lastNumber = (int) substr($lastClass->cls_code, -2);
            $newNumber  = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $numberFormatted = str_pad($newNumber, 2, '0', STR_PAD_LEFT);

        $classCode = $prefix . $numberFormatted;

    } else {
        // Kalau tidak berubah → pakai kode lama
        $classCode = $class->cls_code;
    }

    // Update data
    $class->update([
        'cls_code' => $classCode,
        'cls_level' => $request->cls_level,
        'cls_major_id' => $request->cls_major_id,
        'cls_number' => $request->cls_number,
        'cls_homeroom_id' => $request->cls_homeroom_id,
        'cls_acy_id' => $request->cls_acy_id,
    ]);

    Alert::success('Berhasil Update', 'Data kelas berhasil diperbarui');
    return redirect('/administration/classes');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyClass = Classes::findOrFail($id);
        //dd ($destroyScopeCategories);
        $destroyClass->delete();
        Alert::success('Berhasil Menghapus', 'Berhasil menghapus data jurusan');
        return redirect('/administration/classes');
    }
}
