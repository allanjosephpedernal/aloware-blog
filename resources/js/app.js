require('./bootstrap');

// declare vue
window.Vue = require('vue');

// import bootstrap vue
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

// import jQuery
import JQuery from 'jquery'
window.$ = JQuery

// append component
import Post from './components/Post.vue';

// intanciate app
const app = new Vue({
    el: '#app',
    components: {
        'post': Post
    }
})