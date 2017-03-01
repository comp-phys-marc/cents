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

        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
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
                        <div class="form-header">
                            <div id="mobile-links" class="row">
                                <div class="col-sm-6 col-md-6 col-xs-6">
                                    <a href="{{ url('/login') }}">Login</a>
                                </div>
                                <div class="col-sm-6 col-md-6 col-xs-6">
                                    <a href="{{ url('/register') }}">Register</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="app-brand brand"><span class="highlight">Cents</span> Login</div>
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
                                <div class="col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-3">
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
                        </form>

                        <input id="facebook_id" type="hidden" value="none" type="password" class="form-control" name="facebook_id">
                        <input id="facebook_email" type="hidden" value="none" type="password" class="form-control" name="facebook_email">

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
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
