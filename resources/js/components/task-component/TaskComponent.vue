<script lang="ts" setup>
import ModalCreateTask from '@/components/task-component/ModalCreateTask.vue';
import { computed, onMounted, ref, watch } from 'vue';
import ModalUpdateTask from './ModalUpdateTask.vue';

type Task = {
    id: number;
    title: string;
    description: string;
    status: 'pending' | 'in_progress' | 'completed';
};

const tasks = ref<Task[]>([]);
const create = ref(false);
const update = ref(false);
const taskToUpdate = ref<number | null>(null);
const sortBy = ref<'title' | 'status'>('title');
const tasksByStatus = computed(() =>
    [...tasks.value].sort((a, b) => {
        if (a.status === 'completed' && b.status !== 'completed') return 1;
        if (b.status === 'completed' && a.status !== 'completed') return -1;
        if (a.status === 'in_progress' && b.status === 'pending') return 1;
        if (b.status === 'in_progress' && a.status === 'pending') return -1;
        return 0;
    }),
);
const currentPage = ref(1);
const pageSize = 5;
const paginatedTasks = computed(() => {
    const start = (currentPage.value - 1) * pageSize;
    const end = start + pageSize;
    return tasks.value.slice(start, end);
});
const paginatedTasksByStatus = computed(() => {
    const sorted = tasksByStatus.value;
    const start = (currentPage.value - 1) * pageSize;
    const end = start + pageSize;
    return sorted.slice(start, end);
});
const totalPages = computed(() =>
    sortBy.value === 'title' ? Math.ceil(tasks.value.length / pageSize) : Math.ceil(tasksByStatus.value.length / pageSize),
);

async function fetchTasks() {
    const response = await fetch('/to-do-list/tasks');
    tasks.value = await response.json();
}

async function updateStatus(task: Task) {
    const meta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = meta ? meta.getAttribute('content') : '';
    await fetch(`/to-do-list/tasks/status/${task.id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            'X-CSRF-TOKEN': csrfToken ?? '',
        },
        body: JSON.stringify({ status: task.status }),
    });
    console.log(`La tarea ${task.title} ha sido actualizada a ${task.status}`);
}

function refreshTasks(val: boolean) {
    create.value = val;
    if (!val) {
        fetchTasks();
    }
}

function deleteTask(taskId: number) {
    const meta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = meta ? meta.getAttribute('content') : '';
    fetch(`/to-do-list/tasks/${taskId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            'X-CSRF-TOKEN': csrfToken ?? '',
        },
    }).then(() => {
        console.log(`La tarea con ID ${taskId} ha sido eliminada`);
        fetchTasks();
    });
}
onMounted(async () => await fetchTasks());

watch(sortBy, () => {
    currentPage.value = 1;
});
</script>

<template>
    <div class="bg-animado flex min-h-screen flex-col items-center gap-5">
        <div class="my-30 flex w-1/3 flex-col rounded-lg bg-gray-900 p-6 text-center text-white shadow-xl">
            <h1 class="text-4xl font-bold">To-Do List</h1>

            <div class="flex justify-center gap-4">
                <button
                    class="mt-4 w-1/3 rounded bg-green-500 px-4 py-2 font-semibold text-white transition-all hover:bg-green-600"
                    @click="create = true"
                >
                    Crear nueva tarea
                </button>
                <select name="sort" id="sort" v-model="sortBy" class="mt-4 w-1/3 rounded bg-gray-800 px-4 py-2 text-white" placeholder="Ordenar por">
                    <option value="title">Título</option>
                    <option value="status">Estado</option>
                </select>
            </div>

            <div v-if="sortBy === 'title'">
                <div
                    v-for="task in paginatedTasks"
                    :key="task.id"
                    class="mt-4 flex flex-col gap-4 rounded-lg bg-slate-200 p-4 text-center text-black shadow-sm shadow-gray-600"
                >
                    <ul class="mb-4 flex flex-col">
                        <li class="text-3xl font-extrabold">
                            {{ task.title }}
                        </li>
                        <li class="text-lg">
                            {{ task.description }}
                        </li>
                        <li class="flex items-center justify-center text-lg">
                            <span>Estado:</span>
                            <select
                                v-if="task.status == 'pending'"
                                v-model="task.status"
                                @change="updateStatus(task)"
                                class="ml-2 rounded border-2 bg-red-400 text-sm font-semibold transition-all hover:bg-red-500 focus:bg-red-500"
                            >
                                <option class="bg-red-400 text-sm font-semibold" value="pending">Pendiente</option>
                                <option class="bg-yellow-300 text-sm font-semibold" value="in_progress">En Progreso</option>
                                <option class="bg-green-400 text-sm font-semibold" value="completed">Completada</option>
                            </select>
                            <select
                                v-else-if="task.status == 'in_progress'"
                                v-model="task.status"
                                @change="updateStatus(task)"
                                class="ml-2 rounded border-2 bg-yellow-300 text-sm font-semibold transition-all hover:bg-yellow-400 focus:bg-yellow-400"
                            >
                                <option class="bg-red-400 text-sm font-semibold" value="pending">Pendiente</option>
                                <option class="bg-yellow-300 text-sm font-semibold" value="in_progress">En Progreso</option>
                                <option class="bg-green-400 text-sm font-semibold" value="completed">Completada</option>
                            </select>
                            <select
                                v-else-if="task.status == 'completed'"
                                v-model="task.status"
                                @change="updateStatus(task)"
                                class="ml-2 rounded border-2 bg-green-400 text-sm font-semibold transition-all hover:bg-green-500 focus:bg-green-500"
                            >
                                <option class="bg-red-400 text-sm font-semibold" value="pending">Pendiente</option>
                                <option class="bg-yellow-300 text-sm font-semibold" value="in_progress">En Progreso</option>
                                <option class="bg-green-400 text-sm font-semibold" value="completed">Completada</option>
                            </select>
                        </li>
                        <li>
                            <div class="flex justify-center gap-2">
                                <button
                                    class="mt-2 rounded-md border-2 bg-blue-500 p-1 font-semibold transition-all hover:bg-blue-700"
                                    @click="
                                        update = true;
                                        taskToUpdate = task.id;
                                    "
                                >
                                    Editar
                                </button>
                                <button
                                    class="mt-2 rounded-md border-2 bg-red-500 p-1 font-semibold transition-all hover:bg-red-700"
                                    @click="deleteTask(task.id)"
                                >
                                    Borrar
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div v-else-if="sortBy === 'status'">
                <div
                    v-for="task in paginatedTasksByStatus"
                    :key="task.id"
                    class="mt-4 flex flex-col gap-4 rounded-lg bg-slate-200 p-4 text-center text-black shadow-sm shadow-gray-600"
                >
                    <ul class="mb-4 flex flex-col">
                        <li class="text-3xl font-extrabold">
                            {{ task.title }}
                        </li>
                        <li class="text-lg">
                            {{ task.description }}
                        </li>
                        <li class="flex items-center justify-center text-lg">
                            <span>Estado:</span>
                            <select
                                v-if="task.status == 'pending'"
                                v-model="task.status"
                                @change="updateStatus(task)"
                                class="ml-2 rounded border-2 bg-red-400 text-sm font-semibold transition-all hover:bg-red-500 focus:bg-red-500"
                            >
                                <option class="bg-red-400 text-sm font-semibold" value="pending">Pendiente</option>
                                <option class="bg-yellow-300 text-sm font-semibold" value="in_progress">En Progreso</option>
                                <option class="bg-green-400 text-sm font-semibold" value="completed">Completada</option>
                            </select>
                            <select
                                v-else-if="task.status == 'in_progress'"
                                v-model="task.status"
                                @change="updateStatus(task)"
                                class="ml-2 rounded border-2 bg-yellow-300 text-sm font-semibold transition-all hover:bg-yellow-400 focus:bg-yellow-400"
                            >
                                <option class="bg-red-400 text-sm font-semibold" value="pending">Pendiente</option>
                                <option class="bg-yellow-300 text-sm font-semibold" value="in_progress">En Progreso</option>
                                <option class="bg-green-400 text-sm font-semibold" value="completed">Completada</option>
                            </select>
                            <select
                                v-else-if="task.status == 'completed'"
                                v-model="task.status"
                                @change="updateStatus(task)"
                                class="ml-2 rounded border-2 bg-green-400 text-sm font-semibold transition-all hover:bg-green-500 focus:bg-green-500"
                            >
                                <option class="bg-red-400 text-sm font-semibold" value="pending">Pendiente</option>
                                <option class="bg-yellow-300 text-sm font-semibold" value="in_progress">En Progreso</option>
                                <option class="bg-green-400 text-sm font-semibold" value="completed">Completada</option>
                            </select>
                        </li>
                        <li>
                            <div class="flex justify-center gap-2">
                                <button
                                    class="mt-2 rounded-md border-2 bg-blue-500 p-1 font-semibold transition-all hover:bg-blue-600"
                                    @click="
                                        update = true;
                                        taskToUpdate = task.id;
                                    "
                                >
                                    Editar
                                </button>
                                <button
                                    class="mt-2 rounded-md border-2 bg-red-500 p-1 font-semibold transition-all hover:bg-red-700"
                                    @click="deleteTask(task.id)"
                                >
                                    Borrar
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div v-if="totalPages >= 1" class="mt-4 flex items-center justify-center gap-2">
                <button
                    v-if="currentPage > 1"
                    class="rounded bg-gray-600 p-1 font-semibold text-white transition-all hover:bg-gray-700"
                    @click="currentPage--"
                >
                    Anterior
                </button>
                <button v-else class="rounded bg-gray-800 p-1 font-semibold text-gray-500 transition-all" disabled @click="currentPage--">
                    Anterior
                </button>
                <div class="flex justify-center">
                    <span> {{ currentPage }} - {{ totalPages }} </span>
                </div>
                <button
                    v-if="currentPage < totalPages"
                    class="rounded bg-gray-600 p-1 font-semibold text-white transition-all hover:bg-gray-700"
                    @click="currentPage++"
                >
                    Siguiente
                </button>
                <button v-else class="rounded bg-gray-800 p-1 font-semibold text-gray-500 transition-all" disabled @click="currentPage--">
                    Anterior
                </button>
            </div>
        </div>
    </div>
    <ModalCreateTask :create="create" @update:create="refreshTasks" v-if="create" />
    <ModalUpdateTask
        :update="update"
        :id="taskToUpdate"
        @update:update="
            (val) => {
                update = val;
                fetchTasks();
            }
        "
        v-if="update"
    />
</template>
