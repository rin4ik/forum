            <div class="panel panel-default">
                
      <div class="panel-heading">
       
       <div class="level">
       <h5 class="flex">  
       <a href="/profiles/{{$reply->owner->name}}" style="font-weight: 600; font-size: 15px;">{{$reply->owner->name}}</a> said
          {{$reply->created_at->diffForHumans()}}...
          </h5>
        <div>

            <form method="POST" action="/replies/{{$reply->id}}/favorites">
            {{csrf_field()}}
              <button type="submit" class="btn btn-primary" {{$reply->isFavorited() ? 'disabled' : ''}}>{{$reply->favorites_count}} <i class="fa fa-heart" aria-hidden="true"></i></button>
            </form>
        </div>
      </div>
      </div>         <div class="panel-body">
                       {{$reply->body}}
              </div>

              </div>