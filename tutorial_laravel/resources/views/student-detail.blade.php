@extends('layouts.mainlayout')

@section('title', 'Student Detail')

@section('content')
<h1>Halaman Detail Student</h1>
{{-- {{$student}} --}}


<div class="my-3 d-flex justify-content-center">
   <img src="{{asset('storage/photo/'.$student->image)}}" alt="" width="150px">
</div>
<div class="mt-5">
<table class="table table-bordered">
   <tr>
      <th>NIS</th>
      <th>Nama</th>
      <th>Gender</th>
      <th>Class</th>
      <th>Homeroom Teacher</th>
   </tr>
   <tr>
      <td>{{$student->nis}}</td>
      <td>{{$student->name}}</td>
      <td>
         @if ($student->gender == 'P')
         Perempuan
         @else
         Laki Laki
         @endif
      </td>
      <td>{{$student->class->name}}</td>
      <td>{{$student->class->homeroomTeacher->name}}</td>
   </tr>
</table>
</div>

<div>
   <h3>Extracurriculars</h3>
   <ol>
      @foreach ($student->extracurriculars as $item)
      <li>{{$item->name}}</li>
      @endforeach
   </ol>
</div>

<style>
   th{
      width: 20%;
   }
</style>

{{-- <ol>
   <li>{{$student->name}}</li>
   <li>{{$student->gender}}</li>
   <li>{{$student->nis}}</li>
   <li>{{$student->class_id}}</li>
</ol> --}}
@endsection
