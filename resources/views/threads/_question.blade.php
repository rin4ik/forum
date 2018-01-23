{{-- editin the question --}}
<div class="panel panel-default" v-if="editing">
	<div class="panel-heading">

		<input style="
                font-size: 18px;" type="text" value="{{$thread->title}}" class="form-control" v-model="form.title">

	</div>

	<div class="panel-body">
		<div class="md-form">
			<wysiwyg v-model="form.body" :value="form.body"></wysiwyg>

			<button class="button is-info caps" @click="update">Update</button>
			<button class="button is-danger caps" @click="cancel" style="box-shadow:0">Cancel</button>

		</div>

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

				<button type="submit" class="btn btn-link caps" style="color:#f15858">
					<b>Delete Thread</b>
				</button>
			</form>
			@endcan
		</div>
	</div>

	<div class="panel-body" v-html="form.body">

	</div>
	<div v-if="authorize( 'owns' ,thread)">
		<button class="btn is-small btn-link caps" @click="toggleEdit " v-cloak>
			<i class="fa fa-pencil-square-o " style="color:rgb(37, 87, 188) " aria-hidden="true "></i> Edit</button>
	</div>
</div>