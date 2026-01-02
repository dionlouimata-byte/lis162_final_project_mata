<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>YGO Handtrap Analyzer</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --laravel-blue: #03ad7aff;
            --text-color: #ffffff;
            --button-bg: #ffffff;
            --button-text: #03ad7aff;
        }

        body {
            font-family: 'Nunito', sans-serif;
            color: var(--text-color);
            background-color: var(--laravel-blue);
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .relative {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .top-right {
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .links > a {
            color: var(--text-color);
            padding: 0 15px;
            font-size: 16px;
            font-weight: 500;
            letter-spacing: .05rem;
            text-decoration: none;
            text-transform: uppercase;
            transition: opacity 0.2s ease-in-out;
        }

        .links > a:hover {
            opacity: 0.75;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 88px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 50px;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .btn {
            background: var(--button-bg);
            color: var(--button-text);
            padding: 16px 36px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="antialiased">

<div class="relative">

    @if (Route::has('login'))
        <div class="top-right links">
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
        <div class="title">
            Yu-Gi-Oh!
        </div>

        <div class="subtitle">
            Handtrap Matching Helper
        </div>

        <div class="actions">
            <a href="{{ url('/cards') }}" class="btn">
                View Cards
            </a>

            <a href="{{ url('/compare') }}" class="btn">
                Compare Cards
            </a>
        </div>
    </div>

</div>

</body>
</html>
