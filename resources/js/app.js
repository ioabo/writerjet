require('./bootstrap');

window.Vue = require('vue').default;
import { createApp } from 'vue';
import { createWebHistory, createRouter } from 'vue-router';
import { routes } from './routes';
import CKEditor from '@ckeditor/ckeditor5-vue';
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

// import { LayoutPlugin } from 'bootstrap-vue'
// // This imports <b-modal> as well as the v-b-modal directive as a plugin:
// import { ModalPlugin } from 'bootstrap-vue'
// // This imports <b-card> along with all the <b-card-*> sub-components as a plugin:
// import { CardPlugin } from 'bootstrap-vue'
// // This imports directive v-b-scrollspy as a plugin:
// import { VBScrollspyPlugin } from 'bootstrap-vue'
// // This imports the dropdown and table plugins
// import { DropdownPlugin, TablePlugin } from 'bootstrap-vue'

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

const app = createApp({})
app.component('documents-index', require('./components/documents/Index.vue').default)
app.use(CKEditor)
app.use(router)
// app.use(LayoutPlugin)
// app.use(ModalPlugin)
// app.use(CardPlugin)
// app.use(VBScrollspyPlugin)
// app.use(DropdownPlugin)
// app.use(TablePlugin)

app.mount('#app')




