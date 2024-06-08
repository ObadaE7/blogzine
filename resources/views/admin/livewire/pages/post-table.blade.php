@section('breadcrumb')
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="{{ route('admin.table.posts') }}">{{ trans('Table') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>{{ trans('Posts') }}</a></li>
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
            @include('admin.livewire.pages.modals.posts.modal-show')
            @include('admin.livewire.pages.modals.posts.modal-edit')
            @include('admin.livewire.pages.modals.posts.modal-delete')
        </div>
    </div>
</div>
