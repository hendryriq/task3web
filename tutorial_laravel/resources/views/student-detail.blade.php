@extends('layouts.mainlayout')

@section('title', 'Student Detail')

@section('content')
<h1>Halaman Detail Student</h1>

<ol>
   <li>{{$student->name}}</li>
   <li>{{$student->gender}}</li>
   <li>{{$student->nis}}</li>
   <li>{{$student->class_id}}</li>
</ol>
@endsection
