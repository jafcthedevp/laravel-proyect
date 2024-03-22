<script setup>
import { defineComponent, onMounted, toRefs } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Form from "../Pets/Components/Form.vue";
import TableList from "../Pets/Components/TableList.vue";
import { usePetStore } from '../Stores/usePetStore';
import AppLayout from "@/Layouts/AppLayout.vue";
const petStore = usePetStore()
const { typeAction,pets,genders,sizes,stallions,madrillas,disabilitys } = toRefs(petStore);
const props = defineProps({
    pets: Array,
    genders: Array,
    sizes: Array,
    stallions: Array,
    madrillas: Array,
    disabilitys: Array,
});

onMounted(async ()=>{
    pets.value = await props.pets;
    genders.value = await props.genders;
    sizes.value = await props.sizes;
    stallions.value = await props.stallions;
    madrillas.value = await props.madrillas;
    disabilitys.value = await props.disabilitys;
});
</script>
<template>
    <Head title="Users" />
    <AuthenticatedLayout>
            <div>
                <TableList :key="petStore.keyList" v-show="typeAction === 'list'"/>
                <Form v-show="typeAction === 'form'"/>
            </div>
    </AuthenticatedLayout>
</template>
