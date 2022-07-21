import '@/plugins/vue-composition-api'
import '@resources/sass/styles/styles.scss'
import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from './router'
import store from './store'
// import notification start
import Notifications from 'vue-notification'
Vue.use(Notifications)
//import notification end 
// vue-authenticate import start
import VueAxios from 'vue-axios'
// import VueAuthenticate from 'vue-authenticate'
import axios from 'axios'
// vue-authenticate import end
import VueTelInputVuetify from 'vue-tel-input-vuetify/lib';


 import Auth from 'vue-auth-jwt'

 import VueSocialSharing from 'vue-social-sharing'

 Vue.use(VueSocialSharing);


 import VueInstagram from 'vue-instagram'
 
 Vue.use(VueInstagram)



// vue-router-simple-auth import start
// import VueRouterAuth from 'vue-router-simple-auth';

// Vue.use(VueRouterAuth, {
//   route401: '/unauthorized',
//   route403: { path: '/unauthorized' },
//   initTimeout: 5000,
//   authRouteKey: 'authorization',
//   storage: () => window.sessionStorage,
// });

// vue-router-simple-auth import end

Vue.use(VueTelInputVuetify, {
  vuetify,
});

Vue.prototype.$http = axios
// vue-authenticate import cont start
Vue.use(VueAxios, axios)
// Vue.use(VueAuthenticate, {
//   baseUrl: '', // Your API domain
  
//   providers: {
//     github: {
//       clientId: '',
//       redirectUri: 'http://127.0.0.1:8000/dashboard' // Your client app URL
//     }
//   }
// })
// vue-authenticate import cont end 
Vue.config.productionTip = false


// const config = {
//   API_BASE_URL: 'https://127.0.0.1:443/',
// }

// Vue.use(Auth, { router, store, config  });

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App),
  methods: {
    testfnc(){
      console.log("welcome from blade");
    }
  }
}).$mount('#app')
