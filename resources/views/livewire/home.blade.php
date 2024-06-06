<main class="main__wrapper">
    <section class="section__banner flash-animation">
        <img src="{{ asset('assets/img/banner.png') }}" alt="{{ trans('Website banner') }}">
        <div class="section__banner-text">
            <span>{{ trans('Discover, Explore, and Inspire') }}</span>
        </div>
    </section>

    @include('livewire.includes.section-one')
    @include('livewire.includes.section-two')
    @include('livewire.includes.section-three')
</main>

@push('scripts')
    <script src="{{ asset('assets/lib/swiper11/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        document.addEventListener("livewire:navigated", () => {
            initSwiper();
        });
    </script>
@endpush
