import { createRouter, createWebHistory } from 'vue-router'
import Main from '../views/Main.vue';
import Catalog from '../views/Catalog.vue';
import Item from '../views/Item.vue';
import Registration from '../views/Registration.vue';
import Authorization from '../views/Authorization.vue';
import Profile from '../views/Profile.vue';
import AdminPanel from '../views/AdminPanel.vue';

const routes = [
  {
    path: '/',
    name: 'Main',
    component: Main
  },
  {
    path: '/catalog/:category?/:type?',
    name: 'Catalog',
    component: Catalog,
    props: true,
  },
  {
    path: '/catalog/item',
    name: 'Item',
    component: Item
  },
  {
    path: '/registration',
    name: 'Registration',
    component: Registration
  },
  {
    path: '/authorization',
    name: 'Authorization',
    component: Authorization
  },
  {
    path: '/profile',
    name: 'Profile',
    component: Profile
  },
  {
    path: '/adminpanel',
    name: 'AdminPanel',
    component: AdminPanel
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
