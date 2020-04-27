<template>
    <!-- begin:: Header -->
    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

        <!-- begin:: Header Menu -->
        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">

            </div>
        </div>

        <!-- end:: Header Menu -->

        <!-- begin:: Header Topbar -->
        <div class="kt-header__topbar">
            <!--begin: User Bar -->
            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                <b-dropdown :text="'Hi: ' + user.name" style="color:black;background:trasnparent;">
                    <!-- <b-dropdown-item  class="kt-notification__item">
                        <router-link :to="{name: 'editUser', params:{id:user.id} }" title="Edit details" style="display:flex;color:#74788d;">
                            <i class="flaticon2-calendar-3 kt-font-success mr-2"></i>
                            <div class="kt-notification__item-title kt-font-bold" style="margin-top: 3px;">
                                My Account
                            </div>
                        </router-link>
                    </b-dropdown-item> -->
                    <b-dropdown-item @click="logout">
                        SignOut
                    </b-dropdown-item>
                </b-dropdown>
            </div>
            <!--end: User Bar -->
        </div>
        <!-- end:: Header Topbar -->
    </div>
    <!-- end:: Header -->
</div>



</template>
<script>
    export default {
        name:'navBar',
         data(){
            return{
                user:this.$store.state.user
            }
        },
        methods:{
           logout(){
             this.$store.dispatch('destroyToken')
            .then(res => {
                    this.$router.push({ name :'login' })
                })
            }
        }
    }
</script>
<style>
    .dropdown-toggle{
        color: black !important;
        background: transparent !important;    
    }
</style>