import VueRouter from "vue-router";
import Transactions from "./views/transactions/index.vue";
import Accounts from "./views/accounts/index.vue";
import CreateAccount from "./views/accounts/create.vue";
import EditAccount from "./views/accounts/edit.vue";
import Categories from "./views/categories/index.vue";
import CreateCategory from "./views/categories/create.vue";
import EditCategory from "./views/categories/edit.vue";

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
    },
    {
        path: "/categories",
        component: Categories
    },
    {
        path: "/categories/create",
        component: CreateCategory
    },
    {
        path: "/categories/:id/edit",
        component: EditCategory
    }
];

export default new VueRouter({
    mode: "history",
    routes
});
