<template>
  <div>
    <section class="content">
      <div class="box">

        <pagination 
          :page="page" 
          :pagination="pagination">
        </pagination>
        
        <messages-item
           v-for="message in messages"
           v-show="showMessages == true"
          :key="message.id"
          :message="message">
        </messages-item>

        <show-message
          v-show="show == true">
        </show-message>
        
        <Message-session>
        </Message-session>
      </div>
    </section>
  </div>
</template>
 
<script>
import Pagination from './Pagination';
import MessagesItem from './MessageItem';
import MessageSession from './MessageSession';
import ShowMessage from './ShowMessage';

export default {
  components : { Pagination, MessagesItem, MessageSession, ShowMessage },
  data() {
    return {
      messages: [],
      pagination: {
        meta: {
          from : ''
        }
      },
      page: 1,
      showMessages: true,
      show: false,
    }
  },
  methods: {
    listMessages(){
      axios.get(`/messages/index?page=${this.page}`)
        .then(res => {
          this.messages = res.data.data;
          this.pagination = res.data;
          delete this.pagination.data;
        })
        .catch(err => {
          console.log(err.response.data);
        });
    },
  },
  mounted() {
    this.listMessages();
    EventBus.$on("page", page => {
          this.page = page;
          this.listMessages();
    });

    EventBus.$on("message-session", session => {
          this.listMessages();
    });

    EventBus.$on('show-message', message => {
      this.showMessages == true ? this.showMessages = false : this.showMessages = true;
      this.show == false ? this.show = true : this.show = false;
    });
  },
  
}
</script>

<style>
  .d-none{
    display: none!important;
  }
  .selection-all{
    display: inline-flex;
    align-items: center;
  }

  .selection-all:hover{
    background: #80808024;
    border-radius: 4px;
  }

  .all-messages{
    display: flex;
    align-items: center;
  }

  .all-messages p{
    margin: 0px;
  }

  .box-tools{
    display: flex;
  }

  .box-header > .box-tools{
    top: -1px!important;
  }

  /** Iconos de destacar */
  .iconos-uno .icono{
    padding: 7px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .iconos-uno .icono:hover{
    background: #8080802b;
    border-radius: 50%;
  }

  /** Efecto para siguiente **/
  .efecto-icono{
    padding: 10px;
    display: flex;
    align-items: center;
  }

  .efecto-icono:hover{
    padding: 10px;
    background: #8080802b;
    border-radius: 50%;
  }

  .list-item{
    border-top: 1px solid #f4f4f4;
    padding: 3px 11px;
  }

  .list-item p{
    margin: 0px!important;
  }

  .list-item:hover{
    -webkit-box-shadow: inset 1px 0 0 #dadce0, inset -1px 0 0 #dadce0, 0 1px 2px 0 rgba(60,64,67,.3), 0 1px 3px 1px rgba(60,64,67,.15);
    box-shadow: inset 1px 0 0 #dadce0, inset -1px 0 0 #dadce0, 0 1px 2px 0 rgba(60,64,67,.3), 0 1px 3px 1px rgba(60,64,67,.15);
  }
  
  .row{
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .list-item .iconos-uno{
    align-items: center;
  }

  .list-item .iconos-uno p{
    margin-left: 5px;
    margin-bottom: 0px!important;
  }

  .row{
    padding: 3px 0px;
  }

  .row .iconos{
    display: none;
  }

  .row:hover{
    padding: 0px!important;
  }

  .row:hover .fecha{
    display: none;
  }

  .row:hover .iconos{
    display: block;
    display: flex;
    justify-content: flex-start;
    align-items: center;
  }
  
  .iconos ul, .list-item .iconos-uno{
    margin: 0;
    padding: 0;
    display: flex;
  }

  li{
    list-style: none;
  }
  .iconos li{
    padding: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  /** Efecto para acciones del mensaje **/
  .iconos li:hover{
    background: #8080802b;
    border-radius: 50%;
  }
</style>