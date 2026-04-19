<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpdbSubmission;
use App\Models\Majors;

class ClassAssignmentController extends Controller
{
    public function index(){
        $majorCount = Majors::count();
        // Controller
        $major = Majors::withCount([
            'ppdbSubmissions as accepted_students_count' => fn($q) => $q->where('ppsu_status', 1)
        ])->get();
        // dd(Majors::with('ppdbSubmissions')->first());
        $studentCount = PpdbSubmission::where('ppsu_status',1)->count();
        return view('administration.class-assignment.index',compact('studentCount','majorCount','major'));
    }
}
