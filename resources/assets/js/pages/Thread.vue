<script>
import Replies from "../components/Replies.vue";
import SubscribeButton from "../components/SubscribeButton.vue";
export default {
  props: ["thread"],
  components: { Replies, SubscribeButton },
  data() {
    return {
      repliesCount: this.thread.replies_count,
      locked: this.thread.locked,
      editing: false
    };
  },
  methods: {
    toggleLock() {
      axios[this.locked ? "delete" : "post"](
        "/locked-threads/" + this.thread.slug
      );
      this.locked = !this.locked;
    },
    toggleEdit() {
      this.editing = !this.editing;
    }
  }
};
</script>