import Vue from 'vue'
import routes from './router/index'
import Swal from 'sweetalert2'
require('./bootstrap')

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.swtoaster = function(type = 'success', message = '') {
    Toast.fire({
        icon: type,
        title: message
    })
}

Vue.component('app-header', require('./components/Header.vue').default);

const app = new Vue({
    el: '#app',
    router: routes
});
