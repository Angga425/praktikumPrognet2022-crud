@extends('landingpage.admin.layout')

@section('css')
#user_details::-webkit-scrollbar {
    width: 0;
}
@endsection

@section('content')
<div class="relative max-w-lg border border-slate-200 rounded-xl bg-[#f7f7f7] mx-auto shadow-xl p-5">

    <center><h2 class="text-[#951b5c] text-5xl font-black mb-4">New Password</h2></center>

    <hr class="my-2"/>

    <form action="{{ route('admin.save-reset') }}" method="POST">
        @csrf
        <div class="p-1 w-full flex flex-wrap justify-between max-h-[200px] md:max-h-full overflow-y-scroll overscroll-none" id="user_details">

            <input type="hidden" id="email" name="email" value="{{ $email }}"/>

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

        </div>

        <button type="submit" class="mt-4 rounded px-4 py-1 w-full bg-[#80134d] text-slate-100 hover:bg-[#951b5c] active:bg-[#630c3b] hover:shadow-xl hover:shadow-[#951b5c/50]">
            Change
        </button>
    </form>

</div>
@endsection