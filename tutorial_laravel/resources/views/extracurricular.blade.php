@extends('layouts.mainlayout')

@section('title', 'Extracurricular')

@section('content')
<h1>Ini adalah Halaman Extracurricular</h1>
<h3>Extracurricular List</h3>

<div class="my-5">
   <a href="" class="btn btn-primary">Add Data</a>
</div>
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
         <td><a class="btn btn-primary" href="extracurricular-detail/{{$data->id}}">Detail</a></td>
      </tr>
      @endforeach

   </tbody>
</table>

@endsection
