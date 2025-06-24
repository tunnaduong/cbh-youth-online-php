@extends('layouts.home', ['title' => 'Bảng tin', 'feed' => true])

@section('content')
    <div id="main-content" hx-get="/feed/fetch" hx-trigger="load" hx-swap="innerHTML" class="flex-1 min-h-[calc(100vh-100px)]">
        <div class="p-3 pt-4 flex flex-col items-center w-full flex-1">
            @include('components.skeletonPost', ['count' => 5])
        </div>
    </div>

    <script>
        $(document).ready(function () {
        const posts = document.querySelectorAll(".post-container");

        const observer = new IntersectionObserver(
            (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                const postId = entry.target.getAttribute("data-post-id");
                fetch(`/api/posts/${postId}/increment-view`)
                    .then((response) => {
                    if (!response.ok) {
                        console.error("Failed to increment post view");
                    }
                    })
                    .catch((error) => {
                    console.error("Error:", error);
                    });
                observer.unobserve(entry.target);
                }
            });
            },
            {
            threshold: 0.5,
            }
        );

        posts.forEach((post) => {
            observer.observe(post);
        });
        });
    </script>
@endsection

@section('communityActive', 'nav-active')
