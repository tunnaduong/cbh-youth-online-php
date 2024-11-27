@php
    use Carbon\Carbon;
@endphp

@extends('layouts.error')

@section('content')
    @php
        // Ensure the server locale is set to Vietnamese
        setlocale(LC_TIME, 'vi_VN.UTF-8');
        putenv('LC_ALL=vi_VN.UTF-8');

        // Create a Carbon instance from the given datetime
        $joinedDate = Carbon::createFromFormat('Y-m-d H:i:s', $profile->joined_from);

        // Set the locale to Vietnamese (for "1 tuần trước")
        Carbon::setLocale('vi');
    @endphp
    <div class="bg-gray-300 w-full h-72"></div>
    <div class="bg-white w-full h-16 shadow-md">
        <div class="mx-auto max-w-[1120px] h-full flex">
            <img class="w-[170px] h-[170px] rounded-full absolute"
                style="border: 4px solid #fff; transform: translateY(-45%);"
                src="{{ !empty($profile->oauth_profile_picture) ? $profile->oauth_profile_picture : (!empty($profile->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $profile->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                alt="avatar">
            <div class="flex-1 min-w-[280px]"></div>
            <div class="flex flex-row">
                <a class="select-none cursor-pointer h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid #319527">
                    <p class="font-semibold text-sm text-slate-600">Bài viết</p>
                    <p class="font-bold text-xl text-green-600">{{ $profile->posts_count }}</p>
                </a>
                <a href="/{{ $profile->username }}/following"
                    class="select-none h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid transparent">
                    <p class="font-semibold text-sm text-slate-600">Đang theo dõi</p>
                    <p class="font-bold text-xl text-green-600">{{ $profile->total_following }}</p>
                </a>
                <a href="/{{ $profile->username }}/followers"
                    class="select-none h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid transparent">
                    <p class="font-semibold text-sm text-slate-600">Người theo dõi</p>
                    <p class="font-bold text-xl text-green-600">{{ $profile->total_followers }}</p>
                </a>
                <div class="select-none h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid transparent">
                    <p class="font-semibold text-sm text-slate-600">Thích</p>
                    <p class="font-bold text-xl text-green-600">{{ $profile->total_likes }}</p>
                </div>
                <div class="select-none h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid transparent">
                    <p class="font-semibold text-sm text-slate-600">Điểm</p>
                    <p class="font-bold text-xl text-green-600">{{ $profile->total_points }}</p>
                </div>
            </div>
            <div class="flex-1 flex justify-end items-center">
                <button type="button" {{ $_SESSION['user']->username == $profile->username ? 'disabled' : '' }}
                    {!! $_SESSION['user']->username == $profile->username
                        ? ' data-bs-placement="right" data-bs-html="true" data-bs-toggle="tooltip" data-bs-container="body" data-bs-original-title="Bạn không thể tự theo dõi chính mình"'
                        : '' !!} class="btn btn-outline-success rounded-full px-4">Theo dõi</button>
            </div>
        </div>
        <div class="mx-auto max-w-[1120px] flex">
            <div class="min-w-[280px] max-w-[322px] flex-1 !mt-10 pr-6 flex flex-col gap-y-3">
                <div>
                    <h1 class="font-bold text-xl">{{ $profile->profile_name }}</h1>
                    <p class="text-sm text-gray-500"><span>@</span>{{ $profile->username }}</p>
                </div>
                <p>{{ $profile->bio }}</p>
                <div class="flex flex-col gap-y-2">
                    @if (!empty($profile->location))
                        <div class="flex items-center -ml-0.5 gap-x-1 text-gray-500">
                            <ion-icon name="location-outline" class="text-lg"></ion-icon>
                            <span class="text-sm">{{ $profile->location }}</span>
                        </div>
                    @endif
                    @if (!empty($profile->birthday))
                        <div class="flex items-center -ml-0.5 gap-x-1 text-gray-500">
                            <ion-icon name="gift-outline" class="text-lg"></ion-icon>
                            <span class="text-sm">Sinh ngày
                                {{ (function () use ($profile) {$fmt = new IntlDateFormatter('vi_VN', IntlDateFormatter::LONG, IntlDateFormatter::NONE);$fmt->setPattern("d 'Tháng' M yyyy");return $fmt->format(new DateTime($profile->birthday));})() }}</span>
                        </div>
                    @endif
                    <div class="flex items-center -ml-0.5 gap-x-1 text-gray-500">
                        <ion-icon name="calendar-outline" class="text-lg"></ion-icon>
                        <span class="text-sm">Đã tham gia
                            {{ (function () use ($profile) {$fmt = new IntlDateFormatter('vi_VN', IntlDateFormatter::LONG, IntlDateFormatter::NONE);$fmt->setPattern("'Tháng' M yyyy");return $fmt->format(new DateTime($profile->joined_from));})() }}</span>
                    </div>
                </div>
            </div>
            <div class="flex-1"></div>
        </div>
    </div>
@endsection
