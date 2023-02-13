import './bootstrap';

import { createApp } from 'vue';
import router from './Router'
import App from './Layouts/App.vue'

createApp(App)
        .use(router)
        .mount('#app');

