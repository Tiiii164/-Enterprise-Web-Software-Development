import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import App from './Pages/Index.vue'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createApp(App).mount('#app');

