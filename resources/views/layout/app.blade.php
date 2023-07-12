<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Posty | Talal Abbasi</title>
</head>

<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a href="{{ route('home') }}" class="p-3">Home</a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('posts') }}" class="p-3">Posts</a>
            </li>
        </ul>
        <ul class="flex items-center">
            {{-- @if (auth()->user())
                <li>
                    <a href="" class="p-3">Talal Shakeel Abbasi</a>
                </li>
                <li>
                    <a href="" class="p-3">Logout</a>
                </li>
            @else
                <li>
                    <a href="" class="p-3">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li>
            @endif --}}
            {{-- This is one way of customizing the navgiation bar if a user is signed in or if it is a guest --}}

            @auth
                <li>
                    <a href="" class="p-3">{{ auth()->user()->name }}</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="inline p-3">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    {{-- We want it in the menu to work with cross-site-request-forgery-protection
                        So, we create a form and a button --}}
                </li>
            @endauth

            @guest
                <li>
                    <a href="{{ route('login') }}" class="p-3">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li>
            @endguest
            {{-- This is another way of doing the same thing --}}
        </ul>
    </nav>
    @yield('content')
</body>

</html>
