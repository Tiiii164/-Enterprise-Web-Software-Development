import '../css/app.css';
import './bootstrap';
import { createApp } from 'vue';
import router from '../js/Router/router'
import App from './Layouts/App.vue'
import { createVuetify } from 'vuetify/lib/framework.mjs';
import 'vuetify/styles'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify()
createApp(App)
        .use(router)
        .use(vuetify)
        .mount('#app');