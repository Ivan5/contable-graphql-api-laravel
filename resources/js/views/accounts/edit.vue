<template>
    <div class="w-full">
        <graphql-error-toast
            v-if="this.errors"
            :errors="this.errors"
        ></graphql-error-toast>
        <div class="mb-4">
            <label
                for="name"
                class="block text-gray-700 text-sm font-bold mb-2"
            >
                Nombre de la cuenta
            </label>
            <input
                v-model="form.name"
                type="text"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name"
                placeholder="Gastos"
            />
        </div>
        <div class="mb-4">
            <label
                for="balance"
                class="block text-gray-700 text-sm font-bold mb-2"
            >
                Saldo de la Cuenta
            </label>
            <input
                v-model="form.balance"
                type="number"
                min="0"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="balance"
                placeholder="0"
                disabled
            />
        </div>
        <div class="mb-4">
            <loading :loading="loading"></loading>
            <button v-if="!loading" class="button-primary" @click="update">
                Editar Cuenta
            </button>
        </div>
    </div>
</template>
<script>
import GET_ACCOUNT from "../../graphql/accounts/account.graphql";
import UPDATE_ACCOUNT from "../../graphql/accounts/update-account.graphql";
import GraphqlErrorToast from "../components/errors/error-toast";
import Loading from "../components/common/loading.vue";

export default {
    components: {
        GraphqlErrorToast,
        Loading
    },
    data() {
        return {
            form: {
                name: null,
                balance: 0
            },
            errors: null,
            loading: false,
            account: null
        };
    },
    mounted() {
        this.getAccount();
    },
    methods: {
        async getAccount() {
            this.loading = true;
            try {
                const response = await this.$apollo.query({
                    query: GET_ACCOUNT,
                    variables: {
                        id: this.$route.params.id
                    }
                });
                this.loading = false;
                this.account = response.data.account;
                this.form.name = response.data.account.name;
                this.form.balance = response.data.account.balance;
            } catch (error) {
                console.log(error);
            }
        },
        async update() {
            this.loading = true;
            this.errors = null;
            try {
                const response = await this.$apollo.mutate({
                    mutation: UPDATE_ACCOUNT,
                    variables: {
                        id: this.account.id,
                        input: {
                            name: this.form.name
                        }
                    }
                });
                this.loading = false;
                if (response.data) {
                    return this.$router.push("/accounts");
                }
            } catch (error) {
                this.loading = false;
                this.errors = error;
            }
        }
    }
};
</script>
