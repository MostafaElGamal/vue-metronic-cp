<template>
    <router-link
        :to="{
            name: editUrlName,
            params: { id: id }
        }"
        title="Edit details"
        class="btn btn-sm btn-clean btn-icon btn-icon-md"
        v-if="isAuthorized(premissionName)"
    >
        <li class="la la-edit"></li>
    </router-link>
</template>
<script>
export default {
    name: "edit-action",
    props: {
        id: {
            type: Number,
            default: 0
        },
        premissionName: {
            type: String,
            default: ""
        },
        editUrlName: {
            type: String,
            default: "/"
        }
    }
};
</script>
