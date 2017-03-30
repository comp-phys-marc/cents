@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(!is_null($success))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ $success }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></li>
                        </ul>
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Profile Edit</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('update') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $currentUser->name }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ? old('email') : $currentUser->email }}" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('passwordOld') ? ' has-error' : '' }}">
                                <label for="passwordOld" class="col-md-4 control-label">Current Password</label>

                                <div class="col-md-6">
                                    <input id="passwordOld" type="password" class="form-control" name="passwordOld">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        Update
                                    </button>
                                </div>
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
        $(document).ready(function() {
            //component responsivity js
            if ($(window).width() < 770) {
                $('.container').addClass('padding-top-2');
            }
            else {
                $('.container').removeClass('padding-top-2');
            }
            $(window).resize(function () {
                if ($(window).width() < 770) {
                    $('.container').addClass('padding-top-2');
                }
                else {
                    $('.container').removeClass('padding-top-2');
                }
            });
        });
    </script>
@endsection