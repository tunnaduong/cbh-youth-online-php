@if (!($_SESSION['user'] ?? false))
    <div class="dark:!bg-neutral-700 dark:!text-[#f3f4f6] !p-6 !px-2.5 bg-white fixed bottom-0 z-50 w-full shadow-lg rounded-t-xl"
        id="bottom-cta">
        <div class="container-cta relative">
            {{-- Close button --}}
            <button
                class="absolute -top-2 right-1 text-gray-500 dark:!text-[#bdbdbd] dark:hover:!text-[#cdcdcd] hover:text-gray-700"
                onclick="closeBottomCTA()">
                <ion-icon name="close-circle" class="text-[30px]"></ion-icon>
            </button>
            {{-- Content --}}
            <div class="max-w-[775px] mx-auto flex items-center">
                <img src="/assets/images/logo.png" alt="CYO Logo" class="w-28 logo-white h-28 hidden sm:block mr-4">
                <div class="flex flex-col items-center justify-center text-center flex-1">
                    <h2 class="text-2xl font-bold">Tham gia cộng đồng</h2>
                    <p class="text-gray-500 mt-2">Chia sẻ ý kiến và kết nối với những người có cùng sở thích.</p>
                    <div class="flex gap-2 sm:!gap-10">
                        <a href="/login" class="mt-3 px-4 py-2 bg-gray-500 text-white rounded-lg zoom-btn">Đã
                            có tài khoản?</a>
                        <a href="/register" class="mt-3 px-4 py-2 bg-[#319528] text-white rounded-lg zoom-btn">Tham gia
                            ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function closeBottomCTA() {
            document.querySelector('#bottom-cta').style.display = 'none';
        }
    </script>
@endif