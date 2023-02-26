import '../css/app.css';
import 'bootstrap/dist/css/bootstrap.css'
import './bootstrap';
import { createApp } from 'vue';
import router from '../js/Router/router'
import App from './Layouts/App.vue'
import 'bootstrap/dist/js/bootstrap.js'

createApp(App)
        .use(router)
        .mount('#app');
