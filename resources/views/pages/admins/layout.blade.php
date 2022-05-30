<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://kit.fontawesome.com/5b8fa639bb.js" crossorigin="anonymous"></script>

    @yield('css')

</head>
<body class="flex flex-row">

    {{-- SIDEBAR --}}
    <div class="lg:w-[275px] px-5 bg-[#004159] rounded-r-lg mr-2 text-slate-400">

        {{-- LOGO DASHBOARD --}}
        <a href="{{ route('main.index') }}">
            <div class="flex justify-center items-center py-3">
                <span title="main" class="inline-block w-10 h-10 rounded-full overflow-hidden">
                    <img class="w-full object-fill rounded-full" src="/img/logo.jpg" alt="Logo">
                </span>
                <div class="ml-3 hidden lg:block">
                    <h2 class="text-2xl text-white font-bold">DASHBOARD</h2>
                </div>
            </div>
        </a>
        {{-- END LOGO DASHBOARD --}}

        <hr class="mt-3 mb-6">

        {{-- MAIN MENU --}}
        <ul>
            <li class="text-[18px] px-1 py-2 rounded-full font-semibold mb-2 {{ ($menu === "List Hewan" ? 'text-black bg-white' : '') }}">
                <a href="{{ route('main.index') }}" class="cursor-pointer ml-3 lg:ml-0 {{ ($menu === "List Hewan" ? '' : 'hover:text-white') }}">
                    <i title="List Hewan" class='fas fa-paw w-4 mr-4'></i>
                    <span class="hidden lg:inline-block">List Hewan</span>
                </a>
            </li>
            <li class="text-[18px] px-1 py-2 rounded-full font-semibold mb-2 {{ ($menu === "Kingdom" ? 'text-black bg-white' : '') }}">
                <a href="{{ route('kingdom.index') }}" class="cursor-pointer ml-3 lg:ml-0 {{ ($menu === "Kingdom" ? '' : 'hover:text-white') }}">
                    <i title="Kingdom" class='fas fa-crown w-4 mr-4'></i>
                    <span class="hidden lg:inline-block">Kingdom</span>
                </a>
            </li>
            <li class="text-[18px] px-1 py-2 rounded-full font-semibold mb-2 {{ ($menu === "Habitat" ? 'text-black bg-white' : '') }}">
                <a href="{{ route('habitat.index') }}" class="cursor-pointer ml-3 lg:ml-0 {{ ($menu === "Habitat" ? '' : 'hover:text-white') }}">
                    <i title="Habitat" class='fas fa-location-dot w-4 mr-4'></i>
                    <span class="hidden lg:inline-block">Habitat</span>
                </a>
            </li>
            <li class="text-[18px] px-1 py-2 rounded-full font-semibold mb-2 {{ ($menu === "Cara Berkembang Biak" ? 'text-black bg-white' : '') }}">
                <a href="{{ route('kembang_biak.index') }}" class="cursor-pointer ml-3 lg:ml-0 {{ ($menu === "Cara Berkembang Biak" ? '' : 'hover:text-white') }}">
                    <i title="Cara Kembang Biak" class='fas fa-egg w-4 mr-4'></i>
                    <span class="hidden lg:inline-block">Cara Berkembang Biak</span>
                </a>
            </li>
            <li class="text-[18px] px-1 py-2 rounded-full font-semibold mb-2 {{ ($menu === "Tipe Makanan" ? 'text-black bg-white' : '') }}">
                <a href="{{ route('makanan.index') }}" class="cursor-pointer ml-3 lg:ml-0 {{ ($menu === "Tipe Makanan" ? '' : 'hover:text-white') }}">
                    <i title="Makanan" class="fas fa-utensils w-4 mr-4"></i>
                    <span class="hidden lg:inline-block">Tipe Makanan</span>
                </a>
            </li>
            {{-- END MAIN MENU --}}
            
            <hr class="my-6">
            
            {{-- SIDE MENU --}}
            <li class="text-[18px] px-1 py-2 rounded-full font-semibold mb-2 {{ ($menu === "Recycle" ? 'text-black bg-white' : '') }}">
                <a href="{{ route('trash.index') }}" class="cursor-pointer ml-3 lg:ml-0 {{ ($menu === "Recycle" ? '' : 'hover:text-white') }}">
                    <i title="Bin" class="fas fa-recycle w-4 mr-4"></i>
                    <span class="hidden lg:inline-block">Recycle Bin</span>
                </a>
            </li>
            <li class="text-[18px] px-1 py-2 rounded-full font-semibold mb-2">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="cursor-pointer ml-3 lg:ml-0 hover:text-white">
                        <i title="Logout" class="fa-solid fa-right-from-bracket w-4 mr-4"></i>
                        <span class="hidden lg:inline-block">Log Out</span>
                    </button>
                </form>
            </li>
        </ul>
        {{-- END SIDE MENU --}}

    </div>
    {{-- END SIDEBAR --}}
    
    {{-- MAIN CONTENT --}}
    <div class="w-full lg:w-[calc(100%-275px)]">

        {{-- HEADER --}}
        <header class="flex items-center -ml-4 bg-[#004159] text-white h-12">
            <i class="fa-solid fa-chevron-right mx-4"></i>
            <h2 class="text-xl font-bold">{{ $menu }}</h2>
        </header>
        {{-- END HEADER --}}

        @yield('content')

    </div>
    {{-- END MAIN CONTENT --}}

    @yield('js')

</body>
</html>