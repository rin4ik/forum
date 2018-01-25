<template>
<div>
    <div v-if="signedIn">
     <!-- @auth -->
            <!-- <form method="POST" action="{{$thread->path().'/replies'}}"> -->
                <!-- {{csrf_field()}} -->
                <div class="form-group">
                   <wysiwyg name="body" v-model="body" placeholder="Jot something down" :shouldClear="completed"></wysiwyg>
                   
               </div>
                <button type="submit" @click="addReply" class="btn shadow btn-primary ">POST</button>
            <!-- </form> -->
</div>

          
             <p class="text-center" v-else>Please
                <a href="/login">sign in</a> to participate in this discussion</p>
         

</div>
</template>


<script>
import Reply from "./Reply.vue";

export default {
  data() {
    return {
      body: "",
      completed: false
    };
  },

  methods: {
    addReply() {
      axios
        .post(location.pathname + "/replies", { body: this.body })
        .catch(error => {
          flash(error.response.data, "danger");
        })
        .then(({ data }) => {
          this.body = "";
          this.completed = true;
          flash("Your reply has been posted.");
          this.$emit("created", data);
        });
    }
  }
};
</script>
<style>

</style>
