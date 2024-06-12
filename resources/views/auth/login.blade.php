@extends('livewire.layouts.home')
@section('title', trans('Login -'))
@section('content')
    <section class="main__auth">
        <div class="main__auth-form">
            <div class="auth__header">
                <span>{{ trans('string.Hello') }}</span>
                <span>{{ trans('string.Welcome back') }}</span>
            </div>
            <x-alert status="success" color="success" />
            <x-alert status="error" color="danger" />

            <form method="POST" action="{{ route($routePrefix . 'login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email">{{ trans('string.Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="{{ trans('string.Your email') }}">
                    <x-error name="email" />
                </div>

                <div class="mb-3">
                    <label for="password">{{ trans('string.Password') }}</label>
                    <div class="input-password">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="{{ trans('string.Your password') }}">
                        <span class="icon-password"></span>
                    </div>
                    <x-error name="password" />
                </div>

                <div class="mb-3 d-flex">
                    <input type="checkbox" name="remember" id="remember" class="form-check me-2">
                    <label for="remember" class="text-muted">{{ trans('string.Remember me') }}</label>
                    <small class="d-flex ms-auto">
                        <a wire:navigate href="{{ route('password.request') }}">{{ trans('string.Forget password') }}</a>
                    </small>
                    <x-error name="remember" />
                </div>

                <div class="auth__container">
                    <button type="submit" class="btn btn-primary w-100">{{ trans('string.Login') }}</button>
                    <div class="text-center">
                        <div class="divider"><span>{{ trans('string.OR') }}</span></div>
                        <div class="auth__social">
                            <a href="{{ route('auth.github') }}" class="auth__social-github" aria-label="facebook"></a>
                            <a href="#" class="auth__social-twitter" aria-label="twitter"></a>
                            <a href="#" class="auth__social-google" aria-label="google"></a>
                        </div>
                    </div>

                    <span class="auth__container-create">
                        <span>{{ trans('string.Do not have an account') }}</span>
                        <span><a wire:navigate href="{{ route('register') }}">{{ trans('string.Join us now') }}</a></span>
                    </span>
                </div>
            </form>
        </div>

        <div class="main__auth-illustration flash-animation">
            <img src="{{ asset('assets/img/illustration/sign_in.png') }}" alt="{{ trans('string.Illustration') }}">
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
