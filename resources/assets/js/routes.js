import VueRouter from 'vue-router';

let routes = [

    {
        path: '/news',
        component: require('./components/News.vue')
    },

    {
        path: '/news/:id',
        component: require('./components/SingleNews.vue')
    },

];

const router = new VueRouter({
    routes
});

export default router;