import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from '../pages/Home'
import Category from '../pages/category/Index'
import CreateCategory from '../pages/category/Create'
import EditCategory from '../pages/category/Edit'

const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home,
            name: 'home'
        },
        {
            path: '/category',
            component: Category,
            name: 'category'
        },
        {
            path: '/category/create',
            component: CreateCategory,
            name: 'create-category'
        },
        {
            path: '/category/edit/:slug',
            component: EditCategory,
            name: 'edit-category'
        }
    ],
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
})


export default routes