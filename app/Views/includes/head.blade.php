<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>{{ !empty($title) ? $title . ' - ' : '' }}Thanh niên Chuyên Biên Hòa Online</title>
<!-- Meta tag dành cho SEO -->
<meta property="og:title" content="{{ $title ?? 'Thanh niên Chuyên Biên Hòa Online' }}" />
<meta name="description"
    content="{{ $description ?? 'Mạng xã hội Thanh niên Chuyên Biên Hòa Online thuộc Trường THPT Chuyên Hà Nam' }}">
<meta name="author" content="{{ $author ?? 'Đội ngũ CBH Youth Online' }}">
<meta name="keywords"
    content="{{ $keywords ??
        'thpt chuyen ha nam, thanh nien chuyen bien hoa, thanh nien chuyen bien hoa online, thpt chuyen bien hoa, chuyen bien hoa, chuyen ha nam, cyo, cbh youth online' }}">
<link rel="icon" href="/assets/images/logo.png" type="image/png" sizes="32x32" />
<meta property="og:image" content="{{ $image ?? 'https://chuyenbienhoa.com/assets/images/cyo_thumbnail.png' }}" />
<!-- Bộ mã jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Bộ mã Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<!-- Bộ mã TailwindCSS -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/@tailwindcss/typography@0.5.0/dist/typography.min.css" rel="stylesheet">
<!-- Bộ mã Font Awesome -->
<script src="https://kit.fontawesome.com/5468db3c8c.js" crossorigin="anonymous"></script>
<!-- Bộ mã Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Bộ mã Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"></script>
<!-- Bộ mã Google Fonts - Font: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
<!-- Bộ mã Bootstrap Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Bộ mã Google Recaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- Bộ mã Franken UI -->
<link rel="stylesheet" href="https://unpkg.com/franken-ui@1.1.0/dist/css/core.min.css" />
<script src="https://unpkg.com/franken-ui@1.1.0/dist/js/core.iife.js" type="module"></script>
<script src="https://unpkg.com/franken-ui@1.1.0/dist/js/icon.iife.js" type="module"></script>
<!-- Bộ mã riêng cho giao diện trang web -->
<link href="/assets/css/reset.css" rel="stylesheet">
<link href="/assets/css/style.css" rel="stylesheet">
