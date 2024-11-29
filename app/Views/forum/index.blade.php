@php
    use Carbon\Carbon;
@endphp

@extends('layouts.forum')

@section('content')
    <div class="flex flex-1 !p-6 items-center flex-col">
        @foreach ($mainCategories as $mainCategory)
            <!-- Section 1 -->
            <div class="max-w-[679px] w-[100%] mb-6">
                <p class="text-lg font-semibold px-4 mb-2 uppercase">{{ $mainCategory->name }}</p>
                <div class="bg-white long-shadow rounded-lg">
                    @foreach ($mainCategory->subforums as $subforum)
                        <div class="flex flex-row items-center min-h-[78px]">
                            <ion-icon name="chatbubbles" class="text-[#319528] text-3xl p-4"></ion-icon>
                            <div class="flex flex-col flex-1">
                                <a href="/forum/{{ $mainCategory->id }}/sub/{{ $subforum->id }}"
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
                                    class="flex-1 bg-[#E7FFE4] text-[13px] p-2 px-2 mr-2 rounded-md flex flex-col">
                                    <div class="flex">
                                        <span class="whitespace-nowrap mr-1">Mới nhất:</span>
                                        <a href="/{{ $subforum->latest_post->username }}/posts/{{ $subforum->latest_post->post_id }}"
                                            class="text-[#319528] hover:text-[#319528] hover:underline inline-block text-ellipsis whitespace-nowrap overflow-hidden">{{ $subforum->latest_post->title }}</a>
                                    </div>
                                    <div class="flex items-center mt-1 text-[#319528]">
                                        <a href="/{{ $subforum->latest_post->username }}"
                                            class="hover:text-[#319528] hover:underline">{{ $subforum->latest_post->profile_name }}</a>
                                        @if ($subforum->latest_post->verified == 1)
                                            <ion-icon name="checkmark-circle"
                                                class="text-[15px] leading-5 ml-0.5"></ion-icon>
                                        @endif
                                        <span class="text-black">, {{ $date->diffForHumans() }}</span>

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
