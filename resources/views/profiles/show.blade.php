@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="page-header">
				<h1> {{$profileUser->name}}

				</h1>
				<img src="{{$profileUser->avatar()}}" width="50" height="50"> @can('update', $profileUser)
				<form action="{{route('avatar', $profileUser)}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="file" name="avatar">

					<button type="submit" class="btn btn-primary">Add avatar</button>

				</form>
				@endcan
			</div>
			@forelse($activities as $date => $activity)
			<h3 class="page-header">
				{{$date}}
			</h3>
			@foreach($activity as $activ) @if(view()->exists("profiles.activities.{$activ->type}")) @include("profiles.activities.{$activ->type}")
			@endif @endforeach @empty
			<h4>There is no activity for this user yet!</h4>
			@endforelse {{-- {{$activity->links()}} --}}
		</div>
	</div>
</div>

@endsection