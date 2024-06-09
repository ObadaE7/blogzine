<x-modal>
    <x-slot:id>deleteModal</x-slot:id>
    <x-slot:title>{{ trans('Delete user') }}</x-slot:title>
    <x-slot:body>{{ trans('Are you sure you want to delete this user?') }}</x-slot:body>
    <x-slot:button>
        <button wire:click="resetField" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            {{ trans('Close') }}
        </button>
        <button wire:click='delete({{ $userId }})' type="button" class="btn btn-danger">
            <i class="bi bi-trash3-fill me-2"></i>{{ trans('Delete') }}
        </button>
    </x-slot:button>
</x-modal>
