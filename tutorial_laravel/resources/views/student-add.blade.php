@extends('layouts.mainlayout')

@section('title', 'Student | add new')

@section('content')
{{-- {{$class}} --}}
<h3>Add Student</h3>

<div class="mt-5 col-8 m-auto">
   <form action="student" method="post">
      @csrf
      <div class="mb-3">
         <label for="name">Name</label>
         <input type="text" class="form-control" name="name" id="name" required>
      </div>

      <div class="mb-3">
         <label for="name">Gender</label>
         <select name="gender" id="gender" class="form-control" required>
            <option value="">Select One</option>
            <option value="L">L</option>
            <option value="P">P</option>
         </select>
      </div>
      <div class="mb-3">
         <label for="name">NIS</label>
         <input type="text" class="form-control" name="nis" id="nis" required>
      </div>
      <div class="mb-3">
         <label for="class">Class</label>
         <select name="class_id" id="class" class="form-control" required>
            <option value="">Select One</option>
            @foreach ($class as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
         </select>
      </div>
      <div class="mb-3">
         <button class="btn btn-success">Save</button>
      </div>
   </form>
</div>

@endsection