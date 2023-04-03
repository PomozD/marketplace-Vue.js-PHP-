import { createApp } from 'vue'

import "./services/axios-config.js";
import App from './App.vue'
import router from './router'
import store from './store'

createApp(App).use(store).use(router).mount('#app')
