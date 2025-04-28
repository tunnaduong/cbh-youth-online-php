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

<body class="bg-[#F8F8F8] mt-[4.3rem]">
    <style>
        #openModalBtn2 {
            display: none;
        }
    </style>
    @include('includes.navbar')
    <div id="root" class="flex md:flex-row flex-col">
        @include('includes.leftSidebar2', [
            'links' => [
                'Hỗ trợ' => ['/help', 'help-buoy'],
                'Giới thiệu' => ['/about', 'information-circle'],
                'Điều khoản' => ['/terms', 'document-text'],
                'Việc làm' => ['/careers', 'search'],
                'Quyền riêng tư' => ['/privacy', 'document-lock'],
                'Quảng cáo' => ['/ads', 'cash'],
                'Liên hệ' => ['/contact', 'mail'],
            ],
            'active' => $active ?? null,
        ])
        <div class="flex-1">
            @yield('content')
            {{-- Footer --}}
            <div class="px-3 mt-10">
                <div class="container-footer mx-auto py-6">
                    <hr class="mb-4">
                    <div class="flex items-center justify-between">
                        <a href="https://fatties.vercel.app" target="_blank">
                            <img src="/assets/images/from_fatties.png" alt="Fatties Logo" class="h-6 w-auto -ml-0.5">
                        </a>
                        <div class="ml-4 text-[12px] text-gray-500">© 2025 Fatties Software</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.createPostModal', [
        'recordings' => $recordings ?? false,
    ])
    <script>
        var isLoggedIn = {{ isset($_SESSION['user']) ? 'true' : 'false' }};
        var uid = {{ isset($_SESSION['user']) ? $_SESSION['user']->id : 'null' }};
    </script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        };
    </script>
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
