<?php

use App\Http\Controllers\Administration\AcademicYearController;
use App\Http\Controllers\Administration\ClassController;
use App\Http\Controllers\Administration\MajorController;
use App\Http\Controllers\Administration\PPDBController;
use App\Http\Controllers\Administration\PPDBRequirementController;
use App\Http\Controllers\Administration\PPDBReceptionController;
use App\Http\Controllers\Administration\StudentController;
use App\Http\Controllers\Administration\ScheduleController;
use App\Http\Controllers\Administration\ScheduleSlotController;

use App\Http\Controllers\prospectiveStudentController;
use App\Http\Controllers\DashboardController as AdministrationDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Administration\prospectiveTeacherController;
use App\Http\Controllers\Administration\TeacherReceptionController;
use App\Http\Controllers\Administration\TeacherRequirementController;
use App\Http\Controllers\Administration\ClassAssignmentController;
use App\Http\Controllers\Administration\SubjectController;
use App\Http\Controllers\Administration\TeacherController;
use App\Http\Controllers\Administration\EmployeeController;




use App\Http\Controllers\RegionController;
use App\Http\Controllers\Teacher\ProfileController as TeacherProfileController;
use App\Http\Controllers\Teacher\prospectiveTeacherController as TeacherProspectiveTeacherController;
use App\Http\Controllers\Teacher\RequirementController;
use App\Http\Controllers\Teacher\WaitingController;
use App\Models\Teacher_Bio;
use App\Models\TeacherRequirement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome2');
});


Route::get('/dashboard', function () {

    $user = Auth::user();

    if ($user->hasRole('administration')) {
        return redirect()->route('administration.dashboard');
    }

    if ($user->hasRole('student')) {
        return redirect()->route('student.dashboard.index');
    }

    if ($user->hasRole('teacher')) {
        return redirect()->route('teacher.dashboard.index');

        // $biodata = Teacher_Bio::where(
        //     'tcb_teacher_id',
        //     $user->usr_id
        // )->first();

        // Belum pernah isi biodata
        // if(!$biodata){
        //     return redirect()->route('teacher.prospectiveTeacher.biodata');
        // }

        // Sudah kirim lamaran
        // if($biodata->tcb_status == 'pending'){
        //     return redirect()->route('teacher.prospectiveTeacher.waiting');
        // }

        // Diminta revisi
        // if($biodata->tcb_status == 'revision'){
        //     return redirect()->route('teacher.prospectiveTeacher.edit');
        // }

        // Diterima
        // if($biodata->tcb_status == 'accepted'){
        //     return redirect()->route('teacher.dashboard.index');
        // }

        // Ditolak
        // if($biodata->tcb_status == 'rejected'){
        //     return redirect()->route('teacher.prospectiveTeacher.waiting');
        // }

        // Masih draft
        // return redirect()->route('teacher.prospectiveTeacher.biodata');
    }

    abort(403);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('administration')->name('administration.')->group(function () {
    Route::get('/', [AdministrationDashboardController::class, 'dashboard'])->name('dashboard');

    Route::prefix('major')->name('major.')->group(function () {
        Route::get('/', [MajorController::class, 'index'])->name('index');
        Route::get('/create', [MajorController::class, 'create'])->name('create');
        Route::post('/create', [MajorController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MajorController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [MajorController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [MajorController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('academic-years')->name('academic_years.')->group(function () {
        Route::get('/', [AcademicYearController::class, 'index'])->name('academic_years');
        Route::get('/create', [AcademicYearController::class, 'create'])->name('academic_years.create');
        Route::post('/create', [AcademicYearController::class, 'store'])->name('academic_years.store');
        Route::get('/{id}/edit', [AcademicYearController::class, 'edit'])->name('academic_years.edit');
        Route::post('/{id}/edit', [AcademicYearController::class, 'update'])->name('academic_years.update');
        Route::delete('/{id}/destroy', [AcademicYearController::class, 'destroy'])->name('academic_years.destroy');
    });
    Route::prefix('classes')->name('classes.')->group(function () {
        Route::get('/', [ClassController::class, 'index'])->name('classes');
        Route::get('/{id}/students', [ClassController::class, 'students'])->name('students');
        Route::get('/create', [ClassController::class, 'create'])->name('classes.create');
        Route::post('/create', [ClassController::class, 'store'])->name('classes.store');
        Route::get('/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
        Route::post('/{id}/edit', [ClassController::class, 'update'])->name('classes.update');
        Route::get('/{id}/homeroom', [ClassController::class, 'homeroom'])->name('classes.homeroom');
        Route::post('/{id}/homeroom', [ClassController::class, 'updateHomeroom'])->name('classes.homeroom');
        Route::delete('/{id}/destroy', [ClassController::class, 'destroy'])->name('classes.destroy');
    });
    Route::prefix('ppdb-requirement')->name('ppdbRequirement.')->group(function () {
        Route::get('/{id}', [PpdbRequirementController::class, 'index'])->name('index');
        Route::get('/{ppdbId}/list', [PpdbRequirementController::class, 'getByPpdb']);
        Route::get('/create/{ppdbId}', [PpdbRequirementController::class, 'create'])->name('create');
        Route::post('/create/{ppdbId}', [PpdbRequirementController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
        Route::post('/{id}/edit', [ClassController::class, 'update'])->name('classes.update');
        Route::delete('/{id}/destroy', [PpdbRequirementController::class, 'destroy'])->name('classes.destroy');
    });
    //  Route::prefix('gararetek')->name('gararetek.')->group(function () {
    //     Route::get('/', [ClassController::class, 'index'])->name('classes');
    //     Route::get('/create', [ClassController::class, 'create'])->name('classes.create');
    //     Route::post('/create', [ClassController::class, 'store'])->name('classes.store');
    //     Route::get('/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    //     Route::post('/{id}/edit', [ClassController::class, 'update'])->name('classes.update');
    //     Route::delete('/{id}/destroy', [ClassController::class, 'destroy'])->name('classes.destroy');
    // });
    Route::prefix('prospective-teacher')->name('prospectiveTeacher.')->group(function () {
        Route::get('/biodata', [prospectiveTeacherController::class, 'biodata'])->name('biodata');
        Route::post('/biodata', [prospectiveTeacherController::class, 'store_biodata'])->name('store_biodata');
        Route::get('/address', [prospectiveTeacherController::class, 'address'])->name('address');
        Route::post('/address', [prospectiveTeacherController::class, 'store_address'])->name('store_address');
        Route::get('/partners', [prospectiveTeacherController::class, 'partner'])->name('partner');
        Route::post('/partners', [prospectiveTeacherController::class, 'store_partner'])->name('store_partner');
        Route::get('/teach_history', [prospectiveTeacherController::class, 'history'])->name('history');
        Route::post('/teach_history', [prospectiveTeacherController::class, 'store_history'])->name('store_history');
        Route::get('/education', [prospectiveTeacherController::class, 'education'])->name('education');
        Route::post('/education', [prospectiveTeacherController::class, 'store_education'])->name('store_education');
        Route::post('/finish', [prospectiveTeacherController::class, 'finish'])->name('finish');

        Route::get('/physical-condition', [prospectiveTeacherController::class, 'physicalCondition'])->name('physicalCondition');
        Route::get('/parent-father', [prospectiveTeacherController::class, 'parentFather'])->name('parentFather');
        Route::get('/parent-mother', [prospectiveTeacherController::class, 'parentMother'])->name('parentMother');
        Route::get('/parent-guardian', [prospectiveTeacherController::class, 'parentGuardian'])->name('parentGuardian');
    });
    Route::prefix('teacher-requirement')->name('teacherRequirement.')->group(function () {
        Route::get('/', [TeacherRequirementController::class, 'index'])->name('index');
        Route::get('/create', [TeacherRequirementController::class, 'create'])->name('create');
        Route::post('/create', [TeacherRequirementController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TeacherRequirementController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [TeacherRequirementController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [TeacherRequirementController::class, 'destroy'])->name('classes.destroy');
    });
    Route::prefix('ppdb')->name('ppdb.')->group(function () {
        Route::get('/', [PPDBController::class, 'index'])->name('');
        Route::get('/create', [PPDBController::class, 'create'])->name('create');
        Route::post('/create', [PPDBController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PPDBController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [PPDBController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [PPDBController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('ppdb-reception')->name('ppdbReception.')->group(function () {
        Route::get('/', [PPDBReceptionController::class, 'index'])->name('index');
        Route::get('/{ppd_id}/list', [PpdbReceptionController::class, 'list'])->name('list');
        Route::get('/{student_id}/show', [PPDBReceptionController::class, 'show'])->name('show');
        Route::patch('/{student_id}/accept', [PPDBReceptionController::class, 'accept'])->name('accept');
        Route::post('/{student_id}/reject', [PPDBReceptionController::class, 'reject'])->name('reject');
        Route::get('/accepted', [PPDBReceptionController::class, 'accepted'])->name('accepted');
        Route::get('/{ppd_id}/accepted-list', [PpdbReceptionController::class, 'acceptedList'])->name('acceptedList');
        Route::get('/rejected', [PPDBReceptionController::class, 'rejected'])->name('rejected');
        Route::get('/{ppd_id}/rejected-list', [PpdbReceptionController::class, 'rejectedList'])->name('rejecttedList');
    });
    Route::prefix('class-assignment')->name('classAssignment.')->group(function () {
        Route::get('/', [ClassAssignmentController::class, 'index'])->name('index');
        Route::post('/process', [ClassAssignmentController::class, 'process'])->name('process');
        // Route::get('/{student_id}/show', [ClassAssingmentController::class, 'show'])->name('show');
        // Route::post('/{student_id}/accept', [ClassAssingmentController::class, 'accept'])->name('accept');
        // Route::get('/{student_id}/reject', [ClassAssingmentController::class, 'reject'])->name('reject');
        // Route::get('/accepted', [ClassAssingmentController::class, 'accepted'])->name('accepted');
        // Route::get('/{ppd_id}/accepted-list', [ClassAssingmentController::class, 'acceptedList'])->name('acceptedList');
        // Route::get('/rejected', [ClassAssingmentController::class, 'rejected'])->name('rejected');
        // Route::get('/{ppd_id}/rejected-list', [ClassAssingmentController::class, 'rejectedList'])->name('rejecttedList');

    });
    Route::prefix('subject')->name('subject.')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('index');
        Route::get('/create', [SubjectController::class, 'create'])->name('create');
        Route::post('/create', [SubjectController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SubjectController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [SubjectController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [SubjectController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/subject-teachers', [SubjectController::class, 'subjectTeachers'])->name('subjectTeacher');
        Route::get('/{id}/subject-teachers/create', [SubjectController::class, 'createSubjectTeacher'])->name('subjectTeacher.create');
        Route::post('/{id}/subject-teachers/create', [SubjectController::class, 'storeSubjectTeacher'])->name('subjectTeacher.store');
    });

    Route::prefix('schedule')->name('schedule.')->group(function () {

        Route::get('/', [ScheduleController::class, 'index'])
            ->name('index');


        Route::prefix('slot')->name('slot.')->group(function () {

            Route::get('/', [ScheduleSlotController::class, 'index'])
                ->name('index');

            Route::get('/create', [ScheduleSlotController::class, 'create'])
                ->name('create');

            Route::post('/create', [ScheduleSlotController::class, 'store'])
                ->name('store');
        });
    });


    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('index');
        Route::get('/{id}/show', [TeacherController::class, 'show'])->name('show');
    });
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [SubjectController::class, 'create'])->name('create');
    });




    //     Route::get('/kelas', function () {
    //     return view('administration.class-assignment.index');
    // });
    Route::prefix('teacher-reception')->name('teacherReception.')->group(function () {
        Route::get('/', [TeacherReceptionController::class, 'index'])->name('index');
        Route::get('/{id}/list', [TeacherReceptionController::class, 'list'])->name('list');
        Route::get('/{id}/show', [TeacherReceptionController::class, 'show'])->name('show');
        Route::post('/{id}/accept', [TeacherReceptionController::class, 'accept'])->name('accept');
        Route::get('/{id}/reject', [TeacherReceptionController::class, 'reject'])->name('reject');
        Route::get('/accepted', [TeacherReceptionController::class, 'accepted'])->name('accepted');
        Route::get('/{id}/accepted-list', [TeacherReceptionController::class, 'acceptedList'])->name('acceptedList');
        Route::get('/rejected', [TeacherReceptionController::class, 'rejected'])->name('rejected');
        Route::get('/{id}/rejected-list', [TeacherReceptionController::class, 'rejectedList'])->name('rejecttedList');
    });

    Route::prefix('student')->name('teacherReception.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/{level}', [StudentController::class, 'studentWithLevel'])->name('level');
    });
});

Route::prefix('student')->name('student.')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });
});

Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/profile', [TeacherProfileController::class, 'index'])->name('teacher.profile');
    Route::post('/profile/photo', [TeacherProfileController::class, 'updatePhoto'])->name('teacher.profile.photo');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [TeacherDashboardController::class, 'index'])->name('index');
    });
    Route::prefix('prospective-teacher')->name('prospectiveTeacher.')->group(function () {
        Route::get('/biodata', [prospectiveTeacherController::class, 'biodata'])->name('biodata');
        Route::post('/biodata', [prospectiveTeacherController::class, 'store_biodata'])->name('store_biodata');
        Route::get('/address', [prospectiveTeacherController::class, 'address'])->name('address');
        Route::post('/address', [prospectiveTeacherController::class, 'store_address'])->name('store_address');
        Route::get('/partners', [prospectiveTeacherController::class, 'partner'])->name('partner');
        Route::post('/partners', [prospectiveTeacherController::class, 'store_partner'])->name('store_partner');
        Route::get('/teach_history', [prospectiveTeacherController::class, 'history'])->name('history');
        Route::post('/teach_history', [prospectiveTeacherController::class, 'store_history'])->name('store_history');
        Route::get('/education', [prospectiveTeacherController::class, 'education'])->name('education');
        Route::post('/education', [prospectiveTeacherController::class, 'store_education'])->name('store_education');
        Route::post('/finish', [prospectiveTeacherController::class, 'finish'])->name('finish');
        // Route::post('/finish', function () {
        //     dd('MASUK ROUTE');
        // })->name('finish');  
        // Route::post('/finish', function () {
        //     return response()->json([
        //         'success' => true,
        //         'redirect' => '/abc'
        //     ]);
        // })->name('finish');      

        Route::get('/physical-condition', [prospectiveTeacherController::class, 'physicalCondition'])->name('physicalCondition');
        Route::get('/parent-father', [prospectiveTeacherController::class, 'parentFather'])->name('parentFather');
        Route::get('/parent-mother', [prospectiveTeacherController::class, 'parentMother'])->name('parentMother');
        Route::get('/parent-guardian', [prospectiveTeacherController::class, 'parentGuardian'])->name('parentGuardian');
        Route::get('/waiting', [WaitingController::class, 'waiting'])->name('waiting');
        Route::get('/preview', [WaitingController::class, 'preview'])->name('preview');
        Route::get('/cv/download/{type}', [TeacherProspectiveTeacherController::class, 'download'])->name('cv.download');
        Route::get('/teacher/cv/{type}', [TeacherProspectiveTeacherController::class, 'download'])->name('teacher.cv.download');
    });
    Route::prefix('teacher-requirement')->name('teacherRequirement.')->group(function () {
        Route::get('/', [RequirementController::class, 'index'])->name('index');
        Route::get('/create', [RequirementController::class, 'create'])->name('create');
        Route::post('/create', [RequirementController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RequirementController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [RequirementController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [RequirementController::class, 'destroy'])->name('classes.destroy');
    });
});
Route::prefix('prospective-student')->name('prospectiveStudent.')->group(function () {
    Route::get('/', [prospectiveStudentController::class, 'index'])->name('index');
    Route::get('/biodata', [prospectiveStudentController::class, 'biodata'])->name('biodata');
    Route::post('/register/stepOne', [prospectiveStudentController::class, 'stepOne'])->name('register.stepOne');
    Route::post('/register/stepTwo', [prospectiveStudentController::class, 'stepTwo'])->name('register.stepTwo');
    Route::post('/register/stepThree', [prospectiveStudentController::class, 'stepThree'])->name('register.stepThree');
    Route::post('/register/stepFour', [prospectiveStudentController::class, 'stepFour'])->name('register.stepFour');
    Route::post('/register/stepFive', [prospectiveStudentController::class, 'stepFive'])->name('register.stepFive');
    Route::post('/register/stepSix', [prospectiveStudentController::class, 'stepSix'])->name('register.stepSix');
    Route::get('/api/provinces', [regionController::class, 'provinces']);
    Route::get('/api/regencies/{province}', [regionController::class, 'regencies']);
    Route::get('/api/districts/{province}', [regionController::class, 'districts']);
    Route::get('/api/villages/{province}', [regionController::class, 'villages']);
    Route::get('/ppdb-registration', [prospectiveStudentController::class, 'ppdbRegistration'])->name('ppdbRegistration');
    Route::post('/ppdb-registration/stepOne', [ProspectiveStudentController::class, 'stepSeven'])->name('ppdbRegistration.stepOne');
    Route::post('/ppdb-registration/stepTwo', [ProspectiveStudentController::class, 'stepEight'])->name('ppdbRegistration.stepTwo');
    Route::post('/ppdb-registration/step-three', [ProspectiveStudentController::class, 'stepNine'])->name('ppdbRegistration.stepThree');
});




require __DIR__ . '/auth.php';
