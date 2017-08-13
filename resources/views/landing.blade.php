<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cents</title>

    <!-- Bootstrap and jQuery -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{URL::asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

    <!-- Custom Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/font-awesome.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/stylish-portfolio.css') }}" rel="stylesheet">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('img/centsfav.png') }}">

</head>

<body>
    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top" onclick=$("#menu-close").click();>Cents</a>
            </li>
            <li>
                <a href="#top" onclick=$("#menu-close").click();>Home</a>
            </li>
            <li>
                <a href="#about" onclick=$("#menu-close").click();>About</a>
            </li>
            <li>
                <a href="#contact" onclick=$("#menu-close").click();>Contact</a>
            </li>
            <li>
                <a href="{{ url('/login') }}">Login</a>
            </li>
            <li>
                <a href="{{ url('/register') }}">Register</a>
            </li>
        </ul>
    </nav>

    <!-- Header -->
    <header class="header" id="top">
        <div class="header-title">
            <h1>Cents</h1>
            <h3>The sensible way to manage transactions</h3>
            <br>
            <a href="#about" class="page-scroll btn btn-dark btn-lg">Find Out More</a>
        </div>
    </header>

    <!-- About -->
    <section id="about" class="about">
        <div class="container text-center">
            <h2>Create effective initiatives and manage your crowd.</h2>
            <p class="lead">A comprehensive and intuitive interface combined with a streamlined logical flow makes organizing and contributing a snap.</p>
            <p class="lead">Brought to you by  <a href="http://www.sigmadev.ca">SIGMA Development</a>.</p>
        </div>
        <!-- /.container -->
    </section>

    <!-- Services -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="services" class="services bg-blue text-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12 mx-auto">
                    <h2>Why Use Cents?</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-shield fa-stack-1x text-blue"></i>
                                </span>
                                <h4>
                                    <strong>Secured Cloud Storage</strong>
                                </h4>
                                <p> With Cents, your transaction data is kept securely in the cloud behind a tough-as-nails security layer.
                                    We let <a href="https://stripe.com/ca" class="link-text">Stripe</a>, a trusted platform that handles a billion transactions a year,
                                    maintain our users' financial details.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-compass fa-stack-1x text-blue"></i>
                            </span>
                                <h4>
                                    <strong>Know Where You're Going</strong>
                                </h4>
                                <p>Get a clear picture of where your campaigns are headed and what is happening with your investments.
                                Cents provides in-app campaign summaries and provides communication between fund raisers and contributors.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-cloud fa-stack-1x text-blue"></i>
                                </span>
                                <h4>
                                    <strong>Let Us Handle It</strong>
                                </h4>
                                <p> No need to keep track of your assets on your own. Cents keeps your records securely in the cloud. A two-click authentication can get you access to reports
                                    and downloadable spreadsheets.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Callout -->
    <aside class="callout">
        <div class="text-vertical-center row hidden-xs">
            <h1 class="text-blue">Cents Is Free To Use</h1>
        </div>
    </aside>

    <!-- Call to Action -->
    <aside id="contact" class="call-to-action bg-blue text-white">
        <div class="container text-center">
            <h3>Get a head start on your next project.</h3>
            <a href="{{ url('/register') }}" class="btn btn-lg btn-light">Sign Up</a>
        </div>
    </aside>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto text-center">
                    <h2><strong>Contact Cents</strong>
                    </h2>
                    <h3>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-phone fa-fw"></i> (519) 998-5843</li>
                            <li><i class="fa fa-envelope-o fa-fw"></i> <a href="mailto:marcusedwards@hotmail.ca">send us mail</a>
                            </li>
                        </ul>
                    </h3>
                    <br>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; <a href="http://www.sigmadev.ca">SIGMA Development</a> 2017</p>
                </div>
            </div>
        </div>
        <a id="to-top" href="#top" class="btn btn-dark btn-lg page-scroll"><i class="fa fa-chevron-up fa-fw fa-1x"></i></a>
    </footer>
    <script>
        // Closes the sidebar menu
        $("#menu-close, .sidebar-nav>li>a").click(function(e) {
            $("#sidebar-wrapper").toggleClass("active");
        });

        // Opens the sidebar menu
        $("#menu-toggle").click(function(e) {
            $("#sidebar-wrapper").toggleClass("active");
        });

        //#to-top button appears after scrolling
        var fixed = false;
        $(document).scroll(function() {
            if ($(this).scrollTop() > 250) {
                if (!fixed) {
                    fixed = true;
                    $('#to-top').show("slow", function() {
                        $('#to-top').css({
                            position: 'fixed',
                            display: 'block'
                        });
                    });
                }
            } else {
                if (fixed) {
                    fixed = false;
                    $('#to-top').hide("slow", function() {
                        $('#to-top').css({
                            display: 'none'
                        });
                    });
                }
            }
        });
    </script>
</body>
</html>
