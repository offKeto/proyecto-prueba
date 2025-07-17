<script lang="ts" setup>
import { onMounted, ref } from 'vue';
import ContactComponent from './components/contact-component/ContactComponent.vue';

const csrfToken = ref('');
const user = ref(null);

onMounted(() => {
    const el = document.getElementById('contactapp');
    csrfToken.value = el?.getAttribute('data-csrf') || '';
    const userAttr = el?.getAttribute('data-user');
    user.value = userAttr ? JSON.parse(userAttr) : null;
});

onMounted(() => {
    const el = document.getElementById('contactapp');
    csrfToken.value = el?.getAttribute('data-csrf') || '';
});
</script>
<template>
    <ContactComponent :csrf-token="csrfToken" :user="user" />
</template>
