<script setup>
import { defineComponent, onMounted, toRefs } from "vue";
import { usePetStore } from "../../Stores/usePetStore";

import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Swal from "sweetalert2";
import { useToast } from "../../../composables/useToast";
const toast = useToast();

const petStore = usePetStore();
const {
    pets,
    typeAction,
    formulario,
    trainingArray,
    vaccineAndMedicineArray,
    supplementArray,
    genders,
    sizes,
    stallions,
    madrillas,
    disabilitys,
    errors
} = toRefs(petStore);

//vacuna y medicina
const addVacineMedicine = () => {
    petStore.addVacineMedicine();
};
const deleteVacineMedicine = (index, item) => {
    petStore.deleteVacineMedicine(index, item);
};

//entrenamiento
const addTrainingArray = () => {
    petStore.addTrainingArray();
};
const deleteTrainingArray = (index, item) => {
    petStore.deleteTrainingArray(index, item);
};

//suplementos
const addSupplementArray = () => {
    petStore.addSupplementArray();
};
const deleteSupplementArray = (index, item) => {
    petStore.deleteSupplementArray(index, item);
};

const props = defineProps({
    code: Number,
});
const saveForm = async() => {
    if(vaccineAndMedicineArray.value.length < 1){
        Swal.fire('Ingrese almenos 1 VACUNAS Y MEDICINAS');
        return false;
    }
    if(trainingArray.value.length < 1){
        Swal.fire('Ingrese almenos 1 ENTRENAMIENTO');
        return false;
    }
    if(supplementArray.value.length < 1){
        Swal.fire('Ingrese almenos 1 SUPLEMENTOS');
        return false;
    }
    let data = await petStore.fetchSave();
    if(data.status) {
        typeAction.value = 'list';
        petStore.keyList++;
    }
    /* const response = axios.post(route('pets.store'),formulario.value)
    .then(async(result) =>{
        toast.toast("Éxito", result.data.message, "success");
        console.log('aaaaaa',result)
    }); */

};

const changeScreen = () =>{
    typeAction.value = 'list';
}

onMounted(async () => {
    console.log("ddd", pets.value);
});
</script>
<template>
    <section>
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <PrimaryButton @click="changeScreen()">Atras</PrimaryButton>
        </div>
        <div class="container">
            <div>
                <!-- Fomrulario mascotas -->
                <div
                    class="px-4 py-2 m-2 p-6 sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Crear Mascotas {{ $page.props.auth.user.id }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Verifica la informacion antes de guardar los datos.
                        </p>
                    </header>

                    <form class="mt-6 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <InputLabel for="name" value="Nombre" />

                                <TextInput
                                    id="name"
                                    v-model="formulario.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    @keypress="errors.name = ''"
                                />

                                <InputError
                                    :message="errors.name"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel for="color" value="Color" />

                                <TextInput
                                    id="color"
                                    v-model="formulario.color"
                                    type="text"
                                    class="mt-1 block w-full"
                                    @keypress="errors.color = ''"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="errors.color"
                                />
                            </div>

                            <div>
                                <InputLabel for="gender_id" value="Genero" />

                                <select
                                    id="gender_id"
                                    v-model="formulario.gender_id"
                                    type="text"
                                    class="block w-full"
                                    @change="errors.gender_id = ''"
                                >
                                    <option value="" disabled selected>
                                        Selecciona un género
                                    </option>
                                    <option
                                        v-for="gender in genders"
                                        :key="gender.id"
                                        :value="gender.id"
                                    >
                                        {{ gender.name }}
                                    </option>
                                </select>

                                <InputError
                                    class="mt-2"
                                    :message="errors.gender_id"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <InputLabel for="size_id" value="Tamaño" />

                                <select
                                    id="size_id"
                                    v-model="formulario.size_id"
                                    type="text"
                                    class="block w-full"
                                    @change="errors.size_id = ''"
                                >
                                <option value="" disabled selected>
                                        Selecciona un tamaño
                                    </option>
                                    <option
                                        v-for="size in sizes"
                                        :key="size.id"
                                        :value="size.id"
                                    >
                                        {{ size.name }}
                                    </option>
                            </select>

                                <InputError
                                    class="mt-2"
                                    :message="errors.size_id"
                                />
                            </div>
                            <div>
                                <InputLabel for="race" value="Raza" />

                                <TextInput
                                    id="race"
                                    v-model="formulario.race"
                                    type="text"
                                    class="block w-full"
                                    @keypress="errors.race = ''"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="errors.race"
                                />
                            </div>
                            <div>
                                <InputLabel for="birth" value="Nacimiento" />

                                <TextInput
                                    id="birth"
                                    v-model="formulario.birth"
                                    type="text"
                                    class="block w-full"
                                    @keypress="errors.birth = ''"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="errors.birth"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <InputLabel for="plate" value="Placa" />

                                <TextInput
                                    id="plate"
                                    v-model="formulario.plate"
                                    type="text"
                                    class="block w-full"
                                    @keypress="errors.plate = ''"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="errors.plate"
                                />
                            </div>
                            <div>
                                <InputLabel for="locker" value="Casillero" />

                                <TextInput
                                    id="locker"
                                    v-model="formulario.locker"
                                    type="text"
                                    class="block w-full"
                                    @keypress="errors.locker = ''"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="errors.locker"
                                />
                            </div>
                            <div>
                                <InputLabel
                                    for="stallion_id"
                                    value="Padrillo"
                                />

                                <select
                                    id="stallion_id"
                                    v-model="formulario.stallion_id"
                                    type="text"
                                    class="block w-full"
                                    @change="errors.stallion_id = ''"
                                >
                                <option value="" disabled selected>
                                        Selecciona un padrillo
                                    </option>
                                    <option
                                        v-for="stallion in stallions"
                                        :key="stallion.id"
                                        :value="stallion.id"
                                    >
                                        {{ stallion.name }}
                                    </option>
                            </select>

                                <InputError
                                    class="mt-2"
                                    :message="errors.stallion_id"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <InputLabel
                                    for="madrilla_id"
                                    value="Madrilla"
                                />

                                <select
                                    id="madrilla_id"
                                    v-model="formulario.madrilla_id"
                                    type="text"
                                    class="block w-full"
                                    @change="errors.madrilla_id = ''"
                                >
                                <option value="" disabled selected>
                                        Selecciona una madrilla
                                    </option>
                                    <option
                                        v-for="madrilla in madrillas"
                                        :key="madrilla.id"
                                        :value="madrilla.id"
                                    >
                                        {{ madrilla.name }}
                                    </option>
                            </select>

                                <InputError
                                    class="mt-2"
                                    :message="errors.madrilla_id"
                                />
                            </div>
                            <div>
                                <InputLabel
                                    for="disabilitie_id"
                                    value="Discapacidad"
                                />

                                <select
                                    id="disabilitie_id"
                                    v-model="formulario.disabilitie_id"
                                    type="text"
                                    class="block w-full"
                                    @change="
                                        errors.disabilitie_id = ''
                                    "
                                >
                                <option value="" disabled selected>
                                        Selecciona una discapacidad
                                    </option>
                                    <option
                                        v-for="disability in disabilitys"
                                        :key="disability.id"
                                        :value="disability.id"
                                    >
                                        {{ disability.name }}
                                    </option>
                            </select>

                                <InputError
                                    class="mt-2"
                                    :message="errors.disabilitie_id"
                                />
                            </div>
                            <div>
                                <InputLabel for="Senasa" value="Senasa" />

                                <TextInput
                                    id="Senasa"
                                    v-model="formulario.Senasa"
                                    type="text"
                                    class="block w-full"
                                    @keypress="errors.Senasa = ''"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="errors.Senasa"
                                />
                            </div>
                        </div>
                    </form>
                </div>

                <!-- seccion de comentario -->
                <div
                    class="px-4 py-2 m-2 p-6 sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                        <div>
                            <InputLabel for="observation" value="Observación" />
                            <textarea
                                id="observation"
                                v-model="formulario.observation"
                                type="text"
                                class="block w-full"
                                @keypress="errors.observation = ''"
                            ></textarea>

                            <InputError
                                class="mt-2"
                                :message="errors.observation"
                            />
                        </div>
                    </div>
                </div>

                <!-- Seccion vacunas y medicinas -->
                <div
                    class="px-4 py-2 m-2 p-6 sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            VACUNAS Y MEDICINAS
                        </h2>
                    </header>
                    <div>
                        <PrimaryButton @click="addVacineMedicine()"
                            >+ Agregar</PrimaryButton
                        >
                    </div>
                    <div
                        v-for="(item, index) in vaccineAndMedicineArray"
                        :key="index"
                        v-show="item.delete != 'delete'"
                    >
                        <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                            <div>
                                <InputLabel for="date" value="Fecha" />

                                <TextInput
                                    id="date"
                                    v-model="item.date"
                                    type="date"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="type" value="Tipo" />

                                <TextInput
                                    id="type"
                                    v-model="item.type"
                                    type="text"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="brand" value="Marca" />

                                <TextInput
                                    id="brand"
                                    v-model="item.brand"
                                    type="text"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="dose" value="Dosis" />

                                <TextInput
                                    id="dose"
                                    v-model="item.dose"
                                    type="text"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div class="mt-6">
                                <DangerButton
                                    @click="deleteVacineMedicine(index, item)"
                                    >Eliminar</DangerButton
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seccion entrenamiento -->
                <div
                    class="px-4 py-2 m-2 p-6 sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            ENTRENAMIENTO
                        </h2>
                    </header>
                    <div>
                        <PrimaryButton @click="addTrainingArray()"
                            >+ Agregar</PrimaryButton
                        >
                    </div>
                    <div v-for="(item, index) in trainingArray" :key="index" v-show="item.delete != 'delete'">
                        <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                            <div>
                                <InputLabel for="date" value="Fecha" />

                                <TextInput
                                    id="date"
                                    v-model="item.date"
                                    type="date"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="hour" value="Hora" />

                                <TextInput
                                    id="hour"
                                    v-model="item.hour"
                                    type="time"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="type" value="Tipo" />

                                <TextInput
                                    id="type"
                                    v-model="item.type"
                                    type="text"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="state_id" value="Estado" />

                                <TextInput
                                    id="state_id"
                                    v-model="item.state_id"
                                    type="text"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div class="mt-6">
                                <DangerButton
                                    @click="deleteTrainingArray(index, item)"
                                    >Eliminar</DangerButton
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seccion suplememtos -->
                <div
                    class="px-4 py-2 m-2 p-6 sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            SUPLEMENTOS
                        </h2>
                    </header>
                    <div>
                        <PrimaryButton @click="addSupplementArray()"
                            >+ Agregar</PrimaryButton
                        >
                    </div>
                    <div v-for="(item, index) in supplementArray" :key="index" v-show="item.delete != 'delete'">
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                            <div>
                                <InputLabel for="concept" value="Concepto" />

                                <TextInput
                                    id="concept"
                                    v-model="item.concept"
                                    type="text"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="date" value="Fecha" />

                                <TextInput
                                    id="date"
                                    v-model="item.date"
                                    type="date"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="hour" value="Hora" />

                                <TextInput
                                    id="hour"
                                    v-model="item.hour"
                                    type="time"
                                    class="block w-full"
                                />

                                <InputError class="mt-2" />
                            </div>
                            <div class="mt-6">
                                <DangerButton
                                    @click="deleteSupplementArray(index, item)"
                                    >Eliminar</DangerButton
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="flex justify-center px-4 py-2 m-2 p-6 sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <div class="flex items-center gap-4">
                        <PrimaryButton @click="saveForm()"
                            >Guardar</PrimaryButton
                        >
                        <DangerButton>Cancelar</DangerButton>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
