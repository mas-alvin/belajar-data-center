<header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 md:px-6 z-30 flex-shrink-0">
    <div class="flex items-center gap-3">
        {{-- Toggle Button --}}
        <button onclick="toggleSidebar()"
                class="p-2 rounded-lg text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 transition-all focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
            </svg>
        </button>

        <div class="ml-1">
            <h1 class="text-base md:text-lg font-bold text-gray-800 leading-tight">@yield('page-title', 'Dashboard')</h1>
            <p class="hidden sm:block text-[11px] text-emerald-600 font-medium uppercase tracking-wider">Data Center Management</p>
        </div>
    </div>

    <div class="flex items-center gap-2 md:gap-4">
        {{-- Search --}}
        <div class="relative hidden lg:block">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text"
                   class="w-64 py-2 pl-10 pr-4 text-sm bg-gray-100 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500 transition-all"
                   placeholder="Cari data...">
        </div>

        {{-- Bell --}}
        <button class="relative p-2 rounded-xl text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
        </button>

        <div class="h-8 w-px bg-gray-200 mx-1 hidden md:block"></div>

        {{-- Avatar --}}
        <div class="flex items-center gap-2 pl-1 cursor-pointer group">
            <img class="w-9 h-9 rounded-xl border-2 border-transparent group-hover:border-emerald-500 transition-all"
                 src="https://ui-avatars.com/api/?name=Admin+User&background=d1fae5&color=065f46&size=64" alt="Avatar">
            <div class="hidden md:block">
                <p class="text-sm font-bold text-gray-700 group-hover:text-emerald-700">Admin</p>
            </div>
        </div>
    </div>
</header>
