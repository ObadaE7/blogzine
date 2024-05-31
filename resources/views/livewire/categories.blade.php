<section class="categories__wrapper">
    <div class="categories__header">
        <img src="{{ asset('assets/img/category.jpg') }}" class="categories__header-img"
            alt="{{ trans('Category banner') }}">
        <span class="posts__header-text">{{ trans('Discover All Catetgories') }}</span>
    </div>

    <div class="categories__content">
        @foreach ($categories as $category)
            <div class="categories__content-row">
                <div class="categories__content-img">
                    <img src="{{ asset('storage/' . $category->image) }}" class="categories__content--img"
                        alt="{{ $category->slug }}">
                    <div class="overlay-text">
                        <a href="{{ route('category', $category->slug) }}" class="text-underline-link rest-text-link">
                            {{ trans('View Posts') }}
                        </a>
                    </div>
                </div>

                <div class="categories__content-title">
                    <a href="{{ route('category', $category->slug) }}" class="text-underline-link rest-text-link">
                        {{ $category->name }}
                    </a>
                    <div class="d-block">
                        <span class="badge bg-dark px-3 rounded-pill">{{ $category->posts->count() }}</span>
                    </div>
                </div>

                <div class="categories__content-desc">
                    {{ $category->description }}
                </div>
            </div>
        @endforeach
    </div>

    <div class="paginations">
        {{ $categories->links() }}
    </div>
</section>
