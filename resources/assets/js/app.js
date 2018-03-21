
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import FormHelper from './utilities/FormHelper'
window.Vue = require('vue');
window.FormHelper = FormHelper;


// hier werden die Logs verwaltet!
import Flashes from './utilities/FlashesAndLogs'


import VueSweetAlert from 'vue-sweetalert'
Vue.use(VueSweetAlert)

import VueFlashMessage from 'vue-flash-message';
require('vue-flash-message/dist/vue-flash-message.min.css');
//Vue.use(VueFlashMessage);

const template = `
    <div>
        <div v-for="(message, index) in storage"   :key="index" >
            <div class="alert flash__message-content" v-html="message.content"></div>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            v-html="message.content
      </div>
                
        </div>
  </div>
`;
Vue.use(VueFlashMessage ); //{ template }



Vue.component('book-component', require('./components/BookComponent.vue'));
Vue.component('service-book-lends-component', require('./components/lms/AusleihenComponent.vue'));
Vue.component('books-search-component', require('./components/BooksSearchComponent.vue'));
Vue.component('page-component', require('./components/PageComponent.vue'));
Vue.component('paragraph-component', require('./components/Paragraphs/ParagraphComp.vue'));
Vue.component('feature-component', require('./components/FeatureComponent.vue'));


/* common Components */
Vue.component('flash-component', require('./components/commons/FlashComponent.vue'));

/* Form-Controls */
Vue.component('input-text', require('./forms/InputText.vue'));
Vue.component('input-text-area', require('./forms/InputTextArea.vue'));
Vue.component('input-isbn-lookup', require('./forms/InputIsbnAndLookup'));



const app = new Vue({
    el: '#app'
});
