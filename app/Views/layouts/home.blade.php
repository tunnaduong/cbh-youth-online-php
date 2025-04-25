<!DOCTYPE html>
<html>

<head>
    @include('includes.head', [
        'description' => $description ?? null,
        'title' => $title ?? null,
        'keywords' => $keywords ?? null,
        'image' => $image ?? null,
        'author' => $author ?? null,
    ])
</head>

<body class="bg-[#F8F8F8] mt-[4.3rem] {{ $isDarkMode ?? false ? 'dark' : '' }}">
    @include('includes.navbar')
    <div id="root" class="flex md:flex-row flex-col">
        @include('includes.leftSidebar', [
            'reports' => $reports ?? false,
            'class' => $class ?? false,
            'student' => $student ?? false,
            'feed' => $feed ?? false,
            'forum' => $forum ?? false,
            'recordings' => $recordings ?? false,
            'youth' => $youth ?? false,
            'saved' => $saved ?? false,
        ])
        <div class="flex-1">
            @yield('content')
        </div>
        @include('includes.rightSidebar', [
            'recordings' => $recordings ?? false,
        ])
    </div>
    @include('includes.footer')
    @include('includes.createPostModal', [
        'recordings' => $recordings ?? false,
    ])
    @include('components.bottomCTA')
    <script>
        var isLoggedIn = {{ isset($_SESSION['user']) ? 'true' : 'false' }};
        var uid = {{ isset($_SESSION['user']) ? $_SESSION['user']->id : 'null' }};
    </script>
    @stack('scripts')
    <script src="/assets/js/script.js"></script>
    <script id="cid0020000406220973300" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js"
        style="width: 200px;height: 300px;">
        {
            "handle": "chuyenbienhoa",
            "arch": "js",
            "styles": {
                "a": "319527",
                "b": 100,
                "c": "FFFFFF",
                "d": "FFFFFF",
                "k": "319527",
                "l": "319527",
                "m": "319527",
                "n": "FFFFFF",
                "p": "10",
                "q": "319527",
                "r": 100,
                "pos": "br",
                "cv": 1,
                "cvbg": "319527",
                "cvw": 75,
                "cvh": 30
            }
        }
    </script>
</body>

</html>
