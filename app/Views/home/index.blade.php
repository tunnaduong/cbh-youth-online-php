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
    <div class="flex flex-col items-center w-full flex-1 p-2 pt-4">
        @foreach ($posts as $post)
            @php
                // Create a Carbon instance from the given datetime
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $post->post_created_at);

                // Set the locale to Vietnamese (for "1 tuần trước")
                Carbon::setLocale('vi');
            @endphp
            <div data-post-id="{{ $post->post_id }}"
                class="post-container w-full mb-4 shadow-lg rounded-xl !p-6 bg-white flex flex-row md:max-w-[679px]">
                <div class="min-w-[84px] items-center mt-1 flex-col flex ml-[-20px] text-[13px] font-semibold text-gray-400">
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
                <div class="flex-1 overflow-hidden break-words"><a href="/{{ $post->username }}/posts/{{ $post->post_id }}">
                        <h1 class="text-xl font-semibold mb-1 max-w-[600px] truncate">{{ $post->title }}</h1>
                    </a>
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
                    <div class="flex-row flex text-[13px] items-center"><a href="/{{ $post->username }}"><span
                                class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
                                <img class="border rounded-full aspect-square h-full w-full"
                                    alt="{{ $post->username }} avatar"
                                    src="{{ !empty($post->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $post->username . '/avatar' : '/assets/images/placeholder-user.jpg' }}">
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
                            <a class="flex flex-row-reverse items-center"
                                href="/{{ $post->username }}/posts/{{ $post->post_id }}">
                                <span>{{ roundToNearestFive($post->post_comments) }}+</span>
                                <ion-icon class="text-xl mr-1" name="chatbox-outline"></ion-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('communityActive', 'nav-active')
