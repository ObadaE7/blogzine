<x-guest-layout>
    <div class="verify__wrapper">
        <div class="verify__content">
            <div class="verify__content-header">
                <img src="{{ asset('assets/img/logo/jeveline-icon.png') }}" alt="{{ trans('Website logo') }}">
                <span class="fs-4 fw-medium">{{ trans('Create A New Password') }}</span>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $request->email) }}" placeholder="Enter your email">
                </div>

                <div class="mb-3">
                    <label for="password">{{ trans('string.Password') }}</label>
                    <div class="input-password">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="{{ trans('string.Enter your password') }}">
                        <span class="icon-password"></span>
                    </div>
                    <x-error name="password" />
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">{{ trans('string.Confirm password') }}</label>
                    <div class="input-password">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" placeholder="{{ trans('string.Confirm your password') }}">
                        <span class="icon-password"></span>
                    </div>
                    <x-error name="password_confirmation" />
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">{{ trans('Reset Password') }}</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script>
            togglePassword();
        </script>
    @endpush
</x-guest-layout>
