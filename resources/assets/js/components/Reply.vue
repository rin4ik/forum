<template>
        <div :id="'reply-'+id" class="panel" :class="isBest? 'panel-success' : 'panel-default'">
                <div class="panel-heading" style="">

                        <div class="level">
                                <h5 class="flex">
                                        <a :href="'/profiles/'+reply.owner.name" v-text="reply.owner.name"style=" font-size: 16px;">
                                        </a> said <span v-text="ago"></span>
                                </h5>
                                <div v-if="authorize('owns',reply)">                       
                        <button type="submit" class="btn btn-link" style="font-weight: 700; width:30px;margin-top: -68px;
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
                                        <wysiwyg v-model="body"></wysiwyg>
                                </div>
                                <button class="button is-info caps">Update</button>
                                <button class="button is-danger is-small caps" @click="editing=false" 
                                type="button">Cancel</button>
                                </form>
                        </div>
                        <div v-else v-html="body">  
                        </div>
                </div>
                       <div class='level'>
                      <div v-if="authorize('owns',reply)" style="padding: 0; background-color: white; float:left">
                        
                        <button class="btn is-small btn-link caps" @click="editing = true" style="box-shadow:0; padding-right:0">
                                <i class="fa fa-pencil-square-o" style="color:rgb(37, 87, 188)" aria-hidden="true"></i> Edit</button>
                         </div>  
                         
                       
                                 <favorite :reply="reply" style="padding-left:10px;"></favorite> 
                                
                                 <p v-if="signedIn" class="ml-a"><button class="btn btn-link caps" v-if="authorize('owns',reply.thread)" @click="markBestReply" v-show="!isBest" style="box-shadow:0;color:rgb(60, 150, 60)">Best Reply?</button></p>
                                 <p class="ml-a" @click="markBestReply" v-show="isBest" style="color:#3c763d">Best <i class="fa fa-check-square-o" aria-hidden="true"></i></p>
                                   
                        </div>     
           
                        
                       
</div>

</template>

<script>
import Favorite from "./Favorite.vue";
import moment from "moment";

export default {
  props: ["reply"],
  components: { Favorite },
  data() {
    return {
      editing: false,
      body: this.reply.body,
      id: this.reply.id,
      isBest: this.reply.isBest
    };
  },
  computed: {
    ago() {
      return (
        moment(this.reply.created_at)
          .add(120, "minutes")
          .from(moment()) + "..."
      );
    }
  },
  created() {
    window.events.$on("best-reply-selected", id => {
      this.isBest = id === this.id;
    });
  },

  methods: {
    update() {
      axios
        .patch("/replies/" + this.id, {
          body: this.body
        })
        .catch(error => {
          flash(error.response.data, "danger");
        })
        .then(({ data }) => {
          this.editing = false;
          flash("Updated!!");
        });
    },
    destroy() {
      axios.delete("/replies/" + this.id);
      this.$emit("deleted", this.id);
    },
    markBestReply() {
      axios.post("/replies/" + this.reply.id + "/best");
      window.events.$emit("best-reply-selected", this.id);
    }
  }
};
</script>
<style>

</style>
