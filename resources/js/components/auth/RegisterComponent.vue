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
    <div class="flex min-h-screen flex-col items-center justify-center bg-slate-300">
        <div
            class="mx-20 my-30 flex h-10/12 w-3/5 flex-col items-center justify-center rounded-2xl bg-slate-200 p-6 text-justify text-lg font-semibold text-black shadow-2xl"
        >
            <h1 class="text-center text-4xl font-bold text-black">Register</h1>
            <form @submit.prevent="register" class="my-10 w-3/5">
                <div class="mx-20 flex flex-col gap-4 rounded-2xl bg-indigo-500 p-6 text-left text-gray-200 shadow-2xl">
                    <div>
                        <label for="name" class="text-sm font-semibold">Nombre: </label>
                        <input
                            v-model="name"
                            type="text"
                            id="name"
                            placeholder="Example"
                            required
                            class="mt-1 w-full rounded-md border border-gray-300 p-2 text-sm font-normal"
                        />
                    </div>
                    <div>
                        <label for="email" class="text-sm font-semibold">Email: </label>
                        <input
                            v-model="email"
                            type="email"
                            id="email"
                            placeholder="example@example.com"
                            required
                            class="mt-1 w-full rounded-md border border-gray-300 p-2 text-sm font-normal"
                        />
                    </div>
                    <div>
                        <label for="password" class="text-sm font-semibold">Contraseña: </label>
                        <input
                            v-model="password"
                            type="password"
                            id="password"
                            placeholder="contraseña"
                            required
                            class="mt-1 w-full rounded-md border border-gray-300 p-2 text-sm font-normal"
                        />
                    </div>
                    <button
                        class="cursor-pointer rounded-md bg-indigo-500 px-4 py-2 text-white transition-all hover:bg-indigo-600"
                        type="submit"
                        :disabled="loading"
                    >
                        Registrarse
                    </button>
                </div>
            </form>
            <div v-if="error" class="text-center text-xl font-bold text-red-500 transition-transform">{{ error }}</div>
        </div>
    </div>
</template>
