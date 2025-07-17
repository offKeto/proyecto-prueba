@extends('include.header')
@section('title', 'Contact')
@if (session('success'))
    <div id="success-message"
        class="fixed top-1/3 left-1/2 transform -translate-x-1/2 rounded bg-green-100 p-4 text-green-800 font-semibold shadow transition-opacity duration-500">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            const msg = document.getElementById('success-message');
            if (msg) msg.style.display = 'none';
        }, 3000);
    </script>
@endif
<div id="contactapp" data-csrf="{{ csrf_token() }}" data-user='@json($user)'></div>
@extends('include.footer')
