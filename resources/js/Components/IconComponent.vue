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
            } else {
                this.saveChanges(this.name, this.email);
            }
        },
        async saveChanges(name, email) {
            this.name = name;
            this.email = email;
            // Aquí es donde harías tu llamada axios para guardar los cambios
            try {
                const response = await axios.post('/confirm-user', {
                    name: this.name,
                    email: this.email,
                });

                if (response.status === 200) {
                    console.log("Los cambios se guardaron correctamente");
                } else {
                    console.error("Hubo un problema al guardar los cambios");
                }
            } catch (error) {
                console.error(error);
            }
        },
    },
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
