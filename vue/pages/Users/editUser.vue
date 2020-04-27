<template>
    <div class="card">
        <div class="card-body my-5">
            <errors :errors="errors"></errors>
            <form v-on:submit.prevent="EditUser">
                <div class="form-group m-form__group">
                    <label for="example_input_full_name">Name:</label>
                    <input
                        v-model="user.name"
                        type="text"
                        class="form-control m-input"
                        placeholder="user name"
                    />
                    <span class="m-form__help">Please enter user name</span>
                </div>

                <div class="form-group m-form__group">
                    <label for="example_input_full_name">Email:</label>
                    <input
                        v-model="user.email"
                        type="email"
                        class="form-control m-input"
                        placeholder="Email"
                    />
                    <span class="m-form__help"
                        >Please enter an email for the user</span
                    >
                </div>

                <div class="form-group m-form__group">
                    <label for="example_input_full_name">Password:</label>
                    <input
                        v-model="user.password"
                        type="password"
                        class="form-control m-input"
                        placeholder="Password"
                    />
                    <span class="m-form__help"
                        >Please enter an password for the user</span
                    >
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
                    <label for="exampleSelect1">Agent Role:</label>
                    <v-select :options="roles" v-model="user.role"></v-select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="getBack"
                        style="color:black;"
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
    data() {
        return {
            user: {},
            errors: {},
            roles: []
        };
    },
    mounted() {
        this.getUser();
        this.getRoles();
    },
    methods: {
        async getUser() {
            const userUrl = { URL: "users", id: this.$route.params.id };
            const user = await this.$store.dispatch("update", userUrl);
            this.user = user.data.data;
        },
        async getRoles() {
            const getRoles = await this.$store.dispatch(
                "get_roles_for_new_user"
            );
            for (const role of getRoles) {
                this.roles.push(role.name);
            }
        },
        async EditUser() {
            try {
                const user = { URL: "users", data: this.user };
                await this.$store.dispatch("edit", user);
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
    }, //END OF METHODS

    beforeRouteEnter(to, from, next) {
        if (Vue.prototype.isAuthorized("update-users")) {
            return next();
        }
        return next("/");
    }
};
</script>
