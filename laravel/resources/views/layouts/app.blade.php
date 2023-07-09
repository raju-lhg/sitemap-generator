<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.meta')

    @include('layouts.partials.styles')
    {{ $header ?? '' }}

</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">

        @include('layouts.partials.sidebar')

        @include('layouts.partials.mobile_sidebar')

        <div class="flex flex-col flex-1 w-full">
            @include('layouts.partials.header')

            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <!-- CTA -->
                    {{ $slot }}
                </div>

            </main>
        </div>

    </div>

    @include('layouts.partials.scripts')
</body>

</html>
