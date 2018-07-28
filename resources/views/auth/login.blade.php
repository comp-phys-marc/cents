@extends('layouts.auth')

@section('content')

    <script>

        function fbAuthUser() {
            FB.login(function (response) {
                statusChangeCallback(response);
            }, {scope: 'public_profile,email'});
        }
        function statusChangeCallback(response) {
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                $('.panel').hide();
                $('.wrapper').show();
                callAPI();
            }
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1897034183863604',
                xfbml      : true,
                version    : 'v2.8'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        function callAPI() {
            FB.api('/me', {fields: 'email'}, function(response) {
                $('#email').val('noemail@cents.ca');
                $('#password').val('nopassword');
                $('#facebook_email').val(response.email);
                $('#facebook_id').val(response.id);
                $('#login-button').click();
            });
        }
    </script>


    <div class="app-container app-login">
        <div class="flex-center">
            <div class="app-header">
            </div>
            <div class="app-body">
                <div class="loader-container text-center">
                    <div class="icon">
                        <div class="sk-folding-cube">
                            <div class="sk-cube1 sk-cube"></div>
                            <div class="sk-cube2 sk-cube"></div>
                            <div class="sk-cube4 sk-cube"></div>
                            <div class="sk-cube3 sk-cube"></div>
                        </div>
                    </div>
                    <div id="loader-title" class="title">Loading content...</div>
                </div>
                <div class="app-block">
                    <div class="app-form">
                        <div class="row">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(session('alert-' . $msg))
                                        <p class="alert alert-{{ $msg }}">{{ session('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div id="mobile-links" class="text-center">
                                <a href="{{ url('/login') }}" class="btn col-sm-6 col-md-6 col-xs-6 {{ (strpos($_SERVER['REQUEST_URI'], 'login') != FALSE) ? 'active' : '' }}">
                                    Login
                                </a>
                                <a href="{{ url('/register') }}" class="btn col-sm-6 col-md-6 col-xs-6 {{ (strpos($_SERVER['REQUEST_URI'], 'register') != FALSE) ? 'active' : '' }}">
                                    Register
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-header">
                                <div class="row">
                                    <div class="app-brand brand padding-top"><span class="highlight">Cents</span> Login</div>
                                </div>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('social_login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="email" class="col-md-6 control-label">E-Mail Address</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="password" class="col-md-6 control-label">Password</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-3 col-xs-8 col-xs-offset-3">
                                    <div class="checkbox">
                                        <input class="check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label>Remember Me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                                <input id="login-button" type="submit" class="btn btn-success btn-submit" value="Login">
                            </div>

                            <input id="facebook_id" type="hidden" value="none" type="password" class="form-control" name="facebook_id">
                            <input id="facebook_email" type="hidden" value="none" type="password" class="form-control" name="facebook_email">

                        </form>

                        <div class="form-line">
                            <div class="title">OR</div>
                        </div>
                        <div class="form-footer">
                            <button onClick="fbAuthUser()" id="facebook-button" type="button" class="btn btn-default btn-sm btn-social __facebook">
                                <div class="info">
                                    <i class="icon fa fa-facebook-official" aria-hidden="true"></i>
                                    <span class="title">Login with Facebook</span>
                                </div>
                            </button>
                            <button id="connect-ynab" type="button" class="btn btn-default btn-sm btn-social grey-color">
                                <img id="ynab-image" src="{{ URL::asset('img/YNAB-logo.jpg') }}" class="logo">
                                <span>Connect with YNAB</span>
                            </button>
                            <div style="display: none;" id="ynab-tooltip" class="logo" data-toggle="tooltip" title="YNAB connected! You still need to login normally.">
                                <i class="icon fa fa-question-circle" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ URL::asset('js/ynab/auth.js') }}"></script>
    <script src="{{ URL::asset('js/auth-form.js') }}"></script>
    <script>
        $('.checkbox').on('click', function() {
            if ($(this).find('.check-input').attr('checked') == "checked") {
                $(this).find('.check-input').attr('checked', false);
            }
            else {
                $(this).find('.check-input').attr('checked', 'checked');
            }
        });

        $('#login-button').on('click', function(){
            $('#loader-title').html('Logging in...');
        });
        $('#facebook-button').on('click', function(){
            $('#loader-title').html('Logging in...');
        });

        $(document).ready(function() {
            if($(window).width() < 770) {
                $('#desktop-links').hide();
                $('#mobile-links').show();
            }
            else{
                $('#desktop-links').show();
                $('#mobile-links').hide();
            }
            $(window).resize(function () {
                if($(window).width() < 770) {
                    $('#desktop-links').hide();
                    $('#mobile-links').show();
                }
                else{
                    $('#desktop-links').show();
                    $('#mobile-links').hide();
                }
            });
        });
    </script>
@endsection
