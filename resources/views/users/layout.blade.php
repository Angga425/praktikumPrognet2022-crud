<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://unpkg.com/feather-icons"></script>

       <!-- Favicon -->
       <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    
     <!-- CSS Implementing Plugins -->
     <link rel="stylesheet" href="{{ asset('assets_user/vendor/font-awesome/css/fontawesome-all.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets_user/css/font-electro.css') }}">
 
     <link rel="stylesheet" href="{{ asset('assets_user/vendor/animate.css/animate.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets_user/vendor/hs-megamenu/src/hs.megamenu.css') }}">
     <link rel="stylesheet" href="{{ asset('assets_user/vendor/ion-rangeslider/css/ion.rangeSlider.css') }}">
     <link rel="stylesheet"
         href="{{ asset('assets_user/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
     <link rel="stylesheet" href="{{ asset('assets_user/vendor/fancybox/jquery.fancybox.css') }}">
     <link rel="stylesheet" href="{{ asset('assets_user/vendor/slick-carousel/slick/slick.css') }}">
     <link rel="stylesheet"
         href="{{ asset('assets_user/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
 
     <!-- CSS Electro Template -->
     <link rel="stylesheet" href="{{ asset('assets_user/css/theme.css') }}">
 
     @stack('css')

    <link rel="stylesheet" href="/css/collections.css">
    @livewireStyles

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
            <a href="{{ route('user.home') }}" class="hidden sm:flex">
                <div class="relative max-w-full flex justify-start items-center">
                    <img src="/img/logo.jpeg" alt="Logo" class="w-16 rounded-full">
                    <div class="relative ml-4 text-[1.5em] font-semibold inline sm:hidden lg:inline">
                        Praktikum Pemrograman Internet
                    </div>
                </div>
            </a>

            <ul class="relative flex mt-5 sm:mt-0">
                <li class="list-none flex-3">
                    <a href="{{route('user.home')}}"  class="inline-block text-[#333] font-normal ml-[40px] no-underline text-center hover:text-[#951b5c]">
                      Welcome,  {{auth()->user()->name}}
                    </a>
                </li>
                <li class="list-none flex-3">
                    <a class="inline-block text-[#333] font-normal ml-[40px] no-underline text-center hover:text-[#951b5c]" href="{{ route('user.my-transaction') }}">My
                        Transaction</a>
                </li>
                @auth
                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <li class="list-none flex-3">
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
                <li class="list-none flex-3 mr-10 sm:mr-0">
                    @livewire('cart-livewire')
                </li>
            </ul>
<!-- Vertical-and-Search-Bar -->
<!-- End Vertical-and-secondary-menu -->
        </header>

        <div class="w-10 h-10 bg-white rounded-full flex items-center fixed bottom-5 right-5 cursor-pointer">
            <a href="#" class="text-xl text-white mx-auto">🔝</a>
        </div>
        @yield('content')

    </section>

    @yield('footer')

    <footer class="text-center text-white" style="background-color: #0a4275;">
        <div class="text-center p-4 bg-slate-700">
            © 2022 Copyright:
            <a class="text-white" href="{{ route('user.home') }}">Praktikum Pemrograman Internet 12</a>
        </div>
    </footer>


    
    <!-- JS Global Compulsory -->
    <script src="{{ asset('assets_user/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/bootstrap/bootstrap.min.js') }}"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{ asset('assets_user/vendor/appear.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/svg-injector/dist/svg-injector.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}">
    </script>
    <script src="{{ asset('assets_user/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/typed.js/lib/typed.min.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/slick-carousel/slick/slick.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/appear.js') }}"></script>
    <script src="{{ asset('assets_user/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

    <!-- JS Electro -->
    <script src="{{ asset('assets_user/js/hs.core.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.countdown.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.header.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.hamburgers.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.unfold.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.focus-state.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.malihu-scrollbar.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.validation.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.fancybox.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.onscroll-animation.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.slick-carousel.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.quantity-counter.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.range-slider.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.show-animation.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.svg-injector.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.scroll-nav.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.go-to.js') }}"></script>
    <script src="{{ asset('assets_user/js/components/hs.selectpicker.js') }}"></script>

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


    <!-- JS Plugins Init. -->
    <script>
        $(window).on('load', function() {
            // initialization of HSMegaMenu component
            $('.js-mega-menu').HSMegaMenu({
                event: 'hover',
                direction: 'horizontal',
                pageContainer: $('.container'),
                breakpoint: 767.98,
                hideTimeOut: 0
            });
        });

        $(document).on('ready', function() {
            // initialization of header
            $.HSCore.components.HSHeader.init($('#header'));

            // initialization of animation
            $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                afterOpen: function() {
                    $(this).find('input[type="search"]').focus();
                }
            });

            // initialization of HSScrollNav component
            $.HSCore.components.HSScrollNav.init($('.js-scroll-nav'), {
                duration: 700
            });

            // initialization of quantity counter
            $.HSCore.components.HSQantityCounter.init('.js-quantity');

            // initialization of popups
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of countdowns
            var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                yearsElSelector: '.js-cd-years',
                monthsElSelector: '.js-cd-months',
                daysElSelector: '.js-cd-days',
                hoursElSelector: '.js-cd-hours',
                minutesElSelector: '.js-cd-minutes',
                secondsElSelector: '.js-cd-seconds'
            });

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of forms
            $.HSCore.components.HSFocusState.init();

            // initialization of form validation
            $.HSCore.components.HSValidation.init('.js-validate', {
                rules: {
                    confirmPassword: {
                        equalTo: '#signupPassword'
                    }
                }
            });

            // initialization of forms
            $.HSCore.components.HSRangeSlider.init('.js-range-slider');

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // initialization of fancybox
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of slick carousel
            $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

            // initialization of go to
            $.HSCore.components.HSGoTo.init('.js-go-to');

            // initialization of hamburgers
            $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                beforeClose: function() {
                    $('#hamburgerTrigger').removeClass('is-active');
                },
                afterClose: function() {
                    $('#headerSidebarList .collapse.show').collapse('hide');
                }
            });

            $('#headerSidebarList [data-toggle="collapse"]').on('click', function(e) {
                e.preventDefault();

                var target = $(this).data('target');

                if ($(this).attr('aria-expanded') === "true") {
                    $(target).collapse('hide');
                } else {
                    $(target).collapse('show');
                }
            });

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

            // initialization of select picker
            $.HSCore.components.HSSelectPicker.init('.js-select');
        });
    </script>
    
    @stack('scripts')

    @livewireScripts
</body>
</html>