<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Class_;

class StudentController extends Controller
{
    public function index()
    {
        // $student = Student::all();
        
        $student = Student::get();
        return view('student',['studentList' => $student]);
    }

    public function show($id){
        $student = Student::with(['class.homeroomTeacher', 'extracurriculars'])
        ->findOrFail($id);
        return view('student-detail', ['student' => $student]);
    }

    public function create(){
        $class = ClassRoom::all();
        return view('student-add', ['class' => $class]);
    }

    public function store(Request $request){
        // dd($request->all());
        // $student = new Student;
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();

        $student=Student::create($request->all());
        return redirect('/students');
    }

    public function edit(Request $request, $id){
        $student = Student::findOrFail($id);
        $class = ClassRoom::where('id', '!=', $student->class_id)->get(['id', 'name']);
        // dd($student);
        return view('student-edit', ['student'=> $student, 'class' => $class]);
    }

    public function update(Request $request, $id){
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return redirect('/students');
    }
}
