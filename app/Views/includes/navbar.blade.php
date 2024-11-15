<nav class="fixed w-[100%] top-0 bg-white shadow-md leading-[0] flex justify-between">
    <div class="flex flex-row px-6 py-3.5"><button
            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 w-9 lg:hidden mr-3 min-w-[36px]"
            type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-:R5btb:"
            data-state="closed"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-menu h-6 w-6">
                <line x1="4" x2="20" y1="12" y2="12"></line>
                <line x1="4" x2="20" y1="6" y2="6"></line>
                <line x1="4" x2="20" y1="18" y2="18"></line>
            </svg>
        </button>
        <a id="logo" class="inline-block" href="/">
            <div class="flex gap-x-1 items-center min-w-max"><img src="/assets/images/logo.png" alt="CYO's Logo"
                    class="w-10 h-10">
                <div class="text-[14.5px] font-light text-[#319527] leading-4 hidden lg:block">
                    <h1>Thanh niên</h1>
                    <h1 class="font-bold">Chuyên Biên Hòa Online</h1>
                </div>
            </div>
        </a>
        <div class="max-w-52 lg:flex flex-row items-center bg-[#F7F7F7] rounded-lg pr-1 ml-7 pl-1 hidden">
            <input type="text" placeholder="Tìm kiếm" class="w-full bg-[#F7F7F7] text-[13px] p-2 rounded-lg pr-1">
            <div
                class="bg-white rounded-lg min-w-[30px] h-[30px] flex items-center justify-center cursor-pointer search-btn">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                    class="text-[16px] text-[#6B6B6B]" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M456.69 421.39 362.6 327.3a173.81 173.81 0 0 0 34.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 0 0 327.3 362.6l94.09 94.09a25 25 0 0 0 35.3-35.3zM97.92 222.72a124.8 124.8 0 1 1 124.8 124.8 124.95 124.95 0 0 1-124.8-124.8z">
                    </path>
                </svg>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-x-5">
        <div class="h-full items-center flex flex-row gap-x-3 relative nav-item">
            <a class="lg:flex px-3 py-2 mr-5 hidden h-full items-center min-w-max text-center text-sm font-medium transition-colors duration-200 nav-active"
                href="/">Cộng đồng</a>
            <a class="lg:flex px-3 py-2 mr-5 hidden h-full items-center min-w-max text-center text-sm font-medium transition-colors duration-200"
                href="/reports">Báo cáo</a>
            <a class="lg:flex px-3 py-2 mr-5 hidden h-full items-center min-w-max text-center text-sm font-medium transition-colors duration-200"
                href="/lookup">Tra cứu</a>
            <a class="lg:flex px-3 py-2 mr-5 hidden h-full items-center min-w-max text-center text-sm font-medium transition-colors duration-200"
                href="/explore">Khám phá</a>
        </div>
        @if (!isset($_SESSION['user']))
            <div class="flex flex-row items-center gap-x-5 mr-4">
                <a href="/login" class="hover:text-black">
                    <span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full" type="button"
                        id="radix-:R1qbtb:" aria-haspopup="menu" aria-expanded="false" data-state="closed">
                        <span class="flex h-full w-full items-center justify-center rounded-full bg-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-user">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                    </span>
                </a>
            </div>
        @else
            <div class="flex flex-row items-center gap-x-5 mr-4">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                    class="lg:hidden cursor-pointer text-[23px] text-[#6B6B6B]" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill="none" stroke-miterlimit="10" stroke-width="32"
                        d="M221.09 64a157.09 157.09 0 1 0 157.09 157.09A157.1 157.1 0 0 0 221.09 64z"></path>
                    <path fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32"
                        d="M338.29 338.29 448 448"></path>
                </svg>
                <div class="cursor-pointer"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                        viewBox="0 0 512 512" class="text-[#6B6B6B] text-[23px]" height="1em" width="1em"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill="none" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32"
                            d="M87.49 380c1.19-4.38-1.44-10.47-3.95-14.86a44.86 44.86 0 0 0-2.54-3.8 199.81 199.81 0 0 1-33-110C47.65 139.09 140.73 48 255.83 48 356.21 48 440 117.54 459.58 209.85a199 199 0 0 1 4.42 41.64c0 112.41-89.49 204.93-204.59 204.93-18.3 0-43-4.6-56.47-8.37s-26.92-8.77-30.39-10.11a31.09 31.09 0 0 0-11.12-2.07 30.71 30.71 0 0 0-12.09 2.43l-67.83 24.48a16 16 0 0 1-4.67 1.22 9.6 9.6 0 0 1-9.57-9.74 15.85 15.85 0 0 1 .6-3.29z">
                        </path>
                    </svg><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                        class="paw text-[#6B6B6B] text-[23px]" height="1em" width="1em"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M194.82 496a18.36 18.36 0 0 1-18.1-21.53v-.11L204.83 320H96a16 16 0 0 1-12.44-26.06L302.73 23a18.45 18.45 0 0 1 32.8 13.71c0 .3-.08.59-.13.89L307.19 192H416a16 16 0 0 1 12.44 26.06L209.24 489a18.45 18.45 0 0 1-14.42 7z">
                        </path>
                    </svg></div>
                <div class="cursor-pointer"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                        viewBox="0 0 512 512" class="text-[#6B6B6B] text-[23px]" height="1em" width="1em"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                            d="M427.68 351.43C402 320 383.87 304 383.87 217.35 383.87 138 343.35 109.73 310 96c-4.43-1.82-8.6-6-9.95-10.55C294.2 65.54 277.8 48 256 48s-38.21 17.55-44 37.47c-1.35 4.6-5.52 8.71-9.95 10.53-33.39 13.75-73.87 41.92-73.87 121.35C128.13 304 110 320 84.32 351.43 73.68 364.45 83 384 101.61 384h308.88c18.51 0 27.77-19.61 17.19-32.57zM320 384v16a64 64 0 0 1-128 0v-16">
                        </path>
                    </svg>
                </div>
                <div role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full cursor-pointer"
                        type="button" id="radix-:rc:" aria-haspopup="menu" aria-expanded="false"
                        data-state="closed">
                        <img class="aspect-square h-full w-full" alt="User"
                            src="https://api.chuyenbienhoa.com/v1.0/users/{{ $_SESSION['user']->username }}/avatar">
                    </span>
                </div>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="/{{ $_SESSION['user']->username }}"><i
                                class="bi bi-person"></i>
                            Trang cá nhân</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Cài đặt</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-question-circle"></i> Trợ giúp</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>
