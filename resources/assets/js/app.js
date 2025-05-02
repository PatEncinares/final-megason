
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import {$,jQuery} from 'jquery';
import Vue from 'vue';
// export for others scripts to use
window.$ = $;
window.jQuery = jQuery;
window.Vue = require('vue');
import Axios from 'axios'
// Import VueScheduler
import VueScheduler from 'v-calendar-scheduler';

// Import styles
import 'v-calendar-scheduler/lib/main.css';
var moment = require('moment'); // require
Vue.use(moment);
Vue.use(VueScheduler);
Vue.prototype.$http = Axios;
// ES6 Modules or TypeScript
import Swal from 'sweetalert2'
import SweetModal from 'sweet-modal-vue/src/plugin.js'
Vue.use(SweetModal)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('patients-list', require('./components/PatientsList.vue'));
Vue.component('schedule', require('./components/Schedule.vue'));
Vue.component('show-lab-result',require('./components/lab-results/ShowLabResult.vue'));
Vue.component('fecalysis',require('./components/lab-results/fecalysis.vue'));
Vue.component('hematology',require('./components/lab-results/hematology.vue'));
Vue.component('ultrasound',require('./components/lab-results/ultrasound.vue'));
Vue.component('urinalysis',require('./components/lab-results/urinalysis.vue'));
Vue.component('xray',require('./components/lab-results/xray.vue'));

const app = new Vue({
    el: '#app',
    data : {
        user_data : {},
    },
    created(){
        
    },
    mounted(){
        var self = this;
        this.$http.get('/userdetails')
        .then(function (response) {
            // handle success
            self.user_data = response.data;
            // this.userdetails = 'test';
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
    }
});
