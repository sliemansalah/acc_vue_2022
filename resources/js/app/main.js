import App from "./App.vue";
import Vue from "vue";

import router from "./router/index";
import store from "./store/store";
import "./components";

import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import elementAr from "element-ui/lib/locale/lang/ar";
import locale from 'element-ui/lib/locale'
Vue.use(ElementUI, {elementAr});
locale.use(elementAr)

import i18n from './language/lang'

/* ******************************* Global Variables ********************************* */
import axios from 'axios';
window.server_url = window.location.protocol + "//" + window.location.hostname + ":8000";
window.axios = axios.create({
  baseURL: window.server_url
});

let token = localStorage.getItem("token") || null;
let admin_token = localStorage.getItem("admin_token") || null;
if(token) {
  window.axios.defaults.headers.common = { 'Authorization': `Bearer ${token}` }
}
else if(admin_token) {
  window.axios.defaults.headers.common = { 'Authorization': `Bearer ${admin_token}` }
}
/* **************************************************************** */

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import JsonExcel from 'vue-json-excel'

Vue.component('downloadExcel', JsonExcel)

import VeeValidate from 'vee-validate';

import arabic from './language/vee-validate/locale/ar.js'
import english from './language/vee-validate/locale/en.js'
Vue.use(VeeValidate, {
  fieldsBagName: 'veeFields',
  i18nRootKey: 'validations', // customize the root path for validation messages.
  i18n,
  dictionary: {
   ar:arabic,
   en:english
  }
});

import CKEditor from 'ckeditor4-vue';
Vue.use( CKEditor );

new Vue({
    router,
    store,
    i18n,
    render: h => h(App)
}).$mount("#app");
