@extends('layouts.mainlayout')

@section('title', 'Student | Edit')

@section('content')
{{-- {{$class}} --}}
<h3>Edit Student</h3>

<div class="mt-5 col-8 m-auto">
   <form action="/student/{{$student->id}}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
         <label for="name">Name</label>
         <input type="text" class="form-control" value="{{$student->name}}" name="name" id="name" required>
      </div>

      <div class="mb-3">
         <label for="name">Gender</label>
         <select name="gender" id="gender" class="form-control" required>
            <option value="{{$student->gender}}">{{$student->gender}}</option>
            @if ($student->gender == 'L')
            <option value="P">P</option>
            @else
            <option value="L">L</option>
            @endif
         </select>
      </div>
      <div class="mb-3">
         <label for="name">NIS</label>
         <input type="text" class="form-control" value="{{$student->nis}}" name="nis" id="nis" required>
      </div>
      <div class="mb-3">
         <label for="class">Class</label>
         <select name="class_id" id="class" class="form-control" required>
            <option value="{{$student->class->id}}">{{$student->class->name}}</option>
            @foreach ($class as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
         </select>
      </div>
      <div class="mb-3">
         <button class="btn btn-success">Update</button>
      </div>
   </form>
</div>
{{-- {{$student->class}} --}}

@endsection