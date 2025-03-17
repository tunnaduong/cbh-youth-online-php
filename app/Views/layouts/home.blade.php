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
        <div id="main-content" hx-get="/feed/fetch" hx-trigger="load" hx-swap="innerHTML" class="flex-1">
            <p class="text-center mt-4">Đang tải bài viết...</p>
        </div>
        @include('includes.rightSidebar', [
            'recordings' => $recordings ?? false,
        ])
    </div>
    @include('includes.createPostModal', [
        'recordings' => $recordings ?? false,
    ])
    <script>
        var isLoggedIn = {{ isset($_SESSION['user']) ? 'true' : 'false' }};
        var uid = {{ isset($_SESSION['user']) ? $_SESSION['user']->id : 'null' }};
    </script>
    <script src="/assets/js/script.js"></script>
</body>

</html>
