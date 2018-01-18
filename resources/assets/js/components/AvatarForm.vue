<template>
<div>
  <div class="level">
				<img :src="avatar" width="100" height="100" style="margin-right:10px; border-radius:50px"> 
    <h1 v-text="uppercase(user.name)">
    </h1>
  </div>                   
                <form v-if="canUpdate" method="post" enctype="multipart/form-data">
<image-upload name="avatar" class='mr-1' @loaded="onLoad">

</image-upload>

				</form>
				
            
</div>
</template>
<script>
import ImageUpload from "./ImageUpload.vue";
export default {
  props: ["user"],
  components: { ImageUpload },
  data() {
    return {
      avatar: this.user.avatar_path
    };
  },
  computed: {
    canUpdate() {
      return this.authorize(user => this.user.id === user.id);
    }
  },
  created() {},
  methods: {
    uppercase: function(v) {
      return v.toUpperCase();
    },
    onLoad(avatar) {
      this.avatar = avatar.src;
      this.persist(avatar.file);
    },
    persist(avatar) {
      let data = new FormData();
      data.append("avatar", avatar);

      axios
        .post("/api/users/${this.user.name}/avatar", data)
        .then(() => flash("Avatar uploaded!"));
    }
  }
};
</script>
