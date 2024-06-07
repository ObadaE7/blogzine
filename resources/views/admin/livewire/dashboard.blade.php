<x-app-layout>
    @section('title', 'Admin Dashboard')

    <section class="dashboard__wrapper">
        @include('admin.livewire.includes.aside')

        <main class="dashboard__main">
            @include('admin.livewire.includes.header')

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
