<template>
    <div v-if="isOpen">
      <!-- Tu código de ventana modal aquí -->
    </div>
  </template>
  
  <script>
  export default {
    props: {
      isOpen: {
        type: Boolean,
        default: false,
      },
    },
  };
  </script>