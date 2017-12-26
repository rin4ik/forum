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
      <script>
      window.App={!!json_encode(['csrfToken'=>csrf_token(),
      'user'=>Auth::user(),
      'signedIn'=>Auth::check()
      ])!!};
      </script>
<style>
.badge-notify{
   background:red;
   position:relative;
   
   left: -130px;
  }
    body{
        background-color: #F8F6F2;
        padding-bottom: 100px;
    }
    [v-cloak]{
        display: none;
    },
    .fa-heart-o::before {
    content: "\f087";
}
    #heart{
    text-shadow: 1px 1px 1px #f0d1d1;
    font-size: 1.1em;
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
        <flash message="{{session('flash')}}"></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>
</html>
