<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Extracurricular;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::view('/contact', 'contact', ['name' => 'Muhammad Ariq Hendry']);

Route::redirect('/contact', '/contactme');

Route::get('/product/{id}', function ($id) {
    return 'ini adalah product dengan id ' . $id;
});

Route::prefix('administrator')->group(function () {
    Route::get('/profil-admin', function () {
        return 'profil admin';
    });
    Route::get('/about-admin', function () {
        return 'about admin';
    });
    Route::get('/contact-admin', function () {
        return 'contact admin';
    });
});

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/students', [StudentController::class, 'index'])->middleware('auth');

Route::get('/student/{id}', [StudentController::class, 'show'])->middleware(['auth', 'must-admin-or-teacher']);

Route::get('/student-add', [StudentController::class, 'create'])->middleware(['auth', 'must-admin-or-teacher']);
Route::post('/student', [StudentController::class, 'store'])->middleware('auth');
Route::get('/student-edit/{id}', [StudentController::class, 'edit'])->middleware(['auth', 'must-admin-or-teacher']);
Route::put('/student/{id}', [StudentController::class, 'update'])->middleware(['auth', 'must-admin-or-teacher']);

Route::get('/student-delete/{id}', [StudentController::class, 'delete'])->middleware(['auth', 'must-admin']);
Route::delete('/student-destroy/{id}', [StudentController::class, 'destroy'])->middleware(['auth', 'must-admin']);
Route::get('/student-deleted', [StudentController::class, 'deletedStudent'])->middleware(['auth', 'must-admin']);
Route::get('/student/{id}/restore', [StudentController::class, 'restore'])->middleware(['auth', 'must-admin']);


Route::get('/class', [ClassController::class, 'index'])->middleware('auth');
Route::get('/class-detail/{id}', [ClassController::class, 'show'])->middleware('auth');

Route::get('/extracurricular', [ExtracurricularController::class, 'index'])->middleware('auth');
Route::get('/extracurricular-detail/{id}', [ExtracurricularController::class, 'show'])->middleware('auth');

Route::get('/teacher', [TeacherController::class, 'index'])->middleware('auth');
