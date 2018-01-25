@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 ">
			@include('threads._list')
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading" style=" text-align:center">
					Search
				</div>

				<div class="panel-body ">
					<form method="GET" action="/threads/search">
						<input type="text" style="box-sizing:inherit" placeholder="Search for something..." class="form-control" name="q" id="">
						<button type="submit" class="button shadow caps btn-primary" style=" display:block;
						text-align:center ;
						
						margin:0 auto">
							<b class="caps"> Search</b>

						</button>
					</form>
				</div>

			</div>

			<!--/.Card content-->

			@if(count($trending))
			<div class="panel panel-default">
				<div class="panel-heading" style="border-radius: 5px; text-align:center">
					Trending Threads
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