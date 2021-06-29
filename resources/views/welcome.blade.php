<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->

        <link rel="stylesheet" href="{{asset("css/app.css")}}">

        <style>
            html, body {
                background: url("/storage/imagesAuth/vetor1.png")!important;
                background-size: 512px!important;
                background-attachment: fixed!important;
                background-position-x: right!important;
                background-position-y: bottom!important;
                background-repeat: no-repeat!important;
                color: #00A3E0;
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
                color: #00A3E0;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #00A3E0;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .tittle span{
                color: #000000!important;
                font-weight: bolder!important;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body> 
    
        <div class="menu-top-welcome-index">
            <div class="left-menu">
                <img src="/storage/imagesAuth/sia-gradient.png" alt="login-logo">
                <h2>SIA ETEOT</h2>
            </div>

            @if (Route::has('login'))
                <div class="menu-top-welcome btn-welcome">
                    @auth
                        <a href="{{ url('/dashboard') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>

                
            @endif

        </div>

        <div class="content-index">
            <div class="img-banner"><span></span></div>
        </div>

        <script src="{{asset("js/app.js")}}"></script>

    </body>
</html>
