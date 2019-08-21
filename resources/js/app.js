require('./bootstrap');

window.Vue = require('vue');

Vue.component('list-messages', require('./components/ListMessages.vue').default);

const app = new Vue({
    el: '#app',
});
