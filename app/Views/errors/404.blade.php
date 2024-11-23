@extends('layouts.error')

@section('content')
    <div class="flex flex-1 items-center justify-center"
        style="zoom:1.4;display:block;position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%, -50%);transform:translate(-50%, -50%)">
        <center><img src="/assets/images/404.svg" alt="404" class="w-[80px] h-[80px] mb-2">
            <h4 class="font-bold text-gray-500 text-[14px]">Bạn hiện không xem được nội dung này</h4>
            <p class="text-[12px] text-gray-500">Lỗi này thường do chủ sở hữu chỉ chia sẻ nội dung với một<br>nhóm nhỏ, thay
                đổi người được xem hoặc đã xóa nội dung.</p><button
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 shadow bg-[#319528] hover:bg-green-700 text-white text-[12px] font-semibold rounded-[5px] py-[5px] px-6 mt-3 h-7">Đi
                tới Bảng tin</button><br>
            <div class="text-[#319528] cursor-pointer text-[12px] mt-2 inline-block font-semibold">Quay lại</div>
        </center>
    </div>
@endsection
