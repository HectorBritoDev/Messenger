require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex';
import BootstrapVue from 'bootstrap-vue'
import store from './store'

Vue.use(BootstrapVue)

Vue.component('contact-component', require('./components/ContactComponent.vue').default);
Vue.component('contact-form-component', require('./components/ContactFormComponent.vue').default);
Vue.component('contact-list-component', require('./components/ContactListComponent.vue').default);
Vue.component('active-conversation-component', require('./components/ActiveConversationComponent.vue').default);
Vue.component('message-conversation-component', require('./components/MessageConversationComponent.vue').default);
Vue.component('messenger-component', require('./components/MessengerComponent.vue').default);
Vue.component('status-component', require('./components/StatusComponent.vue').default);
Vue.component('profile-form-component', require('./components/ProfileFormComponent.vue').default);



const app = new Vue({
    el: '#app',
    store, //Cuando un atributo y una variable tienen el mismo idioma se puede usar directamente el nombre en ES6
    methods: {
        logout() {
            document.getElementById('logout-form').submit();
        }
    },
});
