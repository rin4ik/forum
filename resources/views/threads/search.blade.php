@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<ais-index app-id="{{config('scout.algolia.id')}}" api-key="{{config('scout.algolia.key')}}" index-name="threads" query="{{request('q')}}">
			<div class="col-md-8 ">
				<ais-results>
					<template slot-scope="{ result }">

						<p>
							<h4>
								<a :href="result.path">

									<ais-highlight :result="result" attribute-name="title"></ais-highlight>

								</a>
							</h4>
							<br>
							<ais-highlight :result="result" attribute-name="body"></ais-highlight>



						</p>

					</template>
				</ais-results>
				<ais-no-results>
					<template slot-scope="{ result }">
						Sorry! No results for this query...
					</template>
				</ais-no-results>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading" style="border-radius: 5px; text-align:center">
						<b>Search</b>
					</div>
					<div class="panel-body">

						<ais-search-box>

							<ais-input placeholder="Find a thread..." :autofocus="autofocus">
								<i class="fa fa-search" aria-hidden="true"></i>
							</ais-input>

						</ais-search-box>

					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" style="border-radius: 5px; text-align:center">
						<b>Filter by channel</b>
					</div>
					<div class="panel-body">
						<ais-refinement-list class="checkbox" attribute-name="channel.name"></ais-refinement-list>

					</div>
				</div>


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
		</ais-index>
	</div>
</div>
@endsection