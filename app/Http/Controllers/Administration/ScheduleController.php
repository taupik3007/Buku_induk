<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Majors;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classes;
use App\Models\Academic_Year;
use App\Models\SubjectTeacher;
use App\Models\Schedule;
use App\Models\ScheduleSlot;


use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $academicYears = Academic_Year::orderByDesc('acy_id')->get();

        $activeAcademicYear = Academic_Year::where('acy_status', 1)
            ->firstOrFail();

        $academicYearId = $request->acy_id
            ?? $activeAcademicYear->acy_id;

        $classes = Classes::with('cls_major')
            ->orderBy('cls_level')
            ->orderBy('cls_number')
            ->get();

        $classId = $request->class_id
            ?? $classes->first()?->cls_id;

        $slots = ScheduleSlot::orderBy('slt_day')
            ->orderBy('slt_number')
            ->get()
            ->groupBy('slt_day');

        $schedules = Schedule::with([
            'subjectTeacher.subject',
            'subjectTeacher.teacher.user',
            'subjectTeacher.class',
            'slot',
        ])
            ->whereHas('subjectTeacher', function ($query) use ($academicYearId, $classId) {
                $query->where('subt_academic_year_id', $academicYearId)
                    ->where('subt_class_id', $classId);
            })
            ->get()
            ->keyBy('sch_slot_id');

        return view(
            'administration.schedule.index',
            compact(
                'academicYears',
                'academicYearId',
                'classes',
                'classId',
                'slots',
                'schedules'
            )
        );
    }
}
