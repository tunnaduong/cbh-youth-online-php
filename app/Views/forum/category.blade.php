@php
    use Carbon\Carbon;
@endphp

@extends('layouts.home', ['title' => $mainCategory->name, 'forum' => true, 'description' => $mainCategory->description])

@section('content')
@section('menu-label', 'Diễn đàn')

    @include('includes.topBar')

    <div class="flex flex-1 !p-6 !px-2.5 items-center flex-col -mb-8">
        <div class="max-w-[775px] w-[100%] mb-6">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb px-1.5">
                    <li class="breadcrumb-item"><a href="/" class=" flex items-center">Diễn đàn</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a
                            href="/forum/{{ $mainCategory->slug }}">{{ $mainCategory->name }}</a>
                    </li>
                </ol>
            </nav>
            <div
                class="bg-white dark:!bg-[var(--main-white)] long-shadow rounded-lg mt-2 p-4 relative z-10 overflow-hidden">
                <div>
                    <div class="w-[50%] absolute h-full mb-4 top-0 right-0 -z-10"
                        style="background-image: url('/assets/images/{{ $mainCategory->background_image }}'); background-size: cover; background-position: center;">
                    </div>
                    <div class="fade-to-left"></div>
                </div>
                <a href="/forum/{{ $mainCategory->slug }}"
                    class="text-lg font-semibold uppercase">{{ $mainCategory->name }}</a>
                <p class="!mt-3 text-base">{{ $mainCategory->description }}</p>
            </div>
            <div class="bg-white dark:!bg-[var(--main-white)] long-shadow rounded-lg !mt-5">
                @foreach ($subforums as $subforum)
                        <div class="flex flex-row items-center min-h-[78px] pr-2">
                            <ion-icon name="chatbubbles" class="text-[#319528] text-3xl p-4"></ion-icon>
                            <div class="flex flex-col flex-1">
                                <a href="/forum/{{ $mainCategory->slug }}/{{ $subforum->slug }}"
                                    class="text-[#319528] hover:text-[#319528] text-base font-bold w-fit">{{ $subforum->name }}</a>
                                <span class="text-sm text-gray-500">Bài viết: <span
                                        class="mr-1 font-semibold text-black dark:!text-[#f3f4f6]">{{ $subforum->posts_count }}</span>
                                    Bình luận: <span
                                        class="text-black dark:!text-[#f3f4f6] font-semibold">{{ $subforum->comments_count }}</span>
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
                                            class="flex-1 bg-[#E7FFE4] dark:!bg-[#2b2d2c] dark:!border-[#545454] text-[13px] p-2 px-2 rounded-md flex-col hidden sm:flex border-all">
                                            <div class="flex">
                                                <span class="whitespace-nowrap mr-1">Mới nhất:</span>
                                                <a href="/{{ $subforum->latest_post->username }}/posts/{{ $subforum->latest_post->post_id }}"
                                                    class="text-[#319528] hover:text-[#319528] hover:underline inline-block text-ellipsis whitespace-nowrap overflow-hidden">{{ $subforum->latest_post->title }}</a>
                                            </div>
                                            <div class="flex items-center mt-1 text-[#319528]">
                                                <a href="/{{ $subforum->latest_post->username }}"
                                                    class="hover:text-[#319528] hover:underline truncate">{{ $subforum->latest_post->profile_name }}</a>
                                                @if ($subforum->latest_post->verified == 1)
                                                    <ion-icon name="checkmark-circle" class="text-[15px] leading-5 ml-0.5 shrink-0"></ion-icon>
                                                @endif
                                                <span class="text-black shrink-0 dark:!text-[#f3f4f6]">, {{ $date->diffForHumans() }}</span>
                                            </div>
                                        </div>
                            @endif
                        </div>
                        @if (!$loop->last)
                            <hr>
                        @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('communityActive', 'nav-active')