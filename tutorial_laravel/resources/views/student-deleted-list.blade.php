@extends('layouts.mainlayout')

@section('title', 'Student deleted')

@section('content')
<h1>Ini adalah Halaman Student yang sudah di delete</h1>

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
      @foreach ($student as $data)
      <tr>
         <td>{{$loop->iteration}}</td>
         <td>{{$data->name}}</td>
         <td>{{$data->gender}}</td>
         <td>{{$data->nis}}</td>
         <td><a class="btn btn-primary" href="/student/{{$data->id}}/restore">Restore</a>
      </tr>
      @endforeach
   </tbody>
</table>

@endsection