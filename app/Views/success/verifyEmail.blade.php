@extends('layouts.error')

@section('content')
    <div class="flex flex-1 items-center justify-center w-full px-3"
        style="display:block;position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%, -50%);transform:translate(-50%, -50%)">
        <center>
            <img src="/assets/images/email-verification-success.svg" alt="Email verification success"
                class="w-[170px] h-[170px] mb-2">
            <h4 class="font-bold text-gray-500 text-lg">Xác minh địa chỉ email thành công!</h4>
            <p class="text-base text-gray-500 max-w-[450px]">Email của bạn đã được xác minh thành công. Bây giờ bạn có thể
                tận hưởng
                quyền truy cập đầy đủ vào tất cả các tính năng.</p>
            <button onclick="window.location.href='/'"
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 shadow bg-[#319528] hover:bg-green-700 text-white text-base font-semibold rounded-lg !py-5 px-9 mt-3 h-7">Đi
                tới Bảng tin</button><br>
            <div onclick="window.history.back()"
                class="text-[#319528] cursor-pointer text-base mt-2 inline-block font-semibold">Quay lại</div>
        </center>
    </div>
@endsection
