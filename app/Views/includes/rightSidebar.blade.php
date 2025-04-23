@php
    use App\Models\Profile;
    $top_users = (new Profile())->getTop8ActiveUsers();
    $current_user = (new Profile())->getCurrentUserRank();
@endphp

<!-- Right side bar -->
<div class="hidden xl:block w-[340px] !p-6 h-min sticky top-[69px]" id="right-sidebar">
    <button id="openModalBtn"
        class="mb-1.5 hidden md:flex text-base font-semibold bg-[#319527] items-center justify-center w-[100%] text-left leading-3 text-white rounded-xl !p-2.5">
        @if ($recordings ?? false)
            <ion-icon name="mic" class="text-xl mr-1"></ion-icon>
            Đăng ghi âm mới
        @else
            <ion-icon name="add-outline" class="text-xl mr-1"></ion-icon>
            Tạo bài viết mới
        @endif
    </button>
    <div class="bg-white text-sm p-3 mt-4 rounded-xl long-shadow">
        <div class="flex flex-row items-center justify-between">
            <span class="font-bold text-[#6B6B6B] block text-base">Xếp hạng thành viên</span>
            <a href="https://chuyenbienhoa.com/Admin/posts/213101">
                <ion-icon name="help-circle-outline" class="text-[20px] text-gray-500"></ion-icon>
            </a>
        </div>
        @foreach ($top_users as $user)
            <div class="flex flex-row items-center mt-2">
                <a href="/{{ $user->username }}">
                    <img src="{{ !empty($user->oauth_profile_picture) ? $user->oauth_profile_picture : (!empty($user->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $user->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                        class="w-8 h-8 bg-gray-300 rounded-full border" alt="User avatar"></img></a>
                <a href="/{{ $user->username }}"
                    class="ml-1.5 font-semibold flex-1 truncate text-left">{{ $user->profile_name }}</a>
                <span class="mr-1.5 text-[#C1C1C1]">{{ $user->total_points }} điểm</span>
                <span class="text-green-500 font-bold">#{{ $loop->index + 1 }}</span>
            </div>
        @endforeach
        @if (isset($_SESSION['user']))
            <hr class="my-2" />
            <div class="flex flex-row items-center">
                <a href="/{{ $_SESSION['user']->username }}">
                    <img src="{{ isset($_SESSION['user']->additional_info->oauth_profile_picture) ? $_SESSION['user']->additional_info->oauth_profile_picture : (!empty($_SESSION['user']->additional_info->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $_SESSION['user']->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                        class="w-8 h-8 bg-gray-300 rounded-full border" alt="User avatar"></img>
                </a>
                <a href="/{{ $_SESSION['user']->username }}" class="ml-1.5 font-semibold flex-1 truncate text-left">Bạn</a>
                <span class="mr-1.5 text-[#C1C1C1]">{{ $current_user->total_points }} điểm</span>
                <span class="text-green-500 font-bold">#{{ $current_user->current_rank }}</span>
            </div>
        @endif
    </div>
    <div class="flex flex-row text-sm font-semibold p-3 text-[#BCBCBC]">
        <div class="flex flex-1 flex-col gap-y-0.5">
            <a href="/help" class="w-fit">Hỗ trợ</a>
            <a href="/contact" class="w-fit">Liên hệ</a>
            <a href="https://stats.uptimerobot.com/i7pA9rBmTC/798634874" class="w-fit">Trạng thái</a>
            <a href="/ads" class="w-fit">Quảng cáo</a>
        </div>
        <div class="flex flex-1 flex-col ml-5 gap-y-0.5">
            <a href="/about" class="w-fit">Giới thiệu</a>
            <a href="/careers" class="w-fit">Việc làm</a>
            <a href="/terms" class="w-fit">Điều khoản</a>
            <a href="/privacy" class="w-fit">Quyền riêng tư</a>
        </div>
    </div>
    <p class="text-[12px] text-center text-[#BCBCBC]">
        <a href="https://fatties.vn">Fatties Software</a> © {{ date('Y') }}
    </p>
</div>

<!-- Bottom bar for smaller screens -->
<div class="hidden max-md:block !px-3 pt-0 pb-6 mt-3" id="bottom-sidebar">
    <center>
        <div class="bg-white text-sm p-3 rounded-xl long-shadow" id="top-users">
            <div class="flex flex-row items-center justify-between">
                <span class="font-bold text-[#6B6B6B] block text-base text-left">Xếp hạng thành viên</span>
                <a href="https://chuyenbienhoa.com/Admin/posts/213101">
                    <ion-icon name="help-circle-outline" class="text-[20px] text-gray-500"></ion-icon>
                </a>
            </div>
            @foreach ($top_users as $user)
                <div class="flex flex-row items-center mt-2">
                    <a href="/{{ $user->username }}">
                        <img src="{{ !empty($user->oauth_profile_picture) ? $user->oauth_profile_picture : (!empty($user->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $user->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                            class="w-8 h-8 bg-gray-300 rounded-full border" alt="User avatar"></img></a>
                    <a href="/{{ $user->username }}"
                        class="ml-1.5 font-semibold flex-1 truncate text-left">{{ $user->profile_name }}</a>
                    <span class="mr-1.5 text-[#C1C1C1]">{{ $user->total_points }} điểm</span>
                    <span class="text-green-500 font-bold">#{{ $loop->index + 1 }}</span>
                </div>
            @endforeach
            @if (isset($_SESSION['user']))
                <hr class="my-2" />
                <div class="flex flex-row items-center">
                    <a href="/{{ $user->username }}">
                        <img src="{{ isset($_SESSION['user']->additional_info->oauth_profile_picture) ? $_SESSION['user']->additional_info->oauth_profile_picture : (!empty($_SESSION['user']->additional_info->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $_SESSION['user']->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                            class="w-8 h-8 bg-gray-300 rounded-full border" alt="User avatar"></img>
                    </a>
                    <span class="ml-1.5 font-semibold flex-1 truncate text-left">Bạn</span>
                    <span class="mr-1.5 text-[#C1C1C1]">{{ $current_user->total_points }} điểm</span>
                    <span class="text-green-500 font-bold">#{{ $current_user->current_rank }}</span>
                </div>
            @endif
        </div>
    </center>
    <center>
        <div class="flex flex-row text-sm font-semibold p-3 text-[#BCBCBC] max-w-[290px] text-left">
            <div class="flex flex-1 flex-col gap-y-0.5">
                <a href="/help" class="w-fit">Hỗ trợ</a>
                <a href="/contact" class="w-fit">Liên hệ</a>
                <a href="https://stats.uptimerobot.com/i7pA9rBmTC/798634874" class="w-fit">Trạng thái</a>
                <a href="/ads" class="w-fit">Quảng cáo</a>
            </div>
            <div class="flex flex-1 flex-col ml-5 gap-y-0.5">
                <a href="/about" class="w-fit">Giới thiệu</a>
                <a href="/careers" class="w-fit">Việc làm</a>
                <a href="/terms" class="w-fit">Điều khoản</a>
                <a href="/privacy" class="w-fit">Quyền riêng tư</a>
            </div>
        </div>
    </center>
    <p class="text-[12px] text-center text-[#BCBCBC]">
        <a href="https://fatties.vn">Fatties Software</a> © 2022
    </p>
</div>