import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/js/components/Home';
import About from '@/js/components/About';
import Browse from '@/js/pages/Browse';
import BrowseTaxa from '@/js/pages/BrowseTaxa';
import BrowseFlora from '@/js/pages/BrowseFlora';

Vue.use(VueRouter);

let SITE_TITLE = "Database Flora Gondang : ";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta:{title: 'Home'}
        },
        {
            path: '/about',
            name: 'about',
            component: About,
            meta:{title: 'Home'}
        },
        {
            path: '/browse',
            name: 'browse',
            component: Browse,
            meta:{title: 'Home'}
        },
        {
            path: '/browse/:name',
            name: 'browse_taxa',
            component: BrowseTaxa,
            meta:{title: 'Home'}
        },
        {
            path: '/browse/:name/:scientific_name',
            name: 'browse_flora',
            component: BrowseFlora
        }
    ]
});

router.beforeEach((to, from, next) => {
    let isDelegated = false;

    for (let matched = (to.matched || []), i = matched.length; i--;) {
        let route = matched[i];

        if (route.meta.beforeEach) {
            isDelegated = true;
            route.meta.beforeEach(to, from, next);
        }
    }

    !isDelegated && next();
});

export default router;