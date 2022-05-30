@extends('landingpage.user.layout')

@section('css')
    <link rel="stylesheet" href="/css/collections.css">
@endsection

@section('content')
    <div class="relative items-center w-full min-h-[100vh]">
        <div class="relative w-full">
            <h2 class="text-center text-[3em] font-bold p-5 m-5">
                <span class="before:block before:absolute py-3 px-2 before:-inset-1 before:-skew-y-3 before:bg-[#951b5c] relative inline-block">
                    <span class="relative text-white">BEST</span>
                </span>
                COLLECTIONS
            </h2>
            <h2 class="text-[1.5em] text-center w-full font-semibold">
                Some 
                <span class="font-bold text-[#951b5c]">
                    Pair of Shoes 
                </span>
                Collection for You!
            </h2>
        </div>

        <div id="collection_card" class="relative flex flex-wrap justify-center items-center min-h-[100vh]">
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/home" class="buy">Buy Now</a>
                <img src="/img/collections/shoes1.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/home" class="buy">Buy Now</a>
                <img src="/img/collections/shoes2.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/home" class="buy">Buy Now</a>
                <img src="/img/collections/shoes3.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/home" class="buy">Buy Now</a>
                <img src="/img/collections/shoes4.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/home" class="buy">Buy Now</a>
                <img src="/img/collections/shoes5.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/home" class="buy">Buy Now</a>
                <img src="/img/collections/shoes6.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/home" class="buy">Buy Now</a>
                <img src="/img/collections/shoes7.png" alt="Sepatu" class="shoes">
            </div>
            <div class="box">
                <h2 class="name">For You</h2>
                <a href="/user/home" class="buy">Buy Now</a>
                <img src="/img/collections/shoes8.png" alt="Sepatu" class="shoes">
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