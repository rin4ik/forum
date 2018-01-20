{{-- editin the question --}}
<div class="panel panel-default" v-if="editing">
	<div class="panel-heading">
		<div class="level">
			<div class="md-form">
				<input style="
                font-size: 18px;" type="text" columns="20" value="{{$thread->title}}" class="form-control" v-model="form.title">
			</div> @can ('update', $thread)
			<form action="{{ $thread->path() }}" method="POST" class="ml-a">
				{{ csrf_field() }} {{ method_field('DELETE') }}

				<button type="submit" style="padding-bottom:0; padding-top:0;" class="btn btn-xs btn-outline-danger waves-effect">
					<b>Delete Thread</b>
				</button>
			</form>
			@endcan
		</div>
	</div>

	<div class="panel-body">
		<div class="md-form">
			<textarea class="form-control" rows="10" v-model="form.body">{{ $thread->body }}</textarea>
		</div>

	</div>
	<div>
		<button class="btn btn-xs btn-primary" @click="update">Update</button>
		<button class="btn btn-xs btn-danger waves-effect" @click="cancel" style="box-shadow:0">Cancel</button>
	</div>
</div>
{{-- viewing the question --}}
<div class="panel panel-default" v-else>
	<div class="panel-heading">
		<div class="level">

			<img src="{{ $thread->creator->avatar_path }}" alt="{{ $thread->creator->name }}" width="25" height="25" style="border-radius:15px;margin-right:5px">

			<span class="flex" style="
                    font-size: 18px;">
				<a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
				posted:
				<span v-text="form.title"></span>
			</span>

			@can ('update', $thread)
			<form action="{{ $thread->path() }}" method="POST">
				{{ csrf_field() }} {{ method_field('DELETE') }}

				<button type="submit" class="btn btn-xs btn-outline-danger waves-effect">
					<b>Delete Thread</b>
				</button>
			</form>
			@endcan
		</div>
	</div>

	<div class="panel-body" v-text="form.body">

	</div>
	<div v-if="authorize( 'owns' ,thread)">
		<button class=" btn btn-xs btn-outline-primary waves-effect " @click="toggleEdit " style="box-shadow:0 " v-cloak>
			<i class="fa fa-pencil-square-o " style="color:rgb(37, 87, 188) " aria-hidden="true "></i> Edit</button>
	</div>
</div>