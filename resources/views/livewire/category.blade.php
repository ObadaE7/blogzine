<div class="container my-5">
    @if ($category)
        <h1 class="mb-4 text-center">Posts in category "{{ $category->name }}"</h1>
        <div class="row">
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-banner" style="background-image: url('{{ $post->banner_url }}');"></div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 100, '...') }}</p>
                                <a href="" class="btn btn-primary">Read More</a>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <div class="d-flex flex-wrap">
                                    @foreach($post->tags as $postTag)
                                        <a href="{{ route('tags', $postTag->slug) }}" class="badge bg-primary text-white me-2 mb-2">
                                            {{ $postTag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert">
                        No posts found in this category.
                    </div>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center">
            {{-- {{ $posts->links() }} --}}
        </div>
    @else
        <div class="alert alert-danger text-center" role="alert">
            Category not found.
        </div>
    @endif
</div>
