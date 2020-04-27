export default {
    actions: {
        async get_permissions(vuexContext) {
            const premissions = await axios.get("/api/permissions");
            return premissions;
        },
        async get_roles_for_new_user(vuexContext) {
            const newRoles = await axios.get("/api/newRole");
            return newRoles.data.data;
        },
        async getRole(vuexContext, id) {
            const role = await axios.get(`/api/role/${id}`);
            return role;
        },
        async activateRole(vuexContext, id) {
            try {
                const activeRole = await axios.put(`/api/role/activate/${id}`);
                return activeRole.data;
            } catch (error) {
                return error.response.data.errors;
            }
        },
        async deactivateRole(vuexContext, id) {
            try {
                const deactiveRole = await axios.put(
                    `/api/role/deactivate/${id}`
                );
                await vuexContext.dispatch("swalSuccess", "Deactivated");
                return deactiveRole.data;
            } catch (error) {
                Swal.fire({
                    title: "Warrning",
                    text: error.response.data.message,
                    type: "warning"
                });
                throw error;
            }
        },
        async DeleteRole(vuexContext, id) {
            try {
                await axios.delete(`/api/role/${id}`);
                await vuexContext.dispatch("swalSuccess", "Deleted");
                return true;
            } catch (error) {
                Swal.fire({
                    title: "Warrning",
                    text: error.response.data.message,
                    type: "warning"
                });
                throw error;
            }
        }
    }
};
