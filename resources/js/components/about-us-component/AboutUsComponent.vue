<script setup lang="ts"></script>
<template>
    <div class="leg flex min-h-screen flex-col items-center gap-5 bg-slate-300">
        <div class="mx-20 my-30 inline-block h-10/12 w-4/5 rounded-2xl bg-slate-200 p-6 text-justify text-lg font-semibold text-gray-200 shadow-2xl">
            <h1 class="mb-10 text-center text-4xl font-bold text-black">Sobre nosotros</h1>
            <div class="flex flex-row items-center justify-center gap-10">
                <p class="inline-block w-4/5 rounded-2xl bg-indigo-500 p-6 text-justify text-lg font-semibold text-gray-200 shadow-2xl">
                    Somos una empresa dedicada a ofrecer soluciones tecnológicas innovadoras. Si tienes alguna pregunta o necesitas más información,
                    no dudes en contactarnos. También puedes visitar nuestra sección de tareas pendientes para ver el progreso de nuestros proyectos.
                </p>
            </div>
            <div class="my-10 flex flex-row items-center justify-center gap-10">
                <p class="inline-block w-4/5 rounded-2xl bg-indigo-500 p-6 text-justify text-lg font-semibold text-gray-200 shadow-2xl">
                    Si deseas contactarnos, puedes visitar nuestra sección de "<a
                        class="transition-all hover:text-blue-700 hover:underline"
                        href="/contact"
                        >Contacto</a
                    >" donde encontrarás nuestros datos de contacto.
                </p>
            </div>
            <div class="my-10 flex flex-row items-center justify-center gap-10">
                <p class="inline-block w-4/5 rounded-2xl bg-indigo-500 p-6 text-justify text-lg font-semibold text-gray-200 shadow-2xl">
                    Si deseas ver el progreso de nuestros proyectos, puedes visitar nuestra sección de "<a
                        class="transition-all hover:text-blue-700 hover:underline"
                        href="/to-do-list"
                        >Tareas por hacer</a
                    >" donde encontrarás una lista de nuestras tareas pendientes.
                </p>
            </div>
        </div>
    </div>
</template>
