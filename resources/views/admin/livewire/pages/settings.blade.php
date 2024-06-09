@section('breadcrumb')
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="{{ route('admin.settings') }}">{{ trans('Settings') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>{{ trans('Site settings') }}</a></li>
    </x-breadcrumb>
@endsection

<section class="settings__wrapper">
    <div class="settings__general">
        <span class="text-muted"><i class="bi bi-x-diamond-fill me-2"></i>General settings</span>
        <form>
            <div class="mb-3 mt-3">
                <label for="site_name">Site name</label>
                <input type="text" id="site_name" class="form-control"
                    placeholder="{{ trans('Enter the site name') }}">
            </div>
            <div class="mb-3">
                <label for="site_description">Site description</label>
                <textarea name="" id="site_description" cols="30" rows="5" class="form-control"
                    placeholder="{{ trans('Enter the site description') }}"></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary w-25">Save</button>
            </div>
        </form>
    </div>

    <div class="settings__logo">
        <span class="text-muted"><i class="bi bi-transparency me-2"></i>Logo settings</span>
        <form>
            <div class="mb-3 mt-3">
                <label for="site_name">Site logo light</label>
                <input type="file" id="site_name" class="form-control"
                    placeholder="{{ trans('Enter the site name') }}">
            </div>
            <div class="mb-3 mt-3">
                <label for="site_name">Site logo dark</label>
                <input type="file" id="site_name" class="form-control"
                    placeholder="{{ trans('Enter the site name') }}">
            </div>
            <div class="mb-3 mt-3">
                <label for="site_name">Site icon</label>
                <input type="file" id="site_name" class="form-control"
                    placeholder="{{ trans('Enter the site name') }}">
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary w-25">Save</button>
            </div>
        </form>

    </div>

    <div class="settings__links">
        <span class="text-muted"><i class="bi bi-link-45deg me-2"></i>Links settings</span>
        <form>
            <div class="mb-3 mt-3">
                <label for="facebook">Facebook</label>
                <input type="url" id="facebook" class="form-control"
                    placeholder="{{ trans('Enter the facebook url') }}">
            </div>

            <div class="mb-3 mt-3">
                <label for="instagram">Instagram</label>
                <input type="url" id="instagram" class="form-control"
                    placeholder="{{ trans('Enter the instagram url') }}">
            </div>

            <div class="mb-3 mt-3">
                <label for="youtube">Youtube</label>
                <input type="url" id="youtube" class="form-control"
                    placeholder="{{ trans('Enter the youtube url') }}">
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary w-25">Save</button>
            </div>
        </form>
    </div>
</section>
