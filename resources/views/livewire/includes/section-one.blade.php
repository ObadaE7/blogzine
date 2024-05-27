<section class="section-one">
    <div class="row-top">
        <div class="banner">
            <img src="https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0" alt="Banner">
            <div class="overlay rounded-4"></div>
            <div class="banner-text">
                <span class="fw-bold">Discover, Explore, and Inspire</span>
            </div>
        </div>
    </div>

    <div class="row-bottom">
        @foreach ($posts as $post)
            <div class="row-bottom-rows">
                <div class="post-img">
                    <img src="{{ 'storage/' . $post->image }}" alt="Post image">
                    <div class="overlay-text">
                        <div class="overlay-text-position">
                            <a href="#" class="underline-hover">Explore</a>
                        </div>
                    </div>
                </div>

                <div class="post-info">
                    <div class="post-tag">
                        <span class="badge {{ $color }}">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-circle-fill"></i>
                                @foreach ($post->tags->take(1) as $tag)
                                    <span>{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </span>
                    </div>

                    <div class="post-title">
                        <span><a href="#" class="underline-hover">{{ $post->title }}</a></span>
                    </div>

                    <div class="post-content">
                        <span>{!! str()->limit($post->content, '300', '...') !!}</span>
                    </div>

                    <div class="post-footer">
                        <div class="post-owner">
                            @if (empty($post->owner->image))
                                <div class="avatar-subtle">
                                    <span>{{ substr($post->owner->fname, 0, 1) . substr($post->owner->lname, 0, 1) }}</span>
                                </div>
                            @else
                                <img src="{{ $post->owner->image }}" class="avatar" alt="Avatar">
                            @endif
                            <small class="text-muted">
                                By {{ $post->owner->fname . ' ' . $post->owner->lname }}
                                <i class="bi bi-dot"></i>
                                {{ $post->getDateForHuman() }}
                            </small>
                        </div>

                        <div class="post-reaction">
                            <span>124 <i class="bi bi-hand-thumbs-up-fill"></i></span>
                            <span>26 <i class="bi bi-hand-thumbs-down-fill"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
