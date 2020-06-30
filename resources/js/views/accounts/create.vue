<template>
    <div class="w-full">
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
            />
        </div>
        <div class="mb-4">
            <button class="button-primary" @click="submit">Crear Cuenta</button>
        </div>
    </div>
</template>
<script>
import gql from "graphql-tag";
import CREATE_ACCOUNT from "../../graphql/accounts/create-account.graphql";
export default {
    data() {
        return {
            form: {
                name: null,
                balance: 0.0
            }
        };
    },
    methods: {
        async submit() {
            const response = await this.$apollo.mutate({
                mutation: CREATE_ACCOUNT,
                variables: {
                    input: {
                        name: this.form.name,
                        balance: this.form.balance
                    }
                }
            });
            if (response.data) {
                return this.$router.push("/accounts");
            }
        }
    }
};
</script>
<style scoped></style>
