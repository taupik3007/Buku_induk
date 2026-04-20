<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpdbSubmission;
use App\Models\Majors;
use App\Models\Ppdb;


class ClassAssignmentController extends Controller
{
    public function index(Request $request){
         $ppdbList = Ppdb::orderByDesc('ppd_id')->get();
    
    // Default: PPDB aktif atau yang pertama
    $selectedPpdb = $request->ppd_id 
        ? Ppdb::find($request->ppd_id) 
        : $ppdbList->first();
    // $studentCount = PpdbSubmission::where('ppsu_status',1)
    $major = Majors::withCount([
        'ppdbSubmissions as accepted_students_count' => fn($q) => $q
            ->where('ppsu_status', 1)
            ->where('ppsu_ppdb_id', $selectedPpdb->ppd_id)
    ])->get();
    // $major = Majors::with('ppdbSubmissions')->get();
    // dd($major);
    $studentCount =PpdbSubmission::where('ppsu_ppdb_id',$selectedPpdb->ppd_id)->where('ppsu_status',1)->count();

    return view('administration.class-assignment.index', compact('major', 'ppdbList', 'selectedPpdb','studentCount'));
    }
}
