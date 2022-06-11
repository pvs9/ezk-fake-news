import App from "./layouts/App";
import { createApp } from 'vue'
import router from "./router";
// import api from "./api";
import { createPinia } from 'pinia'
const VueScrollTo = require('vue-scrollto');

const app = createApp(App)

// app.config.globalProperties.$axios = api;
app.config.globalProperties.$to = (url) => window.open(url);
app.use(router)
app.use(createPinia())
app.use(VueScrollTo)
app.mount('#app')
