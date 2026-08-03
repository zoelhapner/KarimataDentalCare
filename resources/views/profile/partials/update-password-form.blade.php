<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class="relative">
                <x-text-input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="mt-1 block w-full pr-10"
                    autocomplete="current-password"
                />

                <button
                    type="button"
                    id="toggleCurrentPassword"
                    title="Tampilkan Password"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                    <i id="currentPasswordIcon" class="ti ti-eye text-xl"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class="relative">
                <x-text-input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full pr-10"
                    autocomplete="new-password"
                />

                <button
                    type="button"
                    id="toggleNewPassword"
                    title="Tampilkan Password"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                    <i id="newPasswordIcon" class="ti ti-eye text-xl"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
                <x-text-input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="mt-1 block w-full pr-10"
                    autocomplete="new-password"
                />

                <button
                    type="button"
                    id="toggleConfirmPassword"
                    title="Tampilkan Password"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                    <i id="confirmPasswordIcon" class="ti ti-eye text-xl"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {

    function togglePassword(inputId, buttonId, iconId) {
        const input = document.getElementById(inputId);
        const button = document.getElementById(buttonId);
        const icon = document.getElementById(iconId);

        if (!input || !button || !icon) return;

        button.addEventListener('click', function () {
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('ti-eye', 'ti-eye-off');
                button.title = 'Sembunyikan Password';
            } else {
                input.type = 'password';
                icon.classList.replace('ti-eye-off', 'ti-eye');
                button.title = 'Tampilkan Password';
            }
        });
    }

    togglePassword(
        'update_password_current_password',
        'toggleCurrentPassword',
        'currentPasswordIcon'
    );

    togglePassword(
        'update_password_password',
        'toggleNewPassword',
        'newPasswordIcon'
    );

    togglePassword(
        'update_password_password_confirmation',
        'toggleConfirmPassword',
        'confirmPasswordIcon'
    );

});
</script>