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
                        @foreach ($post->tags->take(1) as $tag)
                            @php
                                $colorNames = ['warning', 'info', 'danger', 'primary', 'success', 'dark', 'secondary'];
                                $colorIndex = array_rand($colorNames);
                                $color = $colorNames[$colorIndex];
                            @endphp
                            <a href="{{ route('tags', $tag->slug) }}"
                                class="badge bg-{{ $color }}-subtle text-{{ $color }} text-decoration-none p-2">
                                {{ $tag->name }}
                            </a>
                        @endforeach
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
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-heart-fill fs-5"></i>
                                <span>58</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-heartbreak-fill fs-5"></i>
                                <span>58</span>
                            </div>
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
