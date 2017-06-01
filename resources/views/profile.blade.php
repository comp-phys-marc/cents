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
                @if(is_null($currentUser->legal_id))
                <div class="panel panel-default">
                    <div class="panel-heading">Register Account</div>
                    <div class="panel-body">
                        <form id="registerForm" class="form-horizontal" role="form" method="POST" action="{{ route('register_account') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                                <label for="date_of_birth" class="col-md-4 control-label">Date of Birth</label>

                                <div class='col-md-6'>
                                    <input type="date" name="date_of_birth" id="date_of_birth">
                                </div>
                            </div>
                            <br>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">City</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="state" class="col-md-4 control-label">State</label>

                                <div class="col-md-6">
                                    <select name="state" id="state" class="form-control bfh-states" data-country="CA" data-state="ON" required></select>
                                </div>
                            </div>
                            <br>

                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                <label for="country" class="col-md-4 control-label">Country</label>

                                <div class="col-md-6">
                                    <select name="country" id="country" class="form-control bfh-countries" for="country" data-country="CA" required></select>
                                </div>
                            </div>
                            <br>

                            <div class="form-group{{ $errors->has('transit') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Transit Number</label>

                                <div class="col-md-6">
                                    <input id="transit" type="text" class="form-control" name="transit" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('institution') ? ' has-error' : '' }}">
                                <label for="institution" class="col-md-4 control-label">Institution Number</label>

                                <div class="col-md-6">
                                    <input id="institution" type="text" class="form-control" name="institution" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('account') ? ' has-error' : '' }}">
                                <label for="account" class="col-md-4 control-label">Account Number</label>

                                <div class="col-md-6">
                                    <input id="account" type="text" class="form-control" name="account" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button id="register-button" type="button" class="btn btn-success">
                                        Register
                                    </button>
                                </div>
                            </div>
                            <input id="bank_token" name="bank_token" type="hidden" value="">
                        </form>
                    </div>
                </div>
                @endif
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
    <script type="text/javascript">

        $('document').ready(function() {
            $('#register-button').on('click', function()
            {
                stripe.createToken('bank_account', {
                    country: $('#country').val(),
                    currency: 'usd',
                    routing_number: $('#transit').val() + $('#institution').val(),
                    account_number: $('#account').val(),
                    account_holder_name: '{{ $currentUser->name }}',
                    account_holder_type: 'individual'
                }).then(function (result) {
                    if(result.token != null) {
                        $('#bank-token').val(result.token);
                        document.getElementById("registerForm").submit();
                    }
                });
            });
        });
    </script>
@endsection