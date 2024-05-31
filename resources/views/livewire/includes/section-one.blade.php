<section class="main__section-one">
    <div class="section__title">
        <span class="section__title-text">
            <i class="title-one-icon"></i>
            {{ trans('Fresh Off the Press') }}
        </span>
        <span>{{ trans('Bringing You the Hottest News and Articles') }}</span>
    </div>

    <div class="section__one-content">
        @forelse ($posts as $post)
            <div class="section__one-row">
                <div class="section__one-img">
                    <img src="{{ 'storage/' . $post->image }}" alt="{{ $post->slug }}">
                    <div class="overlay-text">
                        <a href="{{ route('post', $post->slug) }}" class="text-underline-link rest-text-link">
                            {{ trans('Explore') }}
                        </a>
                    </div>
                </div>

                <div class="section__one-details">
                    <div class="section__one-post-tag">
                        <span class="badge {{ $color }}">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-circle-fill"></i>
                                @foreach ($post->tags->take(1) as $tag)
                                    <a href="{{ route('tags', $tag->slug) }}"><span>{{ $tag->name }}</span></a>
                                @endforeach
                            </div>
                        </span>
                    </div>

                    <div class="section__one-post-title">
                        <span>
                            <a href="{{ route('post', $post->slug) }}" class="text-underline-link rest-text-link">
                                {{ $post->title }}
                            </a>
                        </span>
                    </div>

                    <div class="section__one-post-content">
                        <span>{!! str()->limit($post->content, '300', '...') !!}</span>
                    </div>

                    <div class="section__post-footer">
                        <div class="section__post-owner">
                            @if (empty($post->owner->image))
                                <div class="avatar__subtle">
                                    <span>{{ substr($post->owner->fname, 0, 1) . substr($post->owner->lname, 0, 1) }}</span>
                                </div>
                            @else
                                <img src="{{ $post->owner->image }}" class="avatar" alt="{{ trans('Avatar') }}">
                            @endif
                            <small class="text-muted">
                                {{ trans('By') . ' ' . $post->owner->fname . ' ' . $post->owner->lname }}
                                <i class="bi bi-dot"></i>
                                {{ $post->getDateForHuman() }}
                            </small>
                        </div>

                        <div class="section__post-reaction">
                            <span>124 <i class="bi bi-hand-thumbs-up-fill"></i></span>
                            <span>26 <i class="bi bi-hand-thumbs-down-fill"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="d-flex flex-column text-center fs-3">
                <span>{{ trans('There is no post to display!') }}</span>
                <span>{{ trans('Share your ideas now') }}</span>
            </div>
        @endforelse
    </div>
</section>
