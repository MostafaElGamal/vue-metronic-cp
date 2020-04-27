<template>
    <div v-if="isAuthorized(premissionName)" class="d-inline-block">
        <span
            class="btn btn-sm btn-clean btn-icon btn-icon-md active"
            v-if="status == 'active' && status"
            @click="emitDeactivate"
        >
            <li class="fas fa-toggle-on"></li>
        </span>
        <span
            class="btn btn-sm btn-clean btn-icon btn-icon-md"
            v-if="status !== 'active' && status"
            @click="emitActivate(id)"
        >
            <li class="fas fa-toggle-off"></li>
        </span>
    </div>
</template>
<script>
export default {
    name: "toggle-status",
    props: {
        id: {
            type: Number,
            default: 0
        },
        status: {
            type: String,
            default: null
        },
        premissionName: {
            type: String,
            default: ""
        }
    },
    methods: {
        emitDeactivate() {
            this.$emit("deactivate", this.id, this.status);
        },
        emitActivate() {
            this.$emit("activate", this.id, this.status);
        }
    }
};
</script>
<style scoped>
.active {
    color: green !important;
    background: transparent !important;
}
span {
    cursor: pointer;
}
</style>
