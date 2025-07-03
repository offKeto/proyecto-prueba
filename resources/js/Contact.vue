<script lang="ts" setup>
import { onMounted, ref } from 'vue';
import ContactComponent from './components/contact-component/ContactComponent.vue';

const csrfToken = ref('');

onMounted(() => {
    const el = document.getElementById('contactapp');
    csrfToken.value = el?.getAttribute('data-csrf') || '';
});
</script>
<template>
    <ContactComponent :csrf-token="csrfToken" />
</template>
