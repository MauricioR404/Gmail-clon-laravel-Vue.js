<template>
  <div :class="['list-item', showState]">
    <div class="row" dusk="hover">
      <div class="col-md-2">
        <div>
          <ul class="iconos-uno">
            <!-- <li class="icono">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7,5C5.897,5,5,5.897,5,7v10c0,1.103,0.897,2,2,2h10c1.103,0,2-0.897,2-2V7c0-1.103-0.897-2-2-2H7z M7,17V7h10l0.002,10H7z"/></svg>
                </li> -->
            <li class="icono">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path
                  d="M6.516,14.323l-1.49,6.452c-0.092,0.399,0.068,0.814,0.406,1.047C5.603,21.94,5.801,22,6,22 c0.193,0,0.387-0.056,0.555-0.168L12,18.202l5.445,3.63c0.348,0.232,0.805,0.223,1.145-0.024c0.338-0.247,0.487-0.68,0.372-1.082 l-1.829-6.4l4.536-4.082c0.297-0.268,0.406-0.686,0.278-1.064c-0.129-0.378-0.47-0.644-0.868-0.676L15.378,8.05l-2.467-5.461 C12.75,2.23,12.393,2,12,2s-0.75,0.23-0.911,0.589L8.622,8.05L2.921,8.503C2.529,8.534,2.192,8.791,2.06,9.16 c-0.134,0.369-0.038,0.782,0.242,1.056L6.516,14.323z M9.369,9.997c0.363-0.029,0.683-0.253,0.832-0.586L12,5.43l1.799,3.981 c0.149,0.333,0.469,0.557,0.832,0.586l3.972,0.315l-3.271,2.944c-0.284,0.256-0.397,0.65-0.293,1.018l1.253,4.385l-3.736-2.491 c-0.336-0.225-0.773-0.225-1.109,0l-3.904,2.603l1.05-4.546c0.078-0.34-0.026-0.697-0.276-0.94l-3.038-2.962L9.369,9.997z" />
              </svg>
            </li>
            <li>
              <p v-text="message.name"></p>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-8">
        <p v-text="message.body"></p>
      </div>
      <div class="col-md-2">
        <p class="fecha" v-text="message.created_at"></p>
        <div class="iconos">
          <ul>
            <li dusk="btn-state" @click="stateMessage()">
              <svg :class="['read-' + showState]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path
                  d="M19,3H5C3.897,3,3,3.897,3,5v11c0,1.103,0.897,2,2,2h3.586L12,21.414L15.414,18H19c1.103,0,2-0.897,2-2V5 C21,3.897,20.103,3,19,3z M19,16h-4.414L12,18.586L9.414,16H5V5h14V16z" />
              </svg>
              <svg :class="['unread-' + showState]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path
                  d="M18.999,3h-14c-1.103,0-2,0.897-2,2v11c0,1.103,0.897,2,2,2h3.5l3.5,4l3.5-4h3.5c1.103,0,2-0.897,2-2V5 C20.999,3.897,20.102,3,18.999,3z" />
              </svg>
            </li>
            <li dusk="btn-delete" @click="deleteMessage()">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path
                  d="M5 8v12c0 1.104.896 2 2 2h10c1.104 0 2-.896 2-2V8c0 0-.447 0-1 0H6C5.447 8 5 8 5 8zM3 6L8 6 16 6 21 6 21 4 16.618 4 15 2 9 2 7.382 4 3 4z" />
              </svg>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      message: {
        require: true
      }
    },
    methods: {
      deleteMessage() {
        axios.delete(`/message/${this.message.id}`)
          .then(res => {
            this.sessionMessage = res.data;
            EventBus.$emit('message-session', 'El mensaje se elimino correctamente');
          })
          .catch(err => {
            console.log(err.response.data);
          });
      },
      stateMessage() {
        axios.get(`/message/${this.message.id}/update`)
          .then(res => {
            this.message.state = res.data;
            const message = this.message.state == 0 ? 'Se ha marcado el mensaje como no leído.' : 'Se ha marcado el mensaje como leído.';
            EventBus.$emit('message-session', message);
          })
          .catch(err => {
            console.log(err.response);
          });
      }
    },
    computed: {
      showState() {
        return this.message.state == 1 ? 'showState' : '';
      }
    }
  }
</script>

<style>
  .showState {
    background: rgba(242, 245, 245, 0.8);
  }
  
  .read-,
  .unread-showState{
    display: block;
  }
  .unread-,
  .read-showState{
    display: none;
  }

</style>