<template>
 <button type="submit" @click='toggle' class="btn btn-link " style="padding-left:0px; text-decoration:none;">
      <span v-text="count"> </span> <i class="fa" :class="classes" aria-hidden="true" ></i></button>
</template>

<script>
export default {
  props: ["reply"],
  data() {
    return {
      count: this.reply.favoritesCount,
      active: this.reply.isFavorited
    };
  },
  computed: {
    classes() {
      return [this.active ? "fa-heart ol" : "fa-heart om"];
    }
  },
  created() {},
  methods: {
    toggle() {
      this.active ? this.destroy() : this.create();
    },
    create() {
      axios.post("/replies/" + this.reply.id + "/favorites");
      this.active = true;
      this.count++;
    },
    destroy() {
      axios.delete("/replies/" + this.reply.id + "/favorites");
      this.active = false;
      this.count--;
    }
  }
};
</script>
<style>
.alert-flash {
  position: fixed;
  right: 25px;
  bottom: 25px;
}
.ol {
  color: #c21f1f;
}
.om {
  color: #c85f5f;
}
</style>
