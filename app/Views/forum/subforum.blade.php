@php
    use Carbon\Carbon;
@endphp

@extends('layouts.forum')

@section('content')
@section('menu-label', 'Diễn đàn')

@include('includes.topBar')

<div class="flex flex-1 !p-6 !px-2.5 items-center flex-col -mb-4">
    <div class="max-w-[679px] w-full">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb px-1.5">
                <li class="breadcrumb-item"><a href="/forum" class=" flex items-center">Diễn đàn</a></li>
                <li class="breadcrumb-item"><a href="/forum/{{ $mainCategory->slug }}">{{ $mainCategory->name }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $subforum->name }}</li>
            </ol>
        </nav>

        <!-- Forum Header -->
        <div class="max-w-[679px] w-full mb-6">
            <div class="bg-white long-shadow rounded-lg mt-2 p-4">
                <a href="/forum/{{ $subforum->slug }}" class="text-lg font-semibold uppercase">{{ $subforum->name }}</a>
                <p class="!mt-3 text-base">{{ $subforum->description }}</p>
            </div>
        </div>

        <!-- Pagination Top -->
        {{-- <div class="flex items-center justify-between mb-4">
            <span class="text-sm text-gray-600">Trang 1 / 17345</span>
            <nav aria-label="Page navigation" class="inline-flex">
                <ul class="pagination mb-0">
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">Sau ›</a></li>
                </ul>
            </nav>
        </div> --}}

        <!-- Forum Topics Table -->
        <div class="bg-white rounded-lg long-shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="!p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiêu
                            đề</th>
                        <th
                            class="!p-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell min-w-[75px]">
                            Trả
                            lời</th>
                        <th
                            class="!p-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                            Xem
                        </th>
                        <th
                            class="sm:!p-3 pr-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[115px]">
                            Bài
                            viết cuối</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Topic Row -->
                    <tr class="hover:bg-gray-50">
                        <td class="!p-3 max-w-96" id="responsive-td">
                            <div class="flex items-center">
                                <div class="flex gap-y-2 flex-col">
                                    <div class="text-sm font-medium">
                                        <a href="#" class="text-green-600 hover:text-green-800">Mời anh em chia sẻ
                                            hình Shot on iPhone trong năm qua, TRÚNG VÍ
                                            SEN hit pắc pắc</a>
                                    </div>
                                    <div class="text-sm text-gray-500 flex gap-x-2">
                                        <img class="h-6 w-6 rounded-full border"
                                            src="/assets/images/placeholder-user.jpg" alt="Avatar">
                                        Anh Tú, 12:23 hôm qua
                                    </div>
                                    <div class="text-sm text-gray-500 flex sm:hidden">
                                        <div class="flex-1">
                                            Trả lời: <span class="text-black">114</span> · Xem: <span
                                                class="text-black">4.315</span>
                                        </div>
                                        <div>16 phút trước</div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="!p-3 text-center text-sm text-gray-500 hidden sm:table-cell">114</td>
                        <td class="!p-3 text-center text-sm text-gray-500 hidden sm:table-cell">4.315</td>
                        <td class="!p-3 text-right text-sm text-gray-500 hidden sm:table-cell">
                            <div class=" hidden sm:block">@hoangphat</div>
                            <div>16 phút trước</div>
                        </td>
                    </tr>
                    <!-- Additional topic rows would go here -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('communityActive', 'nav-active')
