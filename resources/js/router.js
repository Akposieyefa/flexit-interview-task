import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

const router = new VueRouter({

    routes: [

        { path: '/', name: 'Home', component: () => import('./views/Home.vue') },
        { path: '/register', name: 'ForgotPassword', component: () => import('./views/Register.vue') },

        { path: '/post-twitte', name: 'PostTwitte', component: () => import('./views/PostTwitte.vue') },
        { path: '/all-tiwtte', name: 'AllTwitte', component: () => import('./views/AllTwitte.vue') },
        { path: '/tiwtte-comments/:id', name: 'TwitteComment', component: () => import('./views/TwitteComment.vue') },

        { path: '/verify-email', name: 'Verify', component: () => import('./views/Verify.vue') },
        
        // otherwise redirect to home
      { path: '*', redirect: '/' }

    ]
});

router.beforeEach((to, from, next) => {
    const publicPages = ['/', '/register','/verify-email'];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = localStorage.getItem('token');

    if (authRequired && !loggedIn) {
        return next('/');
    }

    next();
});

export default router;
