@extends('layouts.app')

@section('content')



    <div class="app-container app-login">
        <div class="flex-center">
            <div class="app-header"></div>
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
                    <div class="title">Logging in...</div>
                </div>
                <div class="app-block">
                    <div class="app-form">
                        <div class="form-header">
                            <div class="app-brand"><span class="highlight">Cents</span> Login</div>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
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
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                                <input type="submit" class="btn btn-success btn-submit" value="Login">
                            </div>
                        </form>

                        <div class="form-line">
                            <div class="title">OR</div>
                        </div>
                        <div class="form-footer">
                            <button type="button" class="btn btn-default btn-sm btn-social __facebook">
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

@endsection
