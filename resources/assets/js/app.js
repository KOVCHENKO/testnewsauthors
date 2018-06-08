import './bootstrap';
import router from './routes';
import { store } from './store/store';

Vue.mixin({
    methods: {
        url: function (url) {
            return '/' + url
        }
    }
})

const app = new Vue({
    el: '#app',
    router: router,
    store: store
});

