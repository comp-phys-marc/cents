
@include('header')

<body>
<div id="app">

    @include('auth.authnavbar')

    @yield('content')

</div>

@yield('footer')
</body>
</html>
