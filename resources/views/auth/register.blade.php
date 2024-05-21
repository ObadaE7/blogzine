@extends('livewire.layouts.home')
@section('content')
    <div class="register">
        <main class="main">
            <div class="auth-content">
                <div class="illustration">
                    <img src="{{ asset('assets/img/sign_up.png') }}" alt="Sign up illustration">
                </div>

                <div class="content">
                    <span class="auth-header">{{ trans('Create account') }}</span>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row row-cols-md-2 row-cols-1 mt-2">
                            <div class="col mb-3">
                                <label for="fname">{{ trans('First name') }}</label>
                                <input type="text" name="fname" id="fname" class="form-control"
                                    placeholder="{{ trans('Enter your first name') }}">
                                <x-error name="fname"></x-error>
                            </div>

                            <div class="col mb-3">
                                <label for="lname">{{ trans('Last name') }}</label>
                                <input type="text" name="lname" id="lname" class="form-control"
                                    placeholder="{{ trans('Enter your last name') }}">
                                <x-error name="lname"></x-error>
                            </div>

                            <div class="col mb-3">
                                <label for="uname">{{ trans('User name') }}</label>
                                <input type="text" name="uname" id="uname" class="form-control"
                                    placeholder="{{ trans('Enter your username') }}">
                                <x-error name="uname"></x-error>
                            </div>

                            <div class="col mb-3">
                                <label for="email">{{ trans('Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="{{ trans('Enter your email') }}">
                                <x-error name="email"></x-error>
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
                                <x-error name="password"></x-error>
                            </div>

                            <div class="col">
                                <label for="password_confirmation">{{ trans('Confirm password') }}</label>
                                <div class="input-password">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" placeholder="{{ trans('Confirm your password') }}">
                                    <span class="icon-password"></span>
                                </div>
                                <x-error name="password_confirmation"></x-error>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary w-25">{{ trans('Register') }}</button>
                            <small class="text-center">
                                <span class="me-1">{{ trans('You have an account?') }}</span>
                                <a href="{{ route('login') }}">{{ trans('Login') }}</a>
                            </small>
                        </div>
                    </form>
                </div>
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
