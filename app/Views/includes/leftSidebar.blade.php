@php
    if ($reports ?? false) {
        $menuItems = [
            [
                'url' => '/report/class',
                'icon' => 'people',
                'text' => 'Báo cáo tập thể lớp',
                'active' => $class ?? false,
            ],
            [
                'url' => '/report/student',
                'icon' => 'person',
                'text' => 'Báo cáo học sinh',
                'active' => $student ?? false,
            ],
        ];
    } else {
        $menuItems = [
            ['url' => '/', 'icon' => 'chatbox-ellipses', 'text' => 'Diễn đàn', 'active' => $forum ?? false],
            ['url' => '/feed', 'icon' => 'telescope', 'text' => 'Bảng tin', 'active' => $feed ?? false],
            ['url' => '/recordings', 'icon' => 'megaphone', 'text' => 'Loa lớn', 'active' => $recordings ?? false],
            ['url' => '/youth-news', 'icon' => 'newspaper', 'text' => 'Tin tức Đoàn', 'active' => $youth ?? false],
            [
                'url' => '/saved',
                'icon' => 'bookmark',
                'text' => 'Đã lưu',
                'active' => $saved ?? false,
                'divider' => true,
            ],
        ];
        if (isset($_SESSION['user'])) {
            $menuItems[] = [
                'url' => "/{$_SESSION['user']->username}/settings",
                'icon' => 'settings',
                'text' => 'Cài đặt',
                'active' => $settings ?? false,
            ];
        }
        $menuItems[] = ['url' => '/help', 'icon' => 'help-circle', 'text' => 'Trợ giúp', 'active' => $help ?? false];
        $menuItems[] = [
            'url' => 'https://forms.gle/XJ3v1vN82BxLUVWo9',
            'icon' => 'chatbubbles',
            'text' => 'Góp ý',
            'active' => $feedback ?? false,
            'external' => true,
        ];
    }
@endphp

<!-- Left side bar -->
<div class="w-[260px] hidden xl:flex flex-col !p-6 sticky top-[69px] h-min" id="left-sidebar">
    <p class="text-sm font-semibold text-[#6b6b6b] pb-3 ml-2.5">
        MENU
    </p>

    @foreach ($menuItems as $item)
        <a href="{{ $item['url'] }}" @class([
            'mb-3 text-base font-semibold flex items-center w-full text-left rounded-xl p-2.5',
            'hover:text-[#319527] text-[#319527] bg-[#E4EEE3] dark:bg-[#495648]' =>
                $item['active'],
            'text-[#CACACA] hover:text-[#CACACA]' => !$item['active'],
        ])
            @if (isset($item['external'])) target="_blank" @endif>
            <div @class([
                'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
                '!border-[#BFE5BB] dark:!border-[#4f7b50] bg-[#CDEBCA] dark:bg-[#1d2a1c]' =>
                    $item['active'],
                'border-[#ECECEC] dark:!border-neutral-500' => !$item['active'],
            ])>
                <ion-icon name="{{ $item['icon'] }}"></ion-icon>
            </div>
            <div @class([
                'text-[#319527]' => $item['active'],
                'text-[#6B6B6B] dark:text-[#CACACA]' => !$item['active'],
            ])>
                {{ $item['text'] }}
            </div>
        </a>
        @if (isset($item['divider']) && $item['divider'])
            <hr class="my-3">
        @endif
    @endforeach
</div>
