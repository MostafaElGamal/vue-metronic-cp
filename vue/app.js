// ----------------------------------------------- Packages Imports --------------------------------------------------
import { store } from "vue/Store/store";
import router from "vue/Router/router";
import checkPremissions from "vue/middleware/checkPremissions";

// ----------------------------------------------- CSS Imports --------------------------------------------------
import "vue-loading-overlay/dist/vue-loading.css";
import "vue-select/dist/vue-select.css";

// ----------------------------------------------- Requires Files --------------------------------------------------
require("vue/windowVarabiles");
require("vue/plugins/globalFunctions");
require("vue/plugins/globalComponents");
require("vue/plugins/vueUses");

// ----------------------------------------------- Vue Logic --------------------------------------------------
checkPremissions();

const app = new Vue({
    el: "#app",
    router: router,
    store: store
});
