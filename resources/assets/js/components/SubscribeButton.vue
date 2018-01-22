<template>

  <button class="btn caps button is-primary is-outlined " @click="subscribe" v-text="sss">
                      
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
    sss() {
      return this.actived ? "Subscribed" : "Subscribe";
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
