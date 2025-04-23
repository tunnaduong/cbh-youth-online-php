<!-- Left side bar -->
<div class="w-[260px] hidden xl:flex flex-col !p-6 sticky top-[69px] h-min" id="left-sidebar">
    <p class="text-sm font-semibold text-[#6b6b6b] pb-3 ml-2.5">
        MENU
    </p>
    @if ($reports ?? false)
        <a href="/report/class" @class([
            'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
            'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $class ?? false,
            'text-[#CACACA] hover:text-[#CACACA]' => !($class ?? false),
        ])>
            <div @class([
                'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
                '!border-[#BFE5BB] bg-[#CDEBCA]' => $class ?? false,
                'border-[#ECECEC]' => !($class ?? false),
            ])>
                <ion-icon name="people"></ion-icon>
            </div>
            <div @class([
                'text-[#319527]' => $class ?? false,
                'text-[#6B6B6B]' => !($class ?? false),
            ])>Báo cáo tập thể lớp</div>
        </a>
        <a href="/report/student" @class([
            'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
            'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $student ?? false,
            'text-[#CACACA] hover:text-[#CACACA]' => !($student ?? false),
        ])>
            <div @class([
                'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
                '!border-[#BFE5BB] bg-[#CDEBCA]' => $student ?? false,
                'border-[#ECECEC]' => !($student ?? false),
            ])>
                <ion-icon name="person"></ion-icon>
            </div>
            <div @class([
                'text-[#319527]' => $student ?? false,
                'text-[#6B6B6B]' => !($student ?? false),
            ])>Báo cáo học sinh</div>
        </a>
    @else
        <a href="/" @class([
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
        <a href="/feed" @class([
            'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
            'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $feed ?? false,
            'text-[#CACACA] hover:text-[#CACACA]' => !($feed ?? false),
        ])>
            <div @class([
                'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
                '!border-[#BFE5BB] bg-[#CDEBCA]' => $feed ?? false,
                'border-[#ECECEC]' => !($feed ?? false),
            ])>
                <ion-icon name="telescope"></ion-icon>
            </div>
            <div @class([
                'text-[#319527]' => $feed ?? false,
                'text-[#6B6B6B]' => !($feed ?? false),
            ])>Bảng tin</div>
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
    @endif
    {{-- Bottom bar, including settings, help, feedback --}}
    <div class="flex-1 flex flex-col justify-end">
        <hr class="mb-3">
        @if (isset($_SESSION['user']))
            <a href="/{{ $_SESSION['user']->username }}/settings" @class([
                'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
                'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $settings ?? false,
                'text-[#CACACA] hover:text-[#CACACA]' => !($settings ?? false),
            ])>
                <div @class([
                    'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
                    '!border-[#BFE5BB] bg-[#CDEBCA]' => $settings ?? false,
                    'border-[#ECECEC]' => !($settings ?? false),
                ])>
                    <ion-icon name="settings"></ion-icon>
                </div>
                <div @class([
                    'text-[#319527]' => $settings ?? false,
                    'text-[#6B6B6B]' => !($settings ?? false),
                ])>Cài đặt</div>
            </a>
        @endif
        <a href="/help" @class([
            'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
            'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $help ?? false,
            'text-[#CACACA] hover:text-[#CACACA]' => !($help ?? false),
        ])>
            <div @class([
                'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
                '!border-[#BFE5BB] bg-[#CDEBCA]' => $help ?? false,
                'border-[#ECECEC]' => !($help ?? false),
            ])>
                <ion-icon name="help-circle"></ion-icon>
            </div>
            <div @class([
                'text-[#319527]' => $help ?? false,
                'text-[#6B6B6B]' => !($help ?? false),
            ])>Trợ giúp</div>
        </a>
        <a href="https://forms.gle/XJ3v1vN82BxLUVWo9" @class([
            'text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
            'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' => $feedback ?? false,
            'text-[#CACACA] hover:text-[#CACACA]' => !($feedback ?? false),
        ]) target="_blank">
            <div @class([
                'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
                '!border-[#BFE5BB] bg-[#CDEBCA]' => $feedback ?? false,
                'border-[#ECECEC]' => !($feedback ?? false),
            ])>
                <ion-icon name="chatbubbles"></ion-icon>
            </div>
            <div @class([
                'text-[#319527]' => $feedback ?? false,
                'text-[#6B6B6B]' => !($feedback ?? false),
            ])>Góp ý</div>
        </a>
    </div>
</div>
