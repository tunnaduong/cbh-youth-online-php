@extends('layouts.home')

@section('content')
    <div class="flex flex-col items-center w-full flex-1 p-2 pt-3">
        <div data-post-id="213012" class="w-full mb-5 shadow-lg rounded-xl !p-6 bg-white flex flex-row md:max-w-[679px]">
            <div class="min-w-[84px] items-center mt-1 flex-col flex ml-[-20px] text-[13px] font-semibold text-gray-400">
                <ion-icon name="arrow-up-outline" class="text-3xl cursor-pointer"></ion-icon>
                <span class="select-none text-lg">3</span>
                <ion-icon name="arrow-down-outline" class="text-3xl cursor-pointer"></ion-icon>
                <div
                    class="bg-[#EAEAEA] cursor-pointer rounded-lg w-[33.6px] h-[33.6px] mt-3 flex items-center justify-center">
                    <ion-icon name="bookmark" class="text-gray-400 text-xl"></ion-icon>
                </div>
            </div>
            <div class="flex-1 overflow-hidden break-words"><a href="/tunnaduong/posts/213012">
                    <h1 class="text-xl font-semibold mb-1 max-w-[600px] truncate">
                        Công
                        cụ lấy điểm thi tự động hanam.edu.vn đã ra mắt!</h1>
                </a>
                <div class="text-base max-w-[600px] overflow-wrap">
                    <div>Công cụ lấy điểm Sở GD&amp;ĐT Tỉnh Hà Nam đã ra mắt!<br>
                        Mời các bạn, các em học sinh dùng thử và cho vài dòng cảm nghĩ 😊<br>
                        <br>
                        Link: https://diemthi.tunnaduong.com
                    </div>
                </div>
                <div class="rounded-md bg-[#E4EEE3] border overflow-hidden !mt-4 max-h-96 flex items-center justify-center">
                    <img alt="Ảnh bài viết" width="700" height="700" decoding="async" data-nimg="1"
                        class="object-contain max-h-96 text-[11px]"
                        src="https://api.chuyenbienhoa.com/storage/images/1730457490_image.jpg" style="color: transparent;">
                </div>
                <hr class="!my-5 border-t-2">
                <div class="flex-row flex text-[13px] items-center"><a href="/tunnaduong"><span
                            class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
                            <img class="aspect-square h-full w-full" alt="tunnaduong avatar"
                                src="https://api.chuyenbienhoa.com/v1.0/users/tunnaduong/avatar">
                        </span>
                    </a>
                    <span class="text-gray-500 hidden md:block ml-2">Đăng bởi</span>
                    <a class="ml-2 md:ml-1 text-[#319527] hover:text-[#319527] font-bold" href="/tunnaduong">Tùng A
                        Dính</a>
                    <span class="mb-2 ml-0.5 text-sm text-gray-500">.</span>
                    <span class="ml-0.5 text-gray-500">1
                        tuần
                        trước</span>
                    <div class="flex flex-1 flex-row-reverse items-center text-gray-500">
                        <span>381</span>
                        <ion-icon class="text-xl mr-1 ml-2" name="eye-outline"></ion-icon>
                        <a class="flex flex-row-reverse items-center" href="/tunnaduong/posts/213012">
                            <span>15+</span>
                            <ion-icon class="text-xl mr-1" name="chatbox-outline"></ion-icon>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('communityActive', 'nav-active')
