<x-guest-layout>
    <div class="verify__wrapper">
        <div class="verify__content">
            <div class="verify__content-header">
                <img src="{{ asset('assets/img/logo/jeveline-icon.png') }}" alt="{{ trans('Website logo') }}">
                <span class="fs-4 fw-medium">{{ trans('Forget Password?') }}</span>
            </div>

            <div class="verify__content-body">
                @if (session('status'))
                    <div class="verify__resent-msg">
                        {{ trans('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @else
                    <div class="verify__info-msg">
                        {{ trans('No problem, Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>
                @endif
            </div>

            <div class="verify__content-formss">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email') }}" placeholder="Enter your email">
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('login') }}" class="btn btn-secondary">{{ trans('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ trans('Reset Link') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
