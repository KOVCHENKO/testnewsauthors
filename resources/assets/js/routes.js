import VueRouter from 'vue-router';

let routes = [

    {
        path: '/test',
        component: require('./components/ExampleComponent.vue')
    },

    {
        path: '/news',
        component: require('./components/News.vue')
    },

];

const router = new VueRouter({
    routes
});

export default router;