/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vuetify from 'vuetify';

window.Vue = require('vue');
Vue.use(Vuetify);
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
Vue.component('OfertasEmpleo', require('./components/OfertasEmpleo.vue').default);
Vue.component('formulario-component', require('./components/FormulariosE.vue').default);
Vue.component('ofertae-component', require('./components/OfertasEmpleoE.vue').default);
Vue.component('empleo-component', require('./components/Empleos.vue').default);
Vue.component('empresa-component', require('./components/Empresas.vue').default);
Vue.component('egresado-component', require('./components/Egresados.vue').default);
Vue.component('reporte-component', require('./components/Reportes.vue').default);
Vue.component('area-component', require('./components/Areas.vue').default);
Vue.component('tipousuario-component', require('./components/TipoUsuario.vue').default);
Vue.component('usuarios-component', require('./components/Usuarios.vue').default);
Vue.component('coordinador-component', require('./components/Coordinador.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    data :{
        menu: 0,
        notifications:[]
    }
});
