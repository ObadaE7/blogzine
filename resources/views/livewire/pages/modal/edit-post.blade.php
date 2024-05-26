<x-modal>
    <x-slot:id>modalEdit</x-slot:id>
    <x-slot:options>modal-xl</x-slot:options>
    <x-slot:title>{{ trans('Edit the post') }}</x-slot:title>
    <x-slot:body>
        <form>
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
                            @elseif (isset($this->existingImage))
                                <img wire:loading.remove class="position-absolute post-image p-1 border-0"
                                    src="{{ asset('storage/' . $this->existingImage) }}" alt="Post image">
                            @endif
                        </label>

                        <input wire:model='form.image' type="file" id="image" class="form-control"
                            accept="image/png, image/jpg, image/jpeg," hidden>
                        <x-error name="form.image" />
                    </div>

                    <div class="create-col-right">
                        <div class="mb-3">
                            <label for="category_id">{{ trans('Category') }}</label>
                            <select wire:model='form.category_id' id="category_id" class="form-select">
                                <option value="" selected>{{ trans('Select category') }}</option>
                                @foreach ($this->form->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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
                        <select wire:model='form.status' id="status" class="form-select">
                            <option value="" selected>{{ trans('Select status') }}</option>
                            @foreach ($this->form->statuses as $key => $value)
                                <option value="{{ $value }}">{{ Str::ucfirst($value) }}</option>
                            @endforeach
                        </select>
                        <x-error name="form.status" />
                    </div>

                    <div class="mb-3">
                        <label for="tag_ids">{{ trans('Tags') }}</label>
                        <select wire:model='form.tag_ids' id="tag_ids" class="form-select" multiple>
                            <option disabled>{{ trans('Select tags') }}</option>
                            @foreach ($this->form->tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        <x-error name="form.tag_ids" />
                    </div>
                </div>
            </div>
        </form>
    </x-slot:body>
    <x-slot:button>
        <button wire:click='update({{ $postId }})' type="button" class="btn btn-primary">
            <i class="bi bi-floppy2-fill me-2"></i>{{ trans('Update') }}
        </button>
    </x-slot:button>
</x-modal>
