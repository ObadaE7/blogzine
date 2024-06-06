@section('breadcrumb')
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.profile') }}">{{ trans('Profile') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a>{{ trans('My profile') }}</a></li>
    </x-breadcrumb>
@endsection

<section class="profile__wrapper">
    <div class="profile__card">
        <div class="profile__header">
            <div class="profile__header-cover">
                <img src="{{ asset('assets/img/banner.png') }}" alt="">
                <div class="profile__header-avatar">
                    <img src="{{ asset('assets/img/avatar.jpg') }}" alt="">
                </div>
            </div>
        </div>

        <div class="profile__info">
            <span class="profile__info-name">{{ $fname . ' ' . $lname }}</span>
        </div>
    </div>

    <div class="profile__content">
        <div class="profile__content-information">
            <div class="d-flex justify-content-between">
                <span class="text-muted">{{ trans('INFORMATION') }}</span>
                <i class="bi bi-info-circle-fill text-info"></i>
            </div>

            <form>
                <div class="row mt-2">
                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="uname">{{ trans('Username') }}</label>
                            <x-success name="uname" />
                        </div>
                        <input wire:model.live.blur='uname' type="text" id="uname" class="form-control"
                            placeholder="{{ trans('Enter your user name') }}">
                        <x-error name="uname" />
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            <label for="fname">{{ trans('First name') }}</label>
                            <x-success name="fname" />
                        </div>
                        <input wire:model.live.blur='fname' type="text" id="fname" class="form-control"
                            placeholder="{{ trans('Enter your first name') }}">
                        <x-error name="fname" />
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between">
                            <label for="lname">{{ trans('Last name') }}</label>
                            <x-success name="lname" />
                        </div>
                        <input wire:model.live.blur='lname' type="text" id="lname" class="form-control"
                            placeholder="{{ trans('Enter your last name') }}">
                        <x-error name="lname" />
                    </div>
                </div>
            </form>
        </div>

        <div class="profile__content-about">
            <div class="d-flex justify-content-between">
                <span class="text-muted">{{ trans('ABOUT ME') }}</span>
                <i class="bi bi-info-circle-fill text-info"></i>
            </div>

            <form>
                <div class="row mt-2">
                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="bio">{{ trans('Bio') }}</label>
                            <x-success name="bio" />
                        </div>
                        <textarea wire:model.live.blur='bio' id="bio" class="form-control" rows="7"></textarea>
                        <x-error name="bio" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="phone">{{ trans('Phone') }}</label>
                            <x-success name="phone" />
                        </div>
                        <input wire:model.live.blur='phone' type="text" id="phone" class="form-control"
                            placeholder="{{ trans('Enter your phone number') }}">
                        <x-error name="phone" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="birthday">{{ trans('Birthday') }}</label>
                            <x-success name="birthday" />
                        </div>
                        <input wire:model.live.blur='birthday' type="date" id="birthday" class="form-control">
                        <x-error name="birthday" />
                    </div>
                </div>
            </form>
        </div>

        <div class="profile__content-email">
            <span class="text-muted">{{ trans('UPDATE EMAIL') }}</span>
            <form>
                <div class="row mt-2">
                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="email">{{ trans('E-mail') }}</label>
                            <x-success name="email" />
                        </div>
                        <input wire:model='email' type="text" id="email" class="form-control"
                            placeholder="{{ trans('Enter your email') }}">
                        <x-error name="email" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="current_password">{{ trans('Password') }}</label>
                        <div class="input-password">
                            <input wire:model='current_password' type="password" id="current_password"
                                class="form-control" placeholder="{{ trans('Enter your password') }}">
                            <span class="icon-password"></span>
                        </div>
                        <x-error name="current_password" />
                    </div>

                    <div class="d-flex justify-content-end">
                        <button wire:click.prevent='saveEmail' class="btn btn-primary w-25">Save</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="profile__content-password">
            <span class="text-muted">{{ trans('UPDATE PASSWORD') }}</span>
            <form>
                <div class="row mt-2">
                    <div class="col-md-12 mb-3">
                        <label for="current_password">{{ trans('Current password') }}</label>
                        <div class="input-password">
                            <input wire:model.live.blur='current_password' type="password" id="current_password"
                                class="form-control" placeholder="{{ trans('Enter your current password') }}">
                            <span class="icon-password"></span>
                        </div>
                        <x-error name="current_password" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="password">{{ trans('Password') }}</label>
                            <x-success name="password" />
                        </div>
                        <div class="input-password">
                            <input wire:model.live.blur='password' type="password" id="password"
                                class="form-control" placeholder="{{ trans('Enter your password') }}">
                            <span class="icon-password"></span>
                        </div>
                        <x-error name="password" />
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="password_confirmation">{{ trans('Confirm password') }}</label>
                        <div class="input-password">
                            <input wire:model.live.blur='password_confirmation' type="password"
                                id="password_confirmation" class="form-control"
                                placeholder="{{ trans('Confirm your password') }}">
                            <span class="icon-password"></span>
                        </div>
                        <x-error name="password_confirmation" />
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary w-25">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        togglePassword();
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
            Livewire.on('resetSuccessMessage', (field) => {
                setTimeout(() => {
                    @this.resetSuccessMessage(field);
                }, 3000);
            })
        });
    </script>
@endpush
