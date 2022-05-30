@extends('dashboard.admin.layout')

@section('content')
    <div class="relative rounded shadow-xl p-5 w-[80%] mx-auto divide-y-2 divide-emerald-900 bg-cyan-500 shadow-cyan-500/50">
        <h1 class="my-2 font-bold">DASHBOARD</h1>
        {{-- <hr class="my-4 border-bold"> --}}
        <h2 class="p-3">Welcome to Admin Dashboard, {{ auth()->user()->name }}</h2>
    </div>
@endsection