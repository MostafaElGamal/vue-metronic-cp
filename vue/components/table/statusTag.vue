<template>
    <div>
        <span
            class="kt-badge kt-badge--inline btn-danger"
            v-if="status !== 'active' && status"
            >{{ status }}</span
        >
        <span
            class="kt-badge kt-badge--inline btn-success"
            v-if="status == 'active' && status"
            >{{ status }}</span
        >
    </div>
</template>
<script>
export default {
    name: "status-tag",
    props: {
        status: {
            type: String,
            default: null
        }
    }
};
</script>
