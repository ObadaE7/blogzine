<x-app-layout>
    @section('title', 'Dashboard')
    <section class="dashboard__wrapper">
        @include('livewire.includes.aside')

        <main class="dashboard__main">
            @include('livewire.includes.header')

            <div class="dashboard__main-container">
                <div class="dashboard__breadcrumb">
                    @yield('breadcrumb')
                </div>

                <div class="dashboard__main-content">
                    @yield('content')
                </div>
            </div>
        </main>
    </section>

    @push('scripts')
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
    @endpush
</x-app-layout>
