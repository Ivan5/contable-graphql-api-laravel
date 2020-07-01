import VueRouter from "vue-router";
import Transactions from "./views/transactions/index.vue";
import Accounts from "./views/accounts/index.vue";
import CreateAccount from "./views/accounts/create.vue";
import EditAccount from "./views/accounts/edit.vue";

const routes = [
    {
        path: "/transactions",
        component: Transactions
    },
    {
        path: "/accounts",
        component: Accounts
    },
    {
        path: "/accounts/create",
        component: CreateAccount
    },
    {
        path: "/accounts/:id/edit",
        component: EditAccount
    }
];

export default new VueRouter({
    mode: "history",
    routes
});