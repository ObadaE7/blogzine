<x-guest-layout>
    <section class="wrapper">
        <x-header></x-header>
        @yield('content')
        @unless (Route::is('login') || Route::is('register'))
            <x-footer></x-footer>
        @endunless
    </section>
</x-guest-layout>
