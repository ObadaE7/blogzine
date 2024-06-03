<section class="post__wrapper">
    <div class="post__about">
        <div class="post__img flash-animation">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}">
        </div>
        @php
            $colorNames = ['warning', 'info', 'danger', 'primary', 'success', 'dark', 'secondary'];
        @endphp
        <div class="post__category">
            <span class="post__category-title">{{ trans('Category') }}</span>
            @foreach ($post->categories as $category)
                @php
                    $colorIndex = array_rand($colorNames);
                    $color = $colorNames[$colorIndex];
                @endphp
                <div class="post__category-tag">
                    <a wire:navigate href="{{ route('category', $category->slug) }}"
                        class="badge bg-{{ $color }}-subtle text-{{ $color }}">
                        {{ $category->name }}
                    </a>
                </div>
            @endforeach
        </div>

        <div class="post__tags">
            <span class="post__tags-title">{{ trans('Tags') }}</span>
            <div class="post__tags-tags">
                @foreach ($post->tags as $tag)
                    @php
                        $colorIndex = array_rand($colorNames);
                        $color = $colorNames[$colorIndex];
                    @endphp
                    <a wire:navigate href="{{ route('tags', $tag->slug) }}"
                        class="badge bg-{{ $color }}-subtle text-{{ $color }}">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="post__content">
        <div class="post__content-subject">
            <div class="post__content-title">
                <span>{{ $this->post->title }}</span>
            </div>

            <div class="post__content-subtitle text-muted">
                <span>{{ $this->post->subtitle }}</span>
            </div>

            <div class="mt-2">
                <small class="text-muted me-3">
                    {{ trans('By') . ' ' . $post->owner->fname . ' ' . $post->owner->lname }}
                </small>
                <small class="text-muted">{{ $post->getDateForHuman() }}</small>
            </div>
        </div>

        <div class="post__content-content">
            <span>{!! $this->post->content !!}</span>
        </div>
    </div>
</section>
