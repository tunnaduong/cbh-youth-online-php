@extends('layouts.default', [
    'description' => 'Đăng ký tài khoản của bạn để sử dụng các dịch vụ của Thanh niên Chuyên Biên Hòa Online.',
    'title' => 'Đăng ký',
])

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-neutral-800 px-4">
        <div
            class="rounded-xl border bg-card text-card-foreground shadow w-full bg-white dark:!bg-neutral-700 dark:!border-neutral-500 max-w-md">
            <div class="flex flex-col p-6 space-y-4 text-center">
                <div class="flex justify-center">
                    <a class="flex gap-x-1 items-center" href="/">
                        <img alt="CYO's Logo" width="50" src="/assets/images/logo.png">
                        <div class="text-[18px] text-left font-light text-[#319527] leading-5">
                            <h1 class="font-light">Thanh niên</h1>
                            <h1 class="font-bold">Chuyên Biên Hòa Online</h1>
                        </div>
                    </a>
                </div>
            </div>
            <div class="p-6 pt-0">
                <!-- if error then show -->
                @unless (empty($error))
                    <div class="alert alert-danger text-sm" role="alert">
                        {{ $error }}
                    </div>
                @endunless
                <form action="" method="POST" class="space-y-4">
                    <div class="space-y-2">
                        <input
                            class="flex dark:!border-neutral-500 h-9 border-input bg-transparent text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 w-full px-3 py-2 border rounded-md"
                            placeholder="Tên đăng nhập" type="text" name="username" value="{{ $_POST['username'] }}">
                    </div>
                    <div class="space-y-2">
                        <input
                            class="flex dark:!border-neutral-500 h-9 border-input bg-transparent text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 w-full px-3 py-2 border rounded-md"
                            placeholder="Họ và tên" type="text" name="name" value="{{ $_POST['name'] }}">
                    </div>
                    <div class="space-y-2">
                        <input
                            class="flex dark:!border-neutral-500 h-9 border-input bg-transparent text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 w-full px-3 py-2 border rounded-md"
                            placeholder="Địa chỉ Email" type="text" name="email" value="{{ $_POST['email'] }}">
                    </div>
                    <div class="space-y-2">
                        <input
                            class="flex dark:!border-neutral-500 h-9 border-input bg-transparent text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 w-full px-3 py-2 border rounded-md"
                            placeholder="Mật khẩu" type="password" name="password" value="{{ $_POST['password'] }}">
                    </div>
                    <div class="space-y-2">
                        <input
                            class="flex dark:!border-neutral-500 h-9 border-input bg-transparent text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 w-full px-3 py-2 border rounded-md"
                            placeholder="Nhập lại mật khẩu" type="password" name="confirm_password"
                            value="{{ $_POST['confirm_password'] }}">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Lf9QY4qAAAAAJuc1teb4_VpVRzrQj6HAf9GESU9"></div>
                    <button
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 shadow h-9 px-4 w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700"
                        type="submit">Đăng ký</button>
                    <div class="flex justify-between text-sm">
                        <a class="text-green-600 hover:underline hover:text-green-600" href="/password/reset">Quên mật
                            khẩu?</a>
                        <a class="text-green-600 hover:underline hover:text-green-600" href="/login">Đã có tài khoản?</a>
                    </div>
                </form>
            </div>
            <div class="flex items-center p-6 pt-0">
                <div class="w-full space-y-2">
                    <div class="text-center text-sm text-gray-600 dark:text-neutral-400">Đăng ký bằng</div>
                    <div class="flex justify-center space-x-4">
                        <a href="/login/facebook"
                            class="inline-flex dark:!border-neutral-500 dark:bg-[#2c2c2c] items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input shadow-sm hover:bg-[#eeeeee] hover:text-accent-foreground w-10 h-10"><svg
                                stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                                class="w-5 h-5 text-blue-600" height="1em" width="1em"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M480 257.35c0-123.7-100.3-224-224-224s-224 100.3-224 224c0 111.8 81.9 204.47 189 221.29V322.12h-56.89v-64.77H221V208c0-56.13 33.45-87.16 84.61-87.16 24.51 0 50.15 4.38 50.15 4.38v55.13H327.5c-27.81 0-36.51 17.26-36.51 35v42h62.12l-9.92 64.77H291v156.54c107.1-16.81 189-109.48 189-221.31z">
                                </path>
                            </svg><span class="sr-only">Facebook</span></a><a href="/login/google"
                            class="inline-flex dark:!border-neutral-500 dark:bg-[#2c2c2c] items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input shadow-sm hover:bg-[#eeeeee] hover:text-accent-foreground w-10 h-10"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-5 h-5">
                                <path fill="#FFC107"
                                    d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                                </path>
                                <path fill="#FF3D00"
                                    d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                                </path>
                                <path fill="#4CAF50"
                                    d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                                </path>
                                <path fill="#1976D2"
                                    d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                                </path>
                            </svg><span class="sr-only">Google</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
