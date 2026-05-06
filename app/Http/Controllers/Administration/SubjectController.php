<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Majors;
use App\Models\Subject;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('major')->get();
        return view('administration.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Majors::all();
        return view('administration.subject.create', compact('majors'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $create_subject = Subject::create([
            'sbj_name' => $request->sbj_name,
            'sbj_code' => $request->sbj_code,
            'sbj_level' => $request->sbj_level,
            'sbj_major_id' => $request->sbj_major_id,
        ]); 
        Alert::success('Berhasil Menambah', 'Berhasil menambah data jurusan');
        return redirect('/administration/subject');
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
        $edit_subject = Subject::findOrFail($id);
        $majors = Majors::all();
        return view('administration.subject.edit', compact(['edit_subject', 'majors']));
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
