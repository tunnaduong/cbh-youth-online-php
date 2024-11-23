@extends('layouts.default')

@section('content')
    <div class="min-h-screen flex items-center bg-gray-100 justify-center px-4">
        <div class="rounded-xl border bg-card text-card-foreground shadow w-full bg-white max-w-md">
            <div class="flex flex-col p-6 space-y-1">
                <h3 class="tracking-tight text-2xl font-bold text-center">Thiết lập lại mật khẩu</h3>
                <p class="text-sm text-muted-foreground text-center">Điền mật khẩu mới của bạn bên dưới.</p>
            </div>
            <div class="p-6 pt-0">
                <!-- if error then show -->
                @unless (empty($error))
                    <div class="alert alert-{{ $error_type }} text-sm" role="alert">
                        {{ $error }}
                    </div>
                @endunless
                <form action="" method="POST">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                for="newPassword">Mật khẩu mới</label>
                            <div class="relative">
                                <input type="password"
                                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                    id="newPassword" name="newPassword" required value="{{ $_POST['newPassword'] }}">
                                <button
                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-[#f1f5f9] h-9 w-9 absolute right-0 top-0"
                                    type="button" onclick="togglePassword('newPassword', this)">
                                    <ion-icon name="eye-outline" class="w-4 h-4"></ion-icon>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                for="confirmPassword">Xác nhận mật khẩu mới</label>
                            <div class="relative">
                                <input type="password"
                                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                    id="confirmPassword" name="confirmPassword" required
                                    value="{{ $_POST['confirmPassword'] }}">
                                <button
                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-[#f1f5f9] h-9 w-9 absolute right-0 top-0"
                                    type="button" onclick="togglePassword('confirmPassword', this)">
                                    <ion-icon name="eye-outline" class="w-4 h-4"></ion-icon>
                                </button>
                            </div>
                        </div>
                        <button
                            class="text-white inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-green-600 hover:bg-green-700"
                            type="submit">Thiết lập lại mật khẩu</button>
                    </div>
                </form>
            </div>
            <div class="flex items-center p-6 pt-0">
                <p class="text-center text-sm text-gray-600 mt-2 w-full">Đã nhớ mật khẩu?
                    <a class="text-green-600 hover:underline hover:text-green-600" href="/login">Quay lại Đăng nhập</a>
                </p>
            </div>
        </div>
    </div>
@endsection
