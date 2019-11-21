import VueRouter from 'vue-router';

let routes = [
    {
        path: '/albums',
        component: require('./views/Albums.vue').default
    },
    {
        name: 'artist',
        path: '/artists/:page*',
        component: require('./views/Artists.vue').default
    },
    {
        path: '/listens',
        component: require('./views/Listens.vue').default
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});