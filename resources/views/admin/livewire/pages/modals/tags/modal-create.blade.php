<x-modal>
    <x-slot:id>createModal</x-slot:id>
    <x-slot:title>{{ trans('Create a new tag') }}</x-slot:title>
    <x-slot:body>
        <form>
            <div class="mb-3">
                <label for="name">{{ trans('Name') }}</label>
                <input wire:model.live.debounce='name' type="text" id="name" class="form-control"
                    placeholder="{{ trans('Enter tag name') }}">
                <x-error name="name" />
            </div>

            <div class="mb-3">
                <label for="slug">{{ trans('Slug') }}</label>
                <input wire:model='slug' type="text" id="slug" class="form-control"
                    placeholder="{{ trans('Enter tag slug') }}">
                <x-error name="slug" />
            </div>

            <x-slot:button>
                <button wire:click="resetField" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ trans('Close') }}
                </button>
                <button wire:click.prevent='create' type="button" class="btn btn-primary">
                    <i class="bi bi-plus me-2"></i>{{ trans('Create') }}
                </button>
            </x-slot:button>
        </form>
    </x-slot:body>
</x-modal>
