@section('breadcrumb')
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="{{ route('admin.table.tags') }}">{{ trans('Table') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>{{ trans('Tags') }}</a></li>
    </x-breadcrumb>
@endsection

<div class="table__wrapper">
    <div class="table__wrapper-header"></div>
    <div class="table__wrapper-content">
        <div class="table__content-filters"></div>

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
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->slug }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn__show btn-success" data-bs-toggle="modal"
                                        data-bs-target="#showModal"></button>
                                    <button class="btn btn-sm btn__edit btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal"></button>
                                    <button class="btn btn-sm btn__delete btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"></button>
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
            @include('admin.livewire.pages.modals.tags.modal-show')
            @include('admin.livewire.pages.modals.tags.modal-edit')
            @include('admin.livewire.pages.modals.tags.modal-delete')
        </div>
    </div>
</div>
