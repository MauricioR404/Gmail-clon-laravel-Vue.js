<template>
  <div :class="['box-header', addPadding]">
    <!-- selection -->
    <div class="selection-all" @click="activeList()" v-if="menuOptions == true">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path
          d="M7,5C5.897,5,5,5.897,5,7v10c0,1.103,0.897,2,2,2h10c1.103,0,2-0.897,2-2V7c0-1.103-0.897-2-2-2H7z M7,17V7h10l0.002,10H7z" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="15" viewBox="0 0 24 24">
        <path d="M11.998 17L18.998 9 4.998 9z" /></svg>
    </div>
    <!-- end-selection -->

    <!-- return-list-messages-->
    <div class="select-options" @click="returnListMessage" v-if="returnList == true">
      <div class="select-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 17.293L8.414 13 18 13 18 11 8.414 11 12.707 6.707 11.293 5.293 4.586 12 11.293 18.707z"/></svg>
      </div>
    </div>
    <!-- end-return-list-messages-->

    <!-- selection-options -->
    <div class="active-list" v-if="active == true">
      <div v-for="item in listItem" :key="item.id" v-text="item" @click="selectMessages(item)" class="item">
      </div>
    </div>
    <!-- end-selection-options -->
    
    <!-- subMenu -->
    <div class="select-options" v-if="subMenu == true">
      <div class="select-icon" @click="deleteMessages()">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="24" viewBox="0 0 24 24">
          <path
            d="M5 8v12c0 1.104.896 2 2 2h10c1.104 0 2-.896 2-2V8c0 0-.447 0-1 0H6C5.447 8 5 8 5 8zM3 6L8 6 16 6 21 6 21 4 16.618 4 15 2 9 2 7.382 4 3 4z" />
          </svg>
      </div>
    </div>
    <!-- end-subMenu -->

   <!-- next-or-previous -->
    <div class="box-tools pull-right">
      <div class="all-messages">
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
    <!-- end-next-or-previous -->
  </div>
</template>

<script>
  export default {
    props: {
      page: {
        required: true
      },
      pagination: {
        required: true
      }
    },
    data() {
      return {
        active: false,
        listItem: ['all', 'none', 'read', 'unRead', 'starred', 'unStarred'],
        subMenu: false,
        returnList: false,
        menuOptions: true
      }
    },
    methods: {
      deleteMessages(){
        this.subMenu = false;
        EventBus.$emit('delete-messages', 'delete');
      },
      nextPage() {
        const page = this.page + 1;
        EventBus.$emit('page', page);
      },
      previousPage() {
        const page = this.page - 1;
        EventBus.$emit('page', page);
      },
      activeList() {
        if (this.active == false) {
          this.active = true;
        } else {
          this.active = false;
        }
      },
      selectMessages(item) {
        this.active = false;
        if (item == 'none') {
          this.subMenu = false;
        } else {
          this.subMenu = true;
        }

        EventBus.$emit('select-messages', item);
      },
      returnListMessage(){
        EventBus.$emit('show-message', 'message')
      }

    },
    computed: {
      isNextButtonDisabled() {
        return this.pagination.meta.current_page == this.pagination.meta.last_page ? 'd-none' : '';
      },
      isPreviousButtonDisabled() {
        return this.page == 1 ? 'd-none' : '';
      },
      addPadding() {
        return this.subMenu == false ? 'padding' : '';
      },
    },
    mounted(){
      EventBus.$on('show-message', message => {
          this.menuOptions == true ? this.menuOptions = false : this.menuOptions = true;
          this.returnList == false ? this.returnList = true : this.returnList = false;
      });
    }

  }
</script>

<style>
  .box-header {
    margin-top: 40px;
    padding: 0 !important;
  }

  .padding {
    padding: 8px !important;
  }

  .active-list {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 15px 0px;
    background: white;
    height: 182px;
    width: 149px;
    position: absolute;
    top: 30px;
    border-radius: 5px;
    z-index: 100;
    webkit-box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
    box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
  }

  .active-list .item {
    padding: 5px 30px;
  }

  .active-list .item:hover {
    background: #0000000a;
  }

  .select-options {
    display: inline-flex;
    justify-content: center;
    align-items: center;
  }

  svg {
    fill: #767676;
  }

  .selection-options div svg {
    margin: 0px 5px;
  }

  .select-icon {
    padding: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .select-icon:hover {
    background: #8080802b;
    border-radius: 50%;
  }
</style>