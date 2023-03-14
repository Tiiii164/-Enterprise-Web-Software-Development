import '../css/app.css';
import 'bootstrap/dist/css/bootstrap.css'
import './bootstrap';
import { createApp } from 'vue';
import router from '../js/Router/router'
import App from './Layouts/App.vue'
import 'bootstrap/dist/js/bootstrap.js'
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faPen } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faPen)

createApp(App)
  .use(router)
  .component('font-awesome-icon', FontAwesomeIcon)
  .mount('#app');