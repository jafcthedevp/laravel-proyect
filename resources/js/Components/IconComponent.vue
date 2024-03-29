<template>
    <div @click="edit" class="icon-container">
        <a href="" @click.prevent="edit">
            <img :src="PencilIcon" alt="Pencil Icon" class="icon-link pencil-icon" />
        </a>
        <a href="" @click.prevent="saveChanges(name, email)">
            <img v-if="showNewIcon" :src="NewIcon" alt="NewIcon" class="icon-link" />
        </a>
    </div>
</template>

<script>
import axios from "axios";
import PencilIcon from "../../icons/pencil.svg";
import NewIcon from "../../icons/check.svg";

export default {
    props: ["userId"],
    data() {
        return {
            PencilIcon,
            NewIcon,
            showNewIcon: false,
            name: "",
            email: "",
        };
    },
    methods: {
        edit() {
            this.$emit("edit", this.userId);
            this.showNewIcon = !this.showNewIcon;
            if (this.showNewIcon) {
                this.name = this.$props.name;
                this.email = this.$props.email;
            } 
        },
        async updateProfile() {
        try {
            const response = await axios.patch('/profile', {
                name: this.name,
                email: this.email,
                // Agrega aquí cualquier otro campo que desees actualizar
            });

            // Maneja la respuesta de la solicitud aquí
            console.log(response.data);
        } catch (error) {
            // Maneja cualquier error que ocurra durante la solicitud aquí
            console.error(error);
        }
    }
}
};
</script>

<style scoped>
.icon-link {
    width: 15px;
    height: 15px;
    display: inline-block;
}

.pencil-icon {
    margin-right: 30px;
}

img {
    width: 16px;
    height: 16px;
    margin-right: 2px;
}
</style>
