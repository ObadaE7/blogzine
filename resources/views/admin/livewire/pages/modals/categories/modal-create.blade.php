<x-modal>
    <x-slot:id>createModal</x-slot:id>
    <x-slot:title>{{ trans('Create a new category') }}</x-slot:title>
    <x-slot:options>modal-lg</x-slot:options>
    <x-slot:body>
        <form>
            <div class="row mb-3">
                <div class="col-md-3 modal__edit-category">
                    <label for="image">
                        <i wire:loading.remove wire:target='image' class="bi bi-image-alt"></i>
                        <span wire:loading.remove wire:target='image'>
                            {{ trans('Click here') }}
                        </span>
                        <div wire:loading wire:target='image'>
                            <div class="loader"></div>
                        </div>
                        @if ($this->image && !$errors->has('image'))
                            <img src="{{ $this->image->temporaryURL() }}" alt="{{ trans('Temp image') }}">
                        @endif
                    </label>
                    <input wire:model='image' type="file" id="image" class="form-control"
                        accept="image/png, image/jpg, image/jpeg," hidden>
                    <x-error name="image" />
                </div>

                <div class="col-md-9">
                    <div class="mb-3">
                        <label for="name">{{ trans('Name') }}</label>
                        <input wire:model.live.debounce='name' type="text" id="name" class="form-control"
                            placeholder="{{ trans('Enter category name') }}">
                        <x-error name="name" />
                    </div>

                    <div class="mb-3">
                        <label for="slug">{{ trans('Slug') }}</label>
                        <input wire:model='slug' type="text" id="slug" class="form-control"
                            placeholder="{{ trans('Enter category slug') }}">
                        <x-error name="slug" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="description">{{ trans('Description') }}</label>
                    <textarea wire:model='description' id="description" class="form-control" rows="5"
                        placeholder="{{ trans('Enter your description') }}"></textarea>
                    <x-error name="description" />
                </div>
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
