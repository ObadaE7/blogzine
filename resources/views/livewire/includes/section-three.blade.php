<section class="section__three">
    <div class="section__title-container">
        <div class="section__title">
            <span class="section__title-text">
                <i class="section__three-icon"></i>{{ trans('Browse articles by category') }}
            </span>
            <span>{{ trans('Discover a variety of articles organized by category.') }}</span>
        </div>

        <div class="section__title-link">
            <a href="{{ route('categories') }}" class="text-underline-link text-decoration-none">
                {{ trans('VIEW ALL CATEGORIES') }}
            </a>
        </div>
    </div>

    <div wire:ignore class="section__three-swiper">
        <swiper-container class="mySwiper" space-between="30" slides-per-view="4" autoplay-delay="5000"
            autoplay-disable-on-interaction="false" navigation="true" loop="true" init="false">
            @foreach ($categories as $category)
                <swiper-slide>
                    <div class="slide__img-container flash-animation">
                        <img src="{{ asset('storage/' . $category->image) }}" class="slide__img"
                            alt="{{ $category->slug }}">
                    </div>

                    <div class="slide__content">
                        <div class="slide__content-title">
                            <span>{{ $category->name }}</span>
                        </div>

                        <div class="slide__link-container">
                            <div class="slide__count-posts">
                                <span>{{ $category->posts->count() }}</span>
                                <span>{{ trans('Posts Available') }}</span>
                            </div>

                            <div class="slide__link">
                                <a href="{{ route('category', $category->slug) }}" class="badge-link"
                                    aria-label="{{ $category->name }} - Category">
                                </a>
                            </div>
                        </div>
                    </div>
                </swiper-slide>
            @endforeach
        </swiper-container>
    </div>
</section>
