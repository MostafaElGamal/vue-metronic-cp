<template>
    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div
            class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page"
        >
            <side-menu></side-menu>
            <div
                class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper"
                id="kt_wrapper"
            >
                <nav-bar></nav-bar>

                <div
                    class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                    id="kt_content"
                >
                    <!-- begin:: Content -->
                    <div
                        class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid"
                    >
                        <router-view name="innerDash"></router-view>
                    </div>
                    <!-- end:: Content -->
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
</template>

<script>
import navBar from "vue/components/Partials/navBar";
import sideMenu from "vue/components/Partials/sideMenu";
export default {
    name: "home",
    components: { navBar, sideMenu }
};
</script>
