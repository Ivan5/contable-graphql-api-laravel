<template>
    <div class="text-center my-4">
        <beat-loader
            class=""
            :color="color"
            :loading="loading"
            :size="150"
            :sizeUnit="sizeUnit"
        ></beat-loader>
    </div>
</template>
<script>
import { BeatLoader } from "@saeris/vue-spinners";
export default {
    name: "loading",
    props: ["loading"],
    components: {
        BeatLoader
    },
    data() {
        return {
            color: "#2a4365",
            sizeUnit: "px"
        };
    }
};
</script>
