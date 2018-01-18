@extends('layouts.app') @section('content') @section ('header')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create a New Thread</div>

				<div class="panel-body">
					@auth

					<form method="POST" action="/threads">
						{{csrf_field()}}

						<div class="form-group">
							<label for="channel_id"> Choose a channel:</label>
							<select name="channel_id" id="channel_id" required>
								<option value="">choose one...</option>
								@foreach($channels as $channel)
								<option value="{{$channel->id}}" {{old( 'channel_id')==$channel->id ? 'selected' : ''}}>{{$channel->name}}</option>
								@endforeach
							</select>
							<div class="form-group {{ $errors->has('channel_id') ? ' has-error' : '' }}">
								<p class="text-danger">{{ $errors->first('channel_id') }}</p>
							</div>
						</div>
						<div class="form-group">

							<label class="active" for="title">Title:</label>
							<input type="text" id="title" style="box-sizing:inherit" placeholder="Add a title" name="title" value="{{old('title')}}"
							 required>
							<p class="text-danger">{{ $errors->first('title') }}</p>

						</div>
						<div class="form-group">
							<label for="body"> Body:</label>
							<textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="6" required>{{old('body')}}</textarea>
							<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
								<p class="text-danger">{{ $errors->first('body') }}</p>
							</div>
						</div>
						<div class="g-recaptcha" data-sitekey="6Lez7UAUAAAAAKp4qnOA1I6VSK46bn9gQUtJ3aPy"></div>
						<div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
							<p class="text-danger">{{ $errors->first('g-recaptcha-response')}}</p>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Publish</button>

						</div>
					</form>

					@endauth @guest
					<p class="text-center">Please
						<a href="{{route('login')}}">sign in</a> to create a new thread</p>
					@endguest
				</div>
			</div>
		</div>
	</div>

</div>
@endsection