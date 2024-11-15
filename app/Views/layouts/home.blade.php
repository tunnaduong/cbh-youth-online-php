<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
</head>

<body class="bg-[#F8F8F8] mt-[4.3rem]">
    @include('includes.navbar')
    <div class="flex flex-row">
        @include('includes.leftSidebar')
        <div class="flex-1">
            @yield('content')
        </div>
        @include('includes.rightSidebar')
    </div>
    <script src="/assets/js/script.js"></script>
</body>

</html>
