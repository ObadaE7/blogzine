<section class="tag__wrapper">
    <div class="tag__header">
        <img src="{{ asset('assets/img/tag-pattern.jpg') }}" class="tag__header-img" alt="{{ trans('Posts banner') }}">
        <span class="tag__header-text">{{ trans('Posts tagged with') }} "{{ $tag->name }}"</span>
    </div>

    <div class="tag__content">
        @foreach ($posts as $post)
            <div class="tagged__post">
                <div class="tagged__post-img card-img-flash">
                    <img src="{{ asset('storage/' . $post->image) }}" class="tagged__post--img"
                        alt="{{ $post->slug }}">
                </div>

                <div class="tagged__post-content">
                    <span class="tagged__post-title">{{ $post->title }}</span>
                    <small class="tagged__post-subtitle">{{ $post->subtitle }}</small>
                    <div class="mt-4">
                        <a href="{{ route('post', $post->slug) }}" class="tagged__post-btn">
                            {{ trans('Read More') }}
                        </a>
                    </div>
                </div>

                <div class="tagged__post-tags">
                    @foreach ($post->tags as $tag)
                        @php
                            $colorNames = ['warning', 'info', 'danger', 'primary', 'success', 'dark', 'secondary'];
                            $colorIndex = array_rand($colorNames);
                            $color = $colorNames[$colorIndex];
                        @endphp
                        <a href="{{ route('tags', $tag->slug) }}"
                            class="badge bg-{{ $color }}-subtle text-{{ $color }} me-2 mb-2">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
