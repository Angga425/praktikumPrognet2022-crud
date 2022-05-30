<!DOCTYPE html>
<html lang="en">
<head>
    @notifyCss
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="stylesheet" href="/css/collections.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        #circle {
            clip-path: circle(525px at right 800px);
        }

        #on {
            display: none;
        }
    </style>
    @yield('css')
    
    <title>Praktikum Pemrograman Internet 2022</title>
</head>
<body>
    <section class="relative w-full min-h-screen py-[100px] px-[50px] md:p-[100px] flex justify-between items-center bg-[#f7f7f7]">

        <div id="circle" class="absolute top-0 left-0 w-full h-[60%] h-full bg-[#951b5c]"></div>

        <header class="absolute top-0 left-0 w-full py-[20px] px-[10px] sm:px-[50px] md:px-[100px] flex justify-center sm:justify-between items-center bg-[#f7f7f7]">
            <a href="{{ route('user.homepage') }}" class="hidden sm:flex">
                <div class="relative max-w-full flex justify-start items-center">
                    <img src="/img/logo.jpeg" alt="Logo" class="w-16 rounded-full">
                    <div class="relative ml-4 text-[1.5em] font-semibold inline sm:hidden lg:inline">
                        Praktikum Pemrograman Internet
                    </div>
                </div>
            </a>

            <ul class="relative flex mt-5 sm:mt-0">
                <li class="list-none flex-3 mr-2">
                    <a href="{{ route('user.homepage') }}#home" class="inline-block text-[#333] font-normal ml-[40px] no-underline text-center hover:text-[#951b5c]">
                        Home
                    </a>
                </li>
                <li class="list-none flex-3 mr-2">
                    {{-- <a href="{{ route('user.collections') }}" class="inline-block text-[#333] font-normal ml-[40px] no-underline text-center hover:text-[#951b5c]"> --}}
                    <a href="{{ route('user.homepage') }}#collections" class="inline-block text-[#333] font-normal ml-[40px] no-underline text-center hover:text-[#951b5c]">
                        Collections
                    </a>
                </li>
                <li class="list-none flex-3 mr-2">
                    <a href="{{ route('user.homepage') }}#about" class="inline-block text-[#333] font-normal ml-[40px] no-underline text-center hover:text-[#951b5c]">
                        About Us
                    </a>
                </li>
                @auth
                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <li class="list-none flex-3 mr-10 sm:mr-0">
                        <button type="submit" class="inline-block text-[#333] font-normal ml-[40px] no-underline text-center hover:text-[#951b5c]">    
                            Logout
                        </button>
                    </li>
                </form>
                @else
                <li class="list-none flex-3 mr-10 sm:mr-0">
                    <a href="{{ route('user.login') }}" class="inline-block text-[#333] font-normal ml-[40px] no-underline text-center hover:text-[#951b5c]">
                        Login
                    </a>
                </li>
                @endauth
            </ul>

        </header>
        <x:notify-messages/>
  @notifyJs
        @yield('content')

    </section>

    @yield('footer')

    <script>
      feather.replace()
    </script>
    <script>
        const visibilityToggle = document.querySelector('#visibility');
        const input            = document.querySelector('#password');
        const icon_on          = document.querySelector('#on');
        const icon_off         = document.querySelector('#off');
        
        var password = true;

        visibilityToggle.addEventListener('click', function() {
            if(password){
                input.setAttribute('type','text');
                icon_on.style.display  = "block";
                icon_off.style.display = "none";
            }
            else{
                input.setAttribute('type','password');
                icon_on.style.display  = "none";
                icon_off.style.display = "block";
            }
            password = !password;
        });
    </script>
  

</body>
</html>