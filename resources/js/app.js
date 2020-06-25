require("./bootstrap");

window.Vue = require("vue");

import VueRouter from "vue-router";
import Router from "./router";

Vue.use(VueRouter);

new Vue({
    router: Router
}).$mount("#app");
