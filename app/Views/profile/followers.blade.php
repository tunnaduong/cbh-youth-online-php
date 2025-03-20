@php
    use Carbon\Carbon;
    use Michelf\MarkdownExtra;

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

@extends('layouts.error')

@section('content')
    @php
        // Create a Carbon instance from the given datetime
        $joinedDate = Carbon::createFromFormat('Y-m-d H:i:s', $profile->joined_from);

        // Set the locale to Vietnamese (for "1 tuần trước")
        Carbon::setLocale('vi');
    @endphp
    <div class="relative h-min lg:h-56 overflow-hidden px-2.5 py-8">
        <div style="background-image: url({{ !empty($profile->oauth_profile_picture) ? $profile->oauth_profile_picture : (!empty($profile->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $profile->username . '/avatar' : '/assets/images/placeholder-user.jpg') }})"
            class="bg-gray-300 w-full h-[450px] lg:h-56 blur-effect"></div>
        <div class="lg:hidden flex flex-col items-center gap-y-2 relative z-10">
            <a
                href="{{ !empty($profile->oauth_profile_picture) ? $profile->oauth_profile_picture : (!empty($profile->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $profile->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}">
                <img class="w-32 h-32 rounded-full" style="border: 4px solid #eeeeee;"
                    src="{{ !empty($profile->oauth_profile_picture) ? $profile->oauth_profile_picture : (!empty($profile->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $profile->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                    alt="avatar">
            </a>
            <div class="flex flex-col items-center">
                <h1 class="font-bold text-xl mt-2">
                    <span>{{ $profile->profile_name }}
                        @if ($profile->verified == 1)
                            <span>
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                    aria-hidden="true" class="relative inline shrink-0 text-xl leading-5 text-green-600"
                                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        @endif
                    </span>
                </h1>
                <p class="text-sm text-gray-500"><span>@</span>{{ $profile->username }}</p>
            </div>
            <div class="flex flex-col items-center gap-y-1 !px-6">
                <div class="flex flex-wrap justify-center gap-y-1 px-3">
                    <div class="px-3">
                        <span class="text-gray-500">Bài đã đăng: </span>
                        <span class="font-bold">{{ $profile->posts_count }}</span>
                    </div>
                    <div class="px-3">
                        <span class="text-gray-500">Điểm: </span>
                        <span class="font-bold">{{ $profile->total_points }}</span>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center gap-y-1">
                    <a href="/{{ $profile->username }}/following" class="px-3">
                        <span class="text-gray-500">Đang theo dõi: </span>
                        <span class="font-bold">{{ $profile->total_following }}</span>
                    </a>
                    <a href="/{{ $profile->username }}/followers" class="px-3">
                        <span class="text-gray-500">Người theo dõi: </span>
                        <span class="font-bold follower_count">{{ $profile->total_followers }}</span>
                    </a>
                    <div class="px-3">
                        <span class="text-gray-500">Lượt like: </span>
                        <span class="font-bold">{{ $profile->total_likes }}</span>
                    </div>
                </div>
            </div>
            <p class="text-center">{{ $profile->bio }}</p>
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
                        <span class="text-sm">Sinh vào
                            {{ (function () use ($profile) {$fmt = new IntlDateFormatter('vi_VN', IntlDateFormatter::LONG, IntlDateFormatter::NONE);$fmt->setPattern("d 'Tháng' M yyyy");return $fmt->format(new DateTime($profile->birthday));})() }}</span>
                    </div>
                @endif
                <div class="flex items-center -ml-0.5 gap-x-1 text-gray-500">
                    <ion-icon name="calendar-outline" class="text-lg"></ion-icon>
                    <span class="text-sm">Đã tham gia
                        {{ (function () use ($profile) {$fmt = new IntlDateFormatter('vi_VN', IntlDateFormatter::LONG, IntlDateFormatter::NONE);$fmt->setPattern("'Tháng' M yyyy");return $fmt->format(new DateTime($profile->joined_from));})() }}</span>
                </div>
            </div>
            <div class="flex-1 flex justify-end items-center mt-3">
                @if (($_SESSION['user']->username ?? null) == $profile->username)
                    <a href="/{{ $profile->username }}/settings" class="btn btn-outline-secondary rounded-full px-4"><i
                            class="bi bi-gear-fill"></i> Sửa
                        hồ sơ</a>
                @else
                    @if ($profile->followed == 0)
                        <button type="button" onclick="toggleFollow({{ $profile->uid }})"
                            class="followBtn btn btn-outline-success rounded-full px-4 hover:bg-green-600 border-green-600 hover:border-green-600 text-green-600">Theo
                            dõi</button>
                    @else
                        <button type="button" onclick="toggleFollow({{ $profile->uid }})"
                            class="followBtn btn btn-success rounded-full px-4 bg-green-600 border-green-600 hover:border-green-600">Đang
                            theo
                            dõi</button>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <div class="lg:bg-white h-16 lg:shadow-md">
        <div class="mx-auto max-w-[959px] h-full lg:flex hidden">
            <a
                href="{{ !empty($profile->oauth_profile_picture) ? $profile->oauth_profile_picture : (!empty($profile->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $profile->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}">
                <img class="w-[170px] h-[170px] rounded-full absolute"
                    style="border: 4px solid #eeeeee; transform: translateY(-45%);"
                    src="{{ !empty($profile->oauth_profile_picture) ? $profile->oauth_profile_picture : (!empty($profile->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $profile->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                    alt="avatar">
            </a>
            <div class="flex-1 min-w-[280px]"></div>
            <div class="flex flex-row">
                <a href="/{{ $profile->username }}"
                    class="select-none h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid transparent">
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
                    style="border-bottom: 3px solid #319527">
                    <p class="font-semibold text-sm text-slate-600">Người theo dõi</p>
                    <p class="font-bold text-xl text-green-600 follower_count">{{ $profile->total_followers }}</p>
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
                @if (($_SESSION['user']->username ?? null) == $profile->username)
                    <a href="/{{ $profile->username }}/settings" class="btn btn-outline-secondary rounded-full px-4"><i
                            class="bi bi-gear-fill"></i> Sửa
                        hồ sơ</a>
                @else
                    @if ($profile->followed == 0)
                        <button type="button" onclick="toggleFollow({{ $profile->uid }})"
                            class="followBtn btn btn-outline-success rounded-full px-4 hover:bg-green-600 border-green-600 hover:border-green-600 text-green-600">Theo
                            dõi</button>
                    @else
                        <button type="button" onclick="toggleFollow({{ $profile->uid }})"
                            class="followBtn btn btn-success rounded-full px-4 bg-green-600 border-green-600 hover:border-green-600">Đang
                            theo
                            dõi</button>
                    @endif
                @endif
            </div>
        </div>
        <div class="mx-auto max-w-[959px] flex">
            <div class="max-w-[280px] flex-1 !mt-10 pr-6 hidden lg:flex flex-col gap-y-3">
                <div>
                    <h1 class="font-bold text-xl">
                        <span>{{ $profile->profile_name }}
                            @if ($profile->verified == 1)
                                <span>
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                        aria-hidden="true"
                                        class="relative inline shrink-0 text-xl leading-5 text-green-600" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            @endif
                        </span>
                    </h1>
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
                            <span class="text-sm">Sinh vào
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
            <div class="flex-1 !my-6 !px-3 md:!px-0 flex flex-col bg-white rounded-xl max-h-fit">
                @foreach ($followers as $follow)
                    <div class="px-3 py-2">
                        <div class="flex items-center gap-x-3">
                            <a class="flex-1 flex items-center gap-x-3" href="/{{ $follow->username }}">
                                <img class="w-16 h-16 rounded-full border"
                                    src="{{ !empty($follow->oauth_profile_picture) ? $follow->oauth_profile_picture : (!empty($follow->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $follow->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                                    alt="avatar">
                                <div>
                                    <h2 class="font-bold">{{ $follow->profile_name }}
                                        @if ($follow->verified == 1)
                                            <span>
                                                <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                    viewBox="0 0 20 20" aria-hidden="true"
                                                    class="relative inline shrink-0 text-xl text-green-600 -mt-1"
                                                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd"></path>
                                                </svg> </span>
                                        @endif
                                    </h2>
                                    <p class="text-gray-500"><span>@</span>{{ $follow->username }}</p>
                                </div>
                            </a>
                            <div>
                                @if (($_SESSION['user']->username ?? null) != $follow->username)
                                    @if ($follow->followed == 0)
                                        <button type="button" data-follow-uid="{{ $follow->uid }}"
                                            class="followBtns btn btn-outline-success rounded-full px-4 hover:bg-green-600 border-green-600 hover:border-green-600 text-green-600">Theo
                                            dõi</button>
                                    @else
                                        <button type="button" data-follow-uid="{{ $follow->uid }}"
                                            class="followBtns btn btn-success rounded-full px-4 bg-green-600 border-green-600 hover:border-green-600">Đang
                                            theo
                                            dõi</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
