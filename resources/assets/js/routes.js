import VueRouter from 'vue-router';

let routes = [

    {
        path: '/test',
        component: require('./components/ExampleComponent.vue')
    },

];

const router = new VueRouter({
    routes
});

export default router;