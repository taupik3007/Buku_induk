<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherRequirement;
use App\Models\TeacherSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Teacher::where('tcr_user_id', Auth::id())->firstOrFail();

        // Total seluruh persyaratan
        $totalRequirement = TeacherRequirement::count();
    
        // Jumlah persyaratan yang sudah diisi
        $completed = TeacherSubmission::where('tsb_teacher_id', $teacher->tcr_id)
            ->count();
    
        // Persentase progress
        $percent = $totalRequirement > 0
            ? round(($completed / $totalRequirement) * 100)
            : 0;
    
        return view('teacher.teacher_requirement.index', compact(
            'teacher',
            'totalRequirement',
            'completed',
            'percent'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     $requirements = TeacherRequirement::orderBy('tcq_id')->get();

    // $teacher = Teacher::where('tcr_user_id', Auth::id())->first();
    $teacher = Teacher::where('tcr_user_id', Auth::user()->usr_id)->first();

    $teacherRequirement = TeacherSubmission::where('tsb_teacher_id', $teacher->tcr_id)
        ->get()
        ->keyBy('tsb_requirement_id');

    $completed = $teacherRequirement->count();

    $totalRequirement = $requirements->count();

    return view(
        'teacher.teacher_requirement.create',
        compact(
            'requirements',
            'teacherRequirement',
            'completed',
            'totalRequirement'
        )
    );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('MASUK STORE');
        $requirement = TeacherRequirement::findOrFail($request->tcq_id);
    
        switch ($requirement->tcq_type) {
    
            case 'text':
                $request->validate([
                    'value' => 'required|string'
                ]);
                break;
    
            case 'number':
                $request->validate([
                    'value' => 'required|numeric'
                ]);
                break;
    
            case 'date':
                $request->validate([
                    'value' => 'required|date'
                ]);
                break;
    
            case 'file':
                $request->validate([
                    'value' => 'required|file|max:5120'
                ]);
                break;
        }
    
        $teacher = Teacher::where('tcr_user_id', Auth::id())->firstOrFail();
    
        $submission = TeacherSubmission::firstOrNew([
            'tsb_teacher_id'     => $teacher->tcr_id,
            'tsb_requirement_id' => $requirement->tcq_id,
        ]);
    
        if ($requirement->tcq_type == 'file') {
    
            if (
                $submission->exists &&
                $submission->tsb_value &&
                Storage::disk('public')->exists($submission->tsb_value)
            ) {
                Storage::disk('public')->delete($submission->tsb_value);
            }
    
            $submission->tsb_value = $request
                ->file('value')
                ->store('teacher_requirement', 'public');
    
        } else {
    
            $submission->tsb_value = $request->value;
    
        }
    
        $submission->tsb_status = 1;
        $submission->tsb_note   = null;
    
        $submission->save();
    
        $completed = TeacherSubmission::where(
            'tsb_teacher_id',
            $teacher->tcr_id
        )->count();
    
        $total = TeacherRequirement::count();
    
        return response()->json([
            'success'   => true,
            'completed' => $completed,
            'total'     => $total,
            'message'   => 'Persyaratan berhasil disimpan.'
        ]);
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
