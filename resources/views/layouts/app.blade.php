<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — DataCenter SMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 10px; }
        @media (min-width: 768px) {
            #sidebar.collapsed { width: 5rem; }
            #sidebar.collapsed .sidebar-text,
            #sidebar.collapsed .sidebar-label { opacity: 0; display: none; }
            #sidebar.collapsed .sidebar-item { justify-content: center; padding-left: 0; padding-right: 0; }
            #sidebar.collapsed .brand-text { display: none; }
            #sidebar.collapsed .user-info { display: none; }
        }
    </style>
</head>
<body class="h-full bg-gray-50 text-gray-800 antialiased">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar Partial --}}
    @include('layouts._sidebar')

    {{-- Mobile Overlay --}}
    <div id="sidebarOverlay"
         class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm hidden md:hidden"
         onclick="toggleSidebar()"></div>

    {{-- Main --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- Navbar Partial --}}
        @include('layouts._navbar')

        {{-- Content --}}
        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="p-4 md:p-8 max-w-7xl mx-auto">
                {{-- Breadcrumb --}}
                <div class="mb-6 flex items-center text-xs text-gray-400 gap-2">
                    <span class="hover:text-emerald-600 cursor-pointer">App</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-gray-600 font-medium">@yield('page-title', 'Dashboard')</span>
                </div>

                @yield('content')
            </div>
        </main>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (window.innerWidth < 768) {
            const isHidden = sidebar.classList.contains('-translate-x-full');
            if (isHidden) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        } else {
            sidebar.classList.toggle('collapsed');
        }
    }
    function showToast(message, type = 'success') {
        let bgColor = "#10b981"; // emerald-500
        if (type === 'error') bgColor = "#ef4444"; // red-500
        if (type === 'warning') bgColor = "#f59e0b"; // amber-500
        if (type === 'info') bgColor = "#3b82f6"; // blue-500

        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: bgColor,
                borderRadius: "12px",
                fontWeight: "600",
                fontSize: "14px",
                boxShadow: "0 10px 15px -3px rgba(0, 0, 0, 0.1)"
            }
        }).showToast();
    }

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            document.getElementById('sidebarOverlay').classList.add('hidden');
            document.getElementById('sidebar').classList.remove('-translate-x-full');
        }
    });
</script>

@stack('scripts')
</body>
</html>