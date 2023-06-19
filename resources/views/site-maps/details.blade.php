<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" />
        <link rel="stylesheet" href="{{ asset('windmaill') }}/css/custom.css" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold dark:text-gray-200 mb-4">
                        Sitemap Details
                    </h2>
                    <div>
                        <p class="dark:text-gray-200"><strong>ID:</strong> {{ $sitemap->id }}</p>
                        <p class="dark:text-gray-200"><strong>URL:</strong> {{ $sitemap->url }}</p>
                        <p class="dark:text-gray-200"><strong>Note:</strong> {{ $sitemap->note }}</p>
                        <p class="dark:text-gray-200"><strong>Created By:</strong> {{ $sitemap->createdByUser->name }}
                        </p>
                        <p class="dark:text-gray-200"><strong>XML Path:</strong> {{ $sitemap->xml_path }}</p>
                        <p class="dark:text-gray-200"><strong>Created At:</strong> {{ $sitemap->created_at }}</p>
                        <p class="dark:text-gray-200"><strong>Updated At:</strong> {{ $sitemap->updated_at }}</p>
                    </div>

                    <!-- Visual Sitemap -->
                    <h2 class="text-lg font-semibold dark:text-gray-200 mt-8">Tree</h2>
                    <div class="mt-4">
                        <div class="dark:bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200 p-4">
                            <!-- Whois info content -->
                            <div class="tree mt-8">
                                {!! $customTree !!}
                            </div>
                        </div>
                    </div>

                    <!-- DNS Info -->
                    <h2 class="text-lg font-semibold dark:text-gray-200 mt-8">DNS Info</h2>
                    <div class="mt-4">
                        <div class="shadow overflow-hidden sm:rounded-lg border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200 dark:bg-white">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 dark:bg-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Records</th>
                                        <th scope="col"
                                            class="px-6 py-3 dark:bg-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            TTL</th>
                                        <th scope="col"
                                            class="px-6 py-3 dark:bg-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Class</th>
                                        <th scope="col"
                                            class="px-6 py-3 dark:bg-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Entries/Values</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($dnsInfo as $recordType => $record)
                                        <tr>
                                            <td class="dark:text-gray-200 px-4 py-2">{{ $record['data'][0]['type'] }}
                                            </td>
                                            <td class="dark:text-gray-200 px-4 py-2">{{ $record['ttl'] }}</td>
                                            <td class="dark:text-gray-200 px-4 py-2">{{ $record['class'] }}</td>
                                            <td class="dark:text-gray-200 px-4 py-2">
                                                @if ($record['data'][0]['type'] === 'A')
                                                    @foreach ($record['data'] as $data)
                                                        <p> {{ $data['host'] }}</p>
                                                    @endforeach
                                                @elseif (in_array($record['data'][0]['type'], ['NS', 'MX']))
                                                    @foreach ($record['data'] as $data)
                                                        <p>{{ $data['target'] }}</p>
                                                    @endforeach
                                                @elseif ($record['data'][0]['type'] === 'SOA')
                                                    @foreach ($record['data'] as $data)
                                                        <p><em>Email:</em> {{ $data['mname'] }}</p>
                                                        <p><em>Serial:</em> {{ $data['serial'] }}</p>
                                                        <p><em>Refresh:</em> {{ $data['refresh'] }}</p>
                                                        <p><em>Retry:</em> {{ $data['retry'] }}</p>
                                                        <p><em>Expiry:</em> {{ $data['expire'] }}</p>
                                                        <p><em>Minimum TTL:</em> {{ $data['minimum-ttl'] }}</p>
                                                    @endforeach
                                                @elseif ($recordType === 'txt')
                                                    @foreach ($record['data'] as $data)
                                                        <p> {{ $data['txt'] ?? '' }}</p>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Whois Info -->
                    <h2 class="text-lg font-semibold dark:text-gray-200 mt-8">Whois Info</h2>
                    <div class="mt-4">
                        <div class="dark:bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200 p-4">
                            <!-- Whois info content -->
                            <p class="dark:text-gray-200">{!! $sitemap->who_is_data !!}</p>
                        </div>
                    </div>

                    <!-- Visual Sitemap -->
                    <h2 class="text-lg font-semibold dark:text-gray-200 mt-8">Site map</h2>
                    <div class="mt-4">
                        <div class="dark:bg-white shadow overflow-hidden sm:rounded-lg border border-gray-200 p-4">
                            <!-- Whois info content -->
                            <div id="sitemap" class="mt-8"></div>
                        </div>
                    </div>

                    <!-- Export buttons -->
                    <div class="flex justify-between mt-4">
                        <button id="downloadPDF"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Download as PDF
                        </button>
                        <button id="downloadXML"
                            class="dark:bg-green-500 hover:bg-green-700 dark:text-white font-bold py-2 px-4 rounded">
                            Download XML
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
            // Collapse/Expand tree nodes
            $('.tree i.hasChildren').click(function() {
                $(this).toggleClass('fa-folder-open fa-folder');
                $(this).siblings('ul').toggle();
            });
        });
    </script>

</x-app-layout>
