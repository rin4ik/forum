<template>
        <div :id="'reply-'+id" class="panel panel-default">
                <div class="panel-heading" style="padding-top: 0px;background-color: #2672;border-radius: 5px;
     padding-bottom: 0px;">

                        <div class="level">
                                <h5 class="flex">
                                        <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name"style="font-weight: 600; font-size: 15px;"></a> said {{data.created_at}}...
                                </h5>
<!-- 
                                @can('update', $reply)
                                <button type="submit" class="btn btn-link" style="font-weight: 700; width:30px;margin-top: -45px;
                 margin-right: -17.5px; height:20px;" @click="destroy">
                                        <i class="fa fa-window-close" style="color:rgba(24, 24, 26, 0.77)" aria-hidden="true"></i>

                                </button>

                                @endcan -->
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
                        </div>
                </div>

<!-- @can ('update', $reply)
                <div class="panel-footer level" style="padding: 0; background-color: white;">
                        
                        <button class="btn btn-link " @click="editing = true">
                                <i class="fa fa-pencil-square-o" style="color:rgb(37, 87, 188)" aria-hidden="true"></i> Edit</button>
                        @endcan -->
                        <!-- @auth
                        <favorite :reply="{{$reply}}"></favorite>

    
@endauth
                </div> -->

        </div>

</template>

<script>   
import Favorite from './Favorite.vue';
export default {
    props:['data'],
   data(){
       return{
           editing:false,
           body: this.data.body,
           id:this.data.id,  
       };
   },
   methods:{
       update(){
           axios.patch('/replies/'+ this.data.id,{
               body:this.body
           });
           this.editing = false;  
           flash('Updated!');
       },
       destroy(){
            axios.delete('/replies/'+ this.data.id);
            $(this.$el).fadeOut(300, ()=>{
                flash('Your reply has been Deleted!');
            });
           
       }
   }
}
</script>
<style>

</style>
