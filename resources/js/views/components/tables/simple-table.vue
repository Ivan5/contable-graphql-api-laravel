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
                <tr v-for="item in data" :key="item">
                    <td
                        class="p-4 border border-gray-400 text-center w-16"
                        v-for="row in item"
                        :key="row"
                    >
                        {{ row }}
                    </td>
                    <td class="p-4 border border-gray-400 text-center">
                        <button class="button-primary">Editar</button>
                        <button class="button-danger">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    name: "simple-table",
    props: ["headings", "data"]
};
</script>
