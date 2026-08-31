<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Dashboard Guru')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50 text-gray-900 antialiased">

    <div class="min-h-screen">

        {{-- SIDEBAR --}}

        <aside
            class="fixed inset-y-0 left-0 z-50
                   hidden w-72
                   border-r border-white/10
                   bg-[#062E1F]
                   lg:block">

            {{-- LOGO --}}

            <div class="flex h-20 items-center px-6">

                <a href="{{ route('guru.dashboard') }}" class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-xl
                               bg-[#F4C542]
                               text-[#062E1F]">

                        <i data-lucide="graduation-cap" class="h-6 w-6"></i>

                    </div>

                    <div>

                        <p class="text-sm font-black text-white">
                            Darel Arifien
                        </p>

                        <p
                            class="text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.2em]
                                   text-[#F4C542]">
                            Guru Panel
                        </p>

                    </div>

                </a>

            </div>


            {{-- USER --}}

            <div class="px-5 pt-5">

                <div
                    class="rounded-2xl
                           border border-white/10
                           bg-white/5
                           p-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10
                                   items-center justify-center
                                   rounded-xl
                                   bg-[#087443]
                                   text-white">

                            <i data-lucide="user" class="h-5 w-5"></i>

                        </div>

                        <div class="min-w-0">

                            <p class="truncate text-sm font-bold text-white">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-white/40">
                                Guru
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- NAVIGATION --}}

            <nav class="px-4 py-6">

                <p
                    class="mb-3 px-3
                           text-[10px]
                           font-bold
                           uppercase
                           tracking-widest
                           text-white/30">
                    Utama
                </p>


                {{-- DASHBOARD --}}

                <a href="{{ route('guru.dashboard') }}"
                    class="flex items-center gap-3
                           rounded-xl
                           px-4 py-3
                           text-sm font-semibold
                           text-white/70
                           transition
                           hover:bg-white/10
                           hover:text-white">

                    <i data-lucide="layout-dashboard" class="h-5 w-5"></i>

                    <span>Dashboard</span>

                </a>


                {{-- AKADEMIK --}}

                <div class="pt-6">

                    <p
                        class="mb-3 px-3
                               text-[10px]
                               font-bold
                               uppercase
                               tracking-widest
                               text-white/30">
                        Akademik
                    </p>


                    <a href="{{ route('guru.schedules.index') }}""
                        class="flex items-center gap-3
                               rounded-xl
                               px-4 py-3
                               text-sm font-semibold
                               text-white/70
                               transition
                               hover:bg-white/10
                               hover:text-white">

                        <i data-lucide="calendar-days" class="h-5 w-5"></i>

                        <span>Jadwal Mengajar</span>

                    </a>


                    <a href="{{ route('guru.class.index') }}"
                        class="mt-1 flex items-center gap-3
                               rounded-xl
                               px-4 py-3
                               text-sm font-semibold
                               text-white/70
                               transition
                               hover:bg-white/10
                               hover:text-white">

                        <i data-lucide="school" class="h-5 w-5"></i>

                        <span>Kelas Saya</span>

                    </a>


                    <a href="#"
                        class="mt-1 flex items-center gap-3
                               rounded-xl
                               px-4 py-3
                               text-sm font-semibold
                               text-white/70
                               transition
                               hover:bg-white/10
                               hover:text-white">

                        <i data-lucide="clipboard-list" class="h-5 w-5"></i>

                        <span>Tugas & Nilai</span>

                    </a>

                </div>


                {{-- AKUN --}}

                <div class="pt-6">

                    <p
                        class="mb-3 px-3
                               text-[10px]
                               font-bold
                               uppercase
                               tracking-widest
                               text-white/30">
                        Akun
                    </p>

                    <a href="{{ route('guru.profile') }}"
                        class="flex items-center gap-3
           rounded-xl
           px-4 py-3
           text-sm font-semibold
           text-white/70
           transition
           hover:bg-white/10
           hover:text-white">

                        <i data-lucide="user-cog" class="h-5 w-5"></i>

                        <span>Profil Saya</span>

                    </a>

                </div>

            </nav>


            {{-- LOGOUT --}}

            <div class="absolute bottom-0 left-0 right-0 p-4">

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button type="submit"
                        class="flex w-full
                               items-center gap-3
                               rounded-xl
                               px-4 py-3
                               text-sm font-semibold
                               text-white/60
                               transition
                               hover:bg-red-500/10
                               hover:text-red-400">

                        <i data-lucide="log-out" class="h-5 w-5"></i>

                        <span>Keluar</span>

                    </button>

                </form>

            </div>

        </aside>


        {{-- CONTENT --}}

        <div class="lg:pl-72">

            {{-- TOPBAR --}}

            <header
                class="sticky top-0 z-40
                       border-b border-gray-200
                       bg-white/90
                       backdrop-blur-xl">

                <div
                    class="flex h-20
                           items-center
                           justify-between
                           px-5 lg:px-8">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-widest text-[#087443]">
                            Panel Guru
                        </p>

                        <h1 class="mt-1 text-lg font-black text-gray-900">
                            @yield('page-title', 'Dashboard')
                        </h1>

                    </div>


                    <div
                        class="flex h-10 w-10
                               items-center justify-center
                               rounded-xl
                               bg-[#087443]/10
                               text-[#087443]">

                        <i data-lucide="user" class="h-5 w-5"></i>

                    </div>

                </div>

            </header>


            {{-- PAGE CONTENT --}}

            <main class="p-5 lg:p-8">

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>
