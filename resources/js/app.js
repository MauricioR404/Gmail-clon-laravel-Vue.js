require('./bootstrap');

window.Vue = require('vue');

window.EventBus = new Vue();

Vue.component('list-messages', require('./components/ListMessages').default);
Vue.component('list-aside', require('./components/ListAside').default);

const app = new Vue({
    el: '#app',
});
