import Vue from 'vue'
import Router from 'vue-router'
import Home from "../views/Home"
import List from '@/components/List'
import SignIn from '../views/SignIn'
import Friends from '../views/Friends'
import Register from '../views/Register'
import VueRouter from 'vue-router';
import store from '@/store'


Vue.use(Router)

const routes = [
  {
    path: "/",
    name: "home",
    component: Home
  },
  {
    path: "/register",
    name: "register",
    component: Register
  },
  {
    path: "/signin",
    name: "signin",
    component: SignIn
  },
  {
    path: "/list",
    name: "List",
    component: List,
    beforeEnter: (to, from, next) => {
      if (!store.getters["auth/authenticated"]) {
        return next({
          name: "signin"
        });
      }
      next();
    }
  },
  {
    path: "/friends",
    name: "Friends",
    component: Friends
  }
];

  const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

export default router