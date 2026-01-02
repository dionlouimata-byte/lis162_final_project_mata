<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            :root {
                --laravel-blue: #1e3a5f; /* ✳ changed: new moody blue background */
                --text-color: #ffffff;   /* ✳ changed: white text */
            }

            body {
                font-family: 'Nunito', sans-serif;
                color: var(--text-color); /* ✳ changed */
                background-color: var(--laravel-blue); /* ✳ changed */
                margin: 0;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .relative {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: var(--text-color); /* ✳ changed */
                padding: 0 15px;
                font-size: 16px; /* ✳ slightly larger */
                font-weight: 500; /* ✳ slightly heavier */
                letter-spacing: .05rem;
                text-decoration: none;
                text-transform: uppercase;
                transition: opacity 0.2s ease-in-out; /* ✳ smoother hover */
            }

            .links > a:hover {
                opacity: 0.75; /* ✳ subtle hover effect */
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 88px; /* ✳ slightly larger */
                font-weight: 700; /* ✳ heavier */
                margin-bottom: 20px;
            }

            .subtitle {
                font-size: 20px; /* ✳ slightly larger */
                font-weight: 500; /* ✳ heavier */
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen">
            
            @if (Route::has('login'))
                <div class="top-right links"> <!-- ✳ restored: login/register links -->
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    YGO
                </div>

                <div class="subtitle">
                    How and What to Handtrap
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
