@extends('layouts.error', [
    'description' => 'Quản lý cài đặt tài khoản và thiết lập thông báo email.',
    'title' => 'Cài đặt',
])

@section('content')
    @unless (empty($success))
        <div class="alert alert-success alert-dismissible fade show rounded-none mb-0 text-sm" role="alert">
            {!! $success !!}
            <button type="button" class="btn-close text-[9px] !top-[2px]" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endunless
    <div class="!p-4 sm:!p-6">
        <div class="bg-white !p-4 sm:!p-6 rounded-2xl border shadow-md">
            <div class="space-y-0.5">
                <h2 class="text-2xl font-bold tracking-tight">Cài đặt</h2>
                <p class="text-muted-foreground">Quản lý cài đặt tài khoản và thiết lập thông báo email.</p>
            </div>
            <div class="my-6 border-top"></div>
            <div class="flex flex-col lg:flex-row gap-x-12">
                <aside class="w-full lg:w-1/5 mb-4">
                    <ul class="uk-nav uk-nav-primary"
                        uk-switcher="connect: #component-nav; animation: uk-animation-fade; active: {{ $active ?? 0 }}"
                        uk-nav>
                        <li>
                            <a href="#" class="mx-0">Trang cá nhân</a>
                        </li>
                        <li>
                            <a href="#" class="mx-0">Tài khoản</a>
                        </li>
                        <li>
                            <a href="#" class="mx-0">Thông báo</a>
                        </li>
                    </ul>
                </aside>
                <div class="flex-1">
                    <ul id="component-nav" class="uk-switcher max-w-2xl">
                        <li class="space-y-6 ">
                            <div>
                                <h3 class="text-lg font-medium">Trang cá nhân</h3>
                                <p class="text-sm text-muted-foreground"> Đây là cách người khác sẽ nhìn thấy bạn trên trang
                                    web. </p>
                            </div>
                            <div class="border-t border-border"></div>
                            <form action="" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="type" value="profile_edit">
                                <div class="space-y-2">
                                    <label class="uk-form-label" for="username">Tên đăng nhập</label>
                                    <input class="uk-input" id="username" name="username" type="text"
                                        value="{{ $profile->username }}">
                                    <div class="uk-form-help text-muted-foreground">Đây là tên hiển thị công khai của bạn.
                                        Nó
                                        có thể là tên thật hoặc biệt danh của bạn. Bạn chỉ có thể thay đổi tên đăng nhập mỗi
                                        30
                                        ngày một lần. </div>
                                    @unless (empty($error['username']))
                                        <div class="uk-form-help text-destructive">
                                            {{ $error['username'] }}
                                        </div>
                                    @endunless
                                </div>
                                <div class="space-y-2">
                                    <label class="uk-form-label" for="email">Email đăng ký</label>
                                    <input class="uk-input" id="email" name="email"
                                        {{ $profile->email_verified_at ? 'disabled' : '' }} type="text"
                                        value="{{ $profile->email }}">
                                    @unless ($profile->email_verified_at)
                                        <div class="uk-form-help text-muted-foreground">Bạn chưa xác minh email. <a
                                                href="/{{ $profile->username }}/email/verify"
                                                class="underline underline-offset-[3.2px]">Xác minh ngay</a>.
                                        </div>
                                    @else
                                        <input type="hidden" name="email" value="{{ $profile->email }}" />
                                        <div class="uk-form-help text-muted-foreground">Bạn không thể đổi địa chỉ email sau khi
                                            đã xác minh.</div>
                                    @endunless
                                    @unless (empty($error['email']))
                                        <div class="uk-form-help text-destructive">
                                            {{ $error['email'] }}
                                        </div>
                                    @endunless
                                </div>
                                <div class="space-y-2">
                                    <span class="uk-form-label">Giới tính</span>
                                    <div class="uk-form-controls flex gap-x-3">
                                        <label class="flex items-center text-sm" for="gender_0">
                                            <input id="gender_0" class="mr-2" name="gender" type="radio"
                                                {{ $profile->gender == 'Male' ? 'checked' : '' }} value="Male">Nam</label>
                                        <label class="flex items-center text-sm" for="gender_1">
                                            <input id="gender_1" class="mr-2"
                                                {{ $profile->gender == 'Female' ? 'checked' : '' }} name="gender"
                                                type="radio" value="Female">Nữ</label>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="uk-form-label" for="location">Quê quán</label>
                                    <input class="uk-input" placeholder="Nhập nơi bạn sinh sống" id="location"
                                        name="location" type="text" value="{{ $profile->location }}">
                                </div>
                                <div class="space-y-2">
                                    <label class="uk-form-label" for="bio">Tiểu sử</label>
                                    <textarea class="uk-textarea" id="bio" name="bio"
                                        placeholder="Hãy cho chúng tôi biết một chút về bản thân bạn">{{ $profile->bio }}</textarea>
                                    @unless (empty($error['bio']))
                                        <div class="uk-form-help text-destructive">
                                            {{ $error['bio'] }}
                                        </div>
                                    @endunless
                                </div>
                                <div>
                                    <button type="submit" class="uk-button uk-button-primary">Cập nhật hồ
                                        sơ</button>
                                </div>
                            </form>
                        </li>
                        <li class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium">Tài khoản</h3>
                                <p class="text-sm text-muted-foreground"> Cập nhật cài đặt tài khoản của bạn. Đặt ngôn ngữ
                                    và múi giờ ưa thích của bạn. </p>
                            </div>
                            <div class="border-t border-border"></div>
                            <form action="" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="type" value="account_edit">
                                <div class="space-y-2">
                                    <label class="uk-form-label" for="name">Họ và tên</label>
                                    <input class="uk-input" id="name" name="profile_name" type="text"
                                        placeholder="Tên của bạn" value="{{ $profile->profile_name }}">
                                    <div class="uk-form-help text-muted-foreground">Đây là tên sẽ được hiển thị công khai
                                        trên
                                        hồ sơ của
                                        bạn, bảng tin và diễn đàn.</div>
                                    @unless (empty($error['profile_name']))
                                        <div class="uk-form-help text-destructive">
                                            {{ $error['profile_name'] }}
                                        </div>
                                    @endunless
                                </div>
                                <div class="space-y-2">
                                    <label class="uk-form-label block" for="date_of_birth">Ngày tháng năm sinh</label>
                                    <input class="uk-input w-[240px]" name="birthday" id="date_of_birth" type="date"
                                        placeholder="Chọn một ngày" value="{{ $profile->birthday }}" min="1900-01-01"
                                        max="{{ date('Y-m-d') }}">
                                    <div class="uk-form-help text-muted-foreground">Ngày sinh của bạn được sử dụng để tính
                                        toán
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
                                    <div class="uk-form-help text-muted-foreground">Đây là ngôn ngữ sẽ được sử dụng trên
                                        website
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="uk-button uk-button-primary">Cập nhật hồ
                                        sơ</button>
                                </div>
                            </form>
                        </li>
                        <li class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium">Thông báo</h3>
                                <p class="text-sm text-muted-foreground">Cấu hình cách bạn nhận thông báo.</p>
                            </div>
                            <div class="border-t border-border"></div>
                            <form action="" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="type" value="notification_edit">
                                <div class="space-y-2">
                                    <span class="uk-form-label">Thông báo cho tôi về</span>
                                    <div class="uk-form-controls">
                                        <label class="flex items-center text-sm" for="notification_0">
                                            <input id="notification_0" class="mr-2" name="notify_type" type="radio"
                                                {{ $profile->notify_type == 'all' ? 'checked' : '' }} value="all">Tất
                                            cả thông báo</label>
                                        <label class="flex items-center text-sm" for="notification_1">
                                            <input id="notification_1" class="mr-2" name="notify_type" type="radio"
                                                {{ $profile->notify_type == 'direct_mentions' ? 'checked' : '' }}
                                                value="direct_mentions">Tin
                                            nhắn trực tiếp và đề cập</label>
                                        <label class="flex items-center text-sm" for="notification_2">
                                            <input id="notification_2" class="mr-2" name="notify_type" type="radio"
                                                {{ $profile->notify_type == 'none' ? 'checked' : '' }}
                                                value="none">Không có thông báo</label>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="mb-4 text-lg font-medium">Thông báo qua email</h3>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                            <div class="space-y-0.5">
                                                <label class="text-base font-medium" for="email_notification_0"> Email
                                                    liên
                                                    lạc
                                                </label>
                                                <div class="uk-form-help text-muted-foreground"> Nhận email về hoạt động
                                                    tài
                                                    khoản của bạn. </div>
                                            </div>
                                            <input class="uk-toggle-switch uk-toggle-switch-primary shrink-0 ml-2"
                                                id="email_notification_0" type="checkbox"
                                                {{ $profile->notify_email_contact == '1' ? 'checked' : '' }}
                                                name="notify_email_contact" value="1">
                                        </div>
                                        <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                            <div class="space-y-0.5">
                                                <label class="text-base font-medium" for="email_notification_1">Email
                                                    marketing
                                                </label>
                                                <div class="uk-form-help text-muted-foreground"> Nhận email về sản phẩm
                                                    mới,
                                                    tính năng, và nhiều hơn nữa. </div>
                                            </div>
                                            <input class="uk-toggle-switch uk-toggle-switch-primary shrink-0 ml-2"
                                                id="email_notification_1" type="checkbox" name="notify_email_marketing"
                                                value="1"
                                                {{ $profile->notify_email_marketing == '1' ? 'checked' : '' }}>
                                        </div>
                                        <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                            <div class="space-y-0.5">
                                                <label class="text-base font-medium" for="email_notification_2"> Email xã
                                                    hội
                                                </label>
                                                <div class="uk-form-help text-muted-foreground"> Nhận email về yêu cầu kết
                                                    bạn,
                                                    theo dõi, và nhiều hơn nữa. </div>
                                            </div>
                                            <input class="uk-toggle-switch uk-toggle-switch-primary shrink-0 ml-2"
                                                id="email_notification_2" type="checkbox" name="notify_email_social"
                                                value="1"
                                                {{ $profile->notify_email_social == '1' ? 'checked' : '' }}>
                                        </div>
                                        <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                            <div class="space-y-0.5">
                                                <label class="text-base font-medium" for="email_notification_3"> Email bảo
                                                    mật
                                                </label>
                                                <div class="uk-form-help text-muted-foreground"> Nhận email về hoạt động và
                                                    bảo
                                                    mật tài khoản của bạn. </div>
                                            </div>
                                            <input class="uk-toggle-switch uk-toggle-switch-primary shrink-0 ml-2"
                                                id="email_notification_3" type="checkbox" checked="true" disabled
                                                name="notify_email_security" value="1">
                                            <input type="hidden" name="notify_email_security" value="1">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="uk-button uk-button-primary"> Cập nhật thông báo
                                        </button2>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
