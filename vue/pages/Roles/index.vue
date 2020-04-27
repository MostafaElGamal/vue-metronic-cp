<template>
    <div class="kt-portlet kt-portlet--mobile">
        <table-header
            premissionName="create-role"
            addUrlName="addRole"
            tableName="Roles Table"
        ></table-header>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <table class="table table-sm  table-hover text-center">
                <th></th>
                <th>#</th>
                <th>Role Name</th>
                <th>Created At</th>
                <th>Stauts</th>
                <th></th>
                <tbody class="text-center">
                    <tr
                        role="row"
                        v-for="(role, index) in roles.data"
                        :key="role.id"
                    >
                        <td>
                            <b-dropdown id="dropdown-offset" left size="sm">
                                <b-dropdown-text
                                    v-for="pre in role.permissions"
                                    :key="pre.id"
                                    >{{ pre.name }}</b-dropdown-text
                                >
                            </b-dropdown>
                        </td>
                        <td>{{ index + 1 }}</td>
                        <td>
                            {{ role.name }}
                        </td>
                        <td>{{ role.time }}</td>

                        <td>
                            <status-tag :status="role.status"></status-tag>
                        </td>
                        <td>
                            <toggle-status
                                :id="role.id"
                                :status="role.status"
                                @deactivate="toggleStatus"
                                @activate="toggleStatus"
                                premissionName="activate-deactivate-role"
                            ></toggle-status>

                            <edit-action
                                :id="role.id"
                                editUrlName="editRole"
                                premissionName="update-role"
                            ></edit-action>

                            <delete-action
                                :id="role.id"
                                @delete="Delete"
                                premissionName="delete-role"
                            ></delete-action>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card-footer text-center">
                <pagination
                    :data="roles"
                    @pagination-change-page="getResults"
                ></pagination>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "roles-table",
    data() {
        return {
            roles: {}
        };
    },
    created() {
        this.getResults();
    },
    methods: {
        async getResults(page = 1) {
            const roleUrl = { URL: "role", page };
            const roles = await this.$store.dispatch("index", roleUrl);
            this.roles = roles.data;
        },

        async toggleStatus(id, status) {
            const result = await this.$SwalChecks(
                "Are you want to do this action ?"
            );
            if (result.value) {
                if (status !== "active") {
                    await this.$store.dispatch("activateRole", id);
                    this.toggleActivationFilterUsers(id, "active");
                } else {
                    try {
                        await this.$store.dispatch("deactivateRole", id);
                        this.toggleActivationFilterUsers(id, "deactivate");
                    } catch (error) {}
                }
            }
        },
        toggleActivationFilterUsers(id, status) {
            this.roles.data = this.roles.data.filter(role => {
                if (role.id == id) {
                    role.status = status;
                }
                return true;
            });
        },

        async Delete(id) {
            const result = await this.$SwalChecks(
                "You won't be able to revert this!"
            );
            if (result.value) {
                const roleUrl = { URL: "role", id };
                await this.$store.dispatch("delete", roleUrl);
                this.roles.data = this.roles.data.filter(role => {
                    return role.id != id;
                });
            }
        }
    },

    beforeRouteEnter(to, from, next) {
        if (Vue.prototype.isAuthorized("read-role")) {
            return next();
        }
        return next("/");
    }
};
</script>
