<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

            <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Zendero</title>
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/framework.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    </head>

    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="preload"></div>
                    <header class="space-inter">
                        <div class="container container-flex space-between">
                            <figure class="logo"><img src="{{ asset('img/logo.png') }}" alt=""></figure>
                            <nav class="custom-wrapper" id="menu">
                                <div class="pure-menu"></div>
                                <ul class="container-flex list-unstyled">
                                    <li><a href="index.html" class="text-uppercase">Home</a></li>
                                    <li><a href="about.html" class="text-uppercase">About</a></li>
                                    <li><a href="archive.html" class="text-uppercase">Archive</a></li>
                                    <li><a href="contact.html" class="text-uppercase">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </header>


                <!-- contenido dinámico -->


                </div>
            </div>
        </div>

            <section class="footer">
                <footer>
                <div class="container">
                    
                    <p>© 2019 - Santiago Lopera & Edward Gordillo. All Rights Reserved. Designed & Developed by <span class="c-white">xXx</span></p>
                    
            </footer>
        </section>
    </body>
</html>
