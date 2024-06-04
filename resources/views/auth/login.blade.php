@extends('livewire.layouts.home')
@section('title', 'Login -')
@section('content')
    <section class="main__auth">
        <span class="auth__header">{{ trans('Hello Again!') }}</span>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email">{{ trans('Email') }}</label>
                <input type="email" name="email" id="email" class="form-control"
                    placeholder="{{ trans('Your email') }}">
                <x-error name="email" />
            </div>

            <div class="mb-3">
                <label for="password">{{ trans('Password') }}</label>
                <div class="input-password">
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="{{ trans('Your password') }}">
                    <span class="icon-password"></span>
                </div>
                <x-error name="password" />
            </div>

            <div class="mb-3 d-flex">
                <input type="checkbox" id="remeber_me" class="form-check me-2">
                <label for="remeber_me" class="text-muted">{{ trans('Remember me') }}</label>
                <small class="d-flex ms-auto"><a wire:navigate href="#">{{ trans('Forget password?') }}</a></small>
                <x-error name="remeber_me" />
            </div>

            <div class="auth__container">
                <button type="submit" class="btn btn-primary w-100">{{ trans('Login') }}</button>
                <div class="mb-3 text-center">
                    <div class="divider"><span>{{ trans('OR') }}</span></div>
                    <div class="auth__social">
                        <a href="#" class="auth__social-facebook" aria-label="facebook"></a>
                        <a href="#" class="auth__social-twitter" aria-label="twitter"></a>
                        <a href="#" class="auth__social-google" aria-label="google"></a>
                    </div>
                </div>

                <span class="text-center">
                    <span class="me-1">{{ trans('Not registered?') }}</span>
                    <a wire:navigate href="{{ route('register') }}">{{ trans('Create account') }}</a>
                </span>
            </div>
        </form>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        togglePassword();
    </script>
@endpush
