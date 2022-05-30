@extends('landingpage.admin.layout')

@section('css')
#user_details::-webkit-scrollbar {
    width: 0;
}
@endsection

@section('content')
<div class="relative max-w-lg border border-slate-200 rounded-xl bg-[#f7f7f7] mx-auto shadow-xl p-5">

    <center><h2 class="text-[#951b5c] text-5xl font-black mb-4">SignIn Here</h2></center>

    <hr class="my-2"/>

    <form action="{{ route('admin.create') }}" method="POST">
        @csrf
        <div class="p-1 w-full flex flex-wrap justify-between max-h-[200px] md:max-h-full overflow-y-scroll overscroll-none" id="user_details">

            <div class="w-full md:w-[calc(100%/2-20px)]">
                <label for="name">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 ">Nama</span>
                    <input type="text" id="name" name="name" placeholder="masukkan nama ..." class="mb-4 px-3 py-2 border shadow rounded w-full block text-sm focus:outline-none focus:ring-1 focus:ring-[#951b5c] focus:border-[#951b5c] invalid:text-pink-700" value="{{ old('name') }}" autofocus required/>
                </label>
            </div>

            <div class="w-full md:w-[calc(100%/2-20px)]">
                <label for="email">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 ">Email</span>
                    <input type="email" id="email" name="email" placeholder="masukkan email ..." class="peer px-3 py-2 border shadow rounded w-full block text-sm focus:outline-none focus:ring-1 focus:ring-[#951b5c] focus:border-[#951b5c] invalid:text-pink-700" value="{{ old('email') }}"/>
                    <p class="text-sm mt-1 text-pink-700 invisible peer-invalid:visible">Email tidak valid</p>
                </label>
            </div>

            <div class="w-full md:w-[calc(100%/2-20px)]">
                <label for="password">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 ">Password</span>
                    <input type="password" id="password" name="password" placeholder="masukkan password ..." class="mb-4 px-3 py-2 border shadow rounded w-full block text-sm focus:outline-none focus:ring-1 focus:ring-[#951b5c] focus:border-[#951b5c]" required/>
                </label>
            </div>

            <div class="w-full md:w-[calc(100%/2-20px)]">
                <label for="confirm_password">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 ">Konfirmasi Password</span>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="masukkan kembali password ..." class="mb-4 px-3 py-2 border shadow rounded w-full block text-sm focus:outline-none focus:ring-1 focus:ring-[#951b5c] focus:border-[#951b5c]" required/>
                </label>
            </div>
            
            <div class="w-full md:w-[calc(100%/2-20px)]">
                <label for="phone">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 ">Phone</span>
                    <input type="text" id="phone" name="phone" placeholder="masukkan nomor kontak ..." class="mb-4 px-3 py-2 border shadow rounded w-full block text-sm focus:outline-none focus:ring-1 focus:ring-[#951b5c] focus:border-[#951b5c]" required/>
                </label>
            </div>

            <div class="w-full md:w-[calc(100%/2-20px)]">
                <label class="block">
                    <span class="block font-semibold mb-1 text-slate-700">Pilih Foto Profile</span>
                    <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-slate-700 hover:file:bg-violet-100"/>
                </label>
            </div>

        </div>

        <button type="submit" class="mt-4 rounded px-4 py-1 w-full bg-[#80134d] text-slate-100 hover:bg-[#951b5c] active:bg-[#630c3b] hover:shadow-xl hover:shadow-[#951b5c/50]">
            Sign In
        </button>
            
        
        <center class="mt-4"><a href="{{ route('admin.login') }}" class="font-semibold text-[#80134d] underline hover:text-[#951b5c]">Login</a></center>

    </form>

</div>
@endsection