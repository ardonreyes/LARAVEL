<div class="col-span-full headers">
    <div>
        <h1 class='-mb-1'>{{ $pageInfo['title'] }}</h1>
        <p class='italic'>{{ $pageInfo['description'] }}</p>
    </div>
    <div class="flex items-center justify-center gap-2">
        <button type="button" id="open-nav" class="lg:hidden">
            <i class="fa-solid fa-bars"></i>
        </button>
        @if (request()->is('users', 'users/*', 'customers', 'customers/*'))
            <a
                href="{{ url(request()->is('customers', 'customers/*') ? 'customers/create' : 'users/create') }}"
                data-modal-open="create"
                class="inline-flex size-8 items-center justify-center rounded-md transition hover:bg-slate-200 hover:text-gray-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-700"
                title="Add {{ request()->is('customers', 'customers/*') ? 'customer' : 'user' }}"
            >
                <i class="fa-solid fa-plus"></i>
            </a>
        @endif
    </div>
</div>
