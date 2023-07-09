<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LHG</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <style>
        .tree {
            position: relative;
            background: white;
            margin-top: 20px;
            padding: 30px;
            font-family: 'Roboto Mono', monospace;
            font-size: 0.85rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
        }

        .tree span {
            font-size: 13px;
            font-style: italic;
            letter-spacing: 0.4px;
            color: #a8a8a8;
        }

        .tree .fa-folder-open,
        .tree .fa-folder {
            color: #007bff;
        }

        .tree .fa-html5 {
            color: #f21f10;
        }

        .tree ul {
            padding-left: 5px;
            list-style: none;
        }

        .tree ul li {
            position: relative;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 15px;
            box-sizing: border-box;
        }

        .tree ul li:before {
            position: absolute;
            top: 15px;
            left: 0;
            width: 10px;
            height: 1px;
            margin: auto;
            content: '';
            background-color: #666;
        }

        .tree ul li:after {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 1px;
            height: 100%;
            content: '';
            background-color: #666;
        }

        .tree ul li:last-child:after {
            height: 15px;
        }

        .tree a {
            cursor: pointer;
        }

        .tree a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div class="bg-white shadow-md p-8 rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">DNS Info</h1>
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

                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <div class="bg-white shadow-md p-8 rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Who is Info</h1>
        <p class="dark:text-gray-200">{!! $sitemap->who_is_data !!}</p>
      </div>
      <div class="bg-white shadow-md p-8 rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Sitemap</h1>
        <div class="tree">
            {!! $customTree !!}
        </div>
      </div>
    </div>
  </div>
</body>

</html>
