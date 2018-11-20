window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');

    require('foundation-sites');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue';

import router from './routes.js';
import store from './store.js';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

new Vue({
    router,
    store
}).$mount('#app');