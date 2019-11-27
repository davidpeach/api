import VueRouter from 'vue-router';

let routes = [
    {
        name: 'home',
        path: '/',
        component: require('./views/Home.vue').default,
        pathToRegexpOptions: { strict: true }
    },
    {
        name: 'about',
        path: '/about/',
        component: require('./views/About.vue').default,
        pathToRegexpOptions: { strict: true }
    }
];

export default new VueRouter({
	routes,
	// mode: 'history'
});