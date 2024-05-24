<main class="main">
    @include('livewire.includes.section-one')
    @include('livewire.includes.section-two')
    @include('livewire.includes.section-three')
</main>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        initSwiper()
    </script>
@endpush
