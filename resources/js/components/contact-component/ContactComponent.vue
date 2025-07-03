<script setup lang="ts">
defineProps<{
    csrfToken: string;
}>();
</script>
<template>
    <div class="flex min-h-screen flex-col items-center justify-center bg-slate-300">
        <div
            class="mx-20 my-30 flex h-10/12 w-3/5 flex-col items-center justify-center rounded-2xl bg-slate-200 p-6 text-justify text-lg font-semibold text-black shadow-2xl"
        >
            <h1 class="text-4xl font-bold">Contáctanos</h1>
            <p class="my-4 text-lg font-semibold">Si tienes alguna pregunta o inquietud, no dudes en ponerte en contacto con nosotros.</p>
            <form class="my-10 w-3/5" action="/contact/send-mail" method="post">
                <input type="hidden" name="_token" :value="csrfToken" />
                <div class="mx-20 flex flex-col gap-4 rounded-2xl bg-indigo-500 p-6 text-left text-gray-200 shadow-2xl">
                    <div>
                        <label for="name" class="text-sm font-semibold">Nombre: </label>
                        <input type="text" name="name" id="name" class="mt-1 w-full rounded-md border border-gray-300 p-2 text-sm font-normal" />
                    </div>
                    <div>
                        <label for="email" class="text-sm font-semibold">Correo electrónico: </label>
                        <input type="email" name="email" id="email" class="mt-1 w-full rounded-md border border-gray-300 p-2 text-sm font-normal" />
                    </div>
                    <div>
                        <label for="subject" class="text-sm font-semibold">Asunto: </label>
                        <input
                            type="text"
                            name="subject"
                            id="subject"
                            class="mt-1 w-full rounded-md border border-gray-300 p-2 text-sm font-normal"
                        />
                    </div>
                    <div>
                        <label for="message" class="text-sm font-semibold">Mensaje: </label>
                        <textarea
                            name="message"
                            id="message"
                            class="mt-1 w-full rounded-md border border-gray-300 p-2 text-sm font-normal"
                        ></textarea>
                    </div>
                    <button type="submit" class="rounded-md bg-indigo-500 px-4 py-2 text-white transition-all hover:bg-indigo-600">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</template>
