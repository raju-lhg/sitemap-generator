<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sitemap Details') }}
        </h2>
        <!-- Include the jsTree CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/themes/default/style.min.css" />
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
                        <p><strong>Created By:</strong> {{ $sitemap->createdByUser->name }}</p>
                        <p><strong>XML Path:</strong> {{ $sitemap->xml_path }}</p>
                        <p><strong>Created At:</strong> {{ $sitemap->created_at }}</p>
                        <p><strong>Updated At:</strong> {{ $sitemap->updated_at }}</p>
                    </div>

                    <!-- Export buttons -->
                    <div class="flex justify-between mt-4">
                        <button id="downloadPDF" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Download as PDF
                        </button>
                        <button id="downloadXML" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Download XML
                        </button>
                    </div>

                    <!-- Visual Sitemap -->
                    <div id="sitemap"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the jsTree library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/jstree.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script>
        $(function() {
            // Initialize the jsTree
            $('#sitemap').jstree({
                'core': {
                    'data': [
                        {
                        "text": "Home",
                        "state": { "opened": true },
                        "children": []
                        },
                        {
                        "text": "About",
                        "state": { "opened": true },
                        "children": [
                            { "text": "Mission" },
                            { "text": "Vision" },
                            { "text": "Values" }
                        ]
                        },
                        {
                        "text": "Services",
                        "state": { "opened": true },
                        "children": [
                            { "text": "Service 1" },
                            { "text": "Service 2" },
                            { "text": "Service 3" }
                        ]
                        },
                        {
                        "text": "Products",
                        "state": { "opened": true },
                        "children": [
                            { "text": "Product 1" },
                            { "text": "Product 2" },
                            { "text": "Product 3" }
                        ]
                        },
                        {
                        "text": "Contact",
                        "state": { "opened": true },
                        "children": []
                        }
                    ]
                },
                'plugins': ["wholerow"]
            });

            // Handle download PDF button click event
            document.getElementById('downloadPDF').addEventListener('click', function() {
                const element = document.getElementById('sitemap');
                const options = {
                    margin: 10,
                    filename: 'sitemap.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
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
    </script>
</x-app-layout>
