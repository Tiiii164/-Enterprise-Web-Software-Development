import '../css/app.css';
import 'bootstrap/dist/css/bootstrap.css'
import './bootstrap';
import { createApp } from 'vue';
import router from '../js/Router/router'
import App from './Layouts/App.vue'
import 'bootstrap/dist/js/bootstrap.js'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

createApp(App)
        .use(router)
        .component('VueDatePicker', VueDatePicker)
        .mount('#app');