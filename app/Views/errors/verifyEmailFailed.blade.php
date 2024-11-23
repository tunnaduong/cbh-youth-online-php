@extends('layouts.error')

@section('content')
    <div class="flex flex-1 items-center justify-center"
        style="zoom:1.4;display:block;position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%, -50%);transform:translate(-50%, -50%)">
        <center><img alt="Email verification error" width="170" height="170" src="/assets/images/error.svg">
            <h4 class="font-bold text-gray-500 text-[14px] !mt-3">Không thể xác minh địa chỉ email</h4>
            <p class="text-[12px] text-gray-500">Lỗi này thường do bạn đã xác minh địa chỉ email rồi hoặc<br>liên kết xác
                minh đã hết hạn. Vui lòng kiểm tra lại và thử lại sau.</p>
            <button onclick="window.location.href='/'"
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 shadow bg-[#319528] hover:bg-green-700 text-white text-[12px] font-semibold rounded-[5px] py-[5px] px-6 mt-3 h-7">Đi
                tới Bảng tin</button>
        </center>
    </div>
@endsection
