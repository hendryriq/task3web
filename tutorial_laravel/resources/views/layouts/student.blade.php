@extends('layouts.mainlayout')

@section('title', 'Student')

@section('content')
<h1>Ini adalah Halaman Student</h1>
<h3>Student List</h3>
<table class="table">
   <thead>
      <tr>
         <th>#</th>
         <th>Name</th>
         <th>Gender</th>
         <th>NIS</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($studentList as $data)
      <tr>
         <td>{{$loop->iteration}}</td>
         <td>{{$data->name}}</td>
         <td>{{$data->gender}}</td>
         <td>{{$data->nis}}</td>
         <td><a class="btn btn-primary" href="student/{{$data->id}}">Detail</a></td>
      </tr>
      @endforeach
   </tbody>
</table>

@endsection
