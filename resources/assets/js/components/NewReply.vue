<template>
<div>
    <div v-if="signedIn">
     <!-- @auth -->
            <!-- <form method="POST" action="{{$thread->path().'/replies'}}"> -->
                <!-- {{csrf_field()}} -->
                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Jot something down" rows="5" v-model="body" required></textarea>
               </div>
                <button type="submit" @click="addReply" class="btn btn-outline-primary waves-effect">Post</button>
            <!-- </form> -->
</div>

          
             <p class="text-center" v-else>Please
                <a href="/login">sign in</a> to participate in this discussion</p>
         

</div>
</template>


<script>
import Reply from "./Reply.vue";
import "at.js";
import "jquery.caret";
export default {
  data() {
    return {
      body: ""
    };
  },
  mounted() {
    $("#body").atwho({
      at: "@",
      delay: 2000,
      callbacks: {
        remoteFilter: function(query, callback) {
          console.log("called");
          $.getJSON("/api/users", { name: query }, function(usernames) {
            callback(usernames);
          });
        }
      }
    });
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
          flash("Your reply has been posted.");
          this.$emit("created", data);
        });
    }
  }
};
</script>
<style>

</style>
