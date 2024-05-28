<main class="main__wrapper">
    <div class="main__section-banner">
        <img src="{{ asset('assets/img/banner.jpg') }}" class="section__banner-img" alt="{{ trans('Website banner') }}">
        <div class="overlay"></div>
        <div class="section__banner-text">
            <span class="fw-bold">{{ trans('Discover, Explore, and Inspire') }}</span>
        </div>
    </div>

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
