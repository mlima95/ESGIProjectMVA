import Vue from 'vue'
import App from './App.vue'
import babelPolyfill from 'babel-polyfill'

//import routes
import VueRouter from 'vue-router';
import storedvideoRoutes from './router/storedvideo';
import userRoutes from './router/user';
import loginRoutes from './router/login'
// Add the modules in the store
import Vuex from 'vuex';
import storedVideo from './store/modules/storedvideo/';
import user from './store/modules/user/';
import auth from './store/modules/auth/'
// Other
import 'bootstrap/dist/css/bootstrap.min.css';
import './assets/css/main.css';


Vue.config.productionTip = false;

Vue.use(VueRouter);
Vue.use(Vuex);

// Add routes to VueRouter
const router = new VueRouter({
  mode: 'history',
  routes: [
    ...storedvideoRoutes,
    ...userRoutes,
    ...loginRoutes
  ]
});


export const store = new Vuex.Store({
  // ...
  modules: {
    auth,
    user,
    storedVideo
  }
});

new Vue({
  store,
  router,
  el: '#app',
  render: h => h(App)
})
