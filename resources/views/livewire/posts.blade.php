<section class="posts__wrapper">
    <div class="posts__header">
        <img src="{{ asset('assets/img/posts-pattern.jpg') }}" class="posts__header-img" alt="{{ trans('Posts banner') }}">
        <span class="posts__header-text">{{ trans('Discover All Posts') }}</span>
    </div>

    <div class="posts__content">
        @foreach ($posts as $post)
            <div class="posts__content-row">
                <div class="content__row-info">
                    <div class="row__info-tags">
                        @foreach ($post->tags->shuffle()->take(2) as $tag)
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

                    <div class="row__info-title">
                        <a href="#" class="text-underline-link">
                            <span>{{ $post->title }}</span>
                        </a>
                    </div>

                    <div class="row__info-avatar">
                        @if (empty($post->owner->image))
                            <div class="avatar__subtle">
                                <span>{{ substr($post->owner->fname, 0, 1) . substr($post->owner->lname, 0, 1) }}</span>
                            </div>
                        @else
                            <img src="{{ $post->owner->image }}" class="avatar" alt="{{ trans('Avatar') }}">
                        @endif
                        <div class="d-flex flex-column">
                            <span>{{ trans('By') . ' ' . $post->owner->fname . ' ' . $post->owner->lname }}</span>
                            <small>{{ $post->getDateForHuman() }}</small>
                        </div>
                    </div>
                </div>

                <div class="content__row-content">
                    {!! str()->limit($post->content, 340) !!}
                </div>

                <div class="content__row-img card-img-flash">
                    <img src="{{ asset('storage/' . $post->image) }}" class="content__row--img"
                        alt="{{ $post->slug }}">
                </div>
            </div>
        @endforeach
    </div>

    <div class="paginations">
        {{ $posts->links('components.pagination-links') }}
    </div>
</section>
