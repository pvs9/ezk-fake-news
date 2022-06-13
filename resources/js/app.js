// Initialize Vue App
import App from "./App.vue";
const app = createApp(App)

// Import dependencies
import { createApp } from 'vue'
import api from "./api";
import { createPinia } from 'pinia'
const VueScrollTo = require('vue-scrollto');

// Init plugins
app.config.globalProperties.$axios = api;
app.use(createPinia())
app.use(VueScrollTo)
app.mount('#app')

export default app;