<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherRequirement;
use App\Models\TeacherSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $teacher = Teacher::where('tcr_user_id', Auth::id())->first();

        if ($teacher) {
        
            $totalRequirement = TeacherRequirement::count();
        
            $completed = TeacherSubmission::where(
                'tsb_teacher_id',
                $teacher->tcr_id
            )->count();
        
        } else {
        
            $totalRequirement = 0;
            $completed = 0;
        
        }
        
        $percent = $totalRequirement > 0
            ? round(($completed / $totalRequirement) * 100)
            : 0;
        // $needPhoto = empty($user->usr_photo);
        return view('teacher.dashboard', compact('user', 'completed','totalRequirement','percent'));
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
        //
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
