<main class="main__wrapper">
    <section class="section__banner flash-animation">
        <img src="{{ asset('assets/img/banner.png') }}" class="section__banner-img" alt="{{ trans('Website banner') }}">
        <div class="section__banner-text">
            <span>{{ trans('Discover, Explore, and Inspire') }}</span>
        </div>
    </section>

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
