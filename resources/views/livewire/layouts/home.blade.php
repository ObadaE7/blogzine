<x-guest-layout :title="$title ?? ''">
    <section class="{{ Route::is('login') || Route::is('register') ? 'auth' : '' }} wrapper">
        <x-header></x-header>
        @yield('content')
        @unless (Route::is('login') || Route::is('register') ||Route::is('admin.login'))
            <x-footer></x-footer>
        @endunless
    </section>
</x-guest-layout>
