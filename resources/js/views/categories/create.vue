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
                Nombre de la categoria
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
            <loading :loading="loading"></loading>
            <button v-if="!loading" class="button-primary" @click="submit">
                Crear Categoria
            </button>
        </div>
    </div>
</template>
<script>
import CREATE_CATEGORY from "../../graphql/categories/create-category.graphql";
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
                name: null
            },
            errors: null,
            loading: false
        };
    },
    methods: {
        async submit() {
            this.loading = true;
            this.errors = null;
            try {
                const response = await this.$apollo.mutate({
                    mutation: CREATE_CATEGORY,
                    variables: {
                        input: {
                            name: this.form.name
                        }
                    }
                });
                if (response.data) {
                    return this.$router.push("/categories");
                }
                this.loading = false;
            } catch (error) {
                this.loading = false;
                this.errors = error;
            }
        }
    }
};
</script>
<style scoped></style>
