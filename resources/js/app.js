
import './bootstrap';

import {createApp} from 'vue';

const navBar = createApp();
navBar.component('navbar', require('./components/Navbar.vue').default);
navBar.component('post-list', require('./components/PostList.vue').default);
navBar.mount('#app');

/*
createApp({data() {return {counter: 0}},  mounted() {setInterval(() => {this.counter++}, 1000)}}).mount('#app');

const AttributeBinding = {data() {return {message: 'Was loaded : ' + new Date().toLocaleString()}}};
createApp(AttributeBinding).mount('#bind-attribute');

const EventHandling = {data() {return {message: 'Hello, Vue !'}},
    methods: {reversMessage() {this.message = this.message.split('').reverse().join('')}}};
createApp(EventHandling).mount('#event-handling');

createApp({data() {return {seen: true}}}).mount('#conditional-rendering');

const ListRendering = {
    data() {
        return {todos: [{text: 'Learn JavaScrypt'},
                    {text: 'Learn Vue'},
                    {text: 'Build something awesome'}]}}};
createApp(ListRendering).mount('#list-rendering');

const LoadTest = createApp();
//LoadTest.component('load-test', require('./components/Navbar.vue').default);  //default !!!!
LoadTest.component('load-test', require('./Alert.vue').default);  //default !!!!
LoadTest.mount('#test-load');*/