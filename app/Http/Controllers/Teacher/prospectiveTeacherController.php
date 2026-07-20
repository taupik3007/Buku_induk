<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class prospectiveTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function download($type)
{
    $teacher = Teacher::with([
        'user',
        'teacherBio',
        'teacherAddress',
        'teacherEducation',
        'teachHistories'
    ])
    ->where('tcr_user_id', Auth::id())
    ->firstOrFail();

    // Pilih template
    $view = match ($type) {
        'creative' => 'teacher.prospectiveTeacher.creative',
        'ats' => 'teacher.prospectiveTeacher.ats',
        default => abort(404),
    };

    $pdf = Pdf::loadView($view, compact('teacher'))
        ->setPaper('a4', 'portrait');

    // Preview di browser jika ada ?preview=1
    if (request()->has('preview')) {
        return $pdf->stream("CV-{$type}.pdf");
    }

    // Download PDF
    return $pdf->download("CV-{$type}.pdf");
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
