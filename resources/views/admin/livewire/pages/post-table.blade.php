@section('breadcrumb')
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="{{ route('admin.table.posts') }}">{{ trans('Table') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>{{ trans('Posts') }}</a></li>
    </x-breadcrumb>
@endsection

<div class="table__wrapper">
    <div class="table__wrapper-header tags__table">
        <div class="tags__table-card">
            <div class="d-flex align-items-center justify-content-center w-25 h-100 text-bg-primary rounded-1">
                <i class="bi bi-stickies-fill fs-3"></i>
            </div>

            <div class="d-flex flex-column justify-content-center">
                <span class="fw-medium">{{ trans('Total Post') }}</span>
                <span>{{ $rows->total() }} <small class="text-muted">({{ trans('posts are active') }})</small></span>
            </div>
        </div>

        <div class="tags__table-card">
            <div class="d-flex align-items-center justify-content-center w-25 h-100 text-bg-danger rounded-1">
                <i class="bi bi-trash3-fill fs-3"></i>
            </div>

            <div class="d-flex flex-column justify-content-center">
                <span class="fw-medium">{{ trans('Deleted Post') }}</span>
                <span>{{ $inTrashed }} <small class="text-muted">({{ trans('posts in the trash') }})</small></span>
            </div>
        </div>

        <div class="tags__table-card">
            <div class="d-flex align-items-center justify-content-center w-25 h-100 text-bg-secondary rounded-1">
                <i class="bi bi-info-circle-fill fs-3"></i>
            </div>

            <div class="d-flex flex-column justify-content-center">
                <span class="fw-medium">{{ trans('Status Post') }}</span>
                <span>{{ $published }} <small
                        class="text-muted">({{ trans('posts are published') }})</small></span>
                <span>{{ $draft }} <small class="text-muted">({{ trans('posts are draft') }})</small></span>
            </div>
        </div>
    </div>

    <div class="table__wrapper-content">
        <x-alert status="success" color="success" />
        <x-alert status="error" color="danger" />

        <div class="table__content-filters pb-4">
            <div class="table__search input-group">
                <input wire:model.live='search' type="search" class="form-control"
                    placeholder="{{ trans('Search here ...') }}">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="bi bi-search"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach ($columns as $column)
                        <li>
                            <button wire:click.live="$set('searchBy', '{{ $column }}')"
                                class="dropdown-item {{ $searchBy == $column ? 'active' : '' }}">
                                {{ $column }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="table__options">
                <select wire:model.live='perPage' class="form-select w-25">
                    <option disabled>{{ trans('Per page') }}</option>
                    @foreach ($perPages as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle rounded-1" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">{{ trans('Options') }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        {{-- <li>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="bi bi-plus me-2"></i>{{ trans('Create') }}
                            </button>
                        </li> --}}
                        <li>
                            <button wire:click='$refresh' class="dropdown-item">
                                <i class="bi bi-arrow-clockwise me-2"></i>{{ trans('Refresh') }}
                            </button>
                        </li>
                        <li>
                            <button wire:click='resetFilters' class="dropdown-item">
                                <i class="bi bi-funnel me-2"></i>{{ trans('Reset') }}
                            </button>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item-text">
                                <small class="text-muted">{{ trans('Export') }}</small>
                            </div>
                        </li>
                        <li>
                            <button class="dropdown-item">
                                <i class="bi bi-filetype-pdf me-2"></i>{{ trans('Pdf') }}
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item">
                                <i class="bi bi-filetype-xlsx me-2"></i>{{ trans('Excel') }}
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item">
                                <i class="bi bi-filetype-csv me-2"></i>{{ trans('Csv') }}
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item">
                                <i class="bi bi-printer me-2"></i>{{ trans('Print') }}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        @foreach ($headers as $header)
                            <th scope="col"
                                @unless ($header === 'Actions' || $header === 'Image')
                                    wire:click="setOrderBy('{{ $header }}')" style="cursor: pointer;"
                                @endunless>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span>{{ ucfirst($header) }}</span>
                                    @unless ($header === 'Actions' || $header === 'Image')
                                        <i
                                            class="bi bi-chevron-{{ $orderBy === $header ? ($orderDir === 'asc' ? 'up' : 'down') : 'expand' }}"></i>
                                    @endunless
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rows as $row)
                        @php
                            $colorNames = ['warning', 'info', 'danger', 'primary', 'success', 'dark', 'secondary'];
                            $colorIndex = array_rand($colorNames);
                            $color = $colorNames[$colorIndex];
                        @endphp
                        <tr wire:key="{{ $row->id }}">
                            @if (empty($row->image))
                                <td>
                                    <div
                                        class="avatar__subtle bg-{{ $color }}-subtle text-{{ $color }}">
                                        NULL
                                    </div>
                                </td>
                            @else
                                <td>
                                    <img src="{{ asset('storage/' . $row->image) }}" class="avatar"
                                        alt="{{ $row->slug }}">
                                </td>
                            @endif

                            <td>
                                <div class="d-flex flex-column">
                                    <span> {{ $row->title }}</span>
                                    <span class="text-muted">{{ $row->subtitle }}</span>
                                </div>
                            </td>

                            <td>
                                @if ($row->status === 'published')
                                    <span class="badge bg-success-subtle text-success p-2">
                                        {{ strtoupper($row->status) }}
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger p-2">
                                        {{ strtoupper($row->status) }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn__show btn-success" data-bs-toggle="modal"
                                        data-bs-target="#showModal">
                                    </button>
                                    <button wire:click="$set('postId', {{ $row->id }})"
                                        class="btn btn-sm btn__delete btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($headers) }}" class="text-center">
                                {{ trans('No Result Found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section__paginate">
            {{ $rows->links('components.pagination-links') }}
        </div>

        <div class="modals">
            @include('admin.livewire.pages.modals.posts.modal-show')
            @include('admin.livewire.pages.modals.posts.modal-delete')
        </div>
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
