@extends('livewire.layouts.home')
@section('title', 'Login -')
@section('content')
    <div class="main__auth">
        <main class="main__wrapper">
            <div class="auth__content">
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
                        <small class="d-flex ms-auto"><a href="#">{{ trans('Forget password?') }}</a></small>
                        <x-error name="remeber_me" />
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-primary w-100">{{ trans('Login') }}</button>
                        <div class="mb-3 text-center">
                            <div class="divider"><span>{{ trans('OR') }}</span></div>
                            <div class="d-flex justify-content-center gap-4 mt-3">
                                <a href="#" aria-label="facebook" class="auth__social-facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="#" aria-label="twitter" class="auth__social-twitter">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                                <a href="#" aria-label="google" class="auth__social-google">
                                    <i class="bi bi-google"></i>
                                </a>
                            </div>
                        </div>

                        <small class="text-center">
                            <span class="me-1">{{ trans('Not registered?') }}</span>
                            <a href="{{ route('register') }}">{{ trans('Create account') }}</a>
                        </small>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        togglePassword();
    </script>
@endpush
