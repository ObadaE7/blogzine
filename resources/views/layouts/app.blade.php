@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Test">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>
        @if (!empty($title))
            {{ $title }}
        @else
            @yield('title')
        @endif
        {{ ' - ' . config('app.name', '') }}
    </title>

    @include('components.app-icon')
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
