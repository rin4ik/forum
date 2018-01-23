<template>

  <button class="btn shadow button is-link" :class="classes" @click="subscribe" v-text="sss" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
">
                      
  </button>


</template>
<script>
export default {
  props: ["active"],
  data() {
    return {
      actived: this.active,
      message: []
    };
  },
  computed: {
    classes() {
      return this.actived ? "" : " is-outlined";
    },
    sss() {
      return this.actived ? "SUBSCRIBED" : "SUBSCRIBE";
    },
    signedIn() {
      return window.App.signedIn;
    }
  },
  methods: {
    messWhich() {
      message = [];
      return message;
    },
    subscribe() {
      axios[this.actived ? "delete" : "post"](
        location.pathname + "/subscriptions"
      );
      this.actived = !this.actived;
      flash("Subscribed!");
    }
  }
};
</script>
