<!DOCTYPE html>
<html>

<head>
    <title>Custom Tree Structure (Tailwind CSS)</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19" rel="stylesheet">
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
    <div class="tree">
        {!! $customTree !!}
    </div>
</body>
<script>
    $(document).ready(function() {
        // Collapse/Expand tree nodes
        $('.tree i.hasChildren').click(function() {
            $(this).toggleClass('fa-folder-open fa-folder');
            $(this).siblings('ul').toggle();
        });
    });
</script>

</html>
