import VueRouter from "vue-router";
import Transactions from "./views/transactions/index.vue";

const routes = [
    {
        path: "/transactions",
        component: Transactions
    }
];

export default new VueRouter({
    mode: "history",
    routes
});
