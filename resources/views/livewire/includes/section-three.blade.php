<section class="main__section-three">
    <div class="section__three-title">
        <div class="section__title">
            <span class="section__title-text">
                <i class="title-three-icon"></i>
                {{ trans('Browse articles by category') }}
            </span>
            <span>{{ trans('Discover a variety of articles organized by category.') }}</span>
        </div>

        <div class="section__title-link">
            <a href="{{ route('categories') }}"
                class="icon-link icon-link-hover text-underline-link text-decoration-none">
                {{ trans('VIEW ALL CATEGORIES') }}
                <i class="bi bi-box-arrow-in-up-right mb-1"></i>
            </a>
        </div>
    </div>

    <div wire:ignore class="section__three-swiper">
        <swiper-container class="mySwiper" space-between="30" slides-per-view="4" autoplay-delay="5000"
            autoplay-disable-on-interaction="false" navigation="true" loop="true" init="false">
            @foreach ($categories as $category)
                <swiper-slide>
                    <div class="section__three-img card-img-flash">
                        <img src="{{ asset('storage/' . $category->image) }}" class="section__three--slide-img"
                            alt="{{ $category->slug }}">
                    </div>

                    <div class="section__three-content">
                        <div class="slide__content-text">
                            <span>{{ $category->name }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="slide__content-post-have">
                                <span class="fw-bold">
                                    {{ $category->posts->count() }}
                                    <span class="ms-2">{{ trans('Posts Available') }}</span>
                                </span>
                            </div>

                            <div class="slide__content-link">
                                <a href="{{ route('category', $category->slug) }}" class="badge-explore"></a>
                            </div>
                        </div>
                    </div>
                </swiper-slide>
            @endforeach
        </swiper-container>
    </div>
</section>
