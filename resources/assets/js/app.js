
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("babel-polyfill");
/*require('./bootstrap');*/
import VueRouter from 'vue-router';
//import axios from 'axios';
import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueFilter from 'vue-filter';

window.Vue = require('vue');
//var axios = require("axios");


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueFilter);

//Vue.use(axios);


Vue.filter('limit', function(array,length) {
    var limitCount = parseInt(length, 10);

    return array.slice(0, limitCount);
});


Vue.component('posts', require('./components/Posts.vue'));
Vue.component('bycat', require('./components/PostsByCategory.vue'));
Vue.component('paginate', require('vuejs-paginate'));


const routes =  [
    {
        path: '/posts',
        component: require('./components/Posts.vue'),
    },
    {
        path: '/categories/:catId',
        component: require('./components/PostsByCategory.vue')
    }
]



  

var router = new VueRouter({
    routes: routes,
    mode: 'history'
  })


  /*
const app = new Vue({
    el: '#app',
    router: router
});

*/