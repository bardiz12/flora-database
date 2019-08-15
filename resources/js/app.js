import './bootstrap';
import BootstrapVue from 'bootstrap-vue'
import Vue from 'vue';
import Vuetify from 'vuetify/lib';

import Routes from '@/js/routes.js';

import App from '@/js/views/App';
import Navbar from '@/js/components/Navbar';
import Footer from '@/js/components/Footer';
import Breadcrumb from '@/js/components/Breadcrumb';
import vuePicturePreview from 'vue-picture-preview-fix'
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(Vuetify);
Vue.use(BootstrapVue)
Vue.use(vuePicturePreview)
const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674'
  }
   
Vue.use(VueSweetalert2, options)

Vue.component('Navbar',Navbar);
Vue.component('Footer',Footer);
Vue.component('Breadcrumb',Breadcrumb);
const app = new Vue({
    el: '#app',
    router: Routes,
    render: h => h(App)
});

export default app;