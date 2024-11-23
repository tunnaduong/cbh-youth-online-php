@extends('layouts.error')

@section('content')
    <div class="flex flex-1 items-center justify-center"
        style="zoom:1.4;display:block;position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%, -50%);transform:translate(-50%, -50%)">
        <center><img alt="Email verification success" width="170" height="170"
                src="/assets/images/email-verification-success.svg">
            <h4 class="font-bold text-gray-500 text-[14px]">Xác minh địa chỉ email thành công!</h4>
            <p class="text-[12px] text-gray-500">Email của bạn đã được xác minh thành công. Bây giờ bạn có<br>thể tận hưởng
                quyền truy cập đầy đủ vào tất cả các tính năng.</p>
            <button onclick="window.location.href='/'"
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 shadow bg-[#319528] hover:bg-green-700 text-white text-[12px] font-semibold rounded-[5px] py-[5px] px-6 mt-3 h-7">Đi
                tới Bảng tin</button>
        </center>
    </div>
@endsection
