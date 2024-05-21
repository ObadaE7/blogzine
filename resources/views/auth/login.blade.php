@extends('livewire.layouts.home')
@section('content')
    <div class="auth">
        <main class="main">
            <div class="auth-content">
                <span class="auth-header">Hello Again!</span>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Your email">
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="password">Password</label>
                            <small><a href="#">Forget password?</a></small>
                        </div>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Your password">
                    </div>

                    <div class="mb-3 d-flex">
                        <input type="checkbox" id="remeber_me" class="form-check me-2" placeholder="Your password">
                        <label for="remeber_me" class="text-muted">Remember me</label>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                        <div class="mb-3 text-center">
                            <div class="divider"><span>OR</span></div>
                            <div class="d-flex justify-content-center gap-4 mt-3">
                                <i class="bi bi-facebook"></i>
                                <i class="bi bi-twitter-x"></i>
                                <i class="bi bi-google"></i>
                            </div>
                        </div>
                        <small class="text-center">Not registered?<a href="#">Create account</a></small>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection
