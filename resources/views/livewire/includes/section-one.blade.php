<section class="main__section-one">
    <div class="section__one-title">
        <span class="section__one--title-text">{{ trans('Fresh Off the Press') }}</span>
        <span>{{ trans('Bringing You the Hottest News and Articles') }}</span>
    </div>

    <div class="section__one-content">
        @foreach ($posts as $post)
            <div class="section__one-row">
                <div class="section__one-img">
                    <img src="{{ 'storage/' . $post->image }}" alt="{{ trans('Post image') }}">
                    <div class="overlay-text">
                        <div class="overlay-text-position">
                            <a href="#" class="underline-hover">{{ trans('Explore') }}</a>
                        </div>
                    </div>
                </div>

                <div class="section__one-details">
                    <div class="section__one-post-tag">
                        <span class="badge {{ $color }}">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-circle-fill"></i>
                                @foreach ($post->tags->take(1) as $tag)
                                    <span>{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </span>
                    </div>

                    <div class="section__one-post-title">
                        <span><a href="#" class="underline-hover">{{ $post->title }}</a></span>
                    </div>

                    <div class="section__one-post-content">
                        <span>{!! str()->limit($post->content, '300', '...') !!}</span>
                    </div>

                    <div class="section__one-post-footer">
                        <div class="section__one-post-owner">
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

                        <div class="section__one-post-reaction">
                            <span>124 <i class="bi bi-hand-thumbs-up-fill"></i></span>
                            <span>26 <i class="bi bi-hand-thumbs-down-fill"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
