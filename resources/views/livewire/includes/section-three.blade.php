<section class="section-three">
    <div class="section-three-title">
        <div class="d-flex flex-column r1">
            <span class="fs-3"><i class="bi bi-layout-wtf me-2"></i>Browse articles by category</span>
            <small>
                Discover a variety of articles organized by category.
            </small>
        </div>
        <div class="r2">
            <a href="#" class="icon-link icon-link-hover">
                <span>See all categories</span>
                <i class="bi bi-box-arrow-in-up-right mb-1"></i>
            </a>
        </div>
    </div>

    <div class="section-three-swiper">
        <swiper-container class="mySwiper" space-between="30" slides-per-view="4" autoplay-delay="5000"
            autoplay-disable-on-interaction="false" navigation="true" loop="true" init="false">
            @foreach ($categories as $category)
                <swiper-slide>
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->slug }}">
                    <div class="overlay"></div>
                    <div class="slide-content">
                        <span class="fs-4">{{ $category->name }}</span>
                        <a href="#" class="badge-explore">Explore more</a>
                    </div>
                </swiper-slide>
            @endforeach
        </swiper-container>
    </div>
</section>
