@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Welcome, {{ $user }}!</h2>
    <p>This is your dashboard.</p>
@endsection
