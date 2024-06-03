@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Test">
    <title>
        @if (!empty($title))
            {{ $title . ' - ' }}
        @else
            @yield('title')
        @endif
        {{ config('app.name', '') }}
    </title>

    @include('components.app-icon')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/lib/bs-icons/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('css')
    <livewire:styles>
</head>

<body data-bs-theme="light">
    {{ $slot }}

    <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core.js') }}"></script>
    @stack('scripts')
    <livewire:scripts>
</body>

</html>
