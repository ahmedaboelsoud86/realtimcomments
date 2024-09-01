import './bootstrap';


import { createApp } from 'vue/dist/vue.esm-bundler';
import Notifications from './components/Notifications.vue';
import Comments from './components/Comments.vue';
import Notificationsmune from './components/Notificationsmune.vue';


const app = createApp({});

app.component('notifications', Notifications);
app.component('notificationsmune', Notificationsmune);
app.component('comments', Comments);

app.mount('#app');
