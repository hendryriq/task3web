<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        // $student = Student::all();
        
        $student = Student::get();
        return view('layouts.student',['studentList' => $student]);
    }

    public function show($id){
        $student = Student::find($id);
        return view('student-detail', ['student' => $student]);
    }
}
