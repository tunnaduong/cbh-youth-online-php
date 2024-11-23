<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
</head>

<body class="bg-[#F8F8F8] mt-[4.3rem]">
    @include('includes.navbar')
    <div class="flex flex-row">
        <div class="flex-1">
            @yield('content')
        </div>
    </div>
    <script>
        var isLoggedIn = {{ isset($_SESSION['user']) ? 'true' : 'false' }};
        var uid = {{ isset($_SESSION['user']) ? $_SESSION['user']->id : 'null' }};
    </script>
    <script src="/assets/js/script.js"></script>
</body>

</html>
