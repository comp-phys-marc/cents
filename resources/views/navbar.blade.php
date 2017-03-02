<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<nav class="navbar navbar-default" id="navbar">
    <div class="container-fluid">
        <div class="navbar-collapse collapse in">
            <ul class="nav navbar-nav navbar-mobile">
                <li>
                    <button type="button" class="sidebar-toggle">
                        <i class="fa fa-bars"></i>
                    </button>
                </li>
                <li class="logo">
                    <a class="navbar-brand" href="#"><span class="highlight">Cents</span> App</a>
                </li>
                <li>
                    <div class="btn-group nav-button-right" role="group">
                        <a type="button" class="btn nav-button">
                            <span class="fa fa-user-circle user-circle"></span>
                        </a>
                        <a type="button" class="btn btn-success nav-button text-info" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-left">
                <li class="logo navbar-header">
                    <a class="navbar-brand" href="#"><span class="highlight">Cents</span> App</a>
                </li>
                <li class="navbar-search hidden-sm">
                    <input id="search" type="text" placeholder="Search..">
                    <button class="btn-search"><i class="fa fa-search"></i></button>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown profile">
                    <div class="btn-group nav-button-right" role="group">
                        <a type="button" class="dropdown profile btn nav-button">
                            <span class="fa fa-user-circle user-circle"></span>
                        </a>
                        <a type="button" class="btn btn-success nav-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </div>
                    <div class="dropdown-menu">
                        <div class="profile-info">
                            <h4 class="username">Scott White</h4>
                        </div>
                        <ul class="action">
                            <li>
                                <a href="#">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>