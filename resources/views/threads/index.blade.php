@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @forelse($threads as $thread)
            <div class="panel panel-default">
                <div class="panel-heading" style="padding: 0px;
padding-left: 15px; padding-right:15px; background-color: rgba(49, 52, 53, 0.1);border-radius: 5px; ">
                    <div class="level">
                        <h4 class="flex">
                            <a href="{{ $thread->path() }}" style="font-weight: 400;
font-size: 17px;">
                                {{ $thread->title }}
                            </a>
                        </h4>

                        <a href="{{ $thread->path() }}">
                            {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                        </a>
                    </div>

                </div>

                <div class="panel-body">
                    <div class="body">{{ $thread->body }}</div>
                    <div class="level" style="padding: 0; background-color: white; float:right; padding-top:10px">
                        created by
                        <a href="profiles/{{$thread->creator->name}}" style="margin-left:3px;margin-right:3px ">
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