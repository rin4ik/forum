<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" href="/img/img10.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://use.fontawesome.com/21fa307658.js"></script>
    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    body{
        background-color: #F8F6F2;
        padding-bottom: 100px;
    }
    .level{

        display: flex;align-items: center;
    }
    .flex{
        flex: 1;

    }
</style>
</head>
 <body>
    <div id="app">
        @include('layouts.nav')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
