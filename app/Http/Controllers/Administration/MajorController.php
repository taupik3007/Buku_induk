<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Majors;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Majors::all();
        $title = 'Hapus Jurusan!';
        $text = "Apakah Anda yakin ingin menghapus?";
        confirmDelete($title, $text);
        return view('administration.major.index', compact(['majors']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.major.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $create_major = Majors::create([
            'mjr_name' => $request->mjr_name,
            'mjr_abbr' => $request->mjr_abbr,
        ]); 
        Alert::success('Berhasil Menambah', 'Berhasil menambah data jurusan');
        return redirect('/administration/major');
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
    public function edit(Majors $majors, $id)
    {
        $edit_major = Majors::findOrFail($id);
        return view('administration.major.edit', compact(['edit_major']));
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
