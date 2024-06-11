@extends('livewire.layouts.home')
@section('title', 'Register -')
@section('content')
    <section class="main__auth register">
        <div class="main__auth-form">
            <div class="auth__header">
                <span>{{ trans('string.Create account') }}</span>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row row-cols-md-2 row-cols-1">
                    <div class="col mb-3">
                        <label for="fname">{{ trans('string.First name') }}</label>
                        <input type="text" name="fname" id="fname" class="form-control" value="{{ old('fname') }}"
                            placeholder="{{ trans('string.Enter your first name') }}">
                        <x-error name="fname" />
                    </div>

                    <div class="col mb-3">
                        <label for="lname">{{ trans('string.Last name') }}</label>
                        <input type="text" name="lname" id="lname" class="form-control" value="{{ old('lname') }}"
                            placeholder="{{ trans('string.Enter your last name') }}">
                        <x-error name="lname" />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="uname">{{ trans('string.User name') }}</label>
                    <input type="text" name="uname" id="uname" class="form-control" value="{{ old('uname') }}"
                        placeholder="{{ trans('string.Enter your username') }}">
                    <x-error name="uname" />
                </div>

                <div class="mb-3">
                    <label for="email">{{ trans('string.Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                        placeholder="{{ trans('string.Enter your email') }}">
                    <x-error name="email" />
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
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                            placeholder="{{ trans('string.Confirm your password') }}">
                        <span class="icon-password"></span>
                    </div>
                    <x-error name="password_confirmation" />
                </div>

                <div class="auth__container">
                    <button type="submit" class="btn btn-primary w-25">{{ trans('string.Register') }}</button>
                    <span class="text-center">
                        <span class="me-1">{{ trans('string.You have an account') }}</span>
                        <a wire:navigate href="{{ route('login') }}">{{ trans('string.Login') }}</a>
                    </span>
                </div>
            </form>
        </div>

        <div class="main__auth-illustration flash-animation">
            <img src="{{ asset('assets/img/illustration/sign_in.png') }}" alt="{{ trans('string.string.Illustration') }}">
            <div class="auth__illustration-text">
                <a href="{{ route('home') }}">{{ config('app.name') }}</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        togglePassword();
    </script>
@endpush
