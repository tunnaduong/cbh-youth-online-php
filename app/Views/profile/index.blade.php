@extends('layouts.error')

@section('content')
    <div class="bg-slate-400 w-full h-72">
    </div>
    <div class="bg-white w-full h-16 shadow-md">
        <div class="mx-auto max-w-[1120px] h-full flex">
            <img class="w-[170px] h-[170px] rounded-full absolute"
                style="border: 4px solid #fff; transform: translateY(-45%);"
                src="{{ !empty($profile->oauth_profile_picture) ? $profile->oauth_profile_picture : (!empty($profile->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $profile->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                alt="avatar">
            <div class="flex-1 min-w-[280px]"></div>
            <div class="flex flex-row">
                <div class="h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid #319527">
                    <p class="font-semibold text-sm text-slate-600">Bài viết</p>
                    <p class="font-bold text-xl text-green-600">35</p>
                </div>
                <div class="h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid transparent">
                    <p class="font-semibold text-sm text-slate-600">Đang theo dõi</p>
                    <p class="font-bold text-xl text-green-600">7</p>
                </div>
                <div class="h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid transparent">
                    <p class="font-semibold text-sm text-slate-600">Người theo dõi</p>
                    <p class="font-bold text-xl text-green-600">3</p>
                </div>
                <div class="h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid transparent">
                    <p class="font-semibold text-sm text-slate-600">Thích</p>
                    <p class="font-bold text-xl text-green-600">13</p>
                </div>
                <div class="h-full flex flex-col items-center justify-center px-3 box-border min-w-max"
                    style="border-bottom: 3px solid transparent">
                    <p class="font-semibold text-sm text-slate-600">Điểm</p>
                    <p class="font-bold text-xl text-green-600">63</p>
                </div>
            </div>
            <div class="flex-1 flex justify-end items-center">
                <button type="button" class="btn btn-outline-success rounded-full px-4">Theo dõi</button>
            </div>
        </div>
        <div class="mx-auto max-w-[800px]">
        </div>
    </div>
@endsection
