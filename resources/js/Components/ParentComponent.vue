<template>
    <icon-component @openModal="isOpen = true"></icon-component>
    <modal-component :isOpen="isOpen"></modal-component>
  </template>
  
  <script>
  import IconComponent from './IconComponent.vue';
  import ModalComponent from './ModalComponent.vue';
  
  export default {
    components: {
      IconComponent,
      ModalComponent,
    },
    data() {
      return {
        isOpen: false,
      };
    },
  };
  </script>