<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>{{ config('app.name') }} - {{ $pageInfo['title'] }}</title>
</head>
<body class="overflow-x-hidden">
    @include('component.nav-bar')
    <div class="backdrop-blur-md bg-black/10 w-full h-full fixed z-2 opacity-0 duration-300 pointer-events-none inset-0" id="ui-backdrop-nav"></div>

    <section class='grid grid-rows-[1fr_180px] h-screen lg:w-7/10 lg:absolute lg:right-0 xl:w-8/10 duration-300'>
        <div class='p-3 bg-gray-100'>
            @yield('content')
        </div>
        @include('component.footer')
    </section>
</body>
</html>
