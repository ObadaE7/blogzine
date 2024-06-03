<section class="section__one">
    <div class="section__title">
        <span class="section__title-text">
            <i class="section__one-icon"></i>{{ trans('Fresh Off the Press') }}
        </span>
        <span>{{ trans('Bringing You the Hottest News and Articles.') }}</span>
    </div>

    <div class="section__one-container">
        @forelse ($posts as $post)
            <div class="section__one-content">
                <div class="section__one-img">
                    <img src="{{ 'storage/' . $post->image }}" alt="{{ $post->slug }}">
                    <div class="overlay-text">
                        <a wire:navigate href="{{ route('post', $post->slug) }}"
                            class="text-underline-link text-decoration-none">{{ trans('View Post') }}
                        </a>
                    </div>
                </div>

                <div class="section__one-details">
                    <div class="section__one-tag">
                        @foreach ($post->tags->take(1) as $tag)
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

                    <div class="section__one-title">
                        <a wire:navigate href="{{ route('post', $post->slug) }}" class="rest-text-link">
                            <span class="text-underline-link">{{ $post->title }}</span>
                        </a>
                    </div>

                    <div class="section__one-desc">
                        <span>
                            {!! str()->limit(
                                $post->content,
                                300,
                                '... <a wire:navigate href="' . route('post', $post->slug) . '">' . trans('Read More') . '</a>',
                            ) !!}
                        </span>
                    </div>

                    <div class="section__one-owner--container">
                        <div class="section__owner">
                            @if (empty($post->owner->image))
                                <div class="avatar__subtle">
                                    <span>{{ substr($post->owner->fname, 0, 1) . substr($post->owner->lname, 0, 1) }}</span>
                                </div>
                            @else
                                <img src="{{ $post->owner->image }}" class="avatar"
                                    alt="{{ $post->owner->uname . '-' . trans('avatar') }}">
                            @endif
                            <small class="text-muted">
                                {{ trans('By') . ' ' . $post->owner->fname . ' ' . $post->owner->lname }}
                                <i class="bi bi-dot"></i>
                                {{ $post->getDateForHuman() }}
                            </small>
                        </div>

                        <div class="section__reactions">
                            <div class="reaction__like"><span>58</span></div>
                            <div class="reaction__dislike"><span>30</span></div>
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
