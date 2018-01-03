<template>
        <div :id="'reply-'+id" class="panel panel-default">
                <div class="panel-heading" style="padding-top: 0px;background-color: rgba(49, 52, 53, 0.1);border-radius: 5px;
     padding-bottom: 0px;">

                        <div class="level">
                                <h5 class="flex">
                                        <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name"style=" font-size: 16px;">
                                        </a> said <span v-text="ago"></span>
                                </h5>
                                <div v-if="canUpdate">                       
                        <button type="submit" class="btn btn-link" style="font-weight: 700; width:30px;margin-top: -45px;
                 margin-right: -17.5px; height:20px;" @click="destroy">
                                        <i class="fa fa-window-close" style="color:rgba(24, 24, 26, 0.77)" aria-hidden="true"></i>

                                </button>
                                </div>
                        </div>
                </div>
                <div class="panel-body">
                        <div v-if="editing">
                                <form @submit="update">
                                <div class="form-group">
                                        <textarea class="form-control" v-model="body" required></textarea>
                                </div>
                                <button class="btn btn-xs btn-primary">Update</button>
                                <button class="btn btn-xs btn-link" @click="editing=false" type="button">Cancel</button>
                                </form>
                        </div>
                        <div v-else v-text="body">  
                        </div>
                </div>
<hr style="margin:0; width:15%">
                <div v-if="canUpdate" style="padding: 0; background-color: white; float:left">
                        
                        <button class="btn btn-link " @click="editing = true">
                                <i class="fa fa-pencil-square-o" style="color:rgb(37, 87, 188)" aria-hidden="true"></i> Edit</button>
                      
                  
                </div>       
                        
                        <div v-if="signedIn">
                        <favorite :reply="data" style="padding-left:10px;"></favorite> 

                        </div> 
</div>

</template>

<script>   
import Favorite from './Favorite.vue';
import moment from 'moment';

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
      ago(){
              return moment(this.data.created_at).add(120, 'minutes').from(moment())+'...';
      },
      signedIn(){
              return window.App.signedIn;
      },
      canUpdate(){
             return this.authorize(user=>this.data.user_id === user.id);
      }
   },
   methods:{
       update(){
           axios.patch('/replies/'+ this.data.id,{
               body:this.body
           })
           .catch(error => {
                   flash(error.response.data, 'danger');
           }).then(({data}) => {
                       this.editing = false;
            flash('Updated!!');
                    });
            
       },
       destroy(){
            axios.delete('/replies/'+ this.data.id);
            this.$emit('deleted', this.data.id);   
       }
   }
}
</script>
<style>

</style>
