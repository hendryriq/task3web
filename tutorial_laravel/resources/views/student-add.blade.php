@extends('layouts.mainlayout')

@section('title', 'Student | add new')

@section('content')
{{-- {{$class}} --}}
<h3>Add Student</h3>

<div class="mt-5 col-8 m-auto">
   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   <form action="student" method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
         <label for="name">Name</label>
         <input type="text" class="form-control" name="name" id="name">
      </div>

      <div class="mb-3">
         <label for="name">Gender</label>
         <select name="gender" id="gender" class="form-control" >
            <option value="">Select One</option>
            <option value="L">L</option>
            <option value="P">P</option>
         </select>
      </div>
      <div class="mb-3">
         <label for="name">NIS</label>
         <input type="text" class="form-control" name="nis" id="nis" >
      </div>
      <div class="mb-3">
         <label for="class">Class</label>
         <select name="class_id" id="class" class="form-control" >
            <option value="">Select One</option>
            @foreach ($class as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
         </select>
      </div>
      <div class="mb-3">
         <label for="photo" class="form-label">Foto siswa</label>
         <input class="form-control" id="photo" name="photo" type="file" >
       </div>

      <div class="mb-3">
         <button class="btn btn-success">Save</button>
      </div>
   </form>
</div>

@endsection