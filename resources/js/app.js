/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import DataTableUser from'./components/DataTableUser.vue';
// const MudaRecomendante = require('./components/MudaRecomendante.vue');
// const ContaCartasRecomendantes = require('./components/ContaCartasRecomendantes.vue');
import InscricoesNaoFinalizadas from './components/InscricoesNaoFinalizadas.vue';
// const ListaRecomendacoesAtivas  = require('./components/ListaRecomendacoesAtivas.vue');

const app = new Vue({
    el: '#app',
    components: {
        DataTableUser,
        // MudaRecomendante,
        // ContaCartasRecomendantes,
        InscricoesNaoFinalizadas,
        // ListaRecomendacoesAtivas
    }
});
