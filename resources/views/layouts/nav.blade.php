<nav class="navbar is-link">
	<div class="navbar-brand">
		<a class="navbar-item caps" href="{{ url('/') }}" style="font-weight:700; font-size:15px">
			{{ config('app.name') }}
		</a>
		<div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>

	<div id="navbarExampleTransparentExample" class="navbar-menu">
		<div class="navbar-start">

			<div class="navbar-item has-dropdown is-hoverable">
				<a class="navbar-link" href="#">
					Browse
				</a>
				<div class="navbar-dropdown is-boxed">
					<a class="navbar-item" href="/threads">All Threads</a>
					@auth
					<a class="navbar-item" href="/threads?by={{auth()->user()->name}}">My Threads</a> @endauth
					<a class="navbar-item" href="/threads?popular=1">Popular Threads</a>
					<a class="navbar-item" href="/threads?unanswered=1">Unanswered Threads</a>

				</div>
			</div>

			<a class="navbar-item" href="/threads/create">
				New Thread
			</a>
			<div class="navbar-item has-dropdown is-hoverable">
				<a class="navbar-link" href="#">
					Channels
				</a>
				<div class="navbar-dropdown is-boxed">
					<a class="navbar-item" href="/threads?unanswered=1">Unanswered Threads</a>

					@forelse (\App\Channel::all() as $channel) @if(count($channel))

					<a class="nabar-item" href="/threads/{{ $channel->slug }}">
						{{ $channel->name }}
					</a>
					@endif @empty
					<li style="padding-left:7px">No relevant results!</li>
					@endforelse

				</div>
			</div>
		</div>

		<div class="navbar-end">
			<div class="navbar-item">
				<div class="field is-grouped">
					@guest
					<a class="navbar-item" href="{{ route('login') }}">Login</a>



					<a class="navbar-item" href="{{ route('register') }}">Register</a>

					@else
					<p class="navbar-item">
						<user-notifications></user-notifications>
					</p>
					<div class="navbar-item has-dropdown is-hoverable">
						<a class="navbar-link" href="#">
							{{ Auth::user()->name }}
						</a>
						<div class="navbar-dropdown is-boxed">
							<a class="navbar-item" href="/profiles/{{ Auth::user()->name }}">My Profile</a>
							<a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								Logout
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</div>

					</div>
					@endguest
				</div>
			</div>
		</div>
	</div>
</nav>