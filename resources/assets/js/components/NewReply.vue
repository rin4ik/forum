<template>
<div>
    <div v-if="signedIn">
     <!-- @auth -->
            <!-- <form method="POST" action="{{$thread->path().'/replies'}}"> -->
                <!-- {{csrf_field()}} -->
                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5" v-model="body" required></textarea>
               </div>
                <button type="submit" @click="addReply" class="btn btn-default">Post</button>
            <!-- </form> -->
</div>

          
             <p class="text-center" v-else>Please
                <a href="/login">sign in</a> to participate in this discussion</p>
         

</div>
</template>


<script>   
    import Reply from './Reply.vue';
export default {
    props:['endpoint'],
            data(){
            return{
                body:''
            };
            },
            computed:{
                signedIn(){
                    return window.App.signedIn;
                }
            },
            methods:{
                addReply(){
                    axios.post(this.endpoint, {body:this.body})
                    .then(({data})=>{
                        
                        flash('Your reply has been posted');
                        this.$emit('created', data);
                        this.body='';
                    });
                }
            }
       }

</script>
<style>

</style>
