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

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

import ExampleComponent from './components/ExampleComponent.vue';
Vue.component('ExampleComponent', ExampleComponent);
Vue.config.debug = true;
Vue.config.devtools = true;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const task = new Vue({
    el: '#task',
    data:{
      todos:[],
      newTodo:''
    },
    methods:{
      addTodo: function(todo){
        this.todos.push({content:todo,completed: false})
      },
      removeTodo: function(todo){
        this.todos.splice(this.todos.indexOf(todo), 1);
      }
    }
  })
Vue.config.debug = true;
Vue.config.devtools = true;