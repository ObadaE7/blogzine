<form>
    <x-alert status="success" color="success" />
    <x-alert status="error" color="danger" />

    <section class="section__create-post">
        <div class="create__post-top">
            <div class="create__post-left">
                <label for="image">
                    <i wire:loading.remove wire:target='form.image' class="bi bi-image-alt"></i>
                    <span wire:loading.remove wire:target='form.image'>
                        {{ trans('Click here to upload an image') }}
                    </span>
                    <div wire:loading wire:target='form.image'>
                        <div class="loader"></div>
                    </div>
                    @if (!$errors->has('form.image') && $this->form->image)
                        <img wire:loading.remove src="{{ $this->form->image->temporaryURL() }}"
                            alt="{{ trans('Temp image') }}">
                    @endif
                </label>
                <input wire:model='form.image' type="file" id="image" class="form-control"
                    accept="image/png, image/jpg, image/jpeg," hidden>
                <x-error name="form.image" />
            </div>

            <div class="create__post-right">
                <div class="mb-3">
                    <label for="category_id">{{ trans('Category') }}</label>
                    <select wire:model='form.category_id' id="category_id" class="form-select">
                        <option value="" selected>{{ trans('Select category') }}</option>
                        @foreach ($this->form->categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
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

        <div class="create__post-bottom">
            <div class="mb-3">
                <label for="content">{{ trans('Content') }}</label>
                <livewire:quill />
                <x-error name="form.content" />
            </div>

            <div class="mb-3">
                <label for="status">{{ trans('Status') }}</label>
                <select wire:model='form.status' id="status" class="form-select" required>
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

            <button wire:click.prevent='create' type="button"
                class="d-flex ms-auto justify-content-center btn btn-primary w-25">
                {{ trans('Create') }}
            </button>
        </div>
    </section>
</form>
