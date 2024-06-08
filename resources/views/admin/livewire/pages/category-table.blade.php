@section('breadcrumb')
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="{{ route('admin.table.categories') }}">{{ trans('Table') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>{{ trans('Categories') }}</a></li>
    </x-breadcrumb>
@endsection

<div class="table__wrapper">
    <div class="table__wrapper-header"></div>
    <div class="table__wrapper-content">
        <x-alert status="success" color="success" />
        <x-alert status="error" color="danger" />

        <div class="table__content-filters">
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                + Create
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
                        @php
                            $colorNames = ['warning', 'info', 'danger', 'primary', 'success', 'dark', 'secondary'];
                            $colorIndex = array_rand($colorNames);
                            $color = $colorNames[$colorIndex];
                        @endphp
                        <tr>
                            @if (empty($row->image))
                                <td>
                                    <div class="avatar__subtle bg-{{ $color }}-subtle text-{{ $color }}">
                                        NULL
                                    </div>
                                </td>
                            @else
                                <td>
                                    <img src="{{ asset('storage/' . $row->image) }}" class="avatar"
                                        alt="{{ $row->slug }}">
                                </td>
                            @endif

                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->slug }}</td>

                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn__show btn-success" data-bs-toggle="modal"
                                        data-bs-target="#showModal"></button>
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
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section__paginate">
            {{ $rows->links('components.pagination-links') }}
        </div>

        <div class="modals">
            @include('admin.livewire.pages.modals.categories.modal-create')
            @include('admin.livewire.pages.modals.categories.modal-show')
            @include('admin.livewire.pages.modals.categories.modal-edit')
            @include('admin.livewire.pages.modals.categories.modal-delete')
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
