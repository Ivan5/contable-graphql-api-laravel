<template>
    <div class="w-full">
        <div class="flex justify-between">
            <h2 class="h2">Cuentas</h2>
            <div class="button-primary" @click="goToCreate">Crear</div>
        </div>

        <simple-table :headings="headings" :data="accounts"> </simple-table>
    </div>
</template>
<script>
import SimpleTable from "../components/tables/simple-table.vue";
import gql from "graphql-tag";

export default {
    data() {
        return {
            headings: ["ID", "Nombre"],
            accounts: []
        };
    },
    components: {
        SimpleTable
    },
    mounted() {
        this.getAccounts();
    },
    methods: {
        async getAccounts() {
            const response = await this.$apollo.query({
                query: gql(`
              {
                accounts(first:20){
                  data{
                    id
                    name
                  }
                }
              }
            `)
            });
            this.accounts = response.data.accounts.data.map(item => {
                return {
                    id: item.id,
                    name: item.name
                };
            });
        },
        goToCreate() {
            this.$router.push("/accounts/create");
        }
    }
};
</script>
