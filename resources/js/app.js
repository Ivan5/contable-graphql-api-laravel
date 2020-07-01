require("./bootstrap");

window.Vue = require("vue");

import VueRouter from "vue-router";
import VueApollo from "vue-apollo";
import Toasted from "vue-toasted";
import apolloClient from "./apollo/client.js";
import Router from "./router";

Vue.use(VueRouter);
Vue.use(VueApollo);
Vue.use(Toasted);

const apolloProvider = new VueApollo({
    defaultClient: apolloClient
});

new Vue({
    router: Router,
    apolloProvider
}).$mount("#app");
