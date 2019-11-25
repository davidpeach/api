import VueRouter from 'vue-router';

let routes = [
    {
        name: 'album',
        path: '/albums',
        component: require('./views/Albums.vue').default
    },
    {
        name: 'artist',
        path: '/artists/:page*',
        component: require('./views/Artists.vue').default
    },
    {
        name: 'listen',
        path: '/listens',
        component: require('./views/Listens.vue').default
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});