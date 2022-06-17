<!DOCTYPE html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ url('css/common_style.css') }}" />
        @yield('style')
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('script')
        <script>
            const BASE_URL = "{{ url('/') }}";
        </script>
        <script src="{{ url('js/common_script.js') }}" defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    </head>
    <body>
        <article>
            <nav id="links">
                <a href="{{ url('/') }}">HOME</a> 
                <a href="{{ url('stagione') }}">STAGIONE</a>  
                <a href="{{ url('login/auth') }}">COMMUNITY</a>  
            </nav>
            <div id="menu" class="hidden">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div id="menu_view" class="hidden">
                <a href="{{ url('/') }}">HOME</a>
                <a href="{{ url('stagione') }}">STAGIONE</a>  
                <a href="{{ url('login/auth') }}">COMMUNITY</a> 
                <em>Chiudi menu</em>
            </div>
            <header id="upper_header">
                <div id="spazio_nero"></div>
                <img src=" {{url('images/logo_pagina.png') }}" />
            </header>
    
            @yield('contents')

            <footer>
                <img src=" {{ url('images/logo_milan.png') }}" />
                <p>
                    Universita' di Catania Web Programming 2022 </br>
                    Realizzato da Francesco Pennisi
                </p>
                <img src=" {{ url('images/nuovo-logo-unict.png') }}" />
            </footer>
        </article>
    </body>
</html>