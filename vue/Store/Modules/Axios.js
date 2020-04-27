import router from "vue/Router/router";

export default {
    actions: {
        async index(vuexContext, { URL, page = 1 }) {
            const data = await axios.get(`/api/${URL}?page=${page}`);
            return data;
        },
        async update(vuexContext, { URL, id }) {
            const data = await axios.get(`/api/${URL}/${id}`);
            return data;
        },
        async edit(vuexContext, { URL, data }) {
            let loader = Vue.prototype.$loader();
            try {
                await axios.put(`/api/${URL}/${data.id}`, data);
                loader.hide();
                router.push({ name: URL });
            } catch (error) {
                loader.hide();
                throw error.response.data.errors;
            }
        },
        async store(vuexContext, { URL, data }) {
            let loader = Vue.prototype.$loader();
            try {
                await axios.post(`/api/${URL}`, data);
                loader.hide();
                router.push({ name: URL });
            } catch (error) {
                loader.hide();
                throw error.response.data.errors;
            }
        },
        async delete(vuexContext, { URL, id }) {
            try {
                const data = await axios.delete(`/api/${URL}/${id}`);
                vuexContext.dispatch("swalSuccess", "Deleted");
                return true;
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
