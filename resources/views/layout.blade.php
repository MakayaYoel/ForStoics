<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>For Stoics | Your average blog/social site about stoicism.</title>
    @vite('./resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"></script>
    <script src="{{asset('website_js/app.js')}}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://kit.fontawesome.com/c646f5869b.js" crossorigin="anonymous"></script>
</head>
<body class="h-screen bg-zinc-800">
    <x-flash-message />

    @include('partials._navigation_bar')

    <main>
        @yield('content')
    </main>

    @include('partials._footer')
</body>
</html>