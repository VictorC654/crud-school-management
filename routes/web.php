<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Teacher routes
    Route::get('/classroom/create', [ClassroomController::class, 'create'])->name('classroom.create');
    Route::post('/classroom', [ClassroomController::class, 'store'])->name('classroom.store');
    Route::delete('/classroom/{classroom}', [ClassroomController::class, 'destroy'])->name('classroom.delete');
    Route::get('/search/student', [UserController::class, 'search'])->name('search');
    Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classroom.index');
    Route::get('/classrooms/{id}', [ClassroomController::class, 'show'])->name('classroom.show');
    Route::post('/student/{student}', [ClassroomController::class, 'update'])->name('student.add');
    Route::delete('/student/{id}', [ClassroomController::class, 'removeStudent'])->name('student.remove');
    // Teacher routes
    Route::get('/classroom/{id}', [ClassroomController::class, 'showForStudent'])->name('classroom.show.student');
    // Director routes
    Route::get('/all-students', [UserController::class, 'show'])->name('all.students');
    Route::delete('/students/{user}', [UserController::class, 'destroy'])->name('delete.user');
    Route::get('/teachers', [UserController::class, 'showAllTeachers'])->name('all.teachers');
    Route::post('/teacher/{student}', [UserController::class, 'makeTeacher'])->name('make.teacher');
    Route::get('/all-classrooms', [ClassroomController::class, 'showAllClassrooms'])->name('all.classrooms');
    Route::get('/director-create-classroom', [ClassroomController::class, 'directorCreateClassroom'])->name('create.classroom');
    // Director routes
});

require __DIR__.'/auth.php';
