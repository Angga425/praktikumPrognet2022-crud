@extends('landingpage.user.layout')

@section('content')
<div class="relative w-[400px] border border-slate-200 rounded-xl bg-[#fff]/50 mx-auto md:ml-[50px] shadow-xl p-5 mt-5">

    <center><h2 class="text-[#951b5c] text-5xl font-black mb-4 w-full">Login Here</h2></center>

    <hr class="my-2"/>

    @if (session()->has('success'))
        <div class="bg-green-100 rounded-lg py-2 px-3 mx-auto mb-2 text-base text-green-700 inline-flex items-center w-full" role="alert">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle" class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('fail'))
        <div class="bg-red-100 rounded-lg py-2 px-3 mx-auto mb-2 text-base text-red-700 inline-flex items-center w-full" role="alert">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle" class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path>
            </svg>
            {{ session('fail') }}
        </div>
    @endif

    <form action="{{ route('admins.login') }}" method="POST">
        @csrf
        <label for="username">
            <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 ">Username</span>
            <input type="text" id="username" name="username" placeholder="username" class="peer px-3 py-2 border shadow rounded w-full block text-sm focus:outline-none focus:ring-1 focus:ring-[#951b5c] focus:border-[#951b5c] invalid:text-pink-700" autofocus>
            <p class="text-sm m-1 text-pink-700 invisible peer-invalid:visible">Email tidak valid</p>
        </label>
        
        <label for="password">
            <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 ">Password</span>
            <div class="relative w-full flex justify-between items-center">
                <input type="password" id="password" name="password" placeholder="password" class="px-3 py-2 border shadow rounded w-full block text-sm focus:outline-none focus:ring-1 focus:ring-[#951b5c] focus:border-[#951b5c]" required>
                <span id="visibility" class="absolute right-2 text-slate-500 hover:cursor-pointer">
                    <i data-feather="eye-off" id="off"></i>
                    <i data-feather="eye"     id="on" ></i>
                </span>
            </div>

        </label>

        <div class="flex justify-between items-end my-3">
            <div>
                <span class="cursor-pointer">
                    <input class="cursor-pointer" type="checkbox" name="remember" id="remember" value="remember">
                    <label class="cursor-pointer" for="remember">Keep me logged in</label>
                </span>
            </div>
            <div>
                <a href="{{ route('user.forgot-password') }}" class="text-blue-600 hover:text-blue-700 focus:text-blue-700 transition duration-200 ease-in-out">
                    Forgot password?
                </a>
            </div>
        </div>

        <button type="submit" class="mt-3 rounded px-4 py-1 w-full bg-[#80134d] text-slate-100 hover:bg-[#951b5c] active:bg-[#630c3b] hover:shadow-xl hover:shadow-[#951b5c/50]">
            Login
        </button>

        <center class="mt-4"><span>Belum punya Akun? <a href="{{ route('user.register') }}" class="font-semibold text-[#80134d] underline hover:text-[#951b5c]">Registrasi di Sini</a></span></center>

    </form>
    
</div>
@endsection