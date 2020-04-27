<template>
    <div class="kt-portlet kt-portlet--mobile">
        <table-header
            premissionName="create-users"
            addUrlName="addUser"
            tableName="Users Table"
        ></table-header>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <table class="table table-sm  table-hover text-center">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created at</th>
                <th>status</th>
                <th></th>
                <tbody>
                    <tr
                        role="row"
                        class="even mb-2"
                        v-for="(user, index) in users.data"
                        :key="index"
                    >
                        <td>{{ index + 1 }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role_name }}</td>
                        <td>{{ user.date }}</td>
                        <td>
                            <status-tag :status="user.status"></status-tag>
                        </td>
                        <td>
                            <toggle-status
                                :id="user.id"
                                :status="user.status"
                                @deactivate="toggleStatus"
                                @activate="toggleStatus"
                                premissionName="activate-deactivate-users"
                            ></toggle-status>
                            <edit-action
                                :id="user.id"
                                editUrlName="editUser"
                                premissionName="update-users"
                            ></edit-action>
                            <delete-action
                                :id="user.id"
                                @delete="Delete"
                                premissionName="delete-users"
                            ></delete-action>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card-footer text-center">
                <pagination
                    :data="users"
                    @pagination-change-page="getResults"
                ></pagination>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "users-table",
    data() {
        return {
            users: {}
        };
    },

    created() {
        this.getResults();
    },

    methods: {
        async getResults(page = 1) {
            const userUrl = { URL: "users", page };
            const users = await this.$store.dispatch("index", userUrl);
            this.users = users.data;
        },
        async toggleStatus(id, status) {
            const result = await this.$SwalChecks(
                "Are you want to do this action ?"
            );
            if (status !== "active") {
                if (result.value) {
                    await this.$store.dispatch("ActivateUser", id);
                    this.toggleActivationFilterUsers(id, "active");
                }
            } else {
                if (result.value) {
                    await this.$store.dispatch("DeactivateUser", id);
                    this.toggleActivationFilterUsers(id, "deactivate");
                }
            }
        },
        toggleActivationFilterUsers(id, status) {
            this.users.data = this.users.data.filter(user => {
                if (user.id == id) {
                    user.status = status;
                }
                return true;
            });
        },
        async Delete(id) {
            const result = await this.$SwalChecks(
                "You won't be able to revert this!"
            );
            if (result.value) {
                const userUrl = { URL: "users", id };
                await this.$store.dispatch("delete", userUrl);
                this.users.data = this.users.data.filter(user => {
                    return user.id != id;
                });
            }
        }
    },

    beforeRouteEnter(to, from, next) {
        if (Vue.prototype.isAuthorized("read-users")) {
            return next();
        }
        return next("/");
    }
};
</script>
