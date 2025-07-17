<script lang="ts">
export default {
    computed: {
        books(): any {
            return this.$store.getters['allBooks'];
        },
    },
    created(): any {
        this.$store.dispatch('cargarLibros');
    },
};
</script>
<template>
    <div>
        <h2>Lista de libros de Store</h2>
        <ul>
            <li v-for="book in books" :key="book.id">{{ book.title }}</li>
        </ul>
    </div>
</template>
