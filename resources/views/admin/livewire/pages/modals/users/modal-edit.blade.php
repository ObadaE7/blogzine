<x-modal>
    <x-slot:id>editModal</x-slot:id>
    <x-slot:title>{{ trans('Edit user') }}</x-slot:title>
    <x-slot:options>modal-lg</x-slot:options>
    <x-slot:body>
        <form>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fname">{{ trans('First name') }}</label>
                    <input wire:model='fname' type="text" id="fname" class="form-control"
                        placeholder="{{ trans('Enter your first name') }}">
                    <x-error name="fname" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="lname">{{ trans('Last name') }}</label>
                    <input wire:model='lname' type="text" id="lname" class="form-control"
                        placeholder="{{ trans('Enter your last name') }}">
                    <x-error name="lname" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="uname">{{ trans('Username') }}</label>
                    <input wire:model='uname' type="text" id="uname" class="form-control"
                        placeholder="{{ trans('Enter your username') }}">
                    <x-error name="uname" />
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email">{{ trans('Email') }}</label>
                    <input wire:model='email' type="email" id="email" class="form-control"
                        placeholder="{{ trans('Enter your email') }}">
                    <x-error name="email" />
                </div>

                <div class="col-md-6 mb-3">
                    <div class="d-flex justify-content-between">
                        <label for="phone">{{ trans('Phone') }}</label>
                        <small class="text-muted">({{ trans('Optional') }})</small>
                    </div>
                    <input wire:model='phone' type="text" id="phone" class="form-control"
                        placeholder="{{ trans('Enter your phone') }}">
                    <x-error name="phone" />
                </div>

                <div class="col-md-6 mb-3">
                    <div class="d-flex justify-content-between">
                        <label for="birthday">{{ trans('Birthday') }}</label>
                        <small class="text-muted">({{ trans('Optional') }})</small>
                    </div>
                    <input wire:model='birthday' type="date" id="birthday" class="form-control">
                    <x-error name="birthday" />
                </div>
            </div>
            <x-slot:button>
                <button wire:click="resetField" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ trans('Close') }}
                </button>
                <button wire:click.prevent='update({{ $userId }})' type="button" class="btn btn-primary">
                    <i class="bi bi-pencil-square me-2"></i>{{ trans('Update') }}
                </button>
            </x-slot:button>
        </form>
    </x-slot:body>
</x-modal>
