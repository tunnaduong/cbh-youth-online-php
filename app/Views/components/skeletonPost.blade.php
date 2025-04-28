@foreach (range(1, $count ?? 4) as $index)
    <div
        class="w-full md:max-w-[775px] mb-4 !p-6 long-shadow h-min flex flex-row rounded-lg bg-white dark:!bg-[var(--main-white)] animate-pulse">
        <div
            class="min-w-[80px] items-center mt-1 flex-col md:flex ml-[-15px] text-[13px] font-semibold text-gray-400 hidden">
            <div class="h-16 w-6 bg-gray-200 dark:bg-neutral-600 rounded mb-3"></div>
            <div class="h-8 w-8 bg-gray-200 dark:bg-neutral-600 rounded"></div>
        </div>
        <div class="flex-1 overflow-hidden break-words">
            <div class="h-6 w-64 bg-gray-200 dark:bg-neutral-600 rounded mb-2"></div>
            <div class="h-6 w-full bg-gray-200 dark:bg-neutral-600 rounded mb-2"></div>
            <hr class="my-3 border-t-2" />
            <div class="flex-row flex text-[14px] items-center">
                <div class="min-h-7 min-w-7 bg-gray-200 dark:bg-neutral-600 rounded-full"></div>
                <div class="h-5 w-24 bg-gray-200 dark:bg-neutral-600 rounded ml-2"></div>
                <span class="mb-2 ml-1 text-sm text-gray-500">.</span>
                <div class="h-5 w-24 bg-gray-200 dark:bg-neutral-600 rounded ml-1"></div>
                <div class="flex-1 flex-row-reverse items-center text-gray-500 md:flex hidden">
                    <div class="h-5 w-12 bg-gray-200 dark:bg-neutral-600 rounded mr-1"></div>
                    <div class="h-5 w-12 bg-gray-200 dark:bg-neutral-600 rounded mr-1"></div>
                </div>
            </div>
            <div class="flex md:hidden mt-3 items-center">
                <div class="h-6 w-20 bg-gray-200 dark:bg-neutral-600 rounded mr-3"></div>
                <div class="h-8 w-8 bg-gray-200 dark:bg-neutral-600 rounded"></div>
                <div class="flex-1 flex-row-reverse items-center text-gray-500 md:hidden flex">
                    <div class="h-5 w-12 bg-gray-200 dark:bg-neutral-600 rounded mr-1"></div>
                    <div class="h-5 w-12 bg-gray-200 dark:bg-neutral-600 rounded mr-1"></div>
                </div>
            </div>
        </div>
    </div>
@endforeach