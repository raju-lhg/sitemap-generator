<section>
    <header style="margin:10px 0;">
        <h2 class="text-lg font-medium dark:text-gray-200 my-2">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm dark:text-gray-200 my-2">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" style="margin:10px 0;">
        @csrf
        @method('patch')

        <div style="margin:10px 0;">
            <x-input-label style="margin:10px 0;" class="dark:text-gray-200 my-2" for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div style="margin:10px 0;">
            <x-input-label style="margin:10px 0;" class="dark:text-gray-200 my-2" for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 dark:text-gray-200 my-2">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm dark:text-gray-200 my-2 hover:dark:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4" style="margin:10px 0;">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm dark:text-gray-200 my-2">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
