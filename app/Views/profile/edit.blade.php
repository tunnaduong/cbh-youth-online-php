@extends('layouts.error', [
    'description' => 'Quản lý cài đặt tài khoản và thiết lập thông báo email.',
    'title' => 'Cài đặt',
])

@section('content')
    <div class="p-6">
        <div class="bg-white p-6 rounded-2xl border shadow-md">
            <div class="space-y-0.5">
                <h2 class="text-2xl font-bold tracking-tight">Cài đặt</h2>
                <p class="text-muted-foreground">Quản lý cài đặt tài khoản và thiết lập thông báo email.</p>
            </div>
            <div class="my-6 border-top"></div>
            <div class="flex gap-x-12">
                <aside class="w-1/5">
                    <ul class="uk-nav uk-nav-primary" uk-switcher="connect: #component-nav; animation: uk-animation-fade"
                        uk-nav>
                        <li class="uk-active">
                            <a href="#">Trang cá nhân</a>
                        </li>
                        <li>
                            <a href="#">Tài khoản</a>
                        </li>
                        <li>
                            <a href="#">Thông báo</a>
                        </li>
                    </ul>
                </aside>
                <div class="flex-1">
                    <ul id="component-nav" class="uk-switcher max-w-2xl">
                        <li class="uk-active space-y-6">
                            <div>
                                <h3 class="text-lg font-medium">Trang cá nhân</h3>
                                <p class="text-sm text-muted-foreground"> Đây là cách người khác sẽ nhìn thấy bạn trên trang
                                    web. </p>
                            </div>
                            <div class="border-t border-border"></div>
                            <div class="space-y-2">
                                <label class="uk-form-label" for="username">Tên đăng nhập</label>
                                <input class="uk-input" id="username" type="text" value="{{ $profile->username }}">
                                <div class="uk-form-help text-muted-foreground">Đây là tên hiển thị công khai của bạn. Nó
                                    có thể là tên thật hoặc biệt danh của bạn. Bạn chỉ có thể thay đổi tên đăng nhập mỗi
                                    30
                                    ngày một lần. </div>
                            </div>
                            <div class="space-y-2">
                                <label class="uk-form-label" for="email">Email đăng ký</label>
                                <input class="uk-input" id="email" {{ $profile->email_verified_at ? 'disabled' : '' }}
                                    type="text" value="{{ $profile->email }}">
                                @unless ($profile->email_verified_at)
                                    <div class="uk-form-help text-muted-foreground">Bạn chưa xác minh email. <a
                                            href="/{{ $profile->username }}/email/verify"
                                            class="underline underline-offset-[3.2px]">Xác minh ngay.</a>
                                    </div>
                                @endunless
                            </div>
                            <div class="space-y-2">
                                <label class="uk-form-label" for="bio">Tiểu sử</label>
                                <textarea class="uk-textarea" id="bio" placeholder="Hãy cho chúng tôi biết một chút về bản thân bạn"
                                    value="{{ $profile->bio }}"></textarea>
                                @unless (empty($error))
                                    {{-- String must contain at least 4 character(s) --}}
                                    <div class="uk-form-help text-destructive">
                                        {{ $error }}
                                    </div>
                                @endunless
                            </div>
                            <div class="">
                                <button class="uk-button uk-button-primary">Cập nhật hồ sơ</button>
                            </div>
                        </li>
                        <li class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium">Tài khoản</h3>
                                <p class="text-sm text-muted-foreground"> Cập nhật cài đặt tài khoản của bạn. Đặt ngôn ngữ
                                    và múi giờ ưa thích của bạn. </p>
                            </div>
                            <div class="border-t border-border"></div>
                            <div class="space-y-2">
                                <label class="uk-form-label" for="name">Họ và tên</label>
                                <input class="uk-input" id="name" type="text" placeholder="Tên của bạn"
                                    value="{{ $profile->profile_name }}">
                                <div class="uk-form-help text-muted-foreground">Đây là tên sẽ được hiển thị công khai trên
                                    hồ sơ của
                                    bạn, bảng tin và diễn đàn.</div>
                            </div>
                            <div class="space-y-2">
                                <label class="uk-form-label block" for="date_of_birth">Ngày tháng năm sinh</label>
                                <input class="uk-input w-[240px]" id="date_of_birth" type="date"
                                    placeholder="Pick a date">
                                <div class="uk-form-help text-muted-foreground">Ngày sinh của bạn được sử dụng để tính toán
                                    tuổi của bạn.
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="uk-form-label block" for="language">Ngôn ngữ</label>
                                <div class="h-9">
                                    <uk-select name="language" uk-cloak="true">
                                        <option value="" disabled> Chọn một ngôn ngữ </option>
                                        <option selected>Tiếng Việt</option>
                                    </uk-select>
                                </div>
                                <div class="uk-form-help text-muted-foreground">Đây là ngôn ngữ sẽ được sử dụng trên website
                                </div>
                            </div>
                            <div class="">
                                <button class="uk-button uk-button-primary">Cập nhật hồ sơ</button>
                            </div>
                        </li>
                        <li class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium">Thông báo</h3>
                                <p class="text-sm text-muted-foreground"> Cấu hình cách bạn nhận thông báo. </p>
                            </div>
                            <div class="border-t border-border"></div>
                            <div class="space-y-2">
                                <span class="uk-form-label">Thông báo cho tôi về</span>
                                <label class="block text-sm" for="notification_0">
                                    <input id="notification_0" class="uk-radio mr-2" name="notification" type="radio">Tất
                                    cả thông báo</label>
                                <label class="block text-sm" for="notification_1">
                                    <input id="notification_1" class="uk-radio mr-2" name="notification" type="radio">
                                    Tin nhắn trực tiếp và đề cập </label>
                                <label class="block text-sm" for="notification_2">
                                    <input id="notification_2" class="uk-radio mr-2" name="notification" type="radio"
                                        checked="true"> Không có thông báo </label>
                            </div>
                            <div>
                                <h3 class="mb-4 text-lg font-medium">Email Notifications</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                        <div class="space-y-0.5">
                                            <label class="text-base font-medium" for="email_notification_0"> Communication
                                                emails
                                            </label>
                                            <div class="uk-form-help text-muted-foreground"> Receive emails about your
                                                account
                                                activity. </div>
                                        </div>
                                        <input class="uk-toggle-switch uk-toggle-switch-primary" id="email_notification_0"
                                            type="checkbox">
                                    </div>
                                    <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                        <div class="space-y-0.5">
                                            <label class="text-base font-medium" for="email_notification_1"> Marketing
                                                emails
                                            </label>
                                            <div class="uk-form-help text-muted-foreground"> Receive emails about new
                                                products,
                                                features, and more. </div>
                                        </div>
                                        <input class="uk-toggle-switch uk-toggle-switch-primary" id="email_notification_1"
                                            type="checkbox">
                                    </div>
                                    <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                        <div class="space-y-0.5">
                                            <label class="text-base font-medium" for="email_notification_2"> Social emails
                                            </label>
                                            <div class="uk-form-help text-muted-foreground"> Receive emails for friend
                                                requests,
                                                follows, and more. </div>
                                        </div>
                                        <input class="uk-toggle-switch uk-toggle-switch-primary" id="email_notification_2"
                                            type="checkbox" checked="true">
                                    </div>
                                    <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                        <div class="space-y-0.5">
                                            <label class="text-base font-medium" for="email_notification_3"> Security
                                                emails
                                            </label>
                                            <div class="uk-form-help text-muted-foreground"> Receive emails about your
                                                account
                                                activity and security. </div>
                                        </div>
                                        <input class="uk-toggle-switch uk-toggle-switch-primary" id="email_notification_3"
                                            type="checkbox" checked="true" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-x-3">
                                <input class="uk-checkbox mt-1" id="notification_mobile" type="checkbox" checked>
                                <div class="space-y-1">
                                    <label class="uk-form-label" for="notification_mobile"> Use different settings for my
                                        mobile
                                        devices </label>
                                    <div class="uk-form-help text-muted-foreground"> You can manage your mobile
                                        notifications
                                        in
                                        the mobile settings page. </div>
                                </div>
                            </div>
                            <div class="">
                                <button class="uk-button uk-button-primary"> Update notifications
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection