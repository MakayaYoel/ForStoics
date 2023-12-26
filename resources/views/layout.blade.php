<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>For Stoics | Your average blog/social site about stoicism.</title>
    @vite('./resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body class="h-screen bg-zinc-800">
    @include('partials._navigation_bar')

    <main class='h-screen'>
        @yield('content')
    </main>

    @include('partials._footer')
</body>
</html>