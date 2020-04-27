export default {
    actions: {
        async getUser(vuexContext, id) {
            const user = await axios.get(`/api/users/${id}`);
            return user;
        },
        async ActivateUser(vuexContext, id) {
            const user = await axios.put(`/api/users/activate/${id}`);
            vuexContext.dispatch("swalSuccess", "Activated");
            return user.data;
        },

        async DeactivateUser(vuexContext, id) {
            try {
                const user = await axios.put(`/api/users/deactivate/${id}`);
                vuexContext.dispatch("swalSuccess", "Deactivated");
                return user.data;
            } catch (error) {
                Swal.fire({
                    title: "Warrning",
                    text: error.response.data.message,
                    type: "warning"
                });
            }
        },

        async DeleteUser(vuexContext, id) {
            try {
                const user = await axios.delete(`/api/users/${id}`);
                vuexContext.dispatch("swalSuccess", "Deleted");
                return user.data;
            } catch (error) {
                Swal.fire({
                    title: "Warrning",
                    text: error.response.data.message,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Now You Know"
                });
                throw error;
            }
        }
    }
};
