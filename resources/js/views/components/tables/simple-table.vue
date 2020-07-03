<template>
    <div>
        <table class="table-auto w-full mt-4">
            <thead class="bg-blue-900 border b-2">
                <tr class="">
                    <th
                        class="text-white p-2 border border-blue-900"
                        v-for="heading in headings"
                        :key="heading"
                    >
                        {{ heading }}
                    </th>
                    <th class="text-white p-2 border border-blue-900"></th>
                </tr>
            </thead>
            <tbody class="border b-2 ">
                <tr v-if="!$apollo.loading" v-for="item in data" :key="item.id">
                    <td
                        class="p-4 border border-gray-400 text-center w-16"
                        v-for="column in item"
                        :key="column"
                    >
                        {{ column }}
                    </td>
                    <td class="p-4 border border-gray-400 text-center">
                        <button
                            @click="editRecord(item)"
                            class="button-primary"
                        >
                            Editar
                        </button>
                        <button
                            @click="deleteRecord(item)"
                            class="button-danger"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
                <tr>
                    <td v-if="$apollo.loading" :colspan="columns">
                        <loading :loading="$apollo.loading"></loading>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import Loading from "../common/loading";
export default {
    name: "simple-table",
    props: ["headings", "data", "loading"],
    components: {
        Loading
    },
    computed: {
        columns() {
            return this.headings.length + 1;
        }
    },
    methods: {
        editRecord(record) {
            this.$emit("editRecord", record);
        },
        deleteRecord(record) {
            this.$emit("deleteRecord", record);
        }
    }
};
</script>
