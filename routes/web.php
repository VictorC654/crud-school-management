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
    Route::get('/create-classroom', [ClassroomController::class, 'create'])->name('classroom.create');
    Route::post('/create-classroom', [ClassroomController::class, 'store'])->name('classroom.store');
    Route::get('/search-student', [UserController::class, 'search'])->name('search');
    Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classroom.index');
    Route::get('/classrooms/{id}', [ClassroomController::class, 'show'])->name('classroom.show');
    Route::post('/add-student/{id}', [ClassroomController::class, 'update']);
    Route::delete('/remove-student/{id}', [ClassroomController::class, 'removeStudent']);
    Route::delete('/delete-classroom/{classroom}', [ClassroomController::class, 'destroy'])->name('classroom.delete');
    // Teacher routes
    Route::get('/classroom/{id}', [ClassroomController::class, 'showForStudent'])->name('classroom.show.student');
    // Director routes
    Route::get('/all-students', [UserController::class, 'show'])->name('all.students');
    Route::delete('/delete-student/{id}', [UserController::class, 'destroy'])->name('delete.user');
    Route::get('/all-teachers', [UserController::class, 'showAllTeachers'])->name('all.teachers');
    Route::post('/make-teacher/{id}', [UserController::class, 'makeTeacher'])->name('make.teacher');
    Route::get('/all-classrooms', [ClassroomController::class, 'showAllClassrooms'])->name('all.classrooms');
    Route::get('/director-create-classroom', [ClassroomController::class, 'directorCreateClassroom'])->name('create.classroom');
    // Director routes
});

require __DIR__.'/auth.php';
