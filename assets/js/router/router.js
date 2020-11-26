import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginPage from '../views/Login'
import Home from '../views/Home.vue'
import Store from '../store/index'

Vue.use(VueRouter)

const routes = [{
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',

        component: LoginPage
    },
    // otherwise redirect to login
    { path: '*', redirect: '/login' }
]


const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})
router.beforeEach((to, from, next) => {
    // redirect to login page if not logged in and trying to access a restricted page
    const publicPages = ['/login'];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = Store.state.connected;

    if (authRequired && !loggedIn) {
        return next('/login');
    }

    next();
})

export default router