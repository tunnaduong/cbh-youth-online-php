<!-- Left side bar -->
<div class="w-[340px] hidden xl:block !p-6 h-min sticky top-[69px]" id="left-sidebar">
    <p class="text-sm font-semibold text-[#6b6b6b] pb-3 ml-2.5">
        MENU
    </p>
    @foreach ($links as $label => $link)
        <a href="{{ $link[0] }}" @class([
            'mb-3 text-base font-semibold flex items-center w-[100%] text-left rounded-xl p-2.5',
            'hover:text-[#319527] text-[#319527] bg-[#E4EEE3]' =>
                $loop->index === $active,
            'text-[#CACACA] hover:text-[#CACACA]' => !($loop->index === $active),
        ])>
            <div @class([
                'text-lg rounded-lg w-[30px] h-[30px] mr-3 menu-border flex items-center justify-center',
                '!border-[#BFE5BB] bg-[#CDEBCA]' => $loop->index === $active,
                'border-[#ECECEC]' => !($loop->index === $active),
            ])>
                <ion-icon name="{{ $link[1] }}"></ion-icon>
            </div>
            <div @class([
                'text-[#319527]' => $loop->index === $active,
                'text-[#6B6B6B]' => !($loop->index === $active),
            ])>{{ $label }}</div>
        </a>
    @endforeach
</div>
