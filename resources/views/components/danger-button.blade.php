{{-- <button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 dark:bg-red-600 dark:border dark:border-transparent rounded-md font-semibold text-xs dark:text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}

<button class="inline-flex items-center px-4 py-2 dark:bg-red-600 dark:border dark:border-transparent rounded-md font-semibold text-xs dark:text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
    Delete Account
</button>
