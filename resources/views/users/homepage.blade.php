@extends('users.layout')

@section('content')

<div class="w-full">
    <div id="collections" class="relative items-center w-full min-h-[100vh] mt-28">
        <div class="relative w-full">
            <h2 class="text-center text-[2em] md:text-[3em] font-bold p-5 m-5">
                <span class="before:block before:absolute py-3 px-2 before:-inset-1 before:-skew-y-3 before:bg-white md:before:bg-[#951b5c] relative inline-block">
                    <span class="relative text-[#951b5c] md:text-white">BEST</span>
                </span>
                COLLECTIONS
            </h2>
            <h2 class="text-[1.5em] text-center w-full font-semibold">
                Some 
                <span class="font-bold text-black md:text-slate-300 lg:text-[#951b5c]">
                    Pair of Shoes 
                </span>
                Collection for You!
            </h2>
        </div>
        @livewire('product-livewire')
    </div>

<script src="/js/vanilla-tilt.min.js"></script>
<script>
    VanillaTilt.init(document.querySelectorAll(".box"), {
        max: 25,
        speed: 400
    });
</script>
@endsection

@section('footer')
 
@endsection