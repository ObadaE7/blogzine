<section class="main__section-two">
    <div class="section__title">
        <span class="section__title-text">
            <i class="title-two-icon"></i>
            {{ trans('Today\'s top highlights') }}
        </span>
        <span>{{ trans('Latest breaking news, pictures, videos, and special reports') }}</span>
    </div>

    <div class="section_two-content">
        @forelse ($postsSecTwo as $post)
            <div class="section__two-row">
                <div class="section__two-img">
                    <img src="{{ 'storage/' . $post->image }}" alt="{{ $post->slug }}">
                    <div class="card__img-overlay">
                        <div class="section__owner">
                            @if (empty($post->owner->image))
                                <div class="avatar__subtle">
                                    <span>{{ substr($post->owner->fname, 0, 1) . substr($post->owner->lname, 0, 1) }}</span>
                                </div>
                            @else
                                <img src="{{ $post->owner->image }}" class="avatar" alt="{{ trans('Avatar') }}">
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
                                    <div class="section__two-liked">
                                        <span class="total_likes">58</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="section__two-post-title">
                            <span>
                                <a href="{{ route('post', $post->slug) }}" class="text-underline-link rest-text-link">
                                    {{ $post->title }}
                                </a>
                            </span>
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

    <div class="section__two-paginate">
        {{ $postsSecTwo->links('components.pagination-links', data: ['scrollTo' => '.main__section-two']) }}
    </div>

    <div class="section__two-col-right">
        <div class="section__two-social">
            <div class="social__facebook-card card-img-flash">
                <a href="#">
                    <div class="social__text">
                        <i class="bi bi-facebook"></i><small>1.5K {{ trans('Fans') }}</small>
                    </div>
                </a>
            </div>

            <div class="social__instagram-card card-img-flash">
                <a href="#">
                    <div class="social__text">
                        <span><i class="bi bi-instagram"></i></span><small>1.8M {{ trans('Followers') }}</small>
                    </div>
                </a>
            </div>

            <div class="social__youtube-card card-img-flash">
                <a href="#">
                    <div class="social__text">
                        <span><i class="bi bi-youtube"></i></span><small>1.5K {{ trans('Subscribers') }}</small>
                    </div>
                </a>
            </div>
        </div>

        <div class="section__two-categories">
            <span class="section__two-categories-title">{{ trans('Categories') }}</span>
            @php
                $colorNames = ['warning', 'info', 'danger', 'primary', 'success'];
                $colorCount = count($colorNames);
            @endphp
            @foreach ($categoriesSecTwo as $index => $category)
                @php
                    $color = $colorNames[$index % $colorCount];
                @endphp
                <div class="badge-card-{{ $color }}">
                    <a href="#">
                        <div class="social__text">
                            <span>{{ $category->name }}</span>
                            <span class="badge bg-{{ $color }}">{{ $category->countPosts->count() }}</span>
                        </div>
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
