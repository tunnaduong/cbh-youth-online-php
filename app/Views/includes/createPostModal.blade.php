<div id="myModal" class="modal">
    <div class="modal-content">
        <div>
            <div class="flex flex-row justify-center items-center p-[15px]">
                @if ($recordings ?? false)
                    <h1 class="text-lg font-bold text-center">Tạo ghi âm</h1>
                @else
                    <h1 class="text-lg font-bold text-center">Tạo bài viết</h1>
                @endif
            </div>
            <div class="relative">
                <span
                    class="close w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center absolute right-[13px] -top-[44px]"><ion-icon
                        name="close-outline" class="text-2xl"></ion-icon>
                </span>
            </div>
            <hr>
            <div class="p-3 flex flex-row items-center">
                <img src="{{ isset($_SESSION['user']->additional_info->oauth_profile_picture) ? $_SESSION['user']->additional_info->oauth_profile_picture : (!empty($_SESSION['user']->additional_info->profile_picture) ? 'https://api.chuyenbienhoa.com/v1.0/users/' . $_SESSION['user']->username . '/avatar' : '/assets/images/placeholder-user.jpg') }}"
                    alt="{{ $_SESSION['user']->username }}'s avatar" class="border w-11 h-11 rounded-full">
                <div class="flex flex-col ml-2">
                    <span
                        class="text-base font-semibold mb-0.5 flex items-center">{{ $_SESSION['user']->additional_info->profile_name ?? '' }}
                        @if ($_SESSION['user']->additional_info->verified ?? 0 == 1)
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                aria-hidden="true" class="text-base ml-0.5 text-green-600 mt-0.5" height="1em"
                                width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </span>
                    <button class="flex items-center bg-gray-200 rounded-md px-1.5 py-0.5 cursor-pointer w-max">
                        <ion-icon name="earth" class="text-base mt-[1px] mr-0.5"></ion-icon>
                        <span class="text-sm font-semibold">Công khai</span>
                        <ion-icon name="caret-down-outline" class="text-[9px] mt-[1px] ml-0.5"></ion-icon>
                    </button>
                </div>
            </div>
            <form action="/" id="createPostForm" method="POST" class="flex flex-col space-y-4 px-3 pb-3">
                <input id="postTitle"
                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 focus-visible:ring-0"
                    placeholder="Tiêu đề bài viết" name="title" type="text" value="">
                <div class="rounded-md border shadow-sm pb-2 bg-gray-100">
                    <textarea id="postDescription"
                        class="-ml-[1px] -mt-[1px] !mb-1 flex w-full rounded-md border-input bg-white px-3 py-2 text-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 min-h-[120px] border focus-visible:ring-0"
                        name="content" placeholder="Nội dung bài viết" style="width: calc(100% + 2px);"></textarea>
                    <div class="px-3 flex items-center gap-x-2 mt-3">
                        <a href="/Admin/posts/213057" class="-mt-1.5 text-xs font-bold block border-right pr-2"
                            target="_blank">
                            <i class="fa-brands fa-markdown mr-1"></i>
                            Hỗ trợ
                            Markdown
                        </a>
                        <a href="/Admin/posts/213054" class="-mt-1.5 text-xs font-bold block" target="_blank">
                            <i class="fa-solid fa-file-lines mr-1"></i>
                            Quy tắc
                        </a>
                    </div>
                </div>
                <uk-select id="subforumId" name="subforumId" uk-cloak placeholder="Chọn chuyên mục phù hợp">
                    @php
                        // nếu người dùng hiện tại là admin thì lấy tất cả các chuyên mục
                        if (($_SESSION['user']->role ?? null) === 'admin') {
                            $categories = (new \App\Models\Forum())->getCategories();
                        }
                        // ngược lại thì lấy tất cả các chuyên mục trừ chuyên mục admin
                        else {
                            $categories = (new \App\Models\Forum())->getCategoriesExceptAdmin();
                        }
                        foreach ($categories as $category) {
                            $category->subforums = (new \App\Models\Forum())->getSubforumsByMainCategoryId(
                                $category->id,
                            );
                        }
                    @endphp
                    @foreach ($categories as $category)
                        <optgroup label="{{ $category->name }}">
                            @foreach ($category->subforums as $subforum)
                                <option value="{{ $subforum->id }}">{{ $subforum->name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </uk-select>
                @if ($recordings ?? false)
                    <div class="flex flex-row items-center rounded-lg border bg-card text-card-foreground p-3">
                        <p class="text-sm font-medium flex-1">Thêm file âm thanh vào bài viết của bạn</p>
                        <input id="fileInput" accept="audio/*" type="file" style="display: none;">
                        <div class="flex gap-1">
                            <button
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-slate-100 hover:text-accent-foreground h-9 w-9 shrink-0 rounded-full"
                                type="button" id="selectImage">
                                <ion-icon name="mic" class="text-xl mr-1 text-red-500"></ion-icon>
                            </button>
                        </div>
                    </div>
                @else
                    <img id="imagePreview" alt="Preview" class="border rounded-md hidden"
                        style="width: 100px; height: 100px; object-fit: cover" />
                    <div class="flex flex-row items-center rounded-lg border p-3">
                        <p class="text-sm font-medium flex-1">Thêm ảnh vào bài viết của bạn</p>
                        <input id="fileInput" accept="image/*" type="file" style="display: none;">
                        <div class="flex gap-1">
                            <button
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-slate-100 hover:text-accent-foreground h-9 w-9 shrink-0 rounded-full"
                                type="button" id="selectImage">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-image h-5 w-5 text-emerald-500">
                                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2">
                                    </rect>
                                    <circle cx="9" cy="9" r="2"></circle>
                                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
                <button id="createPostButton"
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground shadow h-9 px-4 py-2 w-full bg-green-600 hover:bg-green-700 text-white"
                    type="submit" disabled>Đăng</button>
            </form>
        </div>
    </div>
</div>

<script>
    // getSubforums
    @php
        $subforums = (new \App\Models\Forum())->getSubforums();
    @endphp
    const subforum = {
        @foreach ($subforums as $subforum)
            "{!! $subforum->name !!}": {{ $subforum->id }},
        @endforeach
    };
</script>
