import './bootstrap';
import { createApp } from 'vue';
import router from '../js/Router/router'
import App from './Layouts/App.vue'

createApp(App)
        .use(router)
        .mount('#app');

