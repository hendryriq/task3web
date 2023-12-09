@extends('layouts.mainlayout')

@section('title', 'Extracurricular')

@section('content')
<h1>Ini adalah Halaman Extracurricular</h1>
<h3>Extracurricular List</h3>


<table class="table">
   <thead>
      <tr>
         <th>#</th>
         <th>Name</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      @foreach ($ekskulList as $data)
      <tr>
         <td>{{$loop->iteration}}</td>
         <td>{{$data->name}}</td>
         <td><a class="btn btn-primary" href="student/{{$data->id}}">Detail</a></td>
      </tr>
      @endforeach

   </tbody>
</table>

@endsection
