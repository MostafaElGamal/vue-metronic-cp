<template>
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{ tableName }}
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <router-link
                        :to="{ name: addUrlName }"
                        style="color:white;"
                        class="btn btn-primary m-btn"
                        v-if="isAuthorized(premissionName)"
                    >
                        <i class="la la-plus ml-2"></i>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "table-header",
    props: {
        addUrlName: {
            type: String,
            default: "home"
        },
        tableName: {
            type: String,
            default: "Table"
        },
        premissionName: {
            type: String,
            default: ""
        }
    }
};
</script>
<style scoped>
.kt-portlet__head {
    border: none;
}
</style>
