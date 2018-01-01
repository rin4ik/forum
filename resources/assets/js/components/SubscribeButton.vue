<template>
<div v-if="signedIn">  <button class="btn" :class="classes" @click="subscribe" v-text="sss">
                      
  </button>
</div>

</template>
<script>
export default {
   props:['active'],
    data(){
        return{
            actived:this.active,
            message:[]
        }
    },
    computed:{
      classes(){
          return ['btn', this.actived? 'btn-primary':'btn-default']
      },
      sss(){
         return this.actived? 'Subscribed':'Subscribe'
      },
        signedIn(){
                    return window.App.signedIn;
                }
      
  },
  methods:{
      messWhich(){
         message= []
            return message
      },
      subscribe(){
          axios[(this.actived ? 'delete' : 'post')](location.pathname + '/subscriptions');
          this.actived =!this.actived;
          flash('Subscribed!');
      }
  }
 
}
</script>
