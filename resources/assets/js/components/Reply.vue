<template>
        <div :id="'reply-'+id" class="panel panel-default">
                <div class="panel-heading" style="padding-top: 0px;background-color: #2672;border-radius: 5px;
     padding-bottom: 0px;">

                        <div class="level">
                                <h5 class="flex">
                                        <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name"style="font-weight: 600; font-size: 15px;"></a> said {{data.created_at}}...
                                </h5>

                                <!-- @can('update', $reply) -->
                                <div v-if="canUpdate">                       
                        <button type="submit" class="btn btn-link" style="font-weight: 700; width:30px;margin-top: -45px;
                 margin-right: -17.5px; height:20px;" @click="destroy">
                                        <i class="fa fa-window-close" style="color:rgba(24, 24, 26, 0.77)" aria-hidden="true"></i>

                                </button>
                                </div>
 
<!-- 
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

 
                <div class="panel-footer level" v-if="canUpdate" style="padding: 0; background-color: white;">
                        
                        <button class="btn btn-link " @click="editing = true">
                                <i class="fa fa-pencil-square-o" style="color:rgb(37, 87, 188)" aria-hidden="true"></i> Edit</button>
                      
                         <div v-if="signedIn">
                        <favorite :reply="data"></favorite> 
</div>

                </div> 

        </div>

</template>

<script>   
import Favorite from './Favorite.vue';
export default {
    props:['data'],
    components:{Favorite},
   data(){
       return{
           editing:false,
           body: this.data.body,
           id:this.data.id,  
       };
   },
   computed:{
      signedIn(){
              return window.App.signedIn;
      },
      canUpdate(){
             return this.authorize(user=>this.data.user_id == user.id);
            //  return this.data.user_id == window.App.user.id;
      }
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
            this.$emit('deleted', this.data.id);
        
           
       },
        
   }
}
</script>
<style>

</style>
