 @component('profiles.activities.activity')
@slot('heading')
  
  {{$profileUser->name}} replied to <a href="{{$activ->subject->thread->path()}}">{{$activ->subject->thread->title}}</a>
             
@endslot
@slot('date')
{{$activ->subject->created_at->diffForHumans()}}
@endslot
@slot('body')
   {{ $activ->subject->body}}
@endslot
@endcomponent
