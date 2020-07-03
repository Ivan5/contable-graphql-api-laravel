<template>
    <div class="w-full">
        <loading :loading="loading"></loading>
        <graphql-error-toast
            v-if="this.errors"
            :errors="this.errors"
        ></graphql-error-toast>
        <div class="mb-4">
            <label
                for="account"
                class="block text-gray-700 text-sm font-bold mb-2"
            >
                Cuenta
            </label>
            <select
                id="account"
                v-model="form.account_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
                <option
                    v-for="account in accounts"
                    :value="account.id"
                    :key="account.id"
                    >{{ account.name }}</option
                >
            </select>
        </div>
        <div class="mb-4">
            <label
                for="category"
                class="block text-gray-700 text-sm font-bold mb-2"
            >
                Categoría
            </label>
            <select
                id="category"
                v-model="form.category_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
                <option
                    v-for="category in categories"
                    :value="category.id"
                    :key="category.id"
                    >{{ category.name }}</option
                >
            </select>
        </div>
        <div class="mb-4">
            <label
                for="type"
                class="block text-gray-700 text-sm font-bold mb-2"
            >
                Tipo de Transacción
            </label>
            <select
                id="type"
                v-model="form.type"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
                <option value="INCOME">Ingreso</option>
                <option value="EXPENSE">Gasto</option>
            </select>
        </div>
        <div class="mb-4">
            <label
                for="amount"
                class="block text-gray-700 text-sm font-bold mb-2"
            >
                Valor
            </label>
            <input
                v-model="form.amount"
                type="number"
                min="0"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="amount"
                placeholder="0"
            />
        </div>
        <div class="mb-4">
            <button v-if="!loading" class="button-primary" @click="submit">
                Crear Transacción
            </button>
        </div>
    </div>
</template>
<script>
import GET_SELECT_DATA from "../../graphql/transactions/create-transaction-data.graphql";
import Loading from "../components/common/loading.vue";
import GraphqlErrorToast from "../components/errors/error-toast";

export default {
    data() {
        return {
            loading: true,
            accounts: [],
            categories: [],
            form: {
                account_id: null,
                category_id: null,
                type: "INCOME",
                amount: 0
            },
            errors: null
        };
    },
    components: {
        Loading,
        GraphqlErrorToast
    },
    created() {
        this.getSelectData();
    },
    methods: {
        async getSelectData() {
            const response = await this.$apollo.query({
                query: GET_SELECT_DATA
            });
            this.accounts = response.data.accounts.data.map(item => {
                return {
                    id: item.id,
                    name: item.name
                };
            });
            this.categories = response.data.categories.data.map(item => {
                return {
                    id: item.id,
                    name: item.name
                };
            });
            this.loading = this.$apollo.loading;
        },
        submit() {}
    }
};
</script>
