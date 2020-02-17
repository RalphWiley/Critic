import Vue from 'vue'
import Router from 'vue-router'
import Home from "../views/Home";
import List from '@/components/List'
import SignIn from '../views/SignIn'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: "/",
      name: "home",
      component: Home
    },
    {
      path: "/signin",
      name: "signin",
      component: SignIn
    },
    {
      path: "/list",
      name: "List",
      component: List
    }
  ]
});
