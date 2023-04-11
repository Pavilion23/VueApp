
import './bootstrap';

import {createApp} from 'vue';

const navBar = createApp();
navBar.component('navbar', require('./components/Navbar.vue').default);
navBar.component('post-list', require('./components/PostList.vue').default);
navBar.mount('#app');
