@extends('layouts.app')

@section('content')
<div class="container"ii>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading alert-success"> 
              <div class="level">
                     <span class="flex" style="font-weight: 600; font-size: 15px;"> {{$thread->title}}</span>
                @can('update', $thread)
                <form action="{{$thread->path()}}" method="POST">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                 <button type="submit" class="btn btn-link" style="font-weight: 700;"> Delete Thread</button>
</form>  @endcan
              </div>
           
              

</div>
                <div class="panel-body">
               
               <article>
                        <h4>{{$thread->body}}</h4>
                    </article>
                   <p style="text-align:right;"> posted by  <a href="/profiles/{{$thread->creator->name}}" style="font-weight: 500; font-size: 15px;">{{$thread->creator->name}}</a>

             </p>

              </div>
            </div>
        
        @foreach($replies as $reply)
             @include('threads.reply')
        @endforeach
        {{$replies->links()}}
        @auth
    
            <form method="POST" action="{{$thread->path().'/replies'}}">
                {{csrf_field()}}
              <div class="form-group">
                  <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                  <p class="text-danger">{{ $errors->first('body','Oh my gosh please type something , buddy!') }}</p>
              </div>
              </div>
            <button type="submit" class="btn btn-default">Post</button>
            </form> 
    
    @endauth
    @guest
    <p class="text-center">Please <a href="{{route('login')}}">sign in</a> to participate in this discussion</p>
    @endguest
        </div>
<div class="col-md-4">
  <div class="panel panel-default">


                <div class="panel-body">
               
                  <p>
                      This thread was published {{$thread->created_at->diffForHumans()}} by <a href="#">{{$thread->creator->name}}</a>,
                       and currently has {{$thread->replies_count}} {{str_plural(' comment',$thread->replies_count)}}.
                  </p>
              </div>
            </div>
</div>
    </div>
</div>
@endsection
