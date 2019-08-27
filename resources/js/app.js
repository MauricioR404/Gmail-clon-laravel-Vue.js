require('./bootstrap');

window.Vue = require('vue');

window.EventBus = new Vue();

Vue.component('list-messages', require('./components/ListMessages.vue').default);

const app = new Vue({
    el: '#app',
});
