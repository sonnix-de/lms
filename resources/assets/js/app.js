
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import FormHelper from './utilities/FormHelper'
window.Vue = require('vue');
window.FormHelper = FormHelper;

Vue.component('book-component', require('./components/BookComponent.vue'));
Vue.component('service-book-lends-component', require('./components/ServiceBookLendsComponent.vue'));
Vue.component('books-search-component', require('./components/BooksSearchComponent.vue'));
Vue.component('page-component', require('./components/PageComponent.vue'));
Vue.component('paragraph-component', require('./components/Paragraphs/ParagraphComp.vue'));
Vue.component('feature-display', require('./components/FeatureDisplay.vue'));


Vue.component('input-text', require('./forms/InputText.vue'));
Vue.component('input-text-area', require('./forms/InputTextArea.vue'));
Vue.component('input-isbn-lookup', require('./forms/InputIsbnAndLookup'));



const app = new Vue({
    el: '#app'
});
