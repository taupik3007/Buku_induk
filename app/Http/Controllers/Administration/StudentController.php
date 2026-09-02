<?php

namespace App\Http\Controllers\administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
}
