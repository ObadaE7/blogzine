<x-guest-layout :title="$title ?? ''">
    <section class="{{ Route::is('login') || Route::is('register') || Route::is('admin.login') ? 'auth' : '' }} wrapper">
        @unless (Route::is('login') || Route::is('register') || Route::is('admin.login'))
            <x-header></x-header>
        @endunless
        @yield('content')
        @unless (Route::is('login') || Route::is('register') || Route::is('admin.login'))
            <x-footer></x-footer>
        @endunless
    </section>
</x-guest-layout>
