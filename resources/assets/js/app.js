
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Chart from 'chart.js';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';
import locale from 'element-ui/lib/locale/lang/en'

Vue.use(ElementUI, { locale });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('user-boxers', require('./components/UserBoxers.vue'));
Vue.component('free-agents', require('./components/FreeAgents.vue'));
Vue.component('nav-bar', require('./components/NavBar.vue'));
Vue.component('stats-bar', require('./components/StatsBar.vue'));
Vue.component('advance-day', require('./components/AdvanceDay.vue'));
Vue.component('create-card', require('./components/CreateCard.vue'));
Vue.component('cards-table', require('./components/CardsTable.vue'));
Vue.component('sign', require('./components/Sign.vue'));
Vue.component('cut', require('./components/Cut.vue'));
Vue.component('RevenueChart', require('./components/RevenueChart.vue'));
Vue.component('ViewersChart', require('./components/ViewersChart.vue'));
Vue.component('AttendanceChart', require('./components/AttendanceChart.vue'));

const app = new Vue({
    el: '#app'
});


