<nav class="navbar navbar-default navbar-static-top" style="background-color:hsl(0, 0%, 96%); border-bottom: 1px double  rgb(176, 180, 183); border-radius:4px; ">

	<div class="container">
		<div class="navbar-header">

			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/') }}" style="font-weight:600; color:#ea2742; font-size:14px">
				{{ config('app.name') }}
			</a>
		</div>

		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
						Browse
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						<li>
							<a href="/threads">All Threads</a>
						</li>
						@auth
						<li>
							<a href="/threads?by={{auth()->user()->name}}">My Threads</a>
						</li>
						@endauth
						<li>
							<a href="/threads?popular=1">Popular Threads</a>
						</li>
						<li>
							<a href="/threads?unanswered=1">Unanswered Threads</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="/threads/create">New Thread</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
						Channels
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						@forelse (\App\Channel::all() as $channel) @if(count($channel))
						<li>
							<a href="/threads/{{ $channel->slug }}">{{ $channel->name }}</a>
						</li>
						@endif @empty
						<li style="padding-left:7px">No relevant results!</li>
						@endforelse

					</ul>
				</li>
			</ul>
			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@guest
				<li>
					<a href="{{ route('login') }}">Login</a>
				</li>
				<li>
					<a href="{{ route('register') }}">Register</a>
				</li>
				@else
				<user-notifications></user-notifications>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
						{{ Auth::user()->name }}
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						<li>
							<a href="/profiles/{{ Auth::user()->name }}">My Profile</a>
						</li>
						<li>
							<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
								Logout
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
					</ul>
				</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>