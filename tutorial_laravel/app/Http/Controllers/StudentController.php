<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $student = Student::with('class')
        ->where('name', 'LIKE', '%' .$keyword. '%')
        ->orWhere('gender', $keyword)
        ->orWhere('nis', 'LIKE', '%'.$keyword. '%')
        ->orWhereHas('class', function($query) use($keyword){
            $query->where('name', 'LIKE', '%'.$keyword. '%');
        })
        ->paginate(20);
        
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

    public function store(StudentCreateRequest $request){
        // dd($request->all());
        // $student = new Student;
        // $student->name = $request->name;
        // $student->gender = $request->gender;
        // $student->nis = $request->nis;
        // $student->class_id = $request->class_id;
        // $student->save();

        // $validated = $request->validate([
        //     'nis' => 'unique:students'
        // ]);

        $newName = '';

        if($request->file('photo')){
            $extenion = $request->file('photo')->getClientOriginalExtension();
        $newName = $request->name.'-'.now()->timestamp.'.'.$extenion;
        $request->file('photo')->storeAs('photo', $newName);
        }

        $request['image'] = $newName;
        $student = Student::create($request->all());

        $student=Student::create($request->all());
        if($student){
            Session::flash('status', 'success');
            Session::flash('message', 'add new student success!');
        }

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

    public function delete($id){
        $student = Student::findOrFail($id);
        return view('student-delete', ['student'=> $student]);
    }

    public function destroy($id){
        $deletedStudent = Student::findOrFail($id);
        $deletedStudent->delete();

        if($deletedStudent){
            Session::flash('status', 'success');
            Session::flash('message', 'Delete student success!');
        }

        return redirect('/students');
    }
    public function deletedStudent(){
        $student = Student::onlyTrashed()->get();
        return view('student-deleted-list', ['student' => $student]);

    }

    public function restore($id){
        $deletedStudent = Student::withTrashed()->where('id', $id)->restore();

        if($deletedStudent){
            Session::flash('status', 'success');
            Session::flash('message', 'Restore student success!');
        }
        return redirect ('/students');
    }

}
