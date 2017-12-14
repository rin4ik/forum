 @component('profiles.activities.activity')
@slot('heading')
<i id="heart" class="fa fa-thumbs-up" aria-hidden="true"></i>

  <a href="{{$activ->subject->favorited->path()}}" style="
    margin-left:2px;">
 {{$profileUser->name}} favorited a reply.  
    </a>
          
@endslot
@slot('date')
 {{$activ->subject->created_at->diffForHumans()}} 
@endslot
@slot('body')
   {{ $activ->subject->favorited->body}} 
@endslot
@endcomponent
