@section('breadcrumb')
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="{{ route('admin.table.tags') }}">{{ trans('Table') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>{{ trans('Tags') }}</a></li>
    </x-breadcrumb>
@endsection

<div class="table__wrapper">
    <div class="table__wrapper-header table__tags">
        <div class="table__header-card">
            <div class="header__card-icon icon__one"></div>
            <div class="header__card-text">
                <span class="fw-medium">{{ trans('Total Tag') }}</span>
                <span>{{ $rows->total() }} <small class="text-muted">({{ trans('tags are active') }})</small></span>
            </div>
        </div>

        <div class="table__header-card">
            <div class="header__card-icon icon__two"></div>
            <div class="header__card-text">
                <span class="fw-medium">{{ trans('Top Tag') }}</span>
                @if ($topTagUsed)
                    <span>
                        <a href="{{ route('tags', $topTagUsed->slug) }}"
                            class="text-dark text-decoration-none underline__link-hover">
                            {{ $topTagUsed->name }}
                        </a>
                        <small class="text-muted">({{ $topTagUsed->posts_count }} {{ trans('posts used') }})</small>
                    </span>
                @else
                    <span>{{ trans('No tag was used') }}</span>
                @endif
            </div>
        </div>

        <div class="table__header-card">
            <div class="header__card-icon icon__three"></div>
            <div class="header__card-text">
                <span class="fw-medium">{{ trans('Deleted Tag') }}</span>
                <span>{{ $inTrashed }} <small class="text-muted">({{ trans('tags in the trash') }})</small></span>
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
                                @unless ($header === 'Actions')
                                    wire:click="setOrderBy('{{ $header }}')" style="cursor: pointer;"
                                @endunless>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span>{{ ucfirst($header) }}</span>
                                    @unless ($header === 'Actions')
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
                            <td>{{ $row->id }}</td>
                            <td>
                                <a wire:navigate href="{{ route('tags', $row->slug) }}"
                                    class="badge bg-{{ $color }}-subtle text-{{ $color }} text-decoration-none p-2">
                                    <i class="bi bi-circle-fill me-2"></i>
                                    <span class="underline__link-hover">{{ $row->name }}</span>
                                </a>
                            </td>
                            <td>{{ $row->slug }}</td>
                            <td>{{ $row->posts_count }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button wire:click="edit({{ $row->id }})"
                                        class="btn btn-sm btn__edit btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                    </button>
                                    <button wire:click="$set('tagId', {{ $row->id }})"
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
            @include('admin.livewire.pages.modals.tags.modal-create')
            @include('admin.livewire.pages.modals.tags.modal-edit')
            @include('admin.livewire.pages.modals.tags.modal-delete')
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
