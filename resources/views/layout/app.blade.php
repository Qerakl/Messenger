<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
</head>
<body>
    <header>
        <a href="/">Главная страница</a>
        @if(Auth::check())
            <a href="{{route('user.logout' )}}">Выйти</a>

        @endif
    </header>
    <main>
        @yield('content')
    </main>
    <footer>

    </footer>
</body>
</html>
