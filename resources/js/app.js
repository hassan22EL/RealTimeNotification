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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});



$(document).ready(function () {

    var unreadurl = window.Laravel.unreadnotification;
    $.get(''+unreadurl ,function(data){
        addNotifiction(data);
    });
    Pusher.logToConsole = true;
    var userId = window.Laravel.userId;
    var channel = window.Echo.private(`App.User.${userId}`);
    window.console.log(channel);
    //lisen user when notifiy
    channel.notification(function (notification) {
        window.console.log(notification);
        //add notification in view 
        //now add notifiction in view 
        addNotifiction([notification]);
    });
});
var notifictions = [];
function addNotifiction(newnotification) {
    notifications = window._.concat(newnotification, notifictions);
    show(notifications);
}
function show(notifications) {
    var htmlNotifictions = $("#Notifictions");
    var html = notifications.map(function (notification) {
        return createMessage(notification);
    });
    htmlNotifictions.append(html);
}
function createMessage(notification) {
    var htmlmessage = `<div role="alert" id="message" class="message success">
                         <p>` + notification.data.message + `</p><br>
                         <p>` + notification.data.email + `
                        </div>`;
    return htmlmessage;
}
