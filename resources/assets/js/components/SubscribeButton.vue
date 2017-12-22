<template>
  <button class="btn" :class="classes" @click="subscribe">
                        Subscribe
  </button>
</template>
<script>
export default {
   props:['active'],
    data(){
        return{
            actived:this.active
        }
    },
    computed:{
      classes(){
          return ['btn', this.actived? 'btn-primary':'btn-default']
      }
  },
  methods:{
      subscribe(){

          axios[(this.actived ? 'delete' : 'post')](location.pathname + '/subscriptions');
          this.actived =!this.actived;
          flash('Subscribed');
      }
  }
 
}
</script>
