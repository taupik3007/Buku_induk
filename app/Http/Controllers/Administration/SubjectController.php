<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Majors;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classes;
use App\Models\Academic_Year;
use App\Models\SubjectTeacher;



// use App\Models\Subject;

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
        $title = 'Hapus Mata Pelajaran!';
        $text = "Apakah Anda yakin ingin menghapus?";
        confirmDelete($title, $text);
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
        $validated = $request->validate([
            'sbj_name' => 'required|string|max:255',
            'sbj_code' => 'nullable|string|max:20|unique:subjects,sbj_code',
            'sbj_level' => 'required|in:10,11,12',
            'sbj_major_id' => 'nullable|exists:majors,mjr_id',
        ], [
            'sbj_name.required' => 'Nama mata pelajaran wajib diisi.',
            'sbj_name.max' => 'Nama mata pelajaran maksimal 255 karakter.',
            'sbj_code.unique' => 'Kode mata pelajaran sudah dipakai, coba yang lain.',
            'sbj_level.required' => 'Tingkat kelas wajib dipilih.',
            'sbj_level.in' => 'Tingkat kelas tidak valid.',
            'sbj_major_id.exists' => 'Jurusan yang dipilih tidak ditemukan.',
        ]);

        if ($request->sbj_major_id == null) {

            $majorPrefix = 'nor';

            $lastSubject = Subject::withTrashed()
                ->whereNull('sbj_major_id')
                ->where('sbj_level', $request->sbj_level)
                ->orderByDesc('sbj_id')
                ->first();
        } else {

            $major = Majors::findOrFail($request->sbj_major_id);

            $majorPrefix = $major->mjr_abbr;

            $lastSubject = Subject::withTrashed()
                ->where('sbj_major_id', $major->mjr_id)
                ->where('sbj_level', $request->sbj_level)
                ->orderByDesc('sbj_id')
                ->first();
        }

        $subjectNumber = $lastSubject
            ? ((int) last(explode('-', $lastSubject->sbj_code)) + 1)
            : 1;

        $subjectCode = $majorPrefix . '-' . $request->sbj_level . '-' . $subjectNumber;
        $create_subject = Subject::create([
            'sbj_name' => $request->sbj_name,
            'sbj_code' => $subjectCode, // pake hasil generate, bukan $request->sbj_code
            'sbj_level' => $request->sbj_level,
            'sbj_major_id' => $request->sbj_major_id,
        ]);

        Alert::success('Berhasil Menambah', 'Berhasil menambah data mata pelajaran');
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
        // dd($request);
        $update_subject = Subject::findOrFail($id);
        $update_subject->sbj_name = $request->sbj_name;
        $update_subject->sbj_code = $request->sbj_code;
        $update_subject->sbj_level = $request->sbj_level;
        $update_subject->sbj_major_id = $request->sbj_major_id;
        $update_subject->save();

        Alert::success('Berhasil Mengedit', 'Berhasil mengubah data mata pelajaran');
        return redirect('/administration/subject');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy_subject = Subject::findOrFail($id);
        //dd ($destroyScopeCategories);
        $destroy_subject->delete();
        Alert::success('Berhasil Menghapus', 'Berhasil menghapus data mata pelajaran');
        return redirect('/administration/subject');
    }

    public function subjectTeachers($id)
    {
        return view('administration.subject.subjectTeachers');
    }

    public function createSubjectTeacher($id)
    {
        $subject = Subject::findOrFail($id);
        // dd($subject);

        $teachers = Teacher::with('user')->get();
        // dd($teachers);s
        $classes = Classes::with('cls_major')
            ->where('cls_level', $subject->sbj_level)
            ->get();
        // dd($classes);
        return view('administration.subject.createSubjectTeacher', compact(['subject', 'teachers', 'classes']));
    }

    public function storeSubjectTeacher(Request $request, $id)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,tcr_id',
            'class_id' => 'required|exists:classes,cls_id',
            'total_hours' => 'required|integer|min:2|max:20',
        ], [
            'teacher_id.required' => 'Guru pengampu wajib dipilih.',
            'teacher_id.exists' => 'Guru yang dipilih tidak ditemukan.',

            'class_id.required' => 'Kelas wajib dipilih.',
            'class_id.exists' => 'Kelas yang dipilih tidak ditemukan.',

            'total_hours.required' => 'Jumlah jam wajib diisi.',
            'total_hours.integer' => 'Jumlah jam harus berupa angka.',
            'total_hours.min' => 'Jumlah jam minimal 2 JP.',
            'total_hours.max' => 'Jumlah jam maksimal 20 JP.',
        ]);

        $subject = Subject::findOrFail($id);

        // Tahun ajaran aktif
        $academicYear = Academic_Year::where('acy_status', 1)->firstOrFail();

        // Cek apakah kelas tersebut sudah mempunyai pengampu
        // untuk mapel yang sama di tahun ajaran aktif
        $exists = SubjectTeacher::where('subt_subject_id', $subject->sbj_id)
            ->where('subt_class_id', $validated['class_id'])
            ->where('subt_academic_year_id', $academicYear->acy_id)
            ->exists();

        if ($exists) {
            Alert::error(
                'Gagal',
                'Kelas tersebut sudah memiliki pengampu untuk mata pelajaran ini.'
            );

            return redirect()->back()->withInput();
        }

        SubjectTeacher::create([
            'subt_subject_id' => $subject->sbj_id,
            'subt_class_id' => $validated['class_id'],
            'subt_teacher_id' => $validated['teacher_id'],
            'subt_academic_year_id' => $academicYear->acy_id,
            'subt_total_hours' => $validated['total_hours'],
            'subt_created_by' => auth()->id(),
        ]);

        Alert::success(
            'Berhasil Menambah',
            'Pengampu mata pelajaran berhasil ditambahkan.'
        );

        return redirect()->route(
            'administration.subjectTeacher',
            $subject->sbj_id
        );
    }
}
