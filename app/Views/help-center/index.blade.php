@extends('layouts.helpCenter', ['title' => 'Trung tâm trợ giúp', 'active' => 0])

@section('menu-label', 'Trung tâm trợ giúp')

@section('content')
    @include('includes.topBar')
    <div class="container-main mt-14 px-3">
        <h1 class="fs-4 fw-bold">Chúng tôi có thể giúp gì cho bạn?</h1>
        <form action="/help/search" method="GET">
            <input type="text" name="query"
                class="w-[100%] dark:bg-[var(--main-white)] p-3 mt-3 rounded-xl border-[#ECECEC] text-base"
                placeholder="Tìm kiếm bài viết trợ giúp...">
        </form>
        <h2 class="text-[20px] font-semibold !mt-10 mb-3">Chủ đề phổ biến</h2>
        <div class="flex flex-wrap gap-y-3">
            <div class="w-full md:w-1/3 px-1.5">
                <a href="/help/1"
                    class="flex flex-col justify-center bg-[#eaebec] dark:bg-[var(--main-white)] dark:hover:bg-neutral-700 rounded-lg p-3 hover:bg-[#e1e2e3]">
                    <div class="flex items-center justify-center">
                        <img src="/assets/images/help_account.png" width="100" height="100" alt="Tài khoản">
                    </div>
                    <div class="mt-4">
                        <h3 class="text-[15px] font-semibold mb-1">Cài đặt tài khoản</h3>
                        <p class="text-[12px] text-gray-500">Điều chỉnh cài đặt, quản lý thông báo, tìm hiểu về thay đổi tên
                            và
                            các nội dung
                            khác.</p>
                    </div>
                </a>
            </div>
            <div class="w-full md:w-1/3 px-1.5">
                <a href="/help/2"
                    class="flex flex-col justify-center bg-[#eaebec] dark:bg-[var(--main-white)] dark:hover:bg-neutral-700 rounded-lg p-3 hover:bg-[#e1e2e3]">
                    <div class="flex items-center justify-center">
                        <img src="/assets/images/help_login.png" width="100" height="100" alt="Tài khoản">
                    </div>
                    <div class="mt-4">
                        <h3 class="text-[15px] font-semibold mb-1">Đăng nhập và mật khẩu</h3>
                        <p class="text-[12px] text-gray-500">Khắc phục sự cố khi đăng nhập và tìm hiểu cách thay đổi hoặc
                            đặt
                            lại mật khẩu.</p>
                    </div>
                </a>
            </div>
            <div class="w-full md:w-1/3 px-1.5">
                <a href="/help/3"
                    class="flex flex-col justify-center bg-[#eaebec] dark:bg-[var(--main-white)] dark:hover:bg-neutral-700 rounded-lg p-3 hover:bg-[#e1e2e3]">
                    <div class="flex items-center justify-center">
                        <img src="/assets/images/help_privacy.png" width="100" height="100" alt="Tài khoản">
                    </div>
                    <div class="mt-4">
                        <h3 class="text-[15px] font-semibold mb-1">Quyền riêng tư và bảo mật</h3>
                        <p class="text-[12px] text-gray-500">Kiểm soát đối tượng có thể nhìn thấy nội dung bạn chia sẻ và
                            gia
                            tăng mức độ bảo vệ tài khoản.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
