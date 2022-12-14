<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<nav class="navbar navbar-default" id="navbar">
    <div class="container-fluid">
        <div class="navbar-collapse collapse in">
            <ul class="nav navbar-nav navbar-mobile">
                <li class="logo">
                    <a class="navbar-brand" href="{{ route('home') }}"><span class="highlight">Cents</span> App</a>
                </li>
                <li>
                    <div id="nav-button-mobile" class="btn-group nav-button-right padding-right-small" role="group">
                        <a type="button" class="btn nav-button" href="{{ route('profile') }}">
                            <span class="fa fa-user-circle user-circle"></span>
                        </a>
                        <a type="button" class="btn btn-success nav-button text-info" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left">
                <li class="logo navbar-header">
                    <a class="navbar-brand" href="{{ route('home') }}"><span class="highlight">Cents</span> App</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <div id="nav-button-desktop" class="btn-group padding-right" role="group">
                        <a type="button" class="dropdown profile btn nav-button" href="{{ route('profile') }}">
                            <span class="fa fa-user-circle user-circle"></span>
                        </a>
                        <a type="button" class="btn btn-success nav-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>