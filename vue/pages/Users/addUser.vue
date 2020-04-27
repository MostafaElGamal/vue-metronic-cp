<template>
    <div class="card">
        <div class="card-body my-5">
            <errors :errors="errors"></errors>
            <form v-on:submit.prevent="newUser" enctype="multipart/form-data">
                <div class="form-group m-form__group">
                    <label for="example_input_full_name">Name:</label>
                    <input
                        v-model="user.name"
                        type="text"
                        class="form-control m-input"
                        placeholder="Enter full name"
                    />
                </div>

                <div class="form-group m-form__group">
                    <label>Email address:</label>
                    <input
                        v-model="user.email"
                        type="email"
                        class="form-control m-input"
                        placeholder="Enter email"
                    />
                </div>

                <div class="form-group m-form__group">
                    <label>Password:</label>
                    <input
                        v-model="user.password"
                        type="password"
                        class="form-control m-input"
                        placeholder="Enter Password"
                    />
                </div>

                <div class="form-group m-form__group">
                    <label>Password Confirmation:</label>
                    <input
                        v-model="user.password_confirmation"
                        type="password"
                        class="form-control m-input"
                        placeholder="Enter Password Confirmation"
                    />
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleSelect1">Role:</label>
                    <multiselect
                        v-model="user.role"
                        tag-placeholder="Add this as new tag"
                        @tag="addTag"
                        placeholder="Search or add a tag"
                        label="name"
                        :options="roles"
                    ></multiselect>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button
                        type="button"
                        class="btn btn-primary"
                        data-dismiss="modal"
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
    name: "add-user",
    data() {
        return {
            errors: {},
            roles: [],
            user: {}
        };
    },
    created() {
        this.getRolesForNewUser();
    },
    methods: {
        async getRolesForNewUser() {
            const roles = await this.$store.dispatch("get_roles_for_new_user");
            this.roles = roles;
        },

        async newUser() {
            try {
                const user = { URL: "users", data: this.user };
                await this.$store.dispatch("store", user);
            } catch (error) {
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
            this.options.push(tag);
            this.value.push(tag);
        }
    },
    beforeRouteEnter(to, from, next) {
        if (Vue.prototype.isAuthorized("create-users")) {
            return next();
        }
        return next("/");
    }
};
</script>
