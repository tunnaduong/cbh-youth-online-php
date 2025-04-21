@php
    use Carbon\Carbon;
@endphp

@extends('layouts.home', ['title' => 'Diễn đàn', 'forum' => true])

@section('menu-label', 'Diễn đàn')

@section('content')

    @include('includes.topBar')

    <div class="mx-auto max-w-[775px] pt-4 hidden">

        <div class="border rounded bg-white">
            <div class="flex flex-wrap items-stretch">
                <a href="#" class="px-4 text-sm flex items-center hover:bg-gray-100 tab-button-active">
                    <span class="py-2">Bài mới</span>
                </a>
                <a href="#" class="px-4 text-sm flex items-center bor-right bor-left hover:bg-gray-100 tab-button">
                    <span class="py-2">Chủ đề xem nhiều</span>
                </a>
                <div class="ml-auto flex">
                    <button class="h-9 w-9 border-l flex items-center justify-center tab-button">
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
            <table class="w-full">
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 pl-3 pr-2 align-top text-center w-8">
                            <span
                                class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-red-600 text-white text-xs font-medium">
                                1
                            </span>
                        </td>
                        <td class="py-3 pr-2">
                            <a href="#" class="text-blue-600 hover:underline">
                                Thông tư 24/2024: Những cập nhật quan trọng kế toán HCSN cần nắm vững
                            </a>
                        </td>
                        <td class="py-3 pr-2 text-right text-gray-500 text-sm whitespace-nowrap">57 phút trước</td>
                        <td class="py-3 pr-3 text-right text-sm whitespace-nowrap">
                            <a href="#" class="text-blue-600 hover:underline">
                                Tổ chức giáo dục NOTE EDU
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                                    Bình luận: <span class="text-black font-semibold">{{ $subforum->comments_count }}</span>
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
@endsection

@section('communityActive', 'nav-active')
