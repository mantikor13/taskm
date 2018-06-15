import $ from 'jquery';
import Vue from 'vue';
import Router from 'vue-router';

import App from './components/App.vue';
import Login from './components/Login.vue'

import Menu from './components/menu.vue';
import Board from './components/dashboard.vue';

Vue.component("Login", Login);
Vue.component("Menu", Menu);
Vue.component("Board", Board);

import Manager from './components/bord-comp/mngr.vue';
import Mathematician from './components/bord-comp/math.vue';
import Historian from './components/bord-comp/hist.vue';
import Global from './components/bord-comp/glob.vue';

Vue.component("Manager", Manager);
Vue.component("Math", Mathematician);
Vue.component("Hist", Historian);
Vue.component("Global", Global);

Vue.use(Router);

let router = new Router({
    router: [
        {path: '/dashboard', component: App},
        {path: '/login', component: Login},
    ]
});

const Main =  new Vue({
   el: '.app',
    router: router,
   render: h => h(App)
});
