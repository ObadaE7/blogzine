<div class="table__search input-group">
    <input wire:model.live='search' type="search" class="form-control" placeholder="{{ trans('Search here ...') }}">

    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-search"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <div class="dropdown-item-text">
                <span class="text-muted">{{ trans('Search by') }}</span>
            </div>
        </li>
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
            @if ($optCreate)
                <li>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus me-2"></i>{{ trans('Create') }}
                    </button>
                </li>
            @endif
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
