<section class="posts__wrapper">
    <div class="posts__header">
        <img src="{{ asset('assets/img/posts-pattern.jpg') }}" alt="{{ trans('Posts banner') }}">
        <span class="header__text">{{ trans('Discover All Posts') }}</span>
    </div>

    <div class="posts__content-container">
        @foreach ($posts as $post)
            <div class="posts__content">
                <div class="posts__info">
                    <div class="posts__info-tags">
                        @foreach ($post->tags->shuffle()->take(2) as $tag)
                            @php
                                $colorNames = ['warning', 'info', 'danger', 'primary', 'success', 'dark', 'secondary'];
                                $colorIndex = array_rand($colorNames);
                                $color = $colorNames[$colorIndex];
                            @endphp
                            <a wire:navigate href="{{ route('tags', $tag->slug) }}"
                                class="badge bg-{{ $color }}-subtle text-{{ $color }} text-decoration-none p-2">
                                {{ Str::upper($tag->name) }}
                            </a>
                        @endforeach
                    </div>

                    <div class="posts__info-title">
                        <a wire:navigate href="{{ route('post', $post->slug) }}">
                            <span class="underline__link-hover">{{ $post->title }}</span>
                        </a>
                    </div>

                    <div class="posts__info-avatar">
                        @if (empty($post->owner->image))
                            <div class="avatar__subtle">
                                <span>{{ substr($post->owner->fname, 0, 1) . substr($post->owner->lname, 0, 1) }}</span>
                            </div>
                        @else
                            <img src="{{ $post->owner->image }}" class="avatar"
                                alt="{{ $post->owner->uname . '-' . trans('avatar') }}">
                        @endif
                        <div class="d-flex flex-column">
                            <span class="fw-medium">
                                {{ trans('By') . ' ' . $post->owner->fname . ' ' . $post->owner->lname }}
                            </span>
                            <small class="text-muted">{{ $post->getDateForHuman() }}</small>
                        </div>
                    </div>
                </div>

                <div class="posts__content-content">
                    {!! str()->limit(
                        $post->content,
                        340,
                        '... <a wire:navigate href="' . route('post', $post->slug) . '">' . trans('Read More') . '</a>',
                    ) !!}
                </div>

                <div class="posts__img flash-animation">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}">
                </div>
            </div>
        @endforeach
    </div>

    <div class="section__paginate">
        {{ $posts->links('components.pagination-links') }}
    </div>
</section>
