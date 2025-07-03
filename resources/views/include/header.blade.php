<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'Default')
    </title>
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    @vite('resources/js/app.js')
</head>

<body class="font-sans antialiased">
    <nav
        class="fixed top-0 left-0 w-screen h-1/9 flex items-center justify-around bg-gray-800 p-4 text-white text-xl shadow-2xl opacity-95">
        <div class="flex space-x-10 items-center">
            <a href="http://localhost:8000/">
                <img class="hover:scale-110 transition-transform size-10" src="{{ asset('assets/img/logo.png') }}"
                    alt="Logo">
            </a>
            <a class="hover:text-gray-400 transition-transform transform hover:scale-110" href="/about">Sobre
                nosotros</a>
            <a class="hover:text-gray-400 transition-transform transform hover:scale-110" href="/contact">Contacto</a>
            <a class="hover:text-gray-400 transition-transform transform hover:scale-110" href="/to-do-list">Tareas por
                hacer</a>
        </div>
    </nav>
