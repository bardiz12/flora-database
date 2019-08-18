import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/js/components/Home';
import About from '@/js/components/About';
import Browse from '@/js/pages/Browse';
import BrowseTaxa from '@/js/pages/BrowseTaxa';
import BrowseFlora from '@/js/pages/BrowseFlora';

Vue.use(VueRouter);

let SITE_TITLE = document.title;

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                title: SITE_TITLE + ' - Home',
            },
        },
        {
            path: '/about',
            name: 'about',
            component: About,
            meta: { title: 'Home' }
        },
        {
            path: '/browse',
            name: 'browse',
            component: Browse,
            meta: { title: SITE_TITLE + ' - Families', }
        },
        {
            path: '/browse/:name',
            name: 'browse_taxa',
            component: BrowseTaxa,
            meta: { title: SITE_TITLE + ' - ' }
        },
        {
            path: '/browse/:name/:scientific_name',
            name: 'browse_flora',
            component: BrowseFlora,
            meta: { title: SITE_TITLE + ' - ' }
        }
    ]
});
router.beforeEach((to, from, next) => {
    const { title } = to.meta;
    if (title) {
        document.title = typeof title === 'function' ? title(to) : title;
    }
    next();
});

router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.name) {
        // Start the route progress bar.
        NProgress.start()
    }
    next()
})

router.afterEach((to, from) => {
    // Complete the animation of the route progress bar.
    NProgress.done()
})


export default router;