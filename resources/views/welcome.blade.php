<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/img/img10.png">
	<title>Forum</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded" rel="stylesheet">
	<!-- Styles -->
	<style>
		html,
		body {
			background-color: #eee0;
			color: #FFF;
			font-family: 'Rajdhani', sans-serif;

			font-weight: 500;
			height: 100vh;
			margin: 0;
		}

		.links>a {
			color: #555;
		}

		.full-height {
			height: 80vh;
		}

		.flex-center {
			align-items: center;
			display: flex;
			justify-content: center;
		}

		.position-ref {
			position: relative;
		}

		.top-right {
			position: absolute;
			right: 10px;
			top: 18px;
		}

		.content {
			text-align: center;
		}

		.title {
			font-size: 84px;
			font-weight: 400;
		}

		.links>a {
			padding: 0 25px;
			font-size: 12px;
			font-weight: 600;
			letter-spacing: .1rem;
			text-decoration: none;
			text-transform: uppercase;
		}

		.m-b-md {
			margin-bottom: 30px;
		}
	</style>
</head>

<body>
	<div class="flex-center position-ref full-height">
		@if (Route::has('login'))
		<div class="top-right links">
			@auth
			<a href="{{ url('/home') }}">Home</a>
			@else
			<a href="{{ route('login') }}">Login</a>
			<a href="{{ route('register') }}">Register</a>
			@endauth
		</div>
		@endif

		<div class="content">

                
			<div class="title m-b-md">
				<a href="/threads" style="text-decoration: none; color:#727b7b">Threads</a>
			</div>

		</div>
	</div>
		<!-- Scripts -->

		<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="/js/popper.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap.js"></script>
		<script type="text/javascript" src="/js/mdb.js"></script>
		<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>