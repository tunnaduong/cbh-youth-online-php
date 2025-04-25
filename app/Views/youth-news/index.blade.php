@extends('layouts.home', ['title' => 'Tin tức Đoàn', 'youth' => true])

@section('content')
    <div id="main-content" hx-get="/feed/fetch" hx-trigger="load" hx-swap="innerHTML"
        class="flex-1 min-h-[calc(100vh-100px)]">
        <div class="p-3 pt-4 flex flex-col items-center w-full flex-1">
            @include('components.skeletonPost', ['count' => 5])
        </div>
    </div>
@endsection

@section('communityActive', 'nav-active')