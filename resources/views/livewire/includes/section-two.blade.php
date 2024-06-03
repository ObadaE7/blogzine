<section class="section__two">
    <div class="section__title">
        <span class="section__title-text">
            <i class="section__two-icon"></i>{{ trans('Today\'s top highlights') }}
        </span>
        <span>{{ trans('Latest breaking news, pictures, videos, and special reports') }}</span>
    </div>

    <div class="section__two-container">
        @forelse ($postsSecTwo as $post)
            <div class="section__two-content">
                <div class="section__two-img">
                    <img src="{{ 'storage/' . $post->image }}" alt="{{ $post->slug }}">
                    <div class="card__img-overlay">
                        <div class="section__owner">
                            @if (empty($post->owner->image))
                                <div class="avatar__subtle">
                                    <span>{{ substr($post->owner->fname, 0, 1) . substr($post->owner->lname, 0, 1) }}</span>
                                </div>
                            @else
                                <img src="{{ $post->owner->image }}" class="avatar"
                                    alt="{{ $post->owner->uname . '-' . trans('avatar') }}">
                            @endif
                            <div class="owner__text">
                                <span>{{ $post->owner->fname . ' ' . $post->owner->lname }}</span>
                                <div class="post__date">
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="ms-auto">
                                @if ($post->created_at->isToday())
                                    <span class="badge fs-6 bg-danger">{{ trans('New') }}</span>
                                @else
                                    <div class="reaction__liked"><span class="total_likes">58</span></div>
                                @endif
                            </div>
                        </div>

                        <div class="section__two-title">
                            <a wire:navigate href="{{ route('post', $post->slug) }}" class="rest-text-link">
                                <span class="text-underline-link">{{ $post->title }}</span>
                            </a>
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

    <div class="section__paginate">
        {{ $postsSecTwo->links('components.pagination-links', data: ['scrollTo' => '.section__two']) }}
    </div>

    <div class="section__two-right-container">
        <div class="section__two-social">
            <div class="social__card bg-facebook flash-animation">
                <div class="facebook__link">
                    <a href="#"><span>1.5K {{ trans('Fans') }}</span></a>
                </div>
            </div>

            <div class="social__card bg-instagram flash-animation">
                <div class="instagram__link">
                    <a href="#"><span>1.8M {{ trans('Followers') }}</span></a>
                </div>
            </div>

            <div class="social__card bg-youtube flash-animation">
                <div class="youtube__link">
                    <a href="#"><span>1.5K {{ trans('Subscribers') }}</span></a>
                </div>
            </div>
        </div>

        <div class="section__two-categories">
            <span class="section__two-sub-title">{{ trans('Categories') }}</span>
            @php
                $colorNames = ['warning', 'info', 'danger', 'primary', 'success', 'dark', 'secondary'];
                $colorCount = count($colorNames);
            @endphp
            @foreach ($categoriesSecTwo as $index => $category)
                @php $color = $colorNames[$index % $colorCount]; @endphp
                <div class="badge-card bg-{{ $color }}-subtle">
                    <a wire:navigate href="{{ route('category', $category->slug) }}">
                        <span class="text-{{ $color }}">{{ Str::upper($category->name) }}</span>
                        <span class="badge bg-{{ $color }}">{{ $category->countPosts->count() }}</span>
                    </a>
                </div>
            @endforeach
        </div>

        <form method="POST" action="">
            @csrf
            <div class="section__two-subscribe">
                <span class="fs-5">{{ trans('Subscribe to our mailing list!') }}</span>
                <input type="email" class="form-control" placeholder="{{ trans('Email address') }}">
                <button type="submit" class="btn btn-primary w-75">{{ trans('Subscribe') }}</button>
            </div>
        </form>
    </div>
</section>
