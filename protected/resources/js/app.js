/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
const moment = require('vue-moment');

import store from './store/store';
import ModalPlugin from './modals/common';

import VueGoodTablePlugin from 'vue-good-table';

// import the styles
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTablePlugin);

//Plugins
Vue.use(moment);
Vue.use(ModalPlugin);

//Components
Vue.component('client-list-component', require('./pages/clients/ClientListComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#campsn-app',
    store,
});
