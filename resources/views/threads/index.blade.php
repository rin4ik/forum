@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @forelse($threads as $thread)
            <div class="panel panel-default">
                <div class="panel-heading" style="padding: 0px;
padding-left: 10px; padding-right:10px; background-color: rgba(49, 52, 53, 0.1);border-radius: 5px; ">
                    <div class="level">
                        <h4 class="flex" style="margin: 6px; padding:4px; padding-left:0">
                            <a href="{{ $thread->path() }}" style="font-weight: 700;
font-size: 17px;">
                               
                         

                        <a href="{{ $thread->path() }}">
                        @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                     <p style="font-size:16px; margin: 0; color:rgb(16, 16, 16)">{{ $thread->title }}</p>
                        @else
                         <p style="font-size:16px;margin: 0; color:rgb(80, 90, 96)"> {{ $thread->title }}</p>
                        @endif
   </a>
                        </h4>
                            {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                        </a>
                    </div>

                </div>

                <div class="panel-body">
                    <div class="body" style="padding-left:2px">{{ $thread->body }}</div>
                    <div class="level" style="padding: 0; background-color: white; float:right; padding-top:10px">
                        created by
                        <a href="/profiles/{{$thread->creator->name}}" style="margin-left:3px;margin-right:3px ">
                        {{ $thread->creator->name}}</a>
                        {{$thread->created_at->diffForHumans()}}
                    </div>
                </div>

            </div>

            @empty
            <p>There no relevant results at this time</p>
            @endforelse
        </div>
    </div>
</div>
@endsection