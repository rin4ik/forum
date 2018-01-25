<template>
  <div style="margin-bottom:5px">
       <input id="trix" type="hidden" :name="name" :value="value">
  <trix-editor id="body" ref="trix" input="trix" :placeholder="placeholder" style="background-color:white;" ></trix-editor>
  </div>
</template>
<script>
import Trix from "trix";
import "at.js";
import "jquery.caret";

export default {
  props: ["name", "value", "placeholder", "shouldClear"],

  mounted() {
    $("#body").atwho({
      at: "@",
      delay: 2000,
      callbacks: {
        remoteFilter: function(query, callback) {
          $.getJSON("/api/users", { name: query }, function(usernames) {
            callback(usernames);
          });
        }
      }
    });
    this.$refs.trix.addEventListener("trix-change", e => {
      this.$emit("input", e.target.innerHTML);
    });

    this.$watch("shouldClear", () => {
      this.$refs.trix.value = "";
    });
  }
};
</script>
