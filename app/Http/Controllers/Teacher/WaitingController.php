<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Teacher_Bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaitingController extends Controller
{
    public function waiting()
    {
        $teacher = Teacher::with('teacherBio')
        ->where('tcr_user_id', Auth::id())
        ->first();

    $biodata = $teacher?->teacherBio;

    return view('teacher.prospectiveTeacher.waiting', compact('biodata'));
    }
    
    public function preview()
{
    $teacher = Teacher::with([
        'user',
        'teacherBio',
        'teacherEducation',
        'teachHistories',
        'teacherPartner',
    ])
    ->where('tcr_user_id', Auth::user()->usr_id)
    ->first();

    return view(
        'teacher.prospectiveTeacher.preview',
        compact('teacher')
    );
}
}
