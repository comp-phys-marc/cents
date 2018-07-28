@extends('layouts.auth')

@section('content')

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
                            <button id="connect-ynab" type="button" class="btn btn-default btn-sm btn-social grey-color">
                                <img id="ynab-image" src="{{ URL::asset('img/YNAB-logo.jpg') }}" class="logo">
                                <span>Connect with YNAB</span>
                            </button>
                            <div style="display: none;" id="ynab-tooltip" class="logo" data-toggle="tooltip" title="YNAB connected! You still need to register normally.">
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
        $('#register-button').on('click', function(){
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
