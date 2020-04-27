import setToken from "vue/middleware/setAxiosToken";
export default {
    // -----------------------------------------------------------------
    actions: {
        async login(vuexContext, data) {
            try {
                const authUser = await axios.post("/api/login", {
                    email: data.email,
                    password: data.password
                });
                // These are the Var in the response of the api/login
                const token = authUser.data.access_token;
                const permissions = authUser.data.permissions;
                const user = authUser.data.user;

                // This is functions in  mutations I call it for change values in state
                vuexContext.commit("setAuthToken", token);
                vuexContext.commit("setCurrentUser", user);
                vuexContext.commit("setPermissions", permissions);
                setToken(token);
                // The promise that will we back to the login.vue
                return authUser;
            } catch (error) {
                // If any error happens in the login api
                if (error.response.status == 422) {
                    return error.response.data.errors;
                } else if (error.response.status == 401) {
                    // The reject() will sent an error to the login.vue
                    return error.response.data;
                }
            }
        },
        async destroyToken(context) {
            try {
                const logout = await axios.post("/api/logout");
                context.commit("destroyToken");
                return logout;
            } catch (error) {
                context.commit("destroyToken");
            }
        },
        swalSuccess(vuexContext, text) {
            Swal.fire({
                type: "success",
                text: text
            });
        }
    }
};
