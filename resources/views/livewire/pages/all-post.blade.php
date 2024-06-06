@section('breadcrumb')
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.post.index') }}">{{ trans('Post') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>{{ trans('Show') }}</a></li>
    </x-breadcrumb>
@endsection

<section class="dashboard__posts-wrapper">
    <div class="section__filters">
        <div class="filter__header">
            <span>{{ trans('Filter Options') }}</span>
            <button wire:click='resetFilters' aria-label="{{ trans('Reset the fillters') }}">
                <i class="bi bi-eraser-fill text-danger"></i>
            </button>
        </div>

        <div class="filter__options">
            <div class="search__by">
                <div class="input-group mb-3">
                    <input wire:model.live='search' type="search" class="form-control"
                        placeholder="{{ trans('Search here') }}">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" aria-label="{{ trans('Search') }}">
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <div class="dropdown-item-text text-muted">{{ trans('Search by') }}</div>
                        </li>
                        @foreach ($this->columns() as $key => $value)
                            <li>
                                <span wire:click="$set('searchBy','{{ $value }}')"
                                    class="dropdown-item {{ $this->searchBy === $value ? 'active' : '' }}">
                                    {{ Str::ucfirst($value) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="order__by">
                <div class="input-group mb-3">
                    <select wire:model.live='orderBy' class="form-select form-select"
                        aria-label="{{ trans('orderBy') }}">
                        <option disabled>{{ trans('Order by') }}</option>
                        @foreach ($this->columns() as $key => $value)
                            <option value="{{ $value }}">{{ Str::ucfirst($value) }}</option>
                        @endforeach
                    </select>

                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" aria-label="{{ trans('Sort') }}">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <div class="dropdown-item-text text-muted">{{ trans('Direction') }}</div>
                        </li>
                        <li>
                            <span wire:click="$set('orderDir','asc')"
                                class="dropdown-item {{ $this->orderDir === 'asc' ? 'active' : '' }}">
                                {{ trans('ASC') }}
                            </span>
                        </li>
                        <li>
                            <span wire:click="$set('orderDir','desc')"
                                class="dropdown-item {{ $this->orderDir === 'desc' ? 'active' : '' }}">
                                {{ trans('DESC') }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="per__page">
                <div class="input-group mb-3">
                    <select wire:model.live='perPage' class="form-select form-select"
                        aria-label="{{ trans('Per page') }}">
                        <option disabled>{{ trans('Per page') }}</option>
                        @foreach ($this->perPage() as $key => $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="button" aria-label="{{ trans('Per page') }}"></button>
                </div>
            </div>
        </div>
    </div>

    <x-alert status="success" color="success" />
    <x-alert status="error" color="danger" />

    <div class="section__posts-container">
        @forelse ($posts as $post)
            <div class="section__posts">
                <div class="section__posts-img flash-animation">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}">
                </div>

                <div class="section__posts-info">
                    <div class="posts__badges-container">
                        <div class="posts__info-category">
                            <span class="badge bg-success-subtle text-success p-2">
                                @foreach ($post->categories as $category)
                                    {{ $category->name }}
                                @endforeach
                            </span>

                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" aria-label="{{ trans('Settings') }}">
                                    <i class="bi bi-gear-wide-connected"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <button wire:click="show('{{ $post->id }}')" type="button"
                                            class="dropdown-item show-btn" data-bs-toggle="modal"
                                            data-bs-target="#modalShow">{{ trans('Show') }}
                                        </button>
                                    </li>
                                    <li>
                                        <button wire:click="edit('{{ $post->id }}')" type="button"
                                            class="dropdown-item edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit">{{ trans('Edit') }}
                                        </button>
                                    </li>
                                    <li>
                                        <button wire:click="$set('postId', '{{ $post->id }}')" type="button"
                                            class="dropdown-item delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete">{{ trans('Delete') }}
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="posts__info-tags">
                            @foreach ($post->tags->shuffle()->take(2) as $tag)
                                <span class="badge bg-info-subtle text-info p-2">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="posts__info-title">
                        <span class="fw-bold">{{ $post->title }}</span>
                        <small class="text-muted">{{ $post->subtitle }}</small>
                    </div>

                    <div class="posts__info-date">
                        <span class="text-muted"> {{ $post->getDateForHuman() }}</span>
                        <div class="posts__info-reaction">
                            <div class="total__like"><span>58</span></div>
                            <div class="total__dislike"><span>30</span></div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <span>{{ trans('No Results Found') }}</span>
        @endforelse
    </div>

    <div class="section__paginate">
        {{ $posts->links('components.pagination-links', data: ['scrollTo' => '.filter__options']) }}
    </div>

    <div class="modals">
        @include('livewire.pages.modal.delete-post')
        @include('livewire.pages.modal.edit-post')
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('livewire:navigated', () => {
            Livewire.on('urlReset', url => {
                history.pushState(null, null, url);
            });
        });

        document.addEventListener('closeModal', event => {
            $('#' + event.detail.modalId).modal('hide');
        });
    </script>
@endpush
