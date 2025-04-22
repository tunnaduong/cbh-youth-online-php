@php
    use Carbon\Carbon;
@endphp

@extends('layouts.home', ['title' => 'Diễn đàn', 'forum' => true])

@section('menu-label', 'Diễn đàn')

@section('content')

    @include('includes.topBar')

    <div class="pt-4 !px-2.5">
        <div class="max-w-[775px] mx-auto">
            <div class="border rounded bg-white">
                <div class="flex flex-wrap items-stretch">
                    <a href="?sort=latest"
                        class="px-4 text-sm flex items-center hover:bg-gray-50 tab-button
                        @if (!isset($_GET['sort']) || $_GET['sort'] === 'latest') tab-button-active @endif">
                        <span class="py-2">Bài mới</span>
                    </a>

                    <a href="?sort=most_viewed"
                        class="hidden sm:flex px-4 text-sm items-center bor-left hover:bg-gray-50 tab-button
                        @if (($_GET['sort'] ?? '') === 'most_viewed') tab-button-active @endif">
                        <span class="py-2">Chủ đề xem nhiều</span>
                    </a>

                    <a href="?sort=most_engaged"
                        class="px-4 text-sm hidden sm:flex items-center bor-right bor-left hover:bg-gray-50 tab-button
                        @if (($_GET['sort'] ?? '') === 'most_engaged') tab-button-active @endif">
                        <span class="py-2">Tương tác nhiều</span>
                    </a>
                    <div>
                        <button
                            class="h-9 w-9 border-l items-center justify-center tab-button bor-right flex sm:hidden hover:bg-gray-50"
                            id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <ion-icon name="menu-outline" class="text-xl"></ion-icon>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <li><a class="dropdown-item" href="?sort=most_viewed">Chủ đề xem nhiều</a></li>
                            <li><a class="dropdown-item" href="?sort=most_engaged">Tương tác nhiều</a></li>
                        </ul>
                    </div>
                    <div class="ml-auto flex">
                        <button class="h-9 w-9 border-l flex items-center justify-center tab-button hover:bg-gray-50"
                            onclick="location.reload()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-refresh-cw-icon lucide-refresh-cw h-4 w-4">
                                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8" />
                                <path d="M21 3v5h-5" />
                                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16" />
                                <path d="M8 16H3v5" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    @foreach ($latestPosts as $post)
                        @php
                            // Create a Carbon instance from the given datetime
                            $date = Carbon::createFromFormat('Y-m-d H:i:s', $post->post_created_at);

                            // Set the locale to Vietnamese (for "1 tuần trước")
                            Carbon::setLocale('vi');
                        @endphp
                        <div class="bor-bottom hover:bg-gray-50 flex py-1 px-2">
                            <div class="pr-2 align-top text-center w-8 flex items-center">
                                @php
                                    $rankBg = ['bg-red-600', 'bg-red-400', 'bg-red-200'];
                                    $rankText = $loop->index <= 2 ? 'text-white' : 'text-green-600';
                                @endphp
                                <span
                                    class="inline-flex items-center justify-center h-5 w-5 rounded-full {{ $rankBg[$loop->index] ?? 'bg-gray-200' }} {{ $rankText }} text-[11px] font-medium">
                                    {{ $loop->index + 1 }}
                                </span>
                            </div>
                            <div class="flex items-center flex-1 max-w-[90%] overflow-hidden">
                                <a href="/{{ $post->username }}/posts/{{ $post->post_id }}"
                                    class="truncate block w-full text-[12.7px] text-[#319528] hover:underline">
                                    {{ $post->title }}
                                </a>
                            </div>

                            <div
                                class="sm:flex items-center justify-end hidden text-right text-gray-500 text-[11px] whitespace-nowrap w-[100px] max-w-[100px]">
                                {{ $date->diffForHumans() }}</div>
                            <div
                                class="sm:flex items-center pl-2 hidden text-right text-[11px] whitespace-nowrap w-[150px] max-w-[150px]">
                                <div class="flex items-center justify-end">
                                    <a href="/{{ $post->username }}"
                                        class="text-[#319528] hover:underline truncate inline-block max-w-[150px]">
                                        {{ $post->profile_name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-1 !p-6 !px-2.5 items-center flex-col -mb-8">
        @foreach ($mainCategories as $mainCategory)
            <!-- Section -->
            <div class="max-w-[775px] w-[100%] mb-6">
                <a href="/forum/{{ $mainCategory->slug }}"
                    class="text-lg font-semibold px-4 uppercase">{{ $mainCategory->name }}</a>
                <div class="bg-white long-shadow rounded-lg mt-2">
                    @foreach ($mainCategory->subforums as $subforum)
                        <div class="flex flex-row items-center min-h-[78px] pr-2">
                            <ion-icon name="chatbubbles" class="text-[#319528] text-3xl p-4"></ion-icon>
                            <div class="flex flex-col flex-1">
                                <a href="/forum/{{ $mainCategory->slug }}/{{ $subforum->slug }}"
                                    class="text-[#319528] hover:text-[#319528] text-base font-bold w-fit">{{ $subforum->name }}</a>
                                <span class="text-sm text-gray-500">Bài viết: <span
                                        class="mr-1 font-semibold text-black">{{ $subforum->posts_count }}</span>
                                    Bình luận: <span
                                        class="text-black font-semibold">{{ $subforum->comments_count }}</span>
                                </span>
                            </div>
                            @if ($subforum->latest_post)
                                @php
                                    // Create a Carbon instance from the given datetime
                                    $date = Carbon::createFromFormat(
                                        'Y-m-d H:i:s',
                                        $subforum->latest_post->post_created_at,
                                    );

                                    // Set the locale to Vietnamese (for "1 tuần trước")
                                    Carbon::setLocale('vi');
                                @endphp
                                <div style="max-width: calc(42%);"
                                    class="flex-1 bg-[#E7FFE4] text-[13px] p-2 px-2 rounded-md flex-col hidden sm:flex border-all">
                                    <div class="flex">
                                        <span class="whitespace-nowrap mr-1">Mới nhất:</span>
                                        <a href="/{{ $subforum->latest_post->username }}/posts/{{ $subforum->latest_post->post_id }}"
                                            class="text-[#319528] hover:text-[#319528] hover:underline inline-block text-ellipsis whitespace-nowrap overflow-hidden">{{ $subforum->latest_post->title }}</a>
                                    </div>
                                    <div class="flex items-center mt-1 text-[#319528]">
                                        <a href="/{{ $subforum->latest_post->username }}"
                                            class="hover:text-[#319528] hover:underline truncate">{{ $subforum->latest_post->profile_name }}</a>
                                        @if ($subforum->latest_post->verified == 1)
                                            <ion-icon name="checkmark-circle"
                                                class="text-[15px] leading-5 ml-0.5 shrink-0"></ion-icon>
                                        @endif
                                        <span class="text-black shrink-0">, {{ $date->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="px-2.5 relative z-10 mb-4 mt-2">
        {{-- Forum stats --}}
        <div class="max-w-[775px] mx-auto bg-white p-6 rounded-lg long-shadow">
            <div class="flex flex-row items-center justify-between mb-4">
                <h2 class="text-lg font-semibold uppercase">Thống kê diễn đàn</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-[#E7FFE4] hover:bg-green-100 shadow-md rounded-lg p-4 text-center">
                    <ion-icon name="newspaper-outline" class="text-[30px] text-green-600"></ion-icon>
                    <h3 class="text-xl font-semibold">{{ $stats['postCount'] }}</h3>
                    <p class="text-gray-500">Bài viết</p>
                </div>
                <div class="bg-[#E7FFE4] hover:bg-green-100 shadow-md rounded-lg p-4 text-center">
                    <ion-icon name="chatbox-ellipses-outline" class="text-[30px] text-green-600"></ion-icon>
                    <h3 class="text-xl font-semibold">{{ $stats['commentCount'] }}</h3>
                    <p class="text-gray-500">Bình luận</p>
                </div>
                <div class="bg-[#E7FFE4] hover:bg-green-100 shadow-md rounded-lg p-4 text-center">
                    <ion-icon name="person-outline" class="text-[30px] text-green-600"></ion-icon>
                    <h3 class="text-xl font-semibold">{{ $stats['userCount'] }}</h3>
                    <p class="text-gray-500">Người dùng</p>
                </div>
            </div>
            <div class="mt-6">
                {{-- New user --}}
                <p class="text-gray-600">
                    Chúng ta cùng chào mừng thành viên mới nhất đã tham gia diễn đàn:
                    <a href="/{{ $stats['latestUser']->username }}" class="hover:underline font-bold text-green-600">
                        {{ $stats['latestUser']->profile_name }}</a>
                </p>

                <p class="text-gray-600 my-2">
                    Tổng cộng có
                    <span class="font-bold text-green-600">{{ $stats['stats']->total }}</span> người dùng trực tuyến:
                    <span class="font-semibold">{{ $stats['stats']->registered }}</span> đã đăng ký,
                    <span class="font-semibold">{{ $stats['stats']->hidden }}</span> ẩn và
                    <span class="font-semibold">{{ $stats['stats']->guests }}</span> khách
                </p>

                <p class="text-gray-600">
                    Số người dùng trực tuyến nhiều nhất là
                    <span class="font-semibold text-green-600">{{ $stats['record']->max_online ?? 0 }}</span>
                    vào
                    @php
                        $formatter = new \IntlDateFormatter(
                            'vi_VN',
                            \IntlDateFormatter::FULL,
                            \IntlDateFormatter::SHORT,
                            'Asia/Ho_Chi_Minh',
                            \IntlDateFormatter::GREGORIAN,
                            "EEEE, 'ngày' d 'tháng' M 'năm' y, hh:mm a",
                        );

                        $formattedDate = $formatter->format(strtotime($stats['record']->recorded_at));
                    @endphp
                    <span>{{ $formattedDate }}</span>
                </p>
            </div>
        </div>
    </div>
@endsection

@section('communityActive', 'nav-active')
