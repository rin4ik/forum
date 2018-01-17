@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 ">
			@include('threads._list')
		</div>
		<div class="col-md-4">

			<!--/.Card content-->

			@if(count($trending))
			<div class="panel panel-default">
				<div class="panel-heading" style="border-radius: 5px; text-align:center">
					<b>Trending Threads</b>
				</div>

				<ul class="list-group">
					@foreach($trending as $thread)

					<li class="list-group-item">
						<a href="{{url($thread->path)}}">
							<p>{{$thread->title}}</p>
						</a>
					</li>
					@endforeach
				</ul>

			</div>
			@endif



		</div>
	</div>
</div>
@endsection