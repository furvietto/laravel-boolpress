require('./bootstrap');

 window.Vue = require('vue');
 import App from './views/App';
 import Home from './pages/Home';
 import About from './pages/About';
 import Products from './pages/Products';
 import Product from './pages/Product';
 import Contact from './pages/Contact';

 import VueRouter from 'vue-router';
 
 Vue.use(VueRouter);

 const router = new VueRouter({
    mode: 'history',
    routes:  [
            {
                path: '/',
                name: 'home',
                component: Home
            },
            {
                path: '/products',
                name: 'products',
                component: Products
            },
            {
                path: '/products/:id',
                name: 'product',
                props: true, 
                component: Product
            },
            {
                path: '/about',
                name: 'about',
                component: About
            },
            {
                path: '/contact',
                name: 'contact',
                component: Contact
            },
            
        ]
});

 const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});