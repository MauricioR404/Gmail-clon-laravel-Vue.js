<template>
  <div class="box-header">
    <div class="selection-all">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path
          d="M7,5C5.897,5,5,5.897,5,7v10c0,1.103,0.897,2,2,2h10c1.103,0,2-0.897,2-2V7c0-1.103-0.897-2-2-2H7z M7,17V7h10l0.002,10H7z" />
        </svg>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="15" viewBox="0 0 24 24">
        <path d="M11.998 17L18.998 9 4.998 9z" /></svg>
    </div>
    <div class="box-tools pull-right">
      <div class="all-messages">
        <!-- <p>{{ page }}</p> -- -->
        <p>{{ pagination.meta.from }} - {{ pagination.meta.to }} de {{ pagination.meta.total }}</p>
      </div>
      <div :class="['efecto-icono', isPreviousButtonDisabled]" @click="previousPage()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path d="M13.293 6.293L7.586 12 13.293 17.707 14.707 16.293 10.414 12 14.707 7.707z" /></svg>
      </div>
      <div :class="['efecto-icono', isNextButtonDisabled]" @click="nextPage()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path d="M10.707 17.707L16.414 12 10.707 6.293 9.293 7.707 13.586 12 9.293 16.293z" /></svg>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    page: {
      required: true
    },
    pagination : {
      required: true
    }
  },
  methods: {
    nextPage(){
      const page = this.page + 1;
      EventBus.$emit('page', page);
    },
    previousPage(){
      const page = this.page - 1;
      EventBus.$emit('page', page);
    },
    
  },
  computed: {
    isNextButtonDisabled(){
      return this.page == 4 ? 'd-none' : '';
    },
    isPreviousButtonDisabled(){
      return this.page == 1 ? 'd-none' : '';
    }
  },

}
</script>

<style>
  .box-header{
    margin-top: 40px;
  }
</style>