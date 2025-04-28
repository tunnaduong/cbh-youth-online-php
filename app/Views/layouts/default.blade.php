<!DOCTYPE html>
<html>

<head>
    @include('includes.head', [
        'description' => $description ?? null,
        'title' => $title ?? null,
        'keywords' => $keywords ?? null,
        'image' => $image ?? null,
    ])
</head>

<body>
    @yield('content')
    <script>
        tailwind.config = {
            darkMode: 'class',
        };
    </script>
    <script src="/assets/js/script.js"></script>
</body>

</html>
