import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);


 global.router = new Router({
    mode:'history',
    scrollBehavior() {
        return window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    routes: [
        {
            path: '/',
            component: () => import('../view/layout/seller/index'),
            children: [
                {
                    path: '',
                    name: 'seller',
                    component: () => import('../view/pages/seller/home/homePage.vue'),
                },
                {
                    path: 'items',
                    name: 'items',
                    component: () => import('../view/pages/seller/items/itemsPage.vue'),
                },
                {
                    path: 'items/addEdit/:id?',
                    name: 'itemsAddEdit',
                    component: () => import('../view/pages/seller/items/addEditPage.vue'),
                },
                {
                    path: 'items/details/:id?',
                    name: 'itemsDetails',
                    component: () => import('../view/pages/seller/items/addEditPage.vue'),
                },
                {
                    path: 'categories',
                    name: 'categories',
                    component: () => import('../view/pages/seller/categories/categoriesPage.vue'),
                },
                {
                    path: 'customers',
                    name: 'customers',
                    component: () => import('../view/pages/seller/customers/customerPage.vue'),
                },
                {
                    path: 'coupons',
                    name: 'coupons',
                    component: () => import('../view/pages/seller/coupons/couponsPage.vue'),
                },
                {
                    path: 'coupons/addEdit/:id?',
                    name: 'couponsAddEdit',
                    component: () => import('../view/pages/seller/coupons/addEditPage.vue'),
                },
                {
                    path: 'coupons/details/:id?',
                    name: 'couponsDetails',
                    component: () => import('../view/pages/seller/coupons/addEditPage.vue'),
                },
        
                {
                    path: 'orders',
                    name: 'orders',
                    component: () => import('../view/pages/seller/orders/ordersPage.vue'),
                },
                {
                    path: 'orders/addEdit/:id?',
                    name: 'ordersAddEdit',
                    component: () => import('../view/pages/seller/orders/addEditPage.vue'),
                },
                {
                    path: 'orders/details/:id?',
                    name: 'ordersDetails',
                    component: () => import('../view/pages/seller/orders/addEditPage.vue'),
                },
                
                {
                    path: 'rates',
                    name: 'rates',
                    component: () => import('../view/pages/seller/rates/ratesPage.vue'),
                },
                {
                    path: 'pages',
                    name: 'pages',
                    component: () => import('../view/pages/seller/pages/pagesPage.vue'),
                },
                {
                    path: 'contact-us',
                    name: 'contact-us',
                    component: () => import('../view/pages/seller/contactUs/contactUsPage.vue'),
                },
                {
                    path: 'settings',
                    name: 'settings',
                    component: () => import('../view/pages/seller/settings/settingsPage.vue'),
                },
            ]
        },

        {
            path: '/admin',
            component: () => import('../view/layout/admin/index'),
            children: [
                {
                    path: '',
                    name: 'admin',
                    component: () => import('../view/pages/admin/home/homePage.vue'),
                },
                {
                    path: 'countries',
                    name: 'countries',
                    component: () => import('../view/pages/admin/countries/countriesPage.vue'),
                },
                {
                    path: 'groups',
                    name: 'groups',
                    component: () => import('../view/pages/admin/groups/groupsPage.vue'),
                },
                {
                    path: 'itemTypes',
                    name: 'itemTypes',
                    component: () => import('../view/pages/admin/itemTypes/itemTypesPage.vue'),
                },
                {
                    path: 'stores',
                    name: 'stores',
                    component: () => import('../view/pages/admin/stores/storesPage.vue'),
                },
                {
                    path: 'contact-us',
                    name: 'adminContactUs',
                    component: () => import('../view/pages/admin/contactUs/contactUsPage.vue'),
                },
                {
                    path: 'storeActivities',
                    name: 'storeActivities',
                    component: () => import('../view/pages/admin/storeActivities/storeActivitiesPage.vue'),
                },
            ]
        },
        
    ],


}
)

export default router;

    
