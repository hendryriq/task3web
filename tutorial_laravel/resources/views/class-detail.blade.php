@extends('layouts.mainlayout')

@section('title', 'Class')

@section('content')

<h3>Anda sedang melihat data detail class {{$class->name}}</h3>

<div class="mt-5">
   <h5>Homeroom Teacher : {{$class->homeroomTeacher->name}}</h5>
</div>

<div class="mt-5">
   <h4>List Student</h4>
   <ol>
      @foreach ($class->students as $item)
      <li>{{$item->name}}</li>
         
      @endforeach
   </ol>
</div>
@endsection