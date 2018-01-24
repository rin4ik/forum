@extends('layouts.app') @section('header')
<link rel="stylesheet" href="/css/vendor/jquery.atwho.css"> @endsection @section('content')
<thread-view :thread="{{$thread}}" inline-template>
	<div class="container">
		<div class="row">
			<div class="col-md-8" v-cloak>
				@include('threads._question')

				<replies @added="repliesCount++" @removed="repliesCount--"></replies>
			</div>
			<div class="col-md-4">

				<div class="panel panel-default">
					<div class="panel-body">
						<p>
							This thread was published {{ $thread->created_at->diffForHumans() }} by
							<a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>, and currently has
							<span v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}
						</p>

						<p>
							<subscribe-button v-if="signedIn" :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
							<button v-if="authorize('isAdmin')" class="btn shadow btn-danger " @click="toggleLock" v-text="locked? 'UNLOCK'   : 'LOCK'">
							</button>

						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</thread-view>
@endsection