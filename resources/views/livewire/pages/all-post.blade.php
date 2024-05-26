<div class="all-post-container">
    <div class="row-filters">
        <div class="filter-header d-flex justify-content-between align-items-center">
            <div class="filter-head">
                <i class="bi bi-funnel-fill me-2"></i>{{ trans('Filter Options') }}
            </div>
            <div class="reset-filters">
                <button wire:click='resetFilters' class="btn btn-sm btn-primary"
                    aria-label="{{ trans('Reset the fillters') }}">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
        </div>

        <div class="filter-options">
            <div class="search-by">
                <div class="input-group mb-3">
                    <input wire:model.live='search' type="search" class="form-control"
                        placeholder="{{ trans('Search here') }}">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" aria-label="{{ trans('Search') }}"><i class="bi bi-search"></i>
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

            <div class="order-by">
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
                        <i class="bi bi-sort-alpha-down"></i>
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

            <div class="per-page">
                <div class="input-group mb-3">
                    <select wire:model.live='perPage' class="form-select form-select"
                        aria-label="{{ trans('Per page') }}">
                        <option disabled>{{ trans('Per page') }}</option>
                        @foreach ($this->perPage() as $key => $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="button" aria-label="{{ trans('Per page') }}">
                        <i class="bi bi-list-ol"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row-posts">
        <div class="d-flex justify-content-between border-bottom mb-3">
            <span>{{ trans('MY POSTS') }}</span>
            <div class="d-flex align-items-center">
                <span>{{ trans('Total posts') }}</span>
                <span class="badge bg-info-subtle text-info ms-2">{{ $posts->total() }}</span>
            </div>
        </div>

        <x-alert status="success" color="success" />
        <x-alert status="error" color="danger" />

        @forelse ($posts as $post)
            <div class="row-post">
                <div class="post-image">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}">
                </div>

                <div class="post-info">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex gap-2">
                            <div class="category">
                                <span class="badge bg-success-subtle text-success">
                                    <i class="bi bi-folder-fill"></i>
                                    @foreach ($post->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </span>
                            </div>
                            <div class="tags">
                                @foreach ($post->tags->shuffle()->take(2) as $tag)
                                    <span class="badge bg-info-subtle text-info">
                                        <i class="bi bi-tags-fill"></i>
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-label="{{ trans('Settings') }}">
                                <i class="bi bi-gear-wide-connected"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button wire:click="show('{{ $post->id }}')" type="button"
                                        class="dropdown-item text-success" data-bs-toggle="modal"
                                        data-bs-target="#modalShow">
                                        <i class="bi bi-eye-fill me-2"></i>{{ trans('Show') }}
                                    </button>
                                </li>
                                <li>
                                    <button wire:click="edit('{{ $post->id }}')" type="button"
                                        class="dropdown-item text-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit">
                                        <i class="bi bi-pencil-square me-2"></i>{{ trans('Edit') }}
                                    </button>
                                </li>
                                <li>
                                    <button wire:click="$set('postId', '{{ $post->id }}')" type="button"
                                        class="dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete">
                                        <i class="bi bi-trash3-fill me-2"></i>{{ trans('Delete') }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <span class="fw-bold">{{ $post->title }}</span>
                    <span>{!! Str::limit($post->content, 200, '...') !!}</span>
                    <div class="post-date">
                        <span> {{ trans('At') . ' ' . $post->created_at->format('M d, Y') }}</span>
                        <div class="reactions">
                            120 <i class="bi bi-hand-thumbs-up-fill text-primary me-4"></i>
                            56 <i class="bi bi-hand-thumbs-down-fill text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @empty
            <div class="d-flex justify-content-center text-muted">
                <i class="bi bi-emoji-frown-fill me-2"></i>{{ trans('No result found!') }}
            </div>
        @endforelse
    </div>

    <div class="paginations">
        {{ $posts->links() }}
    </div>

    <div class="modals">
        @include('livewire.pages.modal.delete-post')
        @include('livewire.pages.modal.edit-post')
    </div>
</div>

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
