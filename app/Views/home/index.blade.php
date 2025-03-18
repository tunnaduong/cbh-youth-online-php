@extends('layouts.home', ['title' => 'Bảng tin', 'feed' => true])

@section('content')
    <div id="main-content" hx-get="/feed/fetch" hx-trigger="load" hx-swap="innerHTML" class="flex-1">
        <p class="text-center mt-4">Đang tải bài viết...</p>
    </div>
@endsection

@section('communityActive', 'nav-active')
