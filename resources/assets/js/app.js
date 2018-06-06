import './bootstrap';
import router from './routes';

Vue.mixin({
    methods: {
        url: function (url) {
            return '/' + url
        }
    }
})

const app = new Vue({
    el: '#app',
    router: router
});

