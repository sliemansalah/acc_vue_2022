import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/store'
import Axios from 'axios';

Vue.config.productionTip = false

window.axios= Axios.create({
  baseURL: "http://127.0.0.1:8000/api/"
});

let token = localStorage.getItem("acc_token") || null;
let lang = localStorage.getItem("lang") || 'ar';
window.axios.defaults.headers.common = { 'Authorization': `Bearer ${token}`, 'lang': lang };

/* **************************************************************** */


new Vue({
  router,
  store,
  render: function (h) { return h(App) }
}).$mount('#app')
