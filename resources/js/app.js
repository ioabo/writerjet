require('./bootstrap');

import { createApp } from 'vue';
import { createWebHistory, createRouter } from 'vue-router';
import { routes } from './routes';
import CKEditor from '@ckeditor/ckeditor5-vue';
import VuejsSimpleDatatable from "vuejs-simple-datatable";
import axios from 'axios'
import VueAxios from 'vue-axios'

var VueResource = require('vue-resource');

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

const app = createApp({})
app.component('documents-index', require('./components/Dashboard.vue').default)
app.component('dashboard-index', require('./components/Dashboard.vue'))
app.use(CKEditor)
app.use(router)
app.use(VuejsSimpleDatatable)
app.use(VueAxios, axios)
app.use(VueResource)
app.config.productionTip = false
app.config.globalProperties.$userId = document.querySelector("meta[name='user_id']").getAttribute('content'); //to pass currrent logged in User id from Blades
// app.use(BootstrapVue)- //wait for boostratp-vue support Vue3
// app.use(IconsPlugin)
// app.use(LayoutPlugin)
// app.use(ModalPlugin)
// app.use(CardPlugin)
// app.use(VBScrollspyPlugin)
// app.use(DropdownPlugin)
// app.use(TablePlugin)

app.mount('#app')

// const home = createApp({})
// home.component('dashboard-index', require('./components/Dashboard.vue'))
// home.use(router)

// home.mount('#dashboard')



