
@include('header')

<body>
    <div id="app">

        @include('navbar')

        @yield('content')

    </div>

    @yield('footer')
</body>
</html>
