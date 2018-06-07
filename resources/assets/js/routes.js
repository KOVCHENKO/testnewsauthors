import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        redirect: '/news?page=1'
    },

    {
        path: '/news?page=1',
        component: require('./components/News.vue')
    },

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