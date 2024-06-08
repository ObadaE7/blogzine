@section('breadcrumb')
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="{{ route('admin.table.tags') }}">{{ trans('Table') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>{{ trans('Tags') }}</a></li>
    </x-breadcrumb>
@endsection

<div class="table__wrapper">
    <div class="table__wrapper-header tags__table">
        <div class="tags__table-card">
            <div class="d-flex align-items-center justify-content-center w-25 h-100 text-bg-primary rounded-1">
                <i class="bi bi-tags-fill fs-3"></i>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <span class="fw-medium">{{ trans('Total Tag') }}</span>
                <span>{{ $rows->total() }} <small class="text-muted">({{ trans('active') }})</small></span>
            </div>
        </div>

        <div class="tags__table-card">
            <div class="d-flex align-items-center justify-content-center w-25 h-100 text-bg-success rounded-1">
                <i class="bi bi-award-fill fs-3"></i>
            </div>
            <div class="d-flex flex-column justify-content-center">
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

        <div class="tags__table-card">
            <div class="d-flex align-items-center justify-content-center w-25 h-100 text-bg-danger rounded-1">
                <i class="bi bi-trash3-fill fs-3"></i>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <span class="fw-medium">{{ trans('Deleted Tag') }}</span>
                <span>{{ $inTrashed }} <small class="text-muted">({{ trans('tags in the trash') }})</small></span>
            </div>
        </div>
    </div>
    <div class="table__wrapper-content">
        <x-alert status="success" color="success" />
        <x-alert status="error" color="danger" />

        <div class="table__content-filters">
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                + {{ trans('Create') }}
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        @foreach ($headers as $header)
                            <th scope="col">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>
                                <a href="{{ route('tags', $row->slug) }}"
                                    class="text-dark text-decoration-none underline__link-hover">
                                    {{ $row->name }}
                                </a>
                            </td>
                            <td>{{ $row->slug }}</td>
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
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section__paginate">
            {{ $rows->links('components.pagination-links') }}
        </div>

        <div class="modals">
            @include('admin.livewire.pages.modals.tags.modal-create')
            @include('admin.livewire.pages.modals.tags.modal-edit')
            @include('admin.livewire.pages.modals.tags.modal-delete')
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('closeModal', event => {
            $('#' + event.detail.modalId).modal('hide');
        });
    </script>
@endpush
