@extends('layouts.home', ['title' => 'Báo cáo vi phạm tập thể lớp', 'reports' => true, 'class' => true])

@section('content')
    <div class="flex flex-1 pt-4 px-2.5 -mb-3 items-center flex-col">
        <!-- Main form -->
        <div class="max-w-[679px] w-[100%] long-shadow mb-4 rounded-md bg-white !p-0 sm:!p-2">
            <h1 class="text-center font-semibold my-3 text-[22px]">Báo cáo vi phạm tập thể lớp</h1>
            <div class="flex flex-row justify-center items-center mb-7">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-[#319527] flex items-center justify-center text-white text-xl">1
                    </div>
                    <span class="text-sm mt-0.5 font-semibold text-center">Điền thông tin</span>
                </div>
                <div class="w-[50px] sm:w-[100px] h-[0.7px] bg-gray-500 mb-4 -ml-3 "></div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center text-white text-xl">2</div>
                    <span class="text-sm mt-0.5 text-gray-400 text-center">Xác nhận</span>
                </div>
                <div class="w-[50px] sm:w-[100px] h-[0.7px] bg-gray-500 mb-4 -mr-1.5"></div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center text-white text-xl">3
                    </div>
                    <span class="text-sm mt-0.5 text-gray-400 text-center">Gửi báo cáo</span>
                </div>
            </div>
            <form action="/report/class/confirm" method="post" class="!px-5 !pb-4">
                <div class="flex flex-col mb-2.5">
                    <label for="class" class="flex items-center text-sm"><ion-icon name="location"
                            class="mr-0.5"></ion-icon> Tên lớp</label>
                    <select name="class" id="class" class="mt-1 text-base text-gray-500 rounded-md p-1 bg-gray-100">
                        <optgroup label="Khối 12">
                            <option value="12A1">12 Toán - 12A1</option>
                            <option value="12A2">12 Lý - 12A2</option>
                            <option value="12A3">12 Hoá - 12A3</option>
                            <option value="12A4">12 Sinh - 12A4</option>
                            <option value="12A5">12 Tin - 12A5</option>
                            <option value="12C1">12 Văn - 12C1</option>
                            <option value="12C2">12 Sử - 12C2</option>
                            <option value="12C3">12 Địa - 12C3</option>
                            <option value="12C4">12 Anh - 12C4</option>
                            <option value="12C5">12 Nga - 12C5</option>
                        </optgroup>
                        <optgroup label="Khối 11">
                            <option value="11A1">11 Toán - 11A1</option>
                            <option value="11A2">11 Lý - 11A2</option>
                            <option value="11A3">11 Hoá - 11A3</option>
                            <option value="11A4">11 Sinh - 11A4</option>
                            <option value="11A5">11 Tin - 11A5</option>
                            <option value="11C1">11 Văn - 11C1</option>
                            <option value="11C2">11 Sử - 11C2</option>
                            <option value="11C3">11 Địa - 11C3</option>
                            <option value="11C4">11 Anh - 11C4</option>
                            <option value="11C5">11 Nga - 11C5</option>
                        </optgroup>
                        <optgroup label="Khối 10">
                            <option value="10A1">10 Toán - 10A1</option>
                            <option value="10A2">10 Lý - 10A2</option>
                            <option value="10A3">10 Hoá - 10A3</option>
                            <option value="10A4">10 Sinh - 10A4</option>
                            <option value="10A5">10 Tin - 10A5</option>
                            <option value="10C1">10 Văn - 10C1</option>
                            <option value="10C2">10 Sử - 10C2</option>
                            <option value="10C3">10 Địa - 10C3</option>
                            <option value="10C4">10 Anh - 10C4</option>
                            <option value="10C5">10 Nga - 10C5</option>
                        </optgroup>
                        <optgroup label="THCS">
                            <option value="9A1">9A1</option>
                            <option value="9A2">9A2</option>
                            <option value="8A1">8A1</option>
                            <option value="8A2">8A2</option>
                            <option value="7A1">7A1</option>
                            <option value="7A2">7A2</option>
                            <option value="6A1">6A1</option>
                            <option value="6A2">6A2</option>
                        </optgroup>
                    </select>
                    <input type="hidden" id="classText" name="classText">
                </div>
                <div class="flex flex-col mb-2.5">
                    <label for="time" class="flex items-center text-sm"><ion-icon name="time"
                            class="mr-0.5"></ion-icon> Thời gian báo cáo</label>
                    <input disabled name="time" id="time"
                        class="text-gray-500 mt-1 text-base rounded-md p-1 bg-gray-100"
                        style="background-color: rgb(243 244 246 / var(--tw-bg-opacity))"
                        value="07:53 Thứ bảy, 30/11/2024"></input>
                </div>
                <div class="flex flex-col sm:flex-row gap-x-4">
                    <div class="flex flex-col flex-1 mb-2.5">
                        <label for="missing" class="flex items-center text-sm"><ion-icon name="remove-circle"
                                class="mr-0.5"></ion-icon> Vắng</label>
                        <input min="0" max="35" type="number" value="0" name="missing" id="missing"
                            class="text-gray-500 mt-1 text-base rounded-md p-1 bg-gray-100"></input>
                    </div>
                    <div class="flex flex-col flex-1 mb-2.5">
                        <label for="cleanliness" class="flex items-center text-sm"><ion-icon name="sparkles"
                                class="mr-0.5"></ion-icon> Vệ sinh</label>
                        <select name="cleanliness" id="cleanliness"
                            class="text-gray-500 mt-1 text-base rounded-md p-1 bg-gray-100">
                            <option value="clean">Sạch</option>
                            <option value="dirty">Bẩn</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-x-4">
                    <div class="flex flex-col flex-1 mb-2.5">
                        <label for="uniform" class="flex items-center text-sm"><ion-icon name="shirt"
                                class="mr-0.5"></ion-icon>Đồng phục</label>
                        <select name="uniform" id="uniform"
                            class="text-gray-500 mt-1 text-base rounded-md p-1 bg-gray-100">
                            <option value="full">Đủ</option>
                            <option value="missing">Thiếu</option>
                        </select>
                    </div>
                    <div class="flex flex-col flex-1 mb-2.5">
                        <label for="mistake" class="flex items-center text-sm"><ion-icon name="alert-circle"
                                class="mr-0.5"></ion-icon>Lỗi vi phạm</label>
                        <input placeholder="Nhập một lỗi vi phạm..." name="mistake" id="mistake"
                            class="text-gray-500 mt-1 text-base rounded-md p-1 bg-gray-100"></input>
                    </div>
                </div>
                <div class="flex flex-col mb-3.5">
                    <label for="additional" class="flex items-center text-sm"><ion-icon name="chatbox-ellipses"
                            class="mr-0.5 mt-0.5"></ion-icon>Ghi chú thêm</label>
                    <textarea name="additional" id="additional" cols="30" rows="3" placeholder="Nhập tại đây..."
                        class="bg-gray-100 p-1.5 text-base rounded-md mt-1 resize-none"></textarea>
                </div>
                <center>
                    <a href="#" class="text-sm mb-3 block w-fit">Xem danh sách đầy đủ các lỗi vi phạm</a>
                    <button class="text-base font-semibold bg-[#319527] text-white h-10 px-10 rounded-full">Tiếp
                        tục</button>
                </center>
            </form>
        </div>
    </div>
    <script>
        var classElement = document.getElementById('class');
        var classTextElement = document.getElementById('classText');

        if (classElement && classTextElement) {
            classTextElement.value = classElement.options[0].text;
            classElement.addEventListener('change', function() {
                classTextElement.value = this.options[this.selectedIndex].text;
            });
        }
    </script>
@endsection

@section('reportActive', 'nav-active')
