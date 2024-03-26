<template>
    <div>
        <input type="text" v-model="modifiedField" />
        <button @click="saveChanges">Guardar</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            modifiedField: "",
        };
    },
    methods: {
        saveChanges() {
            // Perform save logic for the modified field
        },
    },
};
</script>
