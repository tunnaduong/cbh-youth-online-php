{{-- Footer --}}
<footer class="footer text-[#6B6B6B] bg-white relative z-30 mt-4">
    <div class="bg-[#319527]">
        <!-- Menu -->
        <div class="container">
            <ul class="flex justify-start items-center py-3 text-white text-[14px] gap-6">
                <li><a href="">Trang chủ</a></li>
                <li><a href="">Trợ giúp</a></li>
                <li><a href="">Điều khoản & Quy định</a></li>
                <li><a href="">Chính sách quyền riêng tư</a></li>
            </ul>
        </div>
    </div>
    </div>
    <div class="container py-3">
        <div>
            <div class="w-[50%] absolute h-full mb-4 top-0 right-0 -z-10"
                style="background-image: url('/assets/images/footer.jpg'); background-size: cover; background-position: center;">
            </div>
            <div class="fade-to-left" style="width: 50%"></div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <img src="/assets/images/logo.png" alt="Logo" class="w-[100px] mb-3">
                <h2 class="font-bold">Diễn đàn học sinh Chuyên Biên Hòa</h2>
                <div class="flex items-center gap-2 !mt-3 text-[20px]">
                    <a href="https://facebook.com/cbhyouthonline" target="_blank">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                    <a href="https://github.com/tunnaduong/cbh-youth-online-php" target="_blank">
                        <ion-icon name="logo-github"></ion-icon>
                    </a>
                </div>
                <p class="text-[13px] !mt-5">Trang web hoạt động phi lợi nhuận<br>
                    <em>(không thuộc quản lý của nhà trường)</em>
                </p>
            </div>
        </div>
        <div class="row text-[12px] mt-3">
            <div class="col-md-12 text-center">
                <p>&copy; {{ date('Y') }} Công ty TNHH Công nghệ Giáo dục <a href="https://fatties.vn">Fatties
                        Software</a> - Được phát
                    triển bởi học sinh, dành cho học sinh.</p>
            </div>
        </div>
    </div>
</footer>