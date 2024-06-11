@extends('livewire.layouts.home')
@section('title', 'Register -')
@section('content')
    <section class="main__auth register">
        <div class="auth__illustration">
            <img src="{{ asset('assets/img/sign_up.png') }}" alt="{{ trans('Sign up illustration') }}">
        </div>

        <div class="auth__content">
            <span class="auth__header">{{ trans('Create account') }}</span>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row row-cols-md-2 row-cols-1 mt-2">
                    <div class="col mb-3">
                        <label for="fname">{{ trans('First name') }}</label>
                        <input type="text" name="fname" id="fname" class="form-control" value="{{ old('fname') }}"
                            placeholder="{{ trans('Enter your first name') }}">
                        <x-error name="fname" />
                    </div>

                    <div class="col mb-3">
                        <label for="lname">{{ trans('Last name') }}</label>
                        <input type="text" name="lname" id="lname" class="form-control" value="{{ old('lname') }}"
                            placeholder="{{ trans('Enter your last name') }}">
                        <x-error name="lname" />
                    </div>

                    <div class="col mb-3">
                        <label for="uname">{{ trans('User name') }}</label>
                        <input type="text" name="uname" id="uname" class="form-control"
                            value="{{ old('uname') }}" placeholder="{{ trans('Enter your username') }}">
                        <x-error name="uname" />
                    </div>

                    <div class="col mb-3">
                        <label for="email">{{ trans('Email') }}</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email') }}" placeholder="{{ trans('Enter your email') }}">
                        <x-error name="email" />
                    </div>
                </div>

                <div class="row row-cols-1 mb-3">
                    <div class="col mb-3">
                        <label for="password">{{ trans('Password') }}</label>
                        <div class="input-password">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="{{ trans('Enter your password') }}">
                            <span class="icon-password"></span>
                        </div>
                        <x-error name="password" />
                    </div>

                    <div class="col">
                        <label for="password_confirmation">{{ trans('Confirm password') }}</label>
                        <div class="input-password">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="{{ trans('Confirm your password') }}">
                            <span class="icon-password"></span>
                        </div>
                        <x-error name="password_confirmation" />
                    </div>
                </div>

                <div class="auth__container">
                    <button type="submit" class="btn btn-primary w-25">{{ trans('Register') }}</button>
                    <span class="text-center">
                        <span class="me-1">{{ trans('You have an account?') }}</span>
                        <a wire:navigate href="{{ route('login') }}">{{ trans('Login') }}</a>
                    </span>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        togglePassword();
    </script>
@endpush
