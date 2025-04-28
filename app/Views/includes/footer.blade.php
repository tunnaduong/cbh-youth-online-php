{{-- Footer --}}
<footer class="footer text-[#6B6B6B] dark:!text-white bg-white dark:!bg-[var(--main-white)] relative z-30 mt-4">
    <div class="bg-[#319527] shadow-md">
        <!-- Menu -->
        <div class="container">
            <ul class="flex justify-start items-center py-3 text-white text-[14px] gap-6">
                <li class="hidden md:block"><a href="/">Trang chủ</a></li>
                <li class="hidden md:block"><a href="/help">Trợ giúp</a></li>
                <li><a href="/">Điều khoản & Quy định</a></li>
                <li><a href="/">Chính sách quyền riêng tư</a></li>
            </ul>
        </div>
    </div>
    </div>
    <div class="container pt-4">
        <div>
            <div class="w-[50%] absolute h-full mb-4 top-0 right-0 -z-10 footer-bg"
                style="background-image: url('/assets/images/footer.jpg'); background-size: cover; background-position: center;">
            </div>
            <div class="fade-to-left" style="width: 50%"></div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4 md:!mb-0">
                <img src="/assets/images/logo.png" alt="Logo" class="w-[100px] mb-3">
                <h2 class="font-bold">Diễn đàn học sinh Chuyên Biên Hòa</h2>
                <div class="flex items-center gap-2 !mt-3 text-[20px]">
                    <a href="https://facebook.com/cbhyouthonline" target="_blank"
                        class="rounded-full h-[35px] w-[35px] flex justify-center items-center bg-[#3b5998] text-white">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                    <a href="https://github.com/tunnaduong/cbh-youth-online-php" target="_blank"
                        class="rounded-full h-[35px] w-[35px] flex justify-center items-center bg-black text-white">
                        <ion-icon name="logo-github"></ion-icon>
                    </a>
                </div>
                <p class="text-[13px] !mt-5">Trang web hoạt động phi lợi nhuận<br>
                    <em>(không thuộc quản lý của nhà trường)</em>
                </p>
            </div>
            <div class="col-md-3 col-6 mb-4 md:!mb-0">
                <h3 class="font-bold text-[16px]">Chuyên mục nổi bật</h3>
                <ul class="list-none mt-3 flex flex-col gap-2">
                    <li><a href="/forum/hoc-tap" class="hover:text-[#319527]">Góc học tập</a></li>
                    <li><a href="/forum/hoat-dong-ngoai-khoa/cau-lac-bo" class="hover:text-[#319527]">Câu
                            lạc bộ</a></li>
                    <li><a href="/forum/hoat-dong-ngoai-khoa" class="hover:text-[#319527]">Hoạt động</a>
                    </li>
                    <li><a href="/forum/giai-tri-xa-hoi" class="hover:text-[#319527]">Giải trí</a></li>
                    <li><a href="/forum/hoc-tap/ebook-giao-trinh" class="hover:text-[#319527]">Tài liệu
                            ôn thi</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-6 mb-4 md:!mb-0">
                <h3 class="font-bold text-[16px]">Chính sách</h3>
                <ul class="list-none mt-3 flex flex-col gap-2">
                    <li><a href="/Admin/posts/213054" class="hover:text-[#319527]">Nội quy diễn đàn</a>
                    </li>
                    <li><a href="/" class="hover:text-[#319527]">Chính sách bảo mật</a></li>
                    <li><a href="/" class="hover:text-[#319527]">Điều khoản sử dụng</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3 class="font-bold text-[16px]">Liên hệ & Hỗ trợ</h3>
                <ul class="list-none mt-3 flex flex-col gap-2">
                    <li>Email: <a href="mailto:cbhyouthonline@gmail.com"
                            class="hover:text-[#319527]">cbhyouthonline@gmail.com</a></li>
                    <li>Hotline: <a href="tel:+84707006421" class="hover:text-[#319527]">(+84) 7070 064
                            21</a></li>
                    <li>Fanpage: <a href="https://facebook.com/cbhyouthonline"
                            class="hover:text-[#319527]">@CBHYouthOnline</a></li>
                </ul>
            </div>
        </div>
        <div class="row text-[12px] py-3">
            <div class="col-md-12 text-center">
                <p>&copy; {{ date('Y') }} Công ty Cổ phần Giải pháp Giáo dục <a href="https://fatties.vn">Fatties
                        Software</a> - Được phát
                    triển bởi học sinh, dành cho học sinh.</p>
            </div>
        </div>
    </div>
</footer>
