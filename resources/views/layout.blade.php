<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mapMemory</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>

    @yield('head')
</head>
<body>
    <div id="app">
        <header class="header">
            <div class="menu">
                <div class="title"><span>MapMemory</span></div>
                @if (session()->has('login') && session('login') == true) 
                    <div class="logout"><a class='button' href="/logout">logout</a></div>
                @endif
                @yield('header')
            </div>
        </header>
        <div class="main">
            @if (session()->has('login') && session('login') == true) 
                <div class="sidemenu">
                    <div class="menu_list">
                        <div class="menu"><a href="/map/map">マップ</a></div>
                    </div>
                </div>
            @endif
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>