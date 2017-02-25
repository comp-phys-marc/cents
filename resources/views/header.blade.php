<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Cents' }}</title>

    <!-- Styles -->
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/vendor.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/flat-admin.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/font-awesome.css')}}">

      <!-- Theme -->
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/theme/blue-sky.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/theme/blue.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/theme/red.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/theme/yellow.css')}}">

      <script src="{{URL::asset('js/jquery-3.1.1.min.js')}}"></script>
      <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>