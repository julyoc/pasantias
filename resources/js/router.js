import VueRouter from "vue-router";

import HomeComponent from "./components/home";
import LoginComponent from "./components/login";
import Dashboard from "./components/dashboard";
import Profile from "./components/profile.vue";
import Admin from "./components/admin.vue";
import ErrorComponent from "./components/error.vue";
const routes = [
    {
        path: "/",
        name: "home",
        component: HomeComponent,
        meta: {
            auth: false
        }
    },
    {
        path: "/404",
        name: "dashboard",
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    {
        path: "/login",
        name: "login",
        component: LoginComponent,
        meta: {
            auth: false
        }
    },
    {
      path: "/error/:resource",
      name: "error",
      component: ErrorComponent,
  },
  
    // USER ROUTES
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    {
        path: "/login",
        name: "login",
        component: LoginComponent,
        meta: {
            auth: true
        }
    },
    {
        path: "/profile",
        name: "profile",
        component: Profile,
        meta: {
            auth: true
        }
    },
    {
        path: "/admin",
        name: "admin",
        component: Admin,
        meta: {
            auth: true
        }
    }
];

export default new VueRouter({
    history: true,
    mode: "history",
    routes
});
