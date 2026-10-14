<?php

namespace App\Http\Controllers\administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Ppdb;
use App\Models\PpdbSubmission;
use App\Models\PpdbRequirement;

class StudentController extends Controller
{
    public function index()
    {
        $student = user::role('student')->get();
        // dd($student);
        return view('administration.student.index', compact(['student']));
    }

    public function studentWithLevel($level)
    {
        $student = User::role('student')
            ->whereHas('student.classes', function ($query) use ($level) {
                $query->where('cls_level', $level);
            })
            ->with([
                'student.classes.cls_major'
            ])
            ->get();

        return view('administration.student.index', compact('student'));
    }

    public function show($id){

    $studentId = Student::where('std_usr_id',$id)->firstOrFail();
         $student   = PpdbSubmission::where('ppsu_student_id',$studentId->std_id)->firstOrFail();
        //  dd($student);
         $documents = PpdbRequirement::with(['upload' => fn($q) => $q->where('psr_std_id', $studentId->std_id)])
                    ->where('pdr_ppdb_id', $student->ppsu_ppdb_id)
                    ->get()
                    ->map(function ($req) {
                        $req->file_path = $req->upload->psr_value ?? null;
                        return $req;
                    });
                    // dd($student->student);
        // dd($documents->upload);
        // foreach($documents as $doc){
        
        //         dd($doc->upload);
        //     }
        // }

        return view('administration.student.show', compact('student', 'documents','studentId'));
    }
   
}
