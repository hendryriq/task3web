@extends('layouts.mainlayout')
@section('title', 'Home')


@section('content')
<h1>Ini adalah Halaman Home</h1>
<h2>Selamat datang, {{ $name }}. Anda adalah {{ $role }}</h2>

@endsection
