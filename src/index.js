import $ from 'jquery';
import Vue from 'vue';
import App from './components/App.vue';

import Menu from './components/menu.vue';
import Board from './components/dashboard.vue';

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

new Vue({
   el: '.app',
   render: h => h(App)
});
