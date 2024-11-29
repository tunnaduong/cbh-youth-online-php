<!-- Left side bar -->
<div class="w-[340px] hidden xl:block !p-6 h-min sticky top-[69px]" id="left-sidebar">
    <p class="text-sm font-semibold text-[#6b6b6b] pb-3 ml-2.5">
        MENU
    </p>
    <a href="/" @class([
        'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
        'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $feed ?? false,
        'text-[#CACACA] hover:text-[#CACACA]' => !($feed ?? false),
    ])>
        <div @class([
            'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
            '!border-[#BFE5BB] bg-[#CDEBCA]' => $feed ?? false,
            'border-[#ECECEC]' => !($feed ?? false),
        ])>
            <ion-icon name="home"></ion-icon>
        </div>
        <div @class([
            'text-[#319527]' => $feed ?? false,
            'text-[#6B6B6B]' => !($feed ?? false),
        ])>Bảng tin</div>
    </a>
    <a href="/forum" @class([
        'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
        'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $forum ?? false,
        'text-[#CACACA] hover:text-[#CACACA]' => !($forum ?? false),
    ])>
        <div @class([
            'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
            '!border-[#BFE5BB] bg-[#CDEBCA]' => $forum ?? false,
            'border-[#ECECEC]' => !($forum ?? false),
        ])>
            <ion-icon name="chatbox-ellipses"></ion-icon>
        </div>
        <div @class([
            'text-[#319527]' => $forum ?? false,
            'text-[#6B6B6B]' => !($forum ?? false),
        ])>Diễn đàn</div>
    </a>
    <a href="/recordings" @class([
        'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
        'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $recordings ?? false,
        'text-[#CACACA] hover:text-[#CACACA]' => !($recordings ?? false),
    ])>
        <div @class([
            'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
            '!border-[#BFE5BB] bg-[#CDEBCA]' => $recordings ?? false,
            'border-[#ECECEC]' => !($recordings ?? false),
        ])>
            <ion-icon name="megaphone"></ion-icon>
        </div>
        <div @class([
            'text-[#319527]' => $recordings ?? false,
            'text-[#6B6B6B]' => !($recordings ?? false),
        ])>Loa lớn</div>
    </a>
    <a href="/youth-news" @class([
        'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
        'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $youth ?? false,
        'text-[#CACACA] hover:text-[#CACACA]' => !($youth ?? false),
    ])>
        <div @class([
            'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
            '!border-[#BFE5BB] bg-[#CDEBCA]' => $youth ?? false,
            'border-[#ECECEC]' => !($youth ?? false),
        ])>
            <ion-icon name="newspaper"></ion-icon>
        </div>
        <div @class([
            'text-[#319527]' => $youth ?? false,
            'text-[#6B6B6B]' => !($youth ?? false),
        ])>Tin tức Đoàn</div>
    </a>
    <a href="/saved" @class([
        'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
        'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $saved ?? false,
        'text-[#CACACA] hover:text-[#CACACA]' => !($saved ?? false),
    ])>
        <div @class([
            'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
            '!border-[#BFE5BB] bg-[#CDEBCA]' => $saved ?? false,
            'border-[#ECECEC]' => !($saved ?? false),
        ])>
            <ion-icon name="bookmark"></ion-icon>
        </div>
        <div @class([
            'text-[#319527]' => $saved ?? false,
            'text-[#6B6B6B]' => !($saved ?? false),
        ])>Đã lưu</div>
    </a>
</div>
