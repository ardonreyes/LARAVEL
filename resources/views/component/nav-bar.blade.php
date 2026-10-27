<nav id="main-nav" class="w-6/10 bg-radial from-slate-800 to-slate-900 grid grid-rows-[70px_2px_auto] text-white h-full fixed text-center right-0 p-3 z-3 translate-x-full duration-300 md:w-4/10 lg:w-3/10 lg:translate-x-0 lg:left-0 lg:right-auto lg:w-2/10 xl:w-2/10">
    <button type="button" class="absolute left-2 top-2 lg:hidden" id="close-nav">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <div class="flex justify-center items-center">
        <h2>CORP</h2>
    </div>
    <div class="bg-white mx-2 md:mx-5"></div>
    <div class="animation_link-btn pt-4 flex flex-col gap-3 items-center">
        <a href="{{ url('/') }}" class="p-1 w-8/10">Home</a>
        <a href="{{ url('/about') }}" class="p-1 w-8/10">About</a>
        <a href="{{ url('/customers') }}" class="p-1 w-8/10">Customers</a>
        <a href="{{ url('/users') }}" class="p-1 w-8/10">Users</a>
    </div>
    <a href="{{ url('/logout') }}" class='absolute right-2 bottom-2 lg:right-auto lg:left-2 lg:-scale-x-100 opacity-0'>
        <i class="fa fa-sign-out"></i>
    </a>
</nav>