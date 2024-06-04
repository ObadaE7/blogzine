<section class="category__wrapper">
    <div class="category__header">
        <img src="{{ asset('assets/img/category.jpg') }}" alt="{{ trans('Categories banner') }}">
        <span class="header__text">{{ trans('Posts in category') }} "{{ $category->name }}"</span>
    </div>

    <div class="category__content-container">
        @forelse ($posts as $post)
            <div class="category__content">
                <div class="category__content-img">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}">
                </div>

                <div class="category__content-details">
                    <div class="category__content-title">
                        <span>{{ $post->title }}</span>
                    </div>

                    <div class="category__content-subtitle">
                        <span>{{ $post->subtitle }}</span>
                    </div>

                    <div class="mt-auto mb-4 ms-auto">
                        <a wire:navigate href="{{ route('post', $post->slug) }}" class="read__more-btn">
                            {{ trans('Read More') }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning text-center" role="alert">
                <span>{{ trans('No posts found in this category.') }}</span>
            </div>
        @endforelse
    </div>
</section>
