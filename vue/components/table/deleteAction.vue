<template>
    <a
        class="btn btn-sm btn-clean btn-icon btn-icon-md"
        title="Delete"
        v-if="isAuthorized(premissionName)"
        @click="emitDelete(id)"
    >
        <i class="la la-trash"></i>
    </a>
</template>
<script>
export default {
    name: "delete-action",
    props: {
        id: {
            type: Number,
            default: 0
        },
        premissionName: {
            type: String,
            default: ""
        }
    },
    methods: {
        emitDelete() {
            this.$emit("delete", this.id);
        }
    }
};
</script>
