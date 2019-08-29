<template>
  <div class="list-item">
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
            <li>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M14 10L10 10 10 13 7 13 12 18 17 13 14 13z" />
                <path
                  d="M21.8,6.4l-3-4C18.611,2.148,18.314,2,18,2H6C5.686,2,5.389,2.148,5.2,2.4l-3,4l0.014,0.01C2.088,6.577,2,6.774,2,7v12 c0,1.103,0.897,2,2,2h16c1.103,0,2-0.897,2-2V7c0-0.226-0.088-0.423-0.214-0.59L21.8,6.4z M6.5,4h11L19,6H5L6.5,4z M4,19V8h16 l0.002,11H4z" />
                </svg>
            </li>
            <li>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path
                  d="M19,3H5C3.897,3,3,3.897,3,5v11c0,1.103,0.897,2,2,2h3.586L12,21.414L15.414,18H19c1.103,0,2-0.897,2-2V5 C21,3.897,20.103,3,19,3z M19,16h-4.414L12,18.586L9.414,16H5V5h14V16z" />
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
    message:{
      require: true
    }
  },
  methods: {
    deleteMessage(){
      axios.delete(`/message/${this.message.id}`)
        .then(res => {
          this.sessionMessage = res.data;
          EventBus.$emit('message-session', 'El mensaje se elimino correctamente');
        })
        .catch(err => {
          console.log(err.response.data);
        });
    }
  },
}
</script>