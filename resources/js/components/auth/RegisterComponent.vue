<script lang="ts" setup>
import { ref } from 'vue';

const name = ref('');
const email = ref('');
const password = ref('');
const error = ref('');
const loading = ref(false);
const tokenElement = document.querySelector('meta[name="csrf-token"]');
const token = tokenElement?.getAttribute('content') ?? '';

async function register() {
    error.value = '';
    loading.value = true;
    try {
        const res = await fetch('/register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
            body: JSON.stringify({ name: name.value, email: email.value, password: password.value }),
        });
        const data = await res.json();
        if (data.success) {
            window.location.href = data.redirect || '/';
        } else {
            error.value = data.message || 'Error en el registro.';
        }
    } catch (e) {
        error.value = 'Error de red.';
        console.error(e);
    }
    loading.value = false;
}
</script>

<template>
    <div class="leg flex min-h-screen flex-col items-center gap-5 bg-slate-300">
        <div class="mx-20 my-30 inline-block h-10/12 w-3/5 rounded-2xl bg-slate-200 p-6 text-justify text-lg font-semibold text-gray-200 shadow-2xl">
            <h1 class="mb-10 text-center text-4xl font-bold text-black">Register</h1>
            <form @submit.prevent="register" class="flex flex-wrap items-center justify-center gap-2 text-black">
                <h2>Nombre:</h2>
                <input v-model="name" type="text" placeholder="Example" required class="p-1 text-sm font-normal" />
                <h2>Email:</h2>
                <input v-model="email" type="email" placeholder="example@example.com" required class="p-1 text-sm font-normal" />
                <h2>Contraseña:</h2>
                <input v-model="password" type="password" placeholder="contraseña" required class="p-1 text-sm font-normal" />
                <button
                    class="hover: rounded-full border border-gray-800 p-2 font-normal transition-colors hover:bg-gray-800 hover:text-white"
                    type="submit"
                    :disabled="loading"
                >
                    Registrarse
                </button>
            </form>
            <div v-if="error" class="text-center text-xl font-bold text-red-500 transition-transform">{{ error }}</div>
        </div>
    </div>
</template>
