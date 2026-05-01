<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherRequirement;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = User::role('teacher')->where('usr_status', 0)
        ->orderBy('created_at', 'asc') // atau kolom lain
        ->get();

        return view('administration.teacher_reception.index', compact('teacher'));
    }

    public function accept($id)
{
    $user = User::findOrFail($id);
    $user->usr_status = 1; // diterima
    $user->save();

    Alert::success(
        'Berhasil Diterima',
        'Kandidat ' . $user->usr_name . ' berhasil diterima menjadi Guru'
    );
    return redirect('/administration/teacher-reception');
}

public function reject($id)
{
    $user = User::findOrFail($id);
    $user->usr_status = 2; // ditolak
    $user->save();

    Alert::success('Berhasil Mengedit', 'Berhasil mengubah data jurusan');
    return redirect('/administration/teacher-reception');
}

public function accepted()
{
    $teacher = User::role('teacher')->where('usr_status', 1)
    ->orderBy('created_at', 'asc') // atau kolom lain
    ->get();

    return view('administration.teacher_reception.accepted', compact('teacher'));
}

public function rejected()
{
    $teacher = User::role('teacher')->where('usr_status', 2)
    ->orderBy('created_at', 'asc') // atau kolom lain
    ->get();

    return view('administration.teacher_reception.rejected', compact('teacher'));
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
        $teacher   = User::with([
            'teacherBio.address',
            'teacherBio.partner',
            'teacherBio.history',
            'teacherBio.education',
        ])->findOrFail($id);;

        $documents = TeacherRequirement::with(['upload' => fn($q) => $q->where('usr_id', $id)])
                   ->get()
                   ->map(function ($req) {
                       $req->file_path = $req->upload->file_path ?? null;
                       return $req;
                   });
       return view('administration.teacher_reception.show', compact('teacher', 'documents'));
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
