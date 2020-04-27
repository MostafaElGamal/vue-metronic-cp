<template>
    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div
            class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1"
            id="kt_login"
        >
            <div
                class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile"
            >
                <!--begin::Aside-->
                <div
                    class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside"
                    style="background-image:url(/images/bg-4.jpg);"
                >
                    <div class="kt-grid__item">
                        <a href="#" class="kt-login__logo">
                            <img src="/images/logo-4.png" />
                        </a>
                    </div>
                    <div
                        class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver"
                    >
                        <div class="kt-grid__item kt-grid__item--middle">
                            <h3 class="kt-login__title">
                                Welcome to the Dashboard ...!
                            </h3>
                            <h4 class="kt-login__subtitle">
                                superadministrator@app.com
                            </h4>
                        </div>
                    </div>
                </div>

                <!--begin::Aside-->

                <!--begin::Content-->
                <div
                    class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper"
                >
                    <!--begin::Body-->
                    <div class="kt-login__body">
                        <!--begin::Signin-->
                        <div class="kt-login__form">
                            <div class="kt-login__title">
                                <h3>Sign In</h3>
                            </div>
                            <!--begin::Form-->
                            <form
                                class="kt-form"
                                action=""
                                novalidate="novalidate"
                                @submit.prevent="login"
                                ref="formContainer"
                            >
                                <div
                                    class="alert alert-danger"
                                    role="alert"
                                    v-if="errors"
                                >
                                    <p>{{ errors }}</p>
                                </div>
                                <div class="form-group">
                                    <input
                                        class="form-control"
                                        v-model="loginForm.email"
                                        type="text"
                                        placeholder="Email"
                                        name="email"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        class="form-control"
                                        v-model="loginForm.password"
                                        type="password"
                                        placeholder="Password"
                                        name="password"
                                    />
                                </div>

                                <!--begin::Action-->
                                <div class="kt-login__actions">
                                    <a class="kt-link kt-login__link-forgot">
                                    </a>
                                    <button
                                        class="btn btn-primary btn-elevate kt-login__btn-primary"
                                        type="submit"
                                    >
                                        Sign In
                                    </button>
                                </div>

                                <!--end::Action-->
                            </form>

                            <!--end::Form-->
                        </div>

                        <!--end::Signin-->
                    </div>

                    <!--end::Body-->
                </div>

                <!--end::Content-->
            </div>
        </div>
    </div>
    <!-- end:: Page -->
</template>

<script>
import { store } from "vue/Store/store";
export default {
    name: "login",
    data() {
        return {
            loginForm: {},
            errors: null
        };
    },
    methods: {
        async login() {
            const loader = this.$loader();
            try {
                await this.$store.dispatch("login", this.loginForm);
                window.permissions = store.state.permissions;
                loader.hide();
                this.$router.push({ name: "home" });
            } catch (error) {
                this.errors = error.message;
                loader.hide();
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!store.getters.loggedin) {
            next();
        } else {
            next({ name: "home" });
        }
    }
};
</script>
