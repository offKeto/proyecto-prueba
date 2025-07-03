<script lang="ts" setup>
import Galleria from 'primevue/galleria';
import { ref } from 'vue';
const images = [
    {
        itemImageSrc: '/assets/img/img1.png',
        thumbnailImageSrc: '/assets/img/img1.png',
        alt: 'Imagen 1',
    },
    {
        itemImageSrc: '/assets/img/img2.png',
        thumbnailImageSrc: '/assets/img/img2.png',
        alt: 'Imagen 2',
    },
    {
        itemImageSrc: '/assets/img/img3.png',
        thumbnailImageSrc: '/assets/img/img3.png',
        alt: 'Imagen 3',
    },
    {
        itemImageSrc: '/assets/img/img4.png',
        thumbnailImageSrc: '/assets/img/img4.png',
        alt: 'Imagen 4',
    },
    {
        itemImageSrc: '/assets/img/img5.png',
        thumbnailImageSrc: '/assets/img/img5.png',
        alt: 'Imagen 5',
    },
];
const responsiveOptions = ref([
    {
        breakpoint: '991px',
        numVisible: 4,
    },
    {
        breakpoint: '767px',
        numVisible: 3,
    },
    {
        breakpoint: '575px',
        numVisible: 1,
    },
]);
</script>
<template>
    <div class="flex min-h-screen flex-col gap-5 bg-slate-200">
        <div class="mx-20 my-30">
            <h1 class="mb-10 text-center text-4xl font-bold text-black">¡Bienvenido a nuestra página web!</h1>
            <div class="flex flex-row items-center justify-center gap-10">
                <p class="inline-block w-2/5 rounded-2xl bg-indigo-500 p-6 text-justify text-lg font-semibold text-gray-200 shadow-2xl">
                    Somos una empresa dedicada a ofrecer soluciones tecnológicas innovadoras. Si tienes alguna pregunta o necesitas más información,
                    no dudes en contactarnos. También puedes visitar nuestra sección de tareas pendientes para ver el progreso de nuestros proyectos.
                    Si deseas saber mas sobre nosotros, puedes visitar nuestra sección de "<a
                        class="transition-all hover:text-blue-700 hover:underline"
                        href="/about"
                        >Sobre Nosotros</a
                    >" donde encontrarás más información sobre nuestra empresa.
                </p>
                <div>
                    <Galleria
                        :value="images"
                        :responsiveOptions="responsiveOptions"
                        :numVisible="5"
                        :circular="true"
                        containerStyle="max-width: 640px"
                        :showItemNavigators="true"
                        :showThumbnails="false"
                        :auto-play="true"
                        :transitionInterval="8000"
                    >
                        <template #item="slotProps">
                            <Transition name="fade-galleria" mode="out-in">
                                <div
                                    :key="slotProps.item.itemImageSrc"
                                    class="flex h-[400px] w-[640px] items-center justify-center overflow-hidden rounded-xl"
                                >
                                    <img
                                        :src="slotProps.item.itemImageSrc"
                                        :alt="slotProps.item.alt"
                                        class="block h-full min-h-full w-full min-w-full object-cover"
                                    />
                                </div>
                            </Transition>
                        </template>
                        <template #thumbnail="slotProps">
                            <img :src="slotProps.item.thumbnailImageSrc" :alt="slotProps.item.alt" class="block" />
                        </template>
                    </Galleria>
                </div>
            </div>
        </div>
    </div>
</template>
