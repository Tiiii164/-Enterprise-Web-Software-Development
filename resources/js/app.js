import '../css/app.css';
import 'bootstrap/dist/css/bootstrap.css'
import './bootstrap';
import { createApp } from 'vue';
import router from '../js/Router/router'
import App from './Layouts/App.vue'
import { createVuetify } from 'vuetify';
import 'vuetify/styles'
import * as components from 'vuetify/lib/components/index.mjs'
import * as directives from 'vuetify/lib/directives/index.mjs'
import 'bootstrap/dist/js/bootstrap.js'

const vuetify = createVuetify({
  components,
  directives
})

createApp(App)
        .use(router)
        .use(vuetify)
        .mount('#app');