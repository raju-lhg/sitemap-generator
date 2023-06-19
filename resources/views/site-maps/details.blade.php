<x-app-layout>
    <x-slot name="header">
        <!-- Include the jsTree CSS -->
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/themes/default/style.min.css" /> --}}
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
                                {{-- <ul>
                                    <li><i class="fa fa-folder-open"></i> Project
                                        <ul>
                                            <li><i class="fa fa-folder-open"></i> Opened Folder <span>- 15kb</span>
                                                <ul>
                                                    <li><i class="fa fa-folder-open"></i> css
                                                        <ul>
                                                            <li><i class="fa fa-code"></i> CSS Files <span>- 3kb</span></li>
                                                        </ul>
                                                    </li>
                                                    <li><i class="fa fa-folder"></i> Folder close <span>- 10kb</span></li>
                                                    <li><i class="fab fa-html5"></i> index.html</li>
                                                    <li><i class="fa fa-picture-o"></i> favicon.ico</li>
                                                </ul>
                                            </li>
                                            <li><i class="fa fa-folder"></i> Folder close <span>- 420kb</span></li>
                                        </ul>
                                    </li>
                                </ul> --}}
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

    {{-- <!-- Include the jsTree library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/jstree.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        $(function() {
            // Initialize the jsTree
            $('#sitemap').jstree({
                'core': {
                    'data': {!! json_encode($sitemapData) !!}
                },
                'plugins': ["wholerow"]
            });

            // Handle download PDF button click event
            document.getElementById('downloadPDF').addEventListener('click', function() {
                const element = document.getElementById('sitemap');
                const options = {
                    margin: 10,
                    filename: 'sitemap.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait'
                    }
                };

                html2pdf().set(options).from(element).save();
            });

            // Handle download XML button click event
            document.getElementById('downloadXML').addEventListener('click', function() {
                // Add your logic to generate and download the XML file
                // You can use the $sitemap->xml_path and $sitemapData variables here
                // to generate the XML content and trigger the file download.
            });
        });
    </script> --}}
</x-app-layout>
