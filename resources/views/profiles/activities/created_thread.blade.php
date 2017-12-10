@component('profiles.activities.activity')
@slot('heading')
  
                           {{$profileUser->name}} published <a href="{{$activ->subject->path()}}">
                             {{$activ->subject->title}}
                           </a>   
@endslot
@slot('date')
{{$activ->subject->created_at->diffForHumans()}}
@endslot

@slot('body')
   {{ $activ->subject->body}}
@endslot
@endcomponent
