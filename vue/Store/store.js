import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import Users from "./Modules/Users";
import Roles from "./Modules/Roles";
import Auth from "./Modules/Auth";
import Axios from "./Modules/Axios";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        token: "",
        user: "",
        permissions: ""
    },
    // -----------------------------------------------------------------
    plugins: [createPersistedState()],
    // -----------------------------------------------------------------
    mutations: {
        setAuthToken(state, token) {
            state.token = token;
        },
        setPermissions(state, permissions) {
            state.permissions = permissions;
        },
        setCurrentUser(state, user) {
            state.user = user;
        },
        destroyToken(state) {
            state.token = null;
            state.user = null;
            state.permissions = null;
            window.permissions = null;
        }
    },
    // -----------------------------------------------------------------

    getters: {
        loggedin(state) {
            if (state.token != null) {
                if (state.token != undefined) {
                    if (state.token != "") {
                        return true;
                    }
                }
            }
            state.token = null;
            return false;
        },
        getToken(state) {
            return state.token;
        }
    },
    // -----------------------------------------------------------------

    modules: {
        Auth: Auth,
        Users: Users,
        Roles: Roles,
        Axios: Axios
    }
});
