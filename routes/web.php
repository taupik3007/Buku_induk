<?php

use App\Http\Controllers\Administration\AcademicYearController;
use App\Http\Controllers\Administration\ClassController;
use App\Http\Controllers\Administration\MajorController;
use App\Http\Controllers\prospectiveStudentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('administration')->name('administration.')->group(function () {
    Route::prefix('major')->name('major.')->group(function () {
        Route::get('/', [MajorController::class, 'index'])->name('index');
        Route::get('/create', [MajorController::class, 'create'])->name('create');
        Route::post('/create', [MajorController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MajorController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [MajorController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [MajorController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('academic_years')->name('academic_years.')->group(function () {
        Route::get('/', [AcademicYearController::class, 'index'])->name('academic_years');
        Route::get('/create', [AcademicYearController::class, 'create'])->name('academic_years.create');
        Route::post('/create', [AcademicYearController::class, 'store'])->name('academic_years.store');
        Route::get('/{id}/edit', [AcademicYearController::class, 'edit'])->name('academic_years.edit');
        Route::post('/{id}/edit', [AcademicYearController::class, 'update'])->name('academic_years.update');
        Route::delete('/{id}/destroy', [AcademicYearController::class, 'destroy'])->name('academic_years.destroy');
    });
    Route::prefix('classes')->name('classes.')->group(function () {
        Route::get('/', [ClassController::class, 'index'])->name('classes');
        Route::get('/create', [ClassController::class, 'create'])->name('classes.create');
        Route::post('/create', [ClassController::class, 'store'])->name('classes.store');
        Route::get('/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
        Route::post('/{id}/edit', [ClassController::class, 'update'])->name('classes.update');
        Route::delete('/{id}/destroy', [ClassController::class, 'destroy'])->name('classes.destroy');
    });
    //  Route::prefix('gararetek')->name('gararetek.')->group(function () {
    //     Route::get('/', [ClassController::class, 'index'])->name('classes');
    //     Route::get('/create', [ClassController::class, 'create'])->name('classes.create');
    //     Route::post('/create', [ClassController::class, 'store'])->name('classes.store');
    //     Route::get('/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    //     Route::post('/{id}/edit', [ClassController::class, 'update'])->name('classes.update');
    //     Route::delete('/{id}/destroy', [ClassController::class, 'destroy'])->name('classes.destroy');
    // });
    
});

    Route::prefix('prospective-student')->name('prospectiveStudent.')->group(function () {
        Route::get('/biodata', [prospectiveStudentController::class, 'biodata'])->name('biodata');
        Route::post('/register/step/{step}', [prospectiveStudentController::class, 'saveStep']);

        
    });






require __DIR__.'/auth.php';
