@extends('layouts.home', ['title' => 'Loa lớn', 'recordings' => true])

@section('content')
    <div class="flex flex-1 !p-6 !px-2.5 pt-2 items-center flex-col">
        <!-- Recordings -->
        @foreach ($recordings as $recording)
            <div
                class="max-w-[775px] w-full long-shadow mb-4 flex flex-row rounded-lg overflow-hidden bg-white dark:!bg-[var(--main-white)]">
                <a href="/recordings/{{ $recording->id }}" class="flex items-center justify-center mr-3 shrink-0">
                    <img src="{{ isset($recording->preview_path) ? 'https://api.chuyenbienhoa.com/storage/' . $recording->preview_path : '/assets/images/soundwaves.png' }}"
                        alt="{{ $recording->title }}" class="w-24 h-24">
                    <img class="absolute w-9" src="/assets/images/play.png" alt="Play button">
                </a>
                <div class="flex flex-col flex-1">
                    <div class="flex flex-row flex-1 items-center mt-[2px]">
                        <a class="flex-1" href="/recordings/{{ $recording->id }}">
                            <h1 class="font-semibold text-xl max-w-[510px] truncate">{{ $recording->title }}</h1>
                        </a>
                        <span class="text-sm mr-3 text-gray-500">{{ $recording->audio_length }}</span>
                    </div>
                    <div class="flex flex-1 items-center text-[13px] text-gray-500">
                        <a href="/{{ $recording->username }}">
                            <img src="{{ !empty($recording->oauth_profile_picture) ? $recording->oauth_profile_picture : (!empty($recording->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $recording->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                                alt="{{ $recording->username }} avatar" class="mr-1.5 w-7 h-7 rounded-full border">
                        </a>
                        <span>Đăng bởi <a href="/{{ $recording->username }}"
                                class="font-semibold text-[#319527] hover:text-[#319527] hover:underline">{{ $recording->profile_name }}</a>
                        </span>
                        <span class="mx-0.5 text-sm text-gray-500">·
                        </span>
                        <span>2 ngày trước</span>
                        <div class="flex items-center flex-1 flex-row-reverse mr-2.5">
                            <span>46</span>
                            <ion-icon class="text-xl mr-1 ml-2" name="eye-outline"></ion-icon>
                            <a class="flex items-center flex-row-reverse" href="/recordings/{{ $recording->id }}">
                                <span>05+</span>
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
