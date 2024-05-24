<form>
    <x-alert status="success" color="success" />
    <x-alert status="error" color="danger" />

    <div class="create-container">
        <div class="create-row-top">
            <div class="create-col-left">
                <label for="image" class="post-image position-relative">
                    <i wire:loading.remove wire:target='form.image' class="bi bi-image-alt"></i>
                    <span wire:loading.remove wire:target='form.image'>
                        {{ trans('Click here to upload an image') }}
                    </span>
                    <div wire:loading wire:target='form.image'>
                        <div class="loader"></div>
                    </div>
                    @if (!$errors->has('form.image') && $this->form->image)
                        <img wire:loading.remove class="position-absolute post-image p-1 border-0"
                            src="{{ $this->form->image->temporaryURL() }}" alt="{{ trans('Temp image') }}">
                    @endif
                </label>
                <input wire:model='form.image' type="file" id="image" class="form-control"
                    accept="image/png, image/jpg, image/jpeg," hidden>
                <x-error name="form.image" />
            </div>

            <div class="create-col-right">
                <div class="mb-3">
                    <label for="category_id">{{ trans('Category') }}</label>
                    <div wire:ignore>
                        <select wire:model='form.category_id' id="category_id" class="form-select"
                            data-placeholder="{{ trans('Select category') }}">
                            <option></option>
                            @foreach ($this->form->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-error name="form.category_id" />
                </div>

                <div class="mb-3">
                    <label for="title">{{ trans('Title') }}</label>
                    <input wire:model.blur='form.title' type="text" id="title" class="form-control"
                        placeholder="{{ trans('Enter the post title') }}">
                    <x-error name="form.title" />
                </div>

                <div class="mb-3">
                    <label for="subtitle">{{ trans('Subtitle') }}</label>
                    <input wire:model='form.subtitle' type="text" id="subtitle" class="form-control"
                        placeholder="{{ trans('Enter the post subtitle') }}">
                    <x-error name="form.subtitle" />
                </div>

                <div class="mb-3">
                    <label for="slug">{{ trans('Slug') }}</label>
                    <input wire:model='form.slug' type="text" id="slug" class="form-control"
                        placeholder="{{ trans('Enter the post slug') }}">
                    <x-error name="form.slug" />
                </div>
            </div>
        </div>

        <div class="create-row-bottom mt-3">
            <div class="mb-3">
                <label for="content">{{ trans('Content') }}</label>
                <livewire:quill />
                <x-error name="form.content" />
            </div>

            <div class="mb-3">
                <label for="status">{{ trans('Status') }}</label>
                <div wire:ignore>
                    <select wire:model='form.status' id="status" class="form-select"
                        data-placeholder="{{ trans('Select status') }}">
                        <option></option>
                        @foreach ($this->form->statuses as $key => $value)
                            <option value="{{ $value }}" {{ $loop->first ? 'selected' : '' }}>
                                {{ Str::ucfirst($value) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-error name="form.status" />
            </div>

            <div class="mb-3">
                <label for="tag_ids">{{ trans('Tags') }}</label>
                <div wire:ignore>
                    <select wire:model='form.tag_ids' id="tag_ids" class="form-select"
                        data-placeholder="{{ trans('Select or add tags as you need') }}" multiple>
                        @foreach ($this->form->tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-error name="form.tag_ids" />
            </div>

            <button wire:click.prevent='create' type="button"
                class="d-flex ms-auto justify-content-center btn btn-primary w-25">
                {{ trans('Save') }}
            </button>
        </div>
    </div>
</form>

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/lib/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/select2/select2-bootstrap-5-theme.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/lib/select2/select2.js') }}"></script>
    <script>
        $(document).ready(() => {
            $('#category_id').select2({
                theme: 'bootstrap-5',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            }).on('select2:select', e => {
                @this.set('form.category_id', $(this).val());
            });

            $('#category_id').select2('focus');


            $('#tag_ids').select2({
                theme: 'bootstrap-5',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
            }).on('select2:select', e => {
                @this.set('form.tag_ids', $(this).val());
            });


            $('#status').select2({
                theme: 'bootstrap-5',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            }).on('select2:select', e => {
                @this.set('form.status', $(this).val());
            });
        });

        document.addEventListener('livewire:navigated', () => {
            Livewire.on('reset-select2', () => {
                $('#category_id').val(null).trigger('change');
                $('#tag_ids').val(null).trigger('change');
                $('#status').val(null).trigger('change');
            });
        });
    </script>
@endpush
