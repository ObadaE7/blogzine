<x-guest-layout>
    <div class="verify__wrapper">
        <div class="verify__content">
            <div class="verify__content-header">
                <img src="{{ asset('assets/img/logo/jeveline-icon.png') }}" alt="{{ trans('Website logo') }}">
                <span class="fs-4 fw-medium">{{ trans('Verify Your E-mail') }}</span>
            </div>

            <div class="verify__content-body">
                @if (session('status') == 'verification-link-sent')
                    <div class="verify__resent-msg">
                        {{ trans('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @else
                    <div class="verify__info-msg">
                        {{ trans('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>
                @endif
            </div>

            <div class="verify__content-forms">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <span>{{ trans('Did\'t receive an email?') }}</span>
                    <button type="submit" class="verify__btn-resend">{{ trans('Resend') }}</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="verify__btn-skip">{{ trans('Skip for now') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
