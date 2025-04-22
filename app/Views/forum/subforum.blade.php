@php
    use Carbon\Carbon;
@endphp

@extends('layouts.home', ['title' => $subforum->name, 'description' => $subforum->description, 'forum' => true])

@section('content')
@section('menu-label', 'Diễn đàn')

@include('includes.topBar')

<div class="flex flex-1 !p-6 !px-2.5 items-center flex-col -mb-4">
    <div class="max-w-[775px] w-full">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb px-1.5">
                <li class="breadcrumb-item"><a href="/forum" class=" flex items-center">Diễn đàn</a></li>
                <li class="breadcrumb-item"><a href="/forum/{{ $mainCategory->slug }}">{{ $mainCategory->name }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $subforum->name }}</li>
            </ol>
        </nav>

        <!-- Forum Header -->
        <div class="w-full mb-6">
            <div class="bg-white long-shadow rounded-lg mt-2 p-4">
                <a href="/forum/{{ $mainCategory->slug }}/{{ $subforum->slug }}"
                    class="text-lg font-semibold uppercase">{{ $subforum->name }}</a>
                <p class="!mt-3 text-base">{{ $subforum->description }}</p>
            </div>
        </div>

        <!-- Pagination Top -->
        {{-- <div class="flex items-center justify-between mb-4">
            <span class="text-sm text-gray-600">Trang 1 / 17345</span>
            <nav aria-label="Page navigation" class="inline-flex">
                <ul class="pagination mb-0">
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">Sau ›</a></li>
                </ul>
            </nav>
        </div> --}}

        <!-- Forum Topics Table -->
        <div class="bg-white rounded-lg long-shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="!p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu
                            đề</th>
                        <th
                            class="!p-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell min-w-[75px]">
                            Trả
                            lời</th>
                        <th
                            class="!p-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                            Xem
                        </th>
                        <th
                            class="sm:!p-3 pr-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[115px] max-w-[200px]">
                            Bài
                            viết cuối</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @if (count($posts) == 0)
                        <tr>
                            <td class="!p-3 text-center" colspan="4">Không có bài viết nào trong diễn đàn này.</td>
                        </tr>
                    @endif
                    @foreach ($posts as $post)
                        @php
                            // Create a Carbon instance from the given datetime
                            $date = Carbon::createFromFormat('Y-m-d H:i:s', $post->post_created_at);
                            // Determine if the date is today or yesterday
                            if ($date->isToday()) {
                                $formattedDate = $date->translatedFormat('H:i') . ' hôm nay';
                            } elseif ($date->isYesterday()) {
                                $formattedDate = $date->translatedFormat('H:i') . ' hôm qua';
                            } else {
                                $formattedDate = $date->translatedFormat('d/m/y'); // Day/Month/2-digit year
                            }

                            if (!empty($post->latest_comment)) {
                                $commentDate = Carbon::createFromFormat(
                                    'Y-m-d H:i:s',
                                    $post->latest_comment->comment_created_at,
                                );
                            } else {
                                $commentDate = Carbon::createFromFormat('Y-m-d H:i:s', $post->post_created_at);
                            }

                            // Set the locale to Vietnamese (for "1 tuần trước")
                            Carbon::setLocale('vi');
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="!p-3 max-w-96 responsive-td">
                                <div class="flex items-center">
                                    <div class="flex gap-y-2 flex-col flex-1">
                                        <div class="text-sm font-medium">
                                            <a href="/{{ $post->username }}/posts/{{ $post->post_id }}"
                                                class="text-green-600 hover:text-green-800">{{ $post->title }}</a>
                                        </div>
                                        <div class="text-sm text-gray-500 flex gap-x-2 items-center">
                                            <a class="flex items-center gap-x-2" href="/{{ $post->username }}">
                                                <img class="h-6 w-6 rounded-full border"
                                                    src="{{ !empty($post->oauth_profile_picture) ? $post->oauth_profile_picture : (!empty($post->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $post->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                                                    alt="Avatar">
                                                {{ $post->profile_name }}
                                                @if ($post->verified == 1)
                                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                        viewBox="0 0 20 20" aria-hidden="true"
                                                        class="text-base leading-5 -ml-1.5 text-green-600"
                                                        height="1em" width="1em"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                @endif
                                            </a>
                                            <span class="-ml-1"> · {{ $formattedDate }}</span>
                                        </div>
                                        <div class="text-sm text-gray-500 flex sm:hidden">
                                            <div class="flex-1">
                                                Trả lời: <span class="text-black">{{ $post->comments_count }}</span> ·
                                                Xem: <span class="text-black">{{ $post->views_count }}</span>
                                            </div>
                                            @if (!empty($post->latest_comment))
                                                <div>{{ $commentDate->diffForHumans() }}</div>
                                            @else
                                                <div>{{ $date->diffForHumans() }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="!p-3 text-center text-sm text-gray-500 hidden sm:table-cell">
                                {{ $post->comments_count }}</td>
                            <td class="!p-3 text-center text-sm text-gray-500 hidden sm:table-cell">
                                {{ $post->views_count }}</td>
                            <td class="!p-3 text-right text-sm text-gray-500 hidden sm:table-cell">
                                @if (!empty($post->latest_comment))
                                    <a href="/{{ $post->latest_comment->username }}"
                                        class="hidden sm:inline"><span>@</span>{{ $post->latest_comment->username }}</a>
                                    <div>{{ $commentDate->diffForHumans() }}</div>
                                @else
                                    <a href="/{{ $post->username }}"
                                        class="hidden sm:inline"><span>@</span>{{ $post->username }}</a>
                                    <div>{{ $date->diffForHumans() }}</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('communityActive', 'nav-active')
