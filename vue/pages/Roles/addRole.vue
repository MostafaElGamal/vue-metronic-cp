<template>
    <div class="card">
        <div class="card-body my-5">
            <errors :errors="errors"></errors>
            <form v-on:submit.prevent="addRole">
                <div class="form-group m-form__group">
                    <label for="example_input_full_name">Name:</label>
                    <input
                        v-model="role.name"
                        type="text"
                        class="form-control m-input"
                        placeholder="Role name"
                    />
                    <span class="m-form__help">Please enter role name</span>
                </div>
                <div class="multiselect-input">
                    <label class="typo__label">Tagging</label>
                    <multiselect
                        v-model="role.permissions"
                        placeholder="Select Role"
                        label="name"
                        track-by="id"
                        :options="options"
                        :multiple="true"
                        :taggable="true"
                        @tag="addTag"
                    >
                    </multiselect>
                </div>
                <div class="form-group">
                    <label for="description" class="form-control-label"
                        >Description:</label
                    >
                    <textarea
                        v-model="role.description"
                        class="form-control"
                        id="description"
                        placeholder="Description"
                    ></textarea>
                    <span class="m-form__help"
                        >Specify the role at details
                    </span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                        style="color:black;"
                        @click="getBack"
                    >
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "add-role",
    data() {
        return {
            role: {},
            errors: {},
            options: []
        };
    },
    created() {
        this.getPermissions();
    },
    methods: {
        async getPermissions() {
            const permissions = await this.$store.dispatch("get_permissions");
            this.options = permissions.data;
        },
        async addRole() {
            const loader = this.$loader();
            try {
                await axios.post("/api/role", this.role);
                loader.hide();
                this.$router.push({ name: "roles" });
            } catch (error) {
                loader.hide();
                this.errors = error.response.data.errors;
            }
        },
        addTag(newTag) {
            const tag = {
                name: newTag,
                code:
                    newTag.substring(0, 2) +
                    Math.floor(Math.random() * 10000000)
            };
            this.role.permissions.push(tag);
        }
    },
    beforeRouteEnter(to, from, next) {
        if (Vue.prototype.isAuthorized("create-role")) {
            return next();
        }
        return next("/");
    }
};
</script>
