<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #circle {
            clip-path: circle(600px at right 800px);
        }

        #on {
            display: none;
        }

        @yield('css');
    </style>

    <title>Praktikum Pemrograman Internet 2022</title>
</head>
<body class="p-5 justify-center items-center">

    @yield('content')

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