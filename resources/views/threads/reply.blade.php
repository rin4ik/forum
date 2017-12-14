<reply :attributes="{{$reply}}" inline-template v-cloak>
        <div id="reply-{{$reply->id}}" class="panel panel-default">
                <div class="panel-heading" style="padding-top: 0px;background-color: #2672;border-radius: 5px;
     padding-bottom: 0px;">

                        <div class="level">
                                <h5 class="flex">
                                        <a href="/profiles/{{$reply->owner->name}}" style="font-weight: 600; font-size: 15px;">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}...
                                </h5>

                                @can('update', $reply)
                                <button type="submit" class="btn btn-link" style="font-weight: 700; width:30px;margin-top: -45px;
                 margin-right: -17.5px; height:20px;" @click="destroy">
                                        <i class="fa fa-window-close" style="color:rgba(24, 24, 26, 0.77)" aria-hidden="true"></i>

                                </button>

                                @endcan
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


                <div class="panel-footer level" style="padding: 0; background-color: white;">
                        @can ('update', $reply)
                        <button class="btn btn-link" @click="editing = true">
                                <i class="fa fa-pencil-square-o" style="color:rgb(37, 87, 188)" aria-hidden="true"></i> Edit</button>
                        @endcan
                        <favorite :reply="{{$reply}}"></favorite>

                </div>

        </div>


</reply>