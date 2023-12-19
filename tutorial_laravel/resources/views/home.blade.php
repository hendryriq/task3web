@extends('layouts.mainlayout')
@section('title', 'Home')


@section('content')
<h1>Ini adalah Halaman Home</h1>
<h2>Selamat datang, {{Auth::user()->name}}. Anda adalah</h2>
{{Auth::user()->name}}

@endsection
