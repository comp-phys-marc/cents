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
                    <div  id="loader-title" class="title">Loading content...</div>
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
                                <div class="app-brand padding-top">Password Reset</div>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
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
                            <div class="text-center">
                                <input id="get-link" type="submit" class="btn btn-success btn-submit" value="Get Reset Link">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('#get-link').on('click', function(){
            $('#loader-title').html('Sending reset link...');
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
