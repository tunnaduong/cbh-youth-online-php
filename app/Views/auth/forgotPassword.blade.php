@extends('layouts.default', [
    'description' => 'Quên mật khẩu của bạn? Nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn một liên kết để thiết lập lại mật khẩu.',
    'title' => 'Quên mật khẩu',
])

@section('content')
    <div class="min-h-screen flex items-center bg-gray-100 dark:bg-neutral-800 justify-center px-4">
        <div class="rounded-xl border bg-card text-card-foreground shadow w-full bg-white dark:!bg-neutral-700 dark:!border-neutral-500 max-w-md">
            <div class="flex flex-col p-6 space-y-1">
                <h3 class="tracking-tight text-2xl font-bold text-center">Quên mật khẩu</h3>
                <p class="text-sm text-muted-foreground text-center">Nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn
                    một liên kết để thiết lập lại mật khẩu.</p>
            </div>
            <div class="p-6 pt-0">
                <!-- if error then show -->
                @unless (empty($error))
                    <div class="alert alert-{{ $error_type }} text-sm" role="alert">
                        {{ $error }}
                    </div>
                @endunless
                @unless ($error_type == 'success')
                    <form action="" method="POST">
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                    for="email">Email</label>
                                <input
                                    class="flex dark:!border-neutral-500 h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                                    id="email" placeholder="user@example.com" required type="email"
                                    value="{{ $_POST['email'] }}" name="email">
                            </div>
                            <button
                                class="text-white inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-green-600 hover:bg-green-700"
                                type="submit">Gửi link reset mật khẩu</button>
                        </div>
                    </form>
                @endunless
            </div>
            <div class="flex items-center p-6 pt-0">
                <p class="text-center text-sm text-gray-600 mt-2 w-full dark:text-neutral-400">Đã nhớ mật khẩu? <a
                        class="text-green-600 hover:underline hover:text-green-600" href="/login">Quay lại Đăng nhập</a>
                </p>
            </div>
        </div>
    </div>
@endsection
