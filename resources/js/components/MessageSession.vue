<template>
  <div class="col-10">
    <div :class="[addClass]">
      <p >{{ message }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: '',
      addClass: ''
    }
  },
  mounted() {
    EventBus.$on('message-session', session => {
        this.message = session;
        this.addClass = 'message';
        setTimeout(() => {
          this.message = '';
          this.addClass = '';
        }, 3000);
    });
  },
}
</script>
<style>
  p{
    margin: 0!important;
  }
  .message{
    background: #202124;
    color: white;
    position: absolute;
    left: 11px;
    bottom: 10px;
    padding: 17px;
    text-align: center;
    z-index: 1000;
    width: 250px;
    border-radius: 4px;
    box-shadow: 0 1px 3px 0 rgba(60,64,67,0.302), 0 4px 8px 3px rgba(60,64,67,0.149);
  }
</style>