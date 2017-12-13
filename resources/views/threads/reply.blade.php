<reply :attributes="{{$reply}}" inline-template>
     <div id="reply-{{$reply->id}}" class="panel panel-default">
                
      <div class="panel-heading" style="padding-top: 0px;
     padding-bottom: 0px;">
       
       <div class="level">
       <h5 class="flex">  
       <a href="/profiles/{{$reply->owner->name}}" style="font-weight: 600; font-size: 15px;">{{$reply->owner->name}}</a> said
          {{$reply->created_at->diffForHumans()}}...
          </h5>
        <div style="display: inline-flex;">
       
            <form method="POST" action="/replies/{{$reply->id}}/favorites">
            {{csrf_field()}}
              <button type="submit" class="btn btn-link" style="text-decoration: none; width:30px; height:20px;" {{$reply->isFavorited() ? 'disabled' : ''}} > {{$reply->favorites_count}}<i class="fa fa-heart" aria-hidden="true" style="color:#c21f1f; margin-left:2px;"></i></button>
            </form>
      
      

<button type="submit" class="btn btn-link"  @click="editing=true" style="font-weight: 700; width:30px; margin-top:3px ; height:20px;"><i class="fa fa-pencil-square-o" style="color:rgb(37, 87, 188)" aria-hidden="true" ></i>
</button>
</div>

@can('update', $reply)
                <form action="\replies\{{$reply->id}}" method="POST">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                 <button type="submit" class="btn btn-link" style="font-weight: 700; width:30px;margin-top: -45px;
                 margin-right: -17.5px; height:20px;"><i class="fa fa-window-close"style="color:rgba(24, 24, 26, 0.77)" aria-hidden="true"></i>

        </button>
</form>  @endcan
        </div>
           </div>
           <div class="panel-body">
              <div v-if="editing">
             <div class="form-group">
              <textarea class="form-control" v-model="body"></textarea>
              </div>
              <button class="btn btn-xs btn-primary" @click="update">Update</button>
              <button class="btn btn-xs btn-link" @click="editing=false">Cancel</button>
              </div>
            <div v-else v-text="body">
               {{$reply->body}}
            </div>
              </div>  
          </div>         
            

</reply>