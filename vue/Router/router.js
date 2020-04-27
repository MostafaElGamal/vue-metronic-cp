import VueRouter from "vue-router";
import { store } from "vue/Store/store";
import setToken from "vue/middleware/setAxiosToken";
import home from "vue/pages";
import login from "vue/pages/login";

// ----------------------- Roles CRUD ----------------------------
import roles from "vue/pages/Roles";
import addRole from "vue/pages/Roles/addRole";
import editRole from "vue/pages/Roles/editRole";

// ----------------------- Users CRUD ----------------------------
import users from "vue/pages/Users";
import addUser from "vue/pages/Users/addUser";
import editUser from "vue/pages/Users/editUser";

let childrenRoutes = [
    {
        path: "roles",
        name: "roles",
        components: {
            default: home,
            innerDash: roles
        }
    },
    {
        path: "roles/new-role",
        name: "addRole",
        components: {
            default: home,
            innerDash: addRole
        }
    },
    {
        path: "roles/edit-role/:id",
        name: "editRole",
        components: {
            default: home,
            innerDash: editRole
        }
    },
    {
        path: "users",
        name: "users",
        components: {
            default: home,
            innerDash: users
        }
    },
    {
        path: "users/new-user",
        name: "addUser",
        components: {
            default: home,
            innerDash: addUser
        }
    },
    {
        path: "users/edit-user/:id",
        name: "editUser",
        components: {
            default: home,
            innerDash: editUser
        }
    }
];
const routes = [
    { path: "/login", component: login, name: "login" },
    {
        path: "/",
        component: home,
        name: "home",
        meta: { requireAuth: true },
        children: childrenRoutes
    }
];

const router = new VueRouter({
    routes,
    mode: "history"
});

router.beforeEach((to, from, next) => {
    const token = store.getters.getToken;
    if (token) {
        setToken(token);
    }
    // check to see if route requires auth
    if (to.matched.some(rec => rec.meta.requireAuth)) {
        // user signed in, proceed to route
        if (store.getters.loggedin) {
            next();
        } else {
            // no user signed in, redirect to login
            next({ name: "login" });
        }
    } else {
        next();
    }
});

export default router;
