<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'Dashboard Santri') - Darel Arifien
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-[#F5F7F6] text-gray-900">

    <div x-data="{ sidebarOpen: false }" class="min-h-screen">

        {{-- MOBILE OVERLAY --}}
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 lg:hidden">
        </div>

        {{-- SIDEBAR --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col bg-[#062E1F] text-white shadow-2xl transition-transform duration-300 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            {{-- BRAND --}}
            <div class="flex h-20 items-center border-b border-white/10 px-6">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#087443] shadow-lg">
                    <span class="text-lg font-black">
                        DA
                    </span>
                </div>

                <div class="ml-3">
                    <p class="text-sm font-bold tracking-wide">
                        DAREL ARIFIEN
                    </p>

                    <p class="text-xs text-emerald-200">
                        Sistem Akademik
                    </p>
                </div>

                {{-- CLOSE MOBILE --}}
                <button @click="sidebarOpen = false"
                    class="ml-auto rounded-lg p-2 text-white/70 hover:bg-white/10 hover:text-white lg:hidden">
                    <i data-lucide="x" class="h-5 w-5"></i>
                </button>

            </div>

            {{-- SANTRI PROFILE --}}
            <div class="border-b border-white/10 px-5 py-5">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-300">
                        <i data-lucide="user" class="h-5 w-5"></i>
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="mt-0.5 text-xs text-emerald-200">
                            Santri
                        </p>
                    </div>

                </div>

            </div>

            {{-- NAVIGATION --}}
            <nav class="flex-1 overflow-y-auto px-4 py-5">

                <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.18em] text-emerald-300/70">
                    Menu Utama
                </p>

                <div class="space-y-1">

                    {{-- DASHBOARD --}}
                    <a href="{{ route('santri.dashboard') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('santri.dashboard')
                        ? 'bg-[#087443] text-white shadow-lg shadow-black/10'
                        : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="h-5 w-5"></i>

                        <span>Dashboard</span>
                    </a>

                    {{-- PROFIL --}}
                    <a href="{{ route('santri.profile') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
    {{ request()->routeIs('santri.profile')
        ? 'bg-[#087443] text-white shadow-lg shadow-black/10'
        : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <i data-lucide="user-round" class="h-5 w-5"></i>

                        <span>Profil Saya</span>
                    </a>

                    {{-- JADWAL --}}
                    <a href="{{ route('santri.schedules.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
   {{ request()->routeIs('santri.schedules.*')
       ? 'bg-[#087443] text-white shadow-lg shadow-black/10'
       : 'text-white/70 hover:bg-white/10 hover:text-white' }}">

                        <i data-lucide="calendar-days" class="h-5 w-5"></i>

                        <span>Jadwal</span>

                    </a>

                    {{-- MATA PELAJARAN --}}
                    <a href="{{ route('santri.subjects.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition
   {{ request()->routeIs('santri.subjects.*')
       ? 'bg-[#087443] text-white shadow-lg shadow-black/10'
       : 'text-white/70 hover:bg-white/10 hover:text-white' }}">

                        <i data-lucide="book-open" class="h-5 w-5"></i>

                        <span>Mata Pelajaran</span>

                    </a>

                    {{-- NILAI --}}
                    <a href="#"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-white/70 transition hover:bg-white/10 hover:text-white">
                        <i data-lucide="chart-no-axes-column" class="h-5 w-5"></i>

                        <span>Nilai</span>
                    </a>

                    {{-- RAPOR --}}
                    <a href="#"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-white/70 transition hover:bg-white/10 hover:text-white">
                        <i data-lucide="file-text" class="h-5 w-5"></i>

                        <span>Rapor</span>
                    </a>

                </div>

                <div class="my-6 border-t border-white/10"></div>

                <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.18em] text-emerald-300/70">
                    Akun
                </p>

                <div class="space-y-1">

                    {{-- PENGATURAN --}}
                    <a href="#"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-white/70 transition hover:bg-white/10 hover:text-white">
                        <i data-lucide="settings" class="h-5 w-5"></i>

                        <span>Pengaturan</span>
                    </a>

                </div>

            </nav>

            {{-- SIDEBAR FOOTER --}}
            <div class="border-t border-white/10 p-4">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-red-200 transition hover:bg-red-500/10 hover:text-red-100">
                        <i data-lucide="log-out" class="h-5 w-5"></i>

                        <span>Keluar</span>
                    </button>
                </form>

            </div>

        </aside>


        {{-- MAIN --}}
        <div class="lg:pl-72">

            {{-- TOPBAR --}}
            <header class="sticky top-0 z-30 border-b border-gray-200/80 bg-white/90 backdrop-blur">

                <div class="flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">

                    {{-- MOBILE MENU --}}
                    <button @click="sidebarOpen = true"
                        class="flex h-10 w-10 items-center justify-center rounded-xl text-gray-600 transition hover:bg-gray-100 lg:hidden">
                        <i data-lucide="menu" class="h-5 w-5"></i>
                    </button>

                    {{-- PAGE TITLE --}}
                    <div class="hidden sm:block">
                        <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                            Sistem Akademik
                        </p>

                        <h2 class="text-lg font-bold text-gray-900">
                            @yield('page-title', 'Dashboard')
                        </h2>
                    </div>

                    {{-- RIGHT --}}
                    <div class="ml-auto flex items-center gap-3">

                        {{-- NOTIFICATION --}}
                        <button
                            class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-500 transition hover:border-gray-300 hover:text-gray-800">
                            <i data-lucide="bell" class="h-5 w-5"></i>

                            <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-emerald-500"></span>
                        </button>

                        {{-- USER --}}
                        <div class="hidden items-center gap-3 border-l border-gray-200 pl-4 sm:flex">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-[#062E1F] text-sm font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <div class="hidden xl:block">
                                <p class="max-w-40 truncate text-sm font-semibold text-gray-900">
                                    {{ auth()->user()->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    Santri
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </header>


            {{-- CONTENT --}}
            <main class="min-h-[calc(100vh-5rem)] p-4 sm:p-6 lg:p-8">

                @if (session('success'))
                    <div
                        class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')

            </main>

        </div>

    </div>

    <script>
        if (window.lucide) {
            lucide.createIcons();
        }
    </script>

</body>

</html>
