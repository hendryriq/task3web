@extends('layouts.mainlayout')

@section('title', 'Student')

@section('content')

<div class="mt-5">
   <h3>Apa anda yakin ingin menghapus data dengan nama {{$student->name}} dan nis {{$student->nis}}</h3>
   <form style="display: inline-block" action="/student-destroy/{{$student->id}}" method="post">
      @csrf
      @method('delete')
      <button class="btn btn-danger" href="/students">Delete</button>
   </form>
  
   <a class="btn btn-primary" href="/students">Cancel</a>
</div>

@endsection