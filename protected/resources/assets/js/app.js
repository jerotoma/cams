/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
const moment = require('vue-moment');

import store from './store/store';
import DatePlugin from './shared/utilities/DateUtilities';
import StringUtilPlugin from './shared/utilities/StringUtil';
import ModalPlugin from './shared/modals/modal-loader';

import VueApexCharts from 'vue-apexcharts'
import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'



//Plugins
Vue.use(moment);
Vue.use(ModalPlugin);
Vue.use(DatePlugin);
Vue.use(StringUtilPlugin);
Vue.use(VueGoodTablePlugin);

//Components
Vue.component('apexchart', VueApexCharts)
Vue.component('client-list-component', require('./pages/clients/ClientListComponent.vue').default);
Vue.component('home-assessment-component', require('./pages/assessments/home/HomeAssessmentComponent.vue').default);
Vue.component('vulnerability-assessment-component', require('./pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue').default);
Vue.component('item-received-list-component', require('./pages/inventories/ItemReceivedComponent.vue').default);
Vue.component('item-category-list-component', require('./pages/inventories/ItemCategoryComponent.vue').default);
Vue.component('item-distribution-list-component', require('./pages/inventories/ItemDistributionComponent.vue').default);
Vue.component('inventory-list-component', require('./pages/inventories/InventoryListComponent.vue').default);
Vue.component('referral-list-component', require('./pages/referrals/ReferralListComponent.vue').default);
Vue.component('chart-stat-component', require('./pages/dashboard/ChartStatComponent.vue').default);
Vue.component('counter-stat-component', require('./pages/dashboard/CounterStatComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#campsn-app',
    store,
});
