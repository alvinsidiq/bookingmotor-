@extends('layouts.admin')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
        <p class="mt-2 text-gray-600">This is your admin dashboard.</p>
    </div>
@endsection
