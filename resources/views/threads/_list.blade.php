@forelse($threads as $thread)
<div class="panel panel-default">
	<div class="panel-heading" style="padding: 0px;
padding-left: 10px; padding-right:10px; border-radius: 5px; ">
		<div class="level">
			<h4 class="flex" style="margin: 6px; padding:4px; padding-left:0">
				<a href="{{ $thread->path() }}">
					@if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
					<p style="font-size:17px; margin: 5px; margin-left:5px; color:rgb(16, 16, 16)">{{$thread->title}}</p>
					@else
					<p style="font-size:17px;margin: 5px;margin-left:5px; color:rgb(80, 90, 96)">{{$thread->title}}</p>
					@endif
				</a>

			</h4>
			<a href="{{ $thread->path() }}" style="
                font-size: 15px;color:rgb(50, 50, 50)">
				<span>{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</span>
			</a>
		</div>

	</div>

	<div class="panel-body">
		<div class="body" style="margin: 5px;padding-left:2px">{{$thread->body }}</div>
		<div class="level" style="padding: 0;margin: 5px; background-color: white; float:right; padding-top:10px">
			posted by
			<a href="/profiles/{{$thread->creator->name}}" style="margin-left:3px;margin-right:3px ">
				{{ $thread->creator->name}}</a>
			{{$thread->created_at->diffForHumans()}}
		</div>
	</div>
	<div class="panel-footer" style="background-color:white">
		{{$thread->visits}} {{ str_plural('Visit', $thread->visits) }}
	</div>
</div>
@empty
<p>There no relevant results at this time</p>
@endforelse {{$threads->render()}}