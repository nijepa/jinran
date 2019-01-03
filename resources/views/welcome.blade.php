<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ asset('css/frontend_css/button.css') }}" />

        <title>Donau</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

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
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/admin') }}">Admin</a>

                    @endauth
                </div>
            @endif

            <div class="content">

                <div class="title m-b-md">
                    DONAU
                </div>
                <div><h2>Web app for bussiness meetings.</h2></div>
                <br />
                <div><h5><img src="{{ asset('images/backend_images/front.png') }}" alt="Logo" /></h5></div>
                <div class="links">

                    <div class="container row-xGrid-yMiddle">
                        <ul>
                            <li><a href="{{ route('login') }}" class="round green">Login<span class="round">That is, if you already have an account.</span></a></li>
                            <li> </li>
                            <li><a href="{{ route('register') }}" class="round red">Register<span class="round">But only if you really, really want to. </span></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>
