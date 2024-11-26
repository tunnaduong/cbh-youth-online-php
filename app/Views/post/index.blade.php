@php
    use Carbon\Carbon;

    // Define a truncation function using mb_substr for multibyte encoding support
    function truncateText($text, $length = 500)
    {
        // Ensure UTF-8 encoding is used for the substr operation
        if (strlen($text) <= $length) {
            return $text;
        }
        return mb_substr($text, 0, $length, 'UTF-8') . '...';
    }

    function roundToNearestFive($count)
    {
        if ($count <= 5) {
            // If count is less than or equal to 5, format it with leading zero
            return str_pad($count, 2, '0', STR_PAD_LEFT);
        } else {
            // Round down to the nearest multiple of 5 and pad to 2 digits
            return str_pad(floor($count / 5) * 5, 2, '0', STR_PAD_LEFT);
        }
    }
@endphp

@extends('layouts.home')

@section('content')
    @include('includes.topBar')
    <div class="flex flex-col items-center w-full flex-1 p-2 pt-4">
        @php
            // Create a Carbon instance from the given datetime
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $post->post_created_at);

            // Set the locale to Vietnamese (for "1 tuần trước")
            Carbon::setLocale('vi');
        @endphp
        <div class="px-1.5 md:px-0 md:max-w-[679px] w-full">
            <div data-post-id="{{ $post->post_id }}"
                class="post-container-post mb-4 shadow-lg rounded-xl !p-6 bg-white flex flex-row">
                <div
                    class="min-w-[84px] items-center mt-1 flex-col hidden md:flex ml-[-20px] text-[13px] font-semibold text-gray-400">
                    <ion-icon name="arrow-up-outline"
                        class="upvote-button text-2xl cursor-pointer {{ $post->user_vote === 'upvote' ? 'text-green-500' : '' }}"></ion-icon>
                    <span
                        class="select-none text-lg vote-count {{ $post->user_vote == 'upvote' ? 'text-green-500' : ($post->user_vote == 'downvote' ? 'text-red-500' : '') }}">{{ $post->post_votes }}</span>
                    <ion-icon name="arrow-down-outline"
                        class="downvote-button text-2xl cursor-pointer {{ $post->user_vote === 'downvote' ? 'text-red-500' : '' }}"></ion-icon>
                    @if ($post->is_saved)
                        <div
                            class="save-post-button bg-[#CDEBCA] cursor-pointer rounded-lg w-[33.6px] h-[33.6px] mt-3 flex items-center justify-center">
                            <ion-icon name="bookmark" class="text-[#319527] text-xl"></ion-icon>
                        </div>
                    @else
                        <div
                            class="save-post-button bg-[#EAEAEA] cursor-pointer rounded-lg w-[33.6px] h-[33.6px] mt-3 flex items-center justify-center">
                            <ion-icon name="bookmark" class="text-gray-400 text-xl"></ion-icon>
                        </div>
                    @endif
                </div>
                <div class="flex-1 overflow-hidden break-words">
                    <h1 class="text-xl font-semibold mb-1 max-w-[600px] truncate">{{ $post->title }}</h1>
                    <div class="text-base max-w-[600px] overflow-wrap">
                        <div id="truncated{{ $post->post_id }}" style="display: block;">
                            <span>{!! nl2br(truncateText($post->description, 330)) !!}</span>
                            @if (strlen($post->description) > 330)
                                <a class="text-black cursor-pointer hover:underline font-medium"
                                    onclick="toggleText{{ $post->post_id }}()">Xem
                                    thêm</a>
                            @endif
                        </div>
                        <div id="fullText{{ $post->post_id }}" style="display: none;">
                            <span>{!! nl2br($post->description) !!} </span>
                            <a class="text-black cursor-pointer hover:underline font-medium"
                                onclick="toggleText{{ $post->post_id }}()">Thu
                                gọn</a>
                        </div>
                    </div>
                    <script>
                        function toggleText{{ $post->post_id }}() {
                            const truncated = document.getElementById('truncated{{ $post->post_id }}');
                            const fullText = document.getElementById('fullText{{ $post->post_id }}');

                            if (truncated.style.display === "none") {
                                truncated.style.display = "block";
                                fullText.style.display = "none";
                            } else {
                                truncated.style.display = "none";
                                fullText.style.display = "block";
                            }
                        }
                    </script>
                    @unless (!isset($post->cdn_image_id))
                        <div
                            class="rounded-md bg-[#E4EEE3] border overflow-hidden !mt-4 max-h-[34rem] flex items-center justify-center">
                            <img alt="Ảnh bài viết" width="700" height="700" decoding="async" data-nimg="1"
                                class="object-contain max-h-[34rem] text-[11px]"
                                src="https://api.chuyenbienhoa.com/storage/{{ $post->file_path }}" style="color: transparent;">
                        </div>
                    @endunless
                    <hr class="!my-5 border-t-2">
                    <div class="flex-row flex-wrap flex text-[13px] items-center"><a href="/{{ $post->username }}"><span
                                class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
                                <img class="border rounded-full aspect-square h-full w-full"
                                    alt="{{ $post->username }} avatar"
                                    src="{{ !empty($post->oauth_profile_picture) ? $post->oauth_profile_picture : (!empty($post->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $post->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}">
                            </span>
                        </a>
                        <span class="text-gray-500 hidden md:block ml-2">Đăng bởi</span>
                        <a class="flex flex-row items-center ml-2 md:ml-1 text-[#319527] hover:text-[#319527] font-bold"
                            href="/{{ $post->username }}">{{ $post->profile_name }}
                            @if ($post->verified == 1)
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                    aria-hidden="true" class="text-base leading-5 ml-0.5" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        </a>
                        <span class="mb-2 ml-0.5 text-sm text-gray-500">.</span>
                        <span class="ml-0.5 text-gray-500">{{ $date->diffForHumans() }}</span>
                        <div class="flex flex-1 flex-row-reverse items-center text-gray-500">
                            <span>{{ $post->post_views }}</span>
                            <ion-icon class="text-xl mr-1 ml-2" name="eye-outline"></ion-icon>
                            <span class="flex flex-row-reverse items-center">
                                <span>{{ roundToNearestFive($post->post_comments) }}+</span>
                                <ion-icon class="text-xl mr-1" name="chatbox-outline"></ion-icon>
                            </span>
                        </div>
                    </div>
                    <div
                        class="min-w-[84px] mt-3 flex md:hidden items-center gap-x-3 flex-row text-[13px] font-semibold text-gray-400">
                        <ion-icon name="arrow-up-outline"
                            class="upvote-button text-2xl cursor-pointer {{ $post->user_vote === 'upvote' ? 'text-green-500' : '' }}"></ion-icon>
                        <span
                            class="select-none text-lg vote-count {{ $post->user_vote == 'upvote' ? 'text-green-500' : ($post->user_vote == 'downvote' ? 'text-red-500' : '') }}">{{ $post->post_votes }}</span>
                        <ion-icon name="arrow-down-outline"
                            class="downvote-button text-2xl cursor-pointer {{ $post->user_vote === 'downvote' ? 'text-red-500' : '' }}"></ion-icon>
                        @if ($post->is_saved)
                            <div
                                class="save-post-button bg-[#CDEBCA] cursor-pointer rounded-lg w-[33.6px] h-[33.6px] flex items-center justify-center">
                                <ion-icon name="bookmark" class="text-[#319527] text-xl"></ion-icon>
                            </div>
                        @else
                            <div
                                class="save-post-button bg-[#EAEAEA] cursor-pointer rounded-lg w-[33.6px] h-[33.6px] flex items-center justify-center">
                                <ion-icon name="bookmark" class="text-gray-400 text-xl"></ion-icon>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="px-1.5 md:!px-0 md:max-w-[679px] w-[100%]">
            <div class="shadow !mb-4 long-shadow h-min rounded-lg bg-white">
                <div
                    class="flex flex-col space-y-1.5 p-6 text-xl -mb-4 font-semibold max-w-sm overflow-hidden whitespace-nowrap overflow-ellipsis">
                    Bình luận</div>
                <div class="p-6 pt-2">
                    @if (isset($_SESSION['user']))
                        <form action="" method="POST" class="space-y-4 mb-7">
                            <textarea
                                class="flex min-h-[60px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                name="comment" required placeholder="Viết bình luận của bạn..."></textarea>
                            <button
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-green-600 hover:bg-green-700 text-white"
                                type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-send mr-2 h-4 w-4">
                                    <path
                                        d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z">
                                    </path>
                                    <path d="m21.854 2.147-10.94 10.939"></path>
                                </svg>Gửi bình luận</button>
                        </form>
                    @else
                        <div class="text-base !mb-8">
                            <a class="text-green-600 hover:text-green-600" href="/login">Đăng
                                nhập</a> để bình luận và
                            tham gia thảo luận cùng cộng đồng.
                        </div>
                    @endif
                    @if (count($comments) > 0)
                        <div class="gap-y-4 flex flex-col">
                            @foreach ($comments as $comment)
                                @php
                                    // Create a Carbon instance from the given datetime
                                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $comment->comment_created_at);

                                    // Set the locale to Vietnamese (for "1 tuần trước")
                                    Carbon::setLocale('vi');
                                @endphp
                                <div data-comment-id="{{ $comment->comment_id }}" class="flex space-x-4">
                                    <a href="/{{ $comment->username }}">
                                        <span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full">
                                            <img src="{{ !empty($comment->oauth_profile_picture) ? $comment->oauth_profile_picture : (!empty($comment->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $comment->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                                                class="flex h-full w-full items-center justify-center rounded-full border" />
                                        </span>
                                    </a>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between"><a
                                                href="/{{ $comment->username }}">
                                                <h4 class="text-sm font-semibold">{{ $comment->profile_name }}</h4>
                                            </a><span class="text-xs text-gray-500">{{ $date->diffForHumans() }}</span>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-700">{{ $comment->comment }}</p>
                                        <div class="mt-2 flex items-center space-x-2 text-gray-400">
                                            <ion-icon name="arrow-up-outline"
                                                class="comment-upvote-button cursor-pointer {{ $comment->user_vote === 'upvote' ? 'text-green-500' : '' }}"></ion-icon>
                                            <span
                                                class="vote-count select-none text-sm font-semibold {{ $comment->user_vote == 'upvote' ? 'text-green-500' : ($comment->user_vote == 'downvote' ? 'text-red-500' : '') }}">{{ $comment->comment_votes }}</span>
                                            <ion-icon name="arrow-down-outline"
                                                class="comment-downvote-button cursor-pointer {{ $comment->user_vote === 'downvote' ? 'text-red-500' : '' }}"></ion-icon>
                                            <span>·</span>
                                            <span class="reply-comment cursor-pointer text-sm font-semibold">Trả lời</span>
                                        </div>
                                        <form action="" method="POST" class="reply-box hidden mt-2">
                                            <textarea
                                                class="flex min-h-[60px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                                name="comment" required placeholder="Viết phản hồi của bạn..."></textarea>
                                            <input type="hidden" name="replyingTo" value="{{ $comment->comment_id }}">
                                            <button
                                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-green-600 hover:bg-green-700 text-white mt-2"
                                                type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-send mr-2 h-4 w-4">
                                                    <path
                                                        d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z">
                                                    </path>
                                                    <path d="m21.854 2.147-10.94 10.939"></path>
                                                </svg>Gửi phản hồi</button>
                                        </form>
                                        @if (count($comment->replies) > 0)
                                            <div class="mt-4 space-y-4 reply-container">
                                                @foreach ($comment->replies as $reply)
                                                    @php
                                                        $replyDate = Carbon::createFromFormat(
                                                            'Y-m-d H:i:s',
                                                            $reply->comment_created_at,
                                                        );
                                                        Carbon::setLocale('vi');
                                                    @endphp
                                                    <div data-comment-id="{{ $reply->comment_id }}"
                                                        class="flex space-x-4">
                                                        <a href="/{{ $reply->username }}">
                                                            <span
                                                                class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-full">
                                                                <img src="{{ !empty($reply->oauth_profile_picture) ? $reply->oauth_profile_picture : (!empty($reply->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $reply->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                                                                    class="flex h-full w-full items-center justify-center rounded-full border" />
                                                            </span>
                                                        </a>
                                                        <div class="flex-1">
                                                            <div class="flex items-center justify-between">
                                                                <a href="/{{ $reply->username }}">
                                                                    <h4 class="text-sm font-semibold">
                                                                        {{ $reply->profile_name }}</h4>
                                                                </a>
                                                                <span
                                                                    class="text-xs text-gray-500">{{ $replyDate->diffForHumans() }}</span>
                                                            </div>
                                                            <p class="mt-1 text-sm text-gray-700">{{ $reply->comment }}
                                                            </p>
                                                            <div class="mt-2 flex items-center space-x-2 text-gray-400">
                                                                <ion-icon name="arrow-up-outline"
                                                                    class="comment-upvote-button cursor-pointer {{ $reply->user_vote === 'upvote' ? 'text-green-500' : '' }}">
                                                                </ion-icon>
                                                                <span
                                                                    class="vote-count select-none text-sm font-semibold {{ $reply->user_vote == 'upvote' ? 'text-green-500' : ($reply->user_vote == 'downvote' ? 'text-red-500' : '') }}">
                                                                    {{ $reply->comment_votes }}
                                                                </span>
                                                                <ion-icon name="arrow-down-outline"
                                                                    class="comment-downvote-button cursor-pointer {{ $reply->user_vote === 'downvote' ? 'text-red-500' : '' }}">
                                                                </ion-icon>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <center class="text-sm text-gray-400">Không có bình luận nào cho bài viết này.<br>Hãy là người đầu
                            tiên
                            để lại ý kiến của bạn!</center>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('communityActive', 'nav-active')
