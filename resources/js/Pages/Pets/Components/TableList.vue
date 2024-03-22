<script setup>
import { defineComponent, onMounted, toRefs } from "vue";
import { usePetStore } from "../../Stores/usePetStore";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { onUnmounted } from "vue";
const petStore = usePetStore();
const {
    typeAction,
    pets,
    //formulario,
    trainingArray,
    vaccineAndMedicineArray,
    supplementArray,
} = toRefs(petStore);

const changeScreen = (type, obj) =>{
    typeAction.value = type;
    if(obj?.id){
        petStore.fetchInfoEdit(obj?.id)
    }
}

onMounted(()=>{
    console.log()
});
</script>
<template>
    <div>
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <PrimaryButton @click="changeScreen('form')">Crear</PrimaryButton>
        </div>
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nombre
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Color
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Raza
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Cumpleaños
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="pet in pets" :key="pet.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ pet.name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ pet.color }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ pet.race }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ pet.birth }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                <PrimaryButton class="primary" @click="changeScreen('form',pet )">Editar</PrimaryButton>
                            </p>
                            <p class="text-gray-900 whitespace-no-wrap">
                                <DangerButton class="danger">Borrar</DangerButton>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="pets.links" />
            </div>
        </div>
    </div>
</template>
