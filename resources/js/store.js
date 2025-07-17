import { createStore } from 'vuex';

export default createStore({
    state: {
        libros: [],
    },
    mutations: {
        SET_LIBROS(state, nuevosLibros) {
            state.libros = nuevosLibros;
        },
    },
    actions: {
        cargarLibros({ commit }) {
            fetch('/libros')
                .then((response) => response.json())
                .then((data) => {
                    commit('SET_LIBROS', data);
                })
                .catch((error) => {
                    console.error('Error al cargar libros: ', error);
                });
        },
        cargarLibrosThen() {
            axios
                .get('/books')
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        async cargarLibrosAsincrono({ commit }) {
            try {
                const response = await fetch('api/libtros');
                if (!response.ok) {
                    throw new Error('No se pudo cargar la lista de libros: ', response.error);
                }

                const data = await response.json();

                commit('SET_LIBROS', data);
            } catch (error) {
                console.error('Error al cargar libros: ', error);
            }
        },
    },
    getters: {
        totalLibros: (state) => state.libros.length,
        allBooks: (state) => state.libros,
    },
    modules: {},
});
