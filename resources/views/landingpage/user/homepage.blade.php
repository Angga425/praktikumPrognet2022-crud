@extends('landingpage.user.layout')

@section('content')
<div class="w-10 h-10 bg-white rounded-full flex items-center fixed bottom-5 right-5 cursor-pointer">
    <a href="#" class="text-xl text-white mx-auto">🔝</a>
</div>

<div class="w-full">
    <div id="home" class="relative w-full flex justify-between items-center mt-10">

        <div class="relative max-w-full sm:max-w-[300px] lg:max-w-[600px]">

            <h2 class="text-[#333] text-[3em] md:text-[2em] lg:text-[4em] leading-[1.4em] font-medium">It's not just Shoes <br>
                It's <span class="text-slate-500 sm:text-[#951b5c] text-[1.2em] font-bold lg:font-black">Pair of Shoes</span>
            </h2>

            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                Voluptas odit quam ipsa laboriosam a! Provident alias laudantium dignissimos officiis aperiam suscipit dicta. 
                Voluptas, sapiente numquam sunt voluptatum optio veritatis odio!
            </p>

            <a href="/user/login" class="inline-block rounded-full shadow-lg shadow-[#951b5c]/50 my-2 bg-[#951b5c] py-2 px-5 font-semibold text-white hover:underline hover:decoration-2">Learn More</a>

        </div>

        <div class="w-[350px] flex justify-end hidden sm:block">
            <img src="/img/shoes.png" alt="a Pair of Shoes">
        </div>
        
    </div>

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
                <span class="font-bold text-white md:text-slate-300 lg:text-[#951b5c]">
                    Pair of Shoes 
                </span>
                Collection for You!
            </h2>
        </div>

        <div id="collection_card" class="relative flex flex-wrap justify-center items-center min-h-[100vh]">
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/login" class="buy">Buy Now</a>
                <img src="/img/collections/shoes1.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/login" class="buy">Buy Now</a>
                <img src="/img/collections/shoes2.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/login" class="buy">Buy Now</a>
                <img src="/img/collections/shoes3.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/login" class="buy">Buy Now</a>
                <img src="/img/collections/shoes4.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/login" class="buy">Buy Now</a>
                <img src="/img/collections/shoes5.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/login" class="buy">Buy Now</a>
                <img src="/img/collections/shoes6.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/login" class="buy">Buy Now</a>
                <img src="/img/collections/shoes7.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/login" class="buy">Buy Now</a>
                <img src="/img/collections/shoes8.png" alt="Sepatu" class="shoes">
            </div>
        </div>
    </div>

    <div id="about" class="relative items-center w-full min-h-[100vh] mt-28">
        <div class="relative w-full">
            <h2 class="text-center text-[2em] md:text-[3em] font-bold p-5 m-5">
                <span class="before:block before:absolute py-3 px-2 before:-inset-1 before:-skew-y-3 before:bg-white md:before:bg-[#951b5c] relative inline-block">
                    <span class="relative text-[#951b5c] md:text-white">ABOUT</span>
                </span>
                US
            </h2>
        </div>
    </div>
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
    <footer class="text-center text-white" style="background-color: #0a4275;">
        <div class="container p-6">
            <div class="">
            <p class="flex justify-center items-center">
                <span class="mr-4">Register for free</span>
                <a href="{{ route('user.register') }}" class="inline-block px-6 py-2 border-2 border-white text-white font-medium text-xs leading-tight uppercase rounded-full hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                Sign up!
                </a>
            </p>
            </div>
        </div>

        <div class="text-center p-4 bg-slate-700">
            © 2022 Copyright:
            <a class="text-white" href="{{ route('user.homepage') }}">Praktikum Pemrograman Internet 12</a>
        </div>
    </footer>
@endsection