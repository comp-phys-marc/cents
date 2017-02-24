
@include('header')

<body>
    <div id="app">

        @include('navbar')

        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
