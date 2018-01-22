 @component('profiles.activities.activity') @slot('heading')
<i class="fa fa-reply" aria-hidden="true" style="margin-right:2px;"> </i>


{{$profileUser->name}} replied to
<a href="{{$activ->subject->thread->path()}}">{{$activ->subject->thread->title}}</a>

@endslot @slot('date') {{$activ->subject->created_at->diffForHumans()}} @endslot @slot('body') {!! $activ->subject->body
!!} @endslot @endcomponent