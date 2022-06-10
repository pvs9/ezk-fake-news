import App from "./layouts/App";
import { createApp } from 'vue'
import router from "./router";
import api from "./api";

const app = createApp(App)

app.config.globalProperties.$axios = api;
app.use(router)
app.mount('#app')
