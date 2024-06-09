@section('breadcrumb')
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="{{ route('admin.table.categories') }}">{{ trans('Table') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>{{ trans('Categories') }}</a></li>
    </x-breadcrumb>
@endsection

<div class="table__wrapper">
    <div class="table__wrapper-header table__categories">
        <div class="table__header-card">
            <div class="header__card-icon icon__one"></div>
            <div class="header__card-text">
                <span class="fw-medium">{{ trans('Total Category') }}</span>
                <span>
                    {{ $rows->total() }}
                    <small class="text-muted">({{ trans('categories are active') }})</small>
                </span>
            </div>
        </div>

        <div class="table__header-card">
            <div class="header__card-icon icon__two"></div>
            <div class="header__card-text">
                <span class="fw-medium">{{ trans('Top Category') }}</span>
                @if ($topCategoryUsed)
                    <span>
                        <a href="{{ route('category', $topCategoryUsed->slug) }}"
                            class="text-dark text-decoration-none underline__link-hover">
                            {{ $topCategoryUsed->name }}
                        </a>
                        <small class="text-muted">
                            ({{ $topCategoryUsed->posts_count }} {{ trans('posts used') }})
                        </small>
                    </span>
                @else
                    <span>{{ trans('No category was used') }}</span>
                @endif
            </div>
        </div>

        <div class="table__header-card">
            <div class="header__card-icon icon__three"></div>
            <div class="header__card-text">
                <span class="fw-medium">{{ trans('Deleted Category') }}</span>
                <span>
                    {{ $inTrashed }}
                    <small class="text-muted">({{ trans('categories in the trash') }})</small>
                </span>
            </div>
        </div>
    </div>

    <div class="table__wrapper-content">
        <x-alert status="success" color="success" />
        <x-alert status="error" color="danger" />

        <div class="table__content-filters">
            <x-table-filter :columns="$this->columns" :searchBy="$this->searchBy" :perPages="$this->perPages" optCreate="true" />
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
                                        <i class="bi bi-chevron-{{ $orderBy === $header ? ($orderDir === 'asc' ? 'up' : 'down') : 'expand' }}"></i>
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
                                        {{ trans('NULL') }}
                                    </div>
                                </td>
                            @else
                                <td>
                                    <img src="{{ asset('storage/' . $row->image) }}" class="avatar"
                                        alt="{{ $row->slug }}">
                                </td>
                            @endif
                            <td>{{ $row->id }}</td>
                            <td>
                                <a wire:navigate href="{{ route('category', $row->slug) }}"
                                    class="badge bg-{{ $color }}-subtle text-{{ $color }} text-decoration-none p-2">
                                    <i class="bi bi-circle-fill me-2"></i>
                                    <span class="underline__link-hover">{{ $row->name }}</span>
                                </a>
                            </td>
                            <td>{{ $row->slug }}</td>
                            <td>{{ $row->posts_count }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button wire:click="show({{ $row->id }})"
                                        class="btn btn-sm btn__show btn-success" data-bs-toggle="modal"
                                        data-bs-target="#showModal">
                                    </button>
                                    <button wire:click="edit({{ $row->id }})"
                                        class="btn btn-sm btn__edit btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                    </button>
                                    <button wire:click="$set('categoryId', {{ $row->id }})"
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

        <div class="section__modals">
            @include('admin.livewire.pages.modals.categories.modal-create')
            @include('admin.livewire.pages.modals.categories.modal-show')
            @include('admin.livewire.pages.modals.categories.modal-edit')
            @include('admin.livewire.pages.modals.categories.modal-delete')
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
