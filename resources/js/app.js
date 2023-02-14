require('./bootstrap');
require('alpinejs');

import Alpine from 'alpinejs'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
import persist from '@alpinejs/persist'

Alpine.plugin(persist)
Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)

window.Alpine = Alpine

Alpine.start() // ?? @todo is this referring to later version than we have?

// ======= Vue.js and font awesome =======
import { createApp } from 'vue'; // vue 3

import mitt from 'mitt'; // vue 3 event bus equivalent
const emitter = mitt();  // @see https://stackoverflow.com/questions/63471824/vue-js-3-event-bus

// application review UI
// import ReviewHistoryAndActions from "./Vue/Admin/ReviewHistoryAndActions";
// import ReviewEntry from "./Vue/Admin/ReviewEntry";
// import ReviewAdminActions from "./Vue/Admin/ReviewAdminActions";
// import ReviewTopPanel from "./Vue/Admin/ReviewTopPanel";

// uploads management UI
import ManageUploads from "./Vue/Admin/ManageUploads";

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import {
    faCheckSquare,
    faSquare,
    faXmark,
    faTrashCan
} from '@fortawesome/free-solid-svg-icons';
library.add(faCheckSquare)
library.add(faSquare)
library.add(faXmark)
library.add(faTrashCan)

import '../sass/app.scss';
// let adminView = document.getElementById("admin");
// if (adminView) {
//   const app =  createApp({
//         components: { ReviewHistoryAndActions,
//             ReviewEntry,
//             ReviewAdminActions,
//             ReviewTopPanel,
//             ManageUploads
//         }
//     }).component('font-awesome-icon', FontAwesomeIcon)
//     app.config.globalProperties.emitter = emitter;
//     app.mount('#admin')
// }

