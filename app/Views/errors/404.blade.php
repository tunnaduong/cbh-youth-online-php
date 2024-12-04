@php
    http_response_code(404);
@endphp

@extends('layouts.error')

@section('content')
    <div class="flex flex-1 items-center justify-center w-full px-3"
        style="display:block;position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%, -50%);transform:translate(-50%, -50%)">
        <center>
            <img src="/assets/images/404.svg" alt="404" class="w-[120px] h-[120px] mb-2" id="error-404">
            <h4 class="font-bold text-gray-500 text-lg">Bạn hiện không xem được nội dung này</h4>
            <p class="text-base text-gray-500 max-w-[450px]">Lỗi này thường do chủ sở hữu chỉ chia sẻ nội dung với một nhóm
                nhỏ,
                thay
                đổi người được xem hoặc đã xóa nội dung.</p>
            <button onclick="window.location.href='/'"
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 shadow bg-[#319528] hover:bg-green-700 text-white text-base font-semibold rounded-lg !py-5 px-9 mt-3 h-7">Đi
                tới Bảng tin</button><br>
            <div onclick="window.history.back()"
                class="text-[#319528] cursor-pointer text-base mt-2 inline-block font-semibold">Quay lại</div>
        </center>
    </div>
    <script>
        console.error("Error from PHP: {!! $error !!}");
    </script>
@endsection
