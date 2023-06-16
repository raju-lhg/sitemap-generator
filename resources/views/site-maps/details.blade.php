<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sitemap Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        Sitemap Details
                    </h2>
                    <div>
                        <p><strong>ID:</strong> {{ $sitemap->id }}</p>
                        <p><strong>URL:</strong> {{ $sitemap->url }}</p>
                        <p><strong>Note:</strong> {{ $sitemap->note }}</p>
                        <p><strong>Created By:</strong> {{ $sitemap->created_by }}</p>
                        <p><strong>XML Path:</strong> {{ $sitemap->xml_path }}</p>
                        <p><strong>Created At:</strong> {{ $sitemap->created_at }}</p>
                        <p><strong>Updated At:</strong> {{ $sitemap->updated_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
