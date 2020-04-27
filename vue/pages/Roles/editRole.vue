<template ref="formContainer">
    <div class="card">
        <div class="card-body my-5">
            <errors :errors="errors"></errors>
            <form v-on:submit.prevent="editRole">
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
                        tag-placeholder="Add this as new user"
                        placeholder="Search or add a user"
                        label="name"
                        track-by="id"
                        :options="permissions"
                        :multiple="true"
                        :taggable="true"
                        @tag="addTag"
                    >
                    </multiselect>
                </div>
                <div class="form-group">
                    <label for="description" class="form-control-label"
                        >Discription:</label
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
                    <button type="submit" class="btn btn-primary">Save</button>
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
    name: "edit-role",
    data() {
        return {
            errors: {},
            role: {},
            rolePermissions: [],
            permissions: []
        };
    },
    created() {
        this.getRole();
        this.getPremssions();
    },
    methods: {
        async getRole() {
            const id = this.$route.params.id;
            const getRole = await this.$store.dispatch("getRole", id);
            this.role = getRole.data.data;
        },
        async getPremssions() {
            const permissions = await this.$store.dispatch("get_permissions");
            this.permissions = permissions.data;
        },
        async editRole() {
            const loader = this.$loader();
            try {
                await axios.put(`/api/role/${this.role.id}`, this.role);
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
    }
};
</script>
