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
	<title>Forum</title>
	<!-- Styles -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/0.11.1/trix.css">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded" rel="stylesheet">

	<script>
		window.App={!!json_encode(['csrfToken'=>csrf_token(),
      'user'=>Auth::user(),
      'signedIn'=>Auth::check()
      ])!!};
	</script>
	@yield('header')

</head>

<body>
	<div id="app">
		@include('layouts.nav') @yield('content')
		<flash message="{{session('flash')}}"></flash>

	</div>

	<!-- Scripts -->


	<script src="{{ asset('js/app.js') }}"></script>
</body>
@include('layouts.footer')

</html>