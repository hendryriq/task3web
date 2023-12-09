<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Extracurricular;
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

Route::get('/', function () {
    return view('home', [
        'name' => 'Muhammad Ariq Hendry', 
        'role' => "admin",
        'buah' => ['pisang', 'apel', 'jeruk', 'semangka', 'kiwi']
    ]);
});

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

Route::get('/student', [StudentController::class, 'index']);
Route::get('/student/{id}', [StudentController::class, 'show']);

Route::get('/class', [ClassController::class, 'index']);
Route::get('/extracurricular', [ExtracurricularController::class, 'index']);
Route::get('/teacher', [TeacherController::class, 'index']);
