@extends('dashboard.user.layout')

@section('content')
    <div class="rounded shadow-xl p-5 w-[80%] mx-auto divide-y-2 divide-emerald-900 bg-cyan-500 shadow-cyan-500/50">
        <h1 class="my-2 font-bold">DASHBOARD</h1>
        {{-- <hr class="my-4 border-bold"> --}}
        <h2 class="p-3">Welcome to User Dashboard {{ auth()->user()->name }}</h2>

        <div class="p-3 flex justify-center items-center w-full">
            <div class="bg-slate-200 rounded-full w-[300px] h-[300px] overflow-hidden">
                @if (auth()->user()->profile_image == null)
                    <img src="/img/default_user_profile.jpg" alt="Profile Image" class="max-w-[300px]"/>
                @else
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Image" class="max-w-[300px]"/>
                @endif
            </div>
        </div>
    </div>
@endsection