<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\TeacherRequirement;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teach_req = TeacherRequirement::all();
        $title = 'Hapus Persyaratan!';
        $text = "Apakah Anda yakin ingin menghapus?";
        confirmDelete($title, $text);
        return view('administration.teacher_requirement.index', compact(['teach_req']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.teacher_requirement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tcq_name' => 'required|string|max:255',
            'tcq_type' => 'required|in:text,file,number,date',
        ]);
        // dd($request);
    
        TeacherRequirement::create([
            'tcq_name'    => $request->tcq_name,
            'tcq_type'    => $request->tcq_type,
        ]);
        
        Alert::success('Berhasil Menambah', 'Berhasil menambah data persyaratan guru');
        return redirect('/administration/teacher-requirement');
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
        $edit_req = TeacherRequirement::findOrFail($id);
        return view('administration.teacher_requirement.edit', compact(['edit_req']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update_req =TeacherRequirement::findOrFail($id); 
        $update_req->tcq_name = $request->tcq_name;
        $update_req->tcq_type = $request->tcq_type;
        $update_req->save();

        Alert::success('Berhasil Mengedit', 'Berhasil mengubah data jurusan');
        return redirect('/administration/teacher-requirement');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy_req = TeacherRequirement::findOrFail($id);
        //dd ($destroyScopeCategories);
        $destroy_req->delete();
        Alert::success('Berhasil Menghapus', 'Berhasil menghapus persyaratan');
        return redirect('/administration/teacher-requirement');
    }
}
