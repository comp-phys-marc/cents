@extends('layouts.auth')

@section('content')

    <script>

        function fbAuthUser() {
            FB.login(function (response) {
                statusChangeCallback(response);
            }, {scope: 'public_profile,email'});
        }

        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                $('.panel').hide();
                $('.wrapper').show();
                callAPI();
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
            }
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId      : '2202037713354969',
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

        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function callAPI() {
            FB.api('/me', {fields: 'name'}, function(response) {
                $('#name').val(response.name);
                $('#password').val('nopassword');
                $('#facebook_id').val(response.id);
            });
            FB.api('/me', {fields: 'email'}, function(response) {
                $('#email').val(response.email);
                $('#facebook_email').val(response.email);
                $('#password-confirm').val('nopassword');
                $('#register-button').click();
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
                            <div id="mobile-links" class="text-center">
                                <a href="{{ url('/login') }}" class="btn col-sm-6 col-md-6 col-xs-6 {{ (strpos($_SERVER['REQUEST_URI'], 'login') == FALSE) ? 'active' : '' }}">
                                   Login
                                </a>
                                <a href="{{ url('/register') }}" class="btn col-sm-6 col-md-6 col-xs-6 {{ (strpos($_SERVER['REQUEST_URI'], 'register') == FALSE) ? 'active' : '' }}">
                                    Register
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-header">
                                <div class="row">
                                    <div class="app-brand brand padding-top"><span class="highlight">Cents</span> Register</div>
                                </div>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="name" class="col-md-6 control-label">Name (First and Last)</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
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
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="password" class="col-md-6 control-label">Password</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <input id="register-button" type="submit" class="btn btn-success btn-submit" value="Register">
                            </div>
                        </form>

                        <div class="form-line">
                            <div class="title">OR</div>
                        </div>
                        <div class="form-footer">
                            <button onClick="fbAuthUser()" id="facebook-button" type="button" class="btn btn-default btn-sm btn-social __facebook">
                                <div class="info">
                                    <i class="icon fa fa-facebook-official" aria-hidden="true"></i>
                                    <span class="title">Register with Facebook</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('#register-button').on('click', function(){
            $('#loader-title').html('Creating account...');
        });
        $('#facebook-button').on('click', function(){
            $('#loader-title').html('Creating account...');
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
