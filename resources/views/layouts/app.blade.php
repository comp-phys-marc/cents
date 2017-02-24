
@include('header')

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">

                @include('navbar')

            </div>
        </nav>

        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
