<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
</head>

<body>
    @include('includes.navbar')
    <div class="flex flex-row">
        @include('includes.leftSidebar')
        @yield('content')
    </div>
    <script src="/assets/js/script.js"></script>
</body>

</html>
