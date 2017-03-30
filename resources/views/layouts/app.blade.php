
@include('header')

<body>
    <div id="app">

        @include('navbar')

        <div class="padding-top-2">
            @yield('content')
        </div>

    </div>

    @yield('footer')
</body>
</html>
