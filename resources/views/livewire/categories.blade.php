<section class="categories__wrapper">
    <div class="categories__header">
        <img src="{{ asset('assets/img/category.jpg') }}" alt="{{ trans('Categories banner') }}">
        <span class="header__text">{{ trans('Discover All Catetgories') }}</span>
    </div>

    <div class="categories__content-container">
        @foreach ($categories as $category)
            <div class="categories__content">
                <div class="categories__content-img">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->slug }}">
                    <div class="overlay-text">
                        <a wire:navigate href="{{ route('category', $category->slug) }}"
                            class="text-underline-link text-decoration-none">{{ trans('View Posts') }}
                        </a>
                    </div>
                </div>

                <div class="categories__content-title">
                    <a wire:navigate href="{{ route('category', $category->slug) }}" class="text-underline-link">
                        {{ $category->name }}
                    </a>
                    <div class="d-block">
                        <span class="badge bg-dark px-3 rounded-pill">{{ $category->posts->count() }}</span>
                    </div>
                </div>

                <div class="categories__content-desc">{{ $category->description }}</div>
            </div>
        @endforeach
    </div>

    <div class="section__paginate">
        {{ $categories->links('components.pagination-links') }}
    </div>
</section>
