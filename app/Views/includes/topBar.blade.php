<div id="top-bar" class="mt-4 xl:hidden !px-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold flex xl:hidden items-center cursor-pointer" role="button" id="dropdownMenuButton"
        data-bs-toggle="dropdown" aria-expanded="false">@yield('menu-label', 'Bảng tin') <ion-icon name="chevron-down-outline"
            class="ml-1"></ion-icon>
    </h1>
    <div class="dropdown-menu min-w-[200px] rounded-lg" aria-labelledby="dropdownMenuButton">
        <a href="/"
            class="dropdown-item text-base font-semibold flex items-center w-[100%] text-left text-[#CACACA] hover:text-[#CACACA] hover:bg-slate-100 focus:bg-slate-100 focus:text-[#CACACA] active:bg-slate-200 p-2">
            <div
                class="text-lg rounded-lg w-[30px] h-[30px] mr-3 border-[#ECECEC] menu-border flex items-center justify-center">
                <ion-icon name="home"></ion-icon>
            </div>
            <div class="text-[#6B6B6B]">Bảng tin</div>
        </a>
        <a href="/forum"
            class="dropdown-item text-base font-semibold flex items-center w-[100%] text-left text-[#CACACA] hover:text-[#CACACA] hover:bg-slate-100 focus:bg-slate-100 focus:text-[#CACACA] active:bg-slate-200 p-2">
            <div
                class="text-lg rounded-lg w-[30px] h-[30px] mr-3 border-[#ECECEC] menu-border flex items-center justify-center">
                <ion-icon name="chatbox-ellipses"></ion-icon>
            </div>
            <div class="text-[#6B6B6B]">Diễn đàn</div>
        </a>
        <a href="/recordings"
            class="dropdown-item text-base font-semibold flex items-center w-[100%] text-left text-[#CACACA] hover:text-[#CACACA] hover:bg-slate-100 focus:bg-slate-100 focus:text-[#CACACA] active:bg-slate-200 p-2">
            <div
                class="text-lg rounded-lg w-[30px] h-[30px] mr-3 border-[#ECECEC] menu-border flex items-center justify-center">
                <ion-icon name="megaphone"></ion-icon>
            </div>
            <div class="text-[#6B6B6B]">Loa lớn</div>
        </a>
        <a href="/youth-news"
            class="dropdown-item text-base font-semibold flex items-center w-[100%] text-left text-[#CACACA] hover:text-[#CACACA] hover:bg-slate-100 focus:bg-slate-100 focus:text-[#CACACA] active:bg-slate-200 p-2">
            <div
                class="text-lg rounded-lg w-[30px] h-[30px] mr-3 border-[#ECECEC] menu-border flex items-center justify-center">
                <ion-icon name="newspaper"></ion-icon>
            </div>
            <div class="text-[#6B6B6B]">Tin tức Đoàn</div>
        </a>
        <a href="/saved"
            class="dropdown-item text-base font-semibold flex items-center w-[100%] text-left text-[#CACACA] hover:text-[#CACACA] hover:bg-slate-100 focus:bg-slate-100 focus:text-[#CACACA] active:bg-slate-200 p-2">
            <div
                class="text-lg rounded-lg w-[30px] h-[30px] mr-3 border-[#ECECEC] menu-border flex items-center justify-center">
                <ion-icon name="bookmark"></ion-icon>
            </div>
            <div class="text-[#6B6B6B]">Đã lưu</div>
        </a>
    </div>
    <button id="openModalBtn2"
        class="flex xl:hidden text-base font-semibold bg-[#319527] items-center justify-center w-full max-w-[180px] text-left leading-3 text-white rounded-xl !p-2.5">
        <ion-icon name="add-outline" class="text-xl mr-1"></ion-icon>
        Tạo bài viết mới
    </button>
</div>
