<script lang="ts" setup>
import { ref } from 'vue';

const props = defineProps(['create']);
const emit = defineEmits(['update:create']);

const title = ref('');
const description = ref('');
const status = ref('pending');

async function createTask() {
    try {
        const response = await fetch('/to-do-list/tasks', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement).content,
            },
            body: JSON.stringify({
                title: title.value,
                description: description.value,
                status: status.value,
            }),
        });
        const data = await response.json();
        if (data.success) {
            console.log('Tarea creada exitosamente:', data.task.title);
            emit('update:create', false);
        }
    } catch (error) {
        console.error('Error al crear la tarea:', error);
    }
}
function closeModal() {
    emit('update:create', false);
}
</script>

<template>
    <div v-if="props.create" class="modal fixed top-0 left-0 flex h-full w-full items-center justify-center">
        <div class="absolute top-0 left-0 h-full w-full bg-black opacity-50"></div>
        <div class="relative z-10 max-h-full w-full max-w-xl overflow-y-auto border-4 border-gray-400 bg-white sm:rounded-2xl">
            <div class="w-full">
                <div class="m-8 mx-auto my-20 max-w-[400px]">
                    <div class="mb-8">
                        <h1 class="mb-4 text-3xl font-extrabold">Crear nueva tarea</h1>
                        <form class="mx-4 w-full">
                            <div class="my-4 flex flex-col gap-2">
                                <label for="title" class="block text-lg font-semibold">Título</label>
                                <input
                                    type="text"
                                    id="title"
                                    v-model="title"
                                    class="w-full rounded-lg border-2 border-gray-400 p-2 text-lg focus:border-blue-500 focus:outline-none"
                                    placeholder="Titulo de la tarea"
                                />
                                <label for="description">
                                    <span class="block text-lg font-semibold">Descripción</span>
                                    <textarea
                                        id="description"
                                        v-model="description"
                                        class="w-full rounded-lg border-2 border-gray-400 p-2 text-lg focus:border-blue-500 focus:outline-none"
                                        placeholder="Descripción de la tarea"
                                    ></textarea>
                                </label>
                                <label for="status" class="block text-lg font-semibold">Estado</label>
                                <select id="status" v-model="status" class="w-full rounded-lg border-2 border-gray-400 p-2 text-lg transition-all">
                                    <option value="pending">Pendiente</option>
                                    <option value="in_progress">En progreso</option>
                                    <option value="completed">Completado</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="flex flex-row justify-center gap-4">
                        <button
                            type="button"
                            class="rounded-lg border-2 border-black bg-white p-2 text-xl font-semibold transition-all hover:bg-gray-300"
                            @click="createTask()"
                        >
                            Crear
                        </button>
                        <button
                            type="button"
                            class="rounded-lg border-2 border-black bg-red-500 p-2 text-xl font-semibold text-white transition-all hover:bg-red-600"
                            @click="closeModal()"
                        >
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
