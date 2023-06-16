<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Site Maps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">
                    List of Site Maps
                </h2>
                <a href="{{ route('site-maps.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Add New
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                URL
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Note
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created By
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                XML Path
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created At
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($siteMaps as $siteMap)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $siteMap->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $siteMap->url }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $siteMap->note }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $siteMap->createdByUser->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $siteMap->xml_path }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $siteMap->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('site-maps.show', $siteMap->id) }}" class="text-indigo-600 hover:text-indigo-900">Details</a>
                                    <a href="{{ route('site-maps.edit', $siteMap->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2">Edit</a>
                                    <form class="inline" action="{{ route('site-maps.destroy', $siteMap->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
