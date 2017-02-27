<nav class="navbar navbar-default header navbar-fixed-top">
    <div class="nav-wrapper">
        <div class="navbar-header" style="width:100%;">

            <!-- Branding Image -->
            <div class="col-md-3 col-sm-3">
                <a class="navbar-brand" href="#">
                    <b>Cents</b>
                </a>
            </div>
            <!-- Right Side Of Navbar -->
            <div class="col-md-9 col-sm-9">
                <ul class="nav navbar-nav navbar-right navbar-links">
                    <!-- Authentication Links -->
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>