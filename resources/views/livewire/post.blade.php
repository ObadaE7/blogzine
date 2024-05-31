<section class="post__wrapper">
    <div class="post__about">
        <div class="post__img card-img-flash">
            <img src="{{ asset('storage/' . $post->image) }}" class="post__img--img" alt="{{ $post->slug }}">
        </div>

        <div class="post__category">
            <span class="post__category-title">{{ trans('Category') }}</span>
            @foreach ($post->categories as $category)
                <a href="#">
                    <span class="badge bg-danger-subtle text-danger">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>

        <div class="post__tags">
            <span class="post__tags-title">{{ trans('Tags') }}</span>
            <div class="tags">
                @foreach ($post->tags as $tag)
                    @php
                        $colorNames = ['warning', 'info', 'danger', 'primary', 'success', 'dark', 'secondary'];
                        $colorIndex = array_rand($colorNames);
                        $color = $colorNames[$colorIndex];
                    @endphp
                    <a href="{{ route('tags', $tag->slug) }}">
                        <span class="badge bg-{{ $color }}-subtle text-{{ $color }}">
                            {{ $tag->name }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="post__content">
        <div class="post__content-title">
            <span>{{ $this->post->title }}</span>
        </div>
        <div class="post__content-subtitle">
            <span>{{ $this->post->subtitle }}</span>
        </div>
        <div class="post__content-content">
            <span>{!! $this->post->content !!}</span>
        </div>
    </div>
</section>
