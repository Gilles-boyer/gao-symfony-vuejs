/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

import Vue from 'vue'
import Router from './js/router/router'
import Layout from './js/layout/Layout'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)
const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        iconfont: 'mdi', //|| 'mdiSvg' || 'md' || 'fa' || 'fa4' || 'faSvg'
    }),
    router: Router,
    components: { Layout }
})
export default new Vuetify(app)