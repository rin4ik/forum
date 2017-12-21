@extends('layouts.app') @section('content')
<thread-view :initial-replies-count="{{$thread->replies_count}}" inline-template>
<div class="container" ii>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading alert-success" style="padding: 0;padding-left: 15px;">
                    <div class="level">
                        <span class="flex" style="font-weight: 400;
font-size: 20px;"> {{$thread->title}}</span>
                        @can('update', $thread)
                        <form action="{{$thread->path()}}" method="POST">
                            {{csrf_field()}} {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-link" style="font-weight: 700;"> Delete Thread</button>
                        </form> @endcan
                    </div>



                </div>
                <div class="panel-body">

                    <article>
                        <h4>{{$thread->body}}</h4>
                    </article>
                    <p style="text-align:right;"> posted by
                        <a href="/profiles/{{$thread->creator->name}}" style="font-weight: 500; font-size: 15px;">{{$thread->creator->name}}</a>

                    </p>

                </div>
            </div>
            <replies @added="repliesCount++" @removed="repliesCount--"></replies>
            
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">


                <div class="panel-body">

                    <p>
                        This thread was published {{$thread->created_at->diffForHumans()}} by
                        <a href="#">{{$thread->creator->name}}</a>, and currently has <span v-text="repliesCount"> </span>{{str_plural(' comment',$thread->replies_count)}}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</thread-view>
@endsection