import Vue from 'vue'
import App from './App.vue'

// Vuesax Component Framework
import Vuesax from 'vuesax'
import 'material-icons/iconfont/material-icons.css' //Material Icons
import 'vuesax/dist/vuesax.css' // Vuesax
Vue.use(Vuesax)

// Theme Configurations
import '../themeConfig.js'

// ACL
import acl from './acl/acl'

// Globally Registered Components
import './globalComponents.js'

// Styles: SCSS
import './assets/scss/main.scss'

// Tailwind
import '@/assets/css/main.css'

// Vue Router
import router from './router'

// Vuex Store
import store from './store/store'

// i18n
import i18n from './language/lang'

// Clipboard
import VueClipboard from 'vue-clipboard2'
Vue.use(VueClipboard)

// Tour
import VueTour from 'vue-tour'
Vue.use(VueTour)
require('vue-tour/dist/vue-tour.css')


// Google Maps
import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
  load: {
    // Add your API key here
    key: 'YOUR_KEY',
    libraries: 'places' // This is required if you use the Auto complete plug-in
  }
})

// Vuejs - Vue wrapper for hammerjs
import { VueHammer } from 'vue2-hammer'
Vue.use(VueHammer)


// PrismJS
import 'prismjs'
import 'prismjs/themes/prism-tomorrow.css'


// Feather font icon
require('./assets/css/iconfont.css')
Vue.config.productionTip = false


import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);

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

import config from "./config";


import axios from 'axios';
window.axios = axios.create({
  baseURL: config.hostUrl
});
window.axios.defaults.headers.lang = config.lang;
if(config.token) {
  window.axios.defaults.headers.common = { 'Authorization': `Bearer ${config.token}` }
}


import mixin from  "./mixin";
new Vue({
  router,
  store,
  i18n,
  acl,
  mixins: [mixin],
  render: h => h(App)
}).$mount('#app')
