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

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:500" rel="stylesheet">

	<script>
		window.App={!!json_encode(['csrfToken'=>csrf_token(),
      'user'=>Auth::user(),
      'signedIn'=>Auth::check()
      ])!!};
	</script>
	@yield('header')
	<style>
		.ml-a {
			margin-left: auto;
			margin-right: 7px
		}

		body {
			font-family: 'Encode Sans Expanded', sans-serif;
			background-color: #fbfbfb;
		}


		.navbar {
			border-radius: 0px;
		}

		[v-cloak] {
			display: none;
		}

		,
		.fa-heart-o::before {
			content: "\f087";
		}

		.btn-file {
			position: relative;
			overflow: hidden;
		}


		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
		}

		#heart {
			text-shadow: 1px 1px 1px #f0d1d1;
			font-size: 1.1em;
		}

		.level {

			display: flex;
			align-items: center;
		}

		a:hover {
			text-decoration: none
		}

		.flex {
			flex: 1;
		}
	</style>
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