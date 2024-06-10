<x-modal>
    <x-slot:id>showModal</x-slot:id>
    <x-slot:options>modal-xl</x-slot:options>
    <x-slot:title>{{ trans('View user posts') }}</x-slot:title>
    <x-slot:body>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        @foreach ($postHeaders as $postHeader)
                            <th scope="col"
                                @unless ($postHeader === 'Actions' || $postHeader === 'Image')
                                    wire:click="setOrderBy('{{ $postHeader }}')" style="cursor: pointer;"
                                @endunless>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span>{{ ucfirst($postHeader) }}</span>
                                    @unless ($postHeader === 'Actions' || $postHeader === 'Image')
                                        <i class="bi bi-chevron-{{ $orderBy === $postHeader ? ($orderDir === 'asc' ? 'up' : 'down') : 'expand' }}"></i>
                                    @endunless
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($postRows as $postRow)
                        @php
                            $colorNames = ['warning', 'info', 'danger', 'primary', 'success', 'dark', 'secondary'];
                            $colorIndex = array_rand($colorNames);
                            $color = $colorNames[$colorIndex];
                        @endphp
                        <tr wire:key="{{ $postRow->id }}">
                            @if (empty($postRow->image))
                                <td>
                                    <div class="avatar__subtle bg-{{ $color }}-subtle text-{{ $color }}">
                                        {{ trans('NULL') }}
                                    </div>
                                </td>
                            @else
                                <td>
                                    <img src="{{ asset('storage/' . $postRow->image) }}" class="avatar"
                                        alt="{{ $postRow->slug }}">
                                </td>
                            @endif
                            <td>
                                <div class="d-flex flex-column">
                                    <span> {{ $postRow->title }}</span>
                                    <span class="text-muted">{{ $postRow->subtitle }}</span>
                                </div>
                            </td>
                            <td>
                                @if ($postRow->status === 'published')
                                    <span class="badge bg-success-subtle text-success p-2">
                                        {{ strtoupper($postRow->status) }}
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger p-2">
                                        {{ strtoupper($postRow->status) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button wire:click="show({{ $postRow->id }})"
                                        class="btn btn-sm btn__show btn-success" data-bs-toggle="modal"
                                        data-bs-target="#showModal">
                                    </button>
                                    <button wire:click="$set('postId', {{ $postRow->id }})"
                                        class="btn btn-sm btn__delete btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($postHeaders) }}" class="text-center">
                                {{ trans('No Result Found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="section__paginate">
            {{ $postRows->links('components.pagination-links') }}
        </div>
    </x-slot:body>
    <x-slot:button>
        <button wire:click="resetField" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            {{ trans('Close') }}
        </button>
    </x-slot:button>
</x-modal>

<div class="section__modals">
    <x-modal>
        <x-slot:id>deleteModal</x-slot:id>
        <x-slot:title>{{ trans('Delete post') }}</x-slot:title>
        <x-slot:body>{{ trans('Are you sure you want to delete this post?') }}</x-slot:body>
        <x-slot:button>
            <button wire:click="resetField" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                {{ trans('Close') }}
            </button>
            <button wire:click='deleteUserPost({{ $postId }})' type="button" class="btn btn-danger">
                <i class="bi bi-trash3-fill me-2"></i>{{ trans('Delete') }}
            </button>
        </x-slot:button>
    </x-modal>
</div>
