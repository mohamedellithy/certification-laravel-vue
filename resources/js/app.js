/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import axios from 'axios'
import VueAxios from 'vue-axios'
import { Lang } from 'laravel-vue-lang';

// Register the plugin
Vue.use(Lang, {
    locale: window.default_locale,
    fallback: window.fallback_locale
});

Vue.use(VueAxios, axios);
require('./filter');
// Vue.use(filter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('image-upload', require('./components/ImageUpload.vue').default);
Vue.component('customize-certification', require('./components/CustomizeCertification.vue').default);
Vue.component('generate-certification', require('./components/GenerateCertification.vue').default);
Vue.component('screenshot-certification', require('./components/ScreenshotCertification.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});