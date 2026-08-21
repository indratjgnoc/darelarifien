<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Dashboard') - {{ $settings['school_name'] ?? 'n' }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-[#F5F7F6] text-gray-900">

    <div class="min-h-screen">

        {{-- SIDEBAR --}}
        <aside
            class="fixed inset-y-0 left-0 z-50
                   flex w-72 flex-col
                   bg-[#062E1F] text-white"
        >

            {{-- Logo --}}
            <div
                class="flex h-24 items-center
                       gap-4 border-b
                       border-white/10 px-7"
            >

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-xl bg-[#F4C542]"
                >
                    <span
                        class="text-lg font-black
                               text-[#111111]"
                    >
                        DA
                    </span>
                </div>

                <div>
                    <h1 class="font-black tracking-wide">
                        {{ $settings['school_name'] ?? '' }}
                    </h1>

                    <p class="text-xs text-white/50">
                        Administrator
                    </p>
                </div>

            </div>


            {{-- Navigation --}}
            <nav class="flex-1 space-y-2 overflow-y-auto p-5">

                {{-- Dashboard --}}
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3
                           rounded-xl px-4 py-3
                           font-semibold
                           bg-[#087443]"
                >

                    <i
                        data-lucide="layout-dashboard"
                        class="h-5 w-5"
                    ></i>

                    <span>Dashboard</span>

                </a>


                {{-- Website --}}
                <div class="pt-6">

                    <p
                        class="mb-3 px-4 text-[11px]
                               font-bold uppercase
                               tracking-widest
                               text-white/30"
                    >
                        Website
                    </p>

                    <a
                        href="#"
                        class="flex items-center gap-3
                               rounded-xl px-4 py-3
                               text-white/70
                               transition
                               hover:bg-white/5
                               hover:text-white"
                    >

                        <i
                            data-lucide="building-2"
                            class="h-5 w-5"
                        ></i>

                        <span>Profil Pesantren</span>

                    </a>


                    <a
    href="{{ route('admin.settings') }}"
    class="mt-1 flex items-center gap-3
           rounded-xl px-4 py-3
           transition
           {{ request()->routeIs('admin.settings')
                ? 'bg-[#F4C542] text-[#062E1F] font-bold'
                : 'text-white/70 hover:bg-white/5 hover:text-white'
           }}"
>

    <i
        data-lucide="settings"
        class="h-5 w-5"
    ></i>

    <span>Pengaturan</span>

</a>

                </div>


                {{-- Konten --}}
                <div class="pt-6">

                    <p
                        class="mb-3 px-4 text-[11px]
                               font-bold uppercase
                               tracking-widest
                               text-white/30"
                    >
                        Konten
                    </p>


                  <a
        href="{{ route('admin.news.index') }}"
        class="flex items-center gap-3
               rounded-xl px-4 py-3
               transition
               {{ request()->routeIs('admin.news.*')
                    ? 'bg-[#F4C542] text-[#062E1F] font-bold'
                    : 'text-white/70 hover:bg-white/5 hover:text-white'
               }}"
    >

        <i
            data-lucide="newspaper"
            class="h-5 w-5"
        ></i>

        <span>Berita</span>

    </a>

<a
    href="{{ route('admin.announcements.index') }}"
    class="mt-1 flex items-center gap-3
           rounded-xl px-4 py-3
           transition
           {{ request()->routeIs('admin.announcements.*')
                ? 'bg-[#F4C542] text-[#062E1F] font-bold'
                : 'text-white/70 hover:bg-white/5 hover:text-white'
           }}"
>

    <i
        data-lucide="megaphone"
        class="h-5 w-5"
    ></i>

    <span>Pengumuman</span>

</a>


<a
    href="{{ route('admin.events.index') }}"
    class="mt-1 flex items-center gap-3
           rounded-xl px-4 py-3
           transition
           {{ request()->routeIs('admin.events.*')
                ? 'bg-[#F4C542] text-[#062E1F] font-bold'
                : 'text-white/70 hover:bg-white/5 hover:text-white'
           }}"
>

    <i
        data-lucide="calendar-days"
        class="h-5 w-5"
    ></i>

    <span>Agenda / Event</span>

</a>

<a
    href="{{ route('admin.galleries.index') }}"
    class="mt-1 flex items-center gap-3
           rounded-xl px-4 py-3
           transition
           {{ request()->routeIs('admin.galleries.*')
                ? 'bg-[#F4C542] text-[#062E1F] font-bold'
                : 'text-white/70 hover:bg-white/5 hover:text-white'
           }}"
>

    <i
        data-lucide="images"
        class="h-5 w-5"
    ></i>

    <span>Galeri</span>

</a>

                </div>


                {{-- Akademik --}}
                <div class="pt-6">

                    <p
                        class="mb-3 px-4 text-[11px]
                               font-bold uppercase
                               tracking-widest
                               text-white/30"
                    >
                        Akademik
                    </p>


                    <a
    href="{{ route('admin.programs.index') }}"
    class="mt-1 flex items-center gap-3
           rounded-xl px-4 py-3
           transition
           {{ request()->routeIs('admin.programs.*')
                ? 'bg-[#F4C542] text-[#062E1F] font-bold'
                : 'text-white/70 hover:bg-white/5 hover:text-white'
           }}"
>

    <i
        data-lucide="graduation-cap"
        class="h-5 w-5"
    ></i>

    <span>Program Pendidikan</span>

</a>

                   <a
    href="{{ route('admin.teachers.index') }}"
    class="mt-1 flex items-center gap-3
           rounded-xl px-4 py-3
           transition
           {{ request()->routeIs('admin.teachers.*')
                ? 'bg-[#F4C542] text-[#062E1F] font-bold'
                : 'text-white/70 hover:bg-white/5 hover:text-white'
           }}"
>

    <i
        data-lucide="users-round"
        class="h-5 w-5"
    ></i>

    <span>Ustadz & Ustadzah</span>

</a>

                </div>


                {{-- Pendaftaran --}}
                <div class="pt-6">

                    <p
                        class="mb-3 px-4 text-[11px]
                               font-bold uppercase
                               tracking-widest
                               text-white/30"
                    >
                        Pendaftaran
                    </p>


                    <a
                        href="#"
                        class="flex items-center gap-3
                               rounded-xl px-4 py-3
                               text-white/70
                               transition
                               hover:bg-white/5
                               hover:text-white"
                    >

                        <i
                            data-lucide="clipboard-list"
                            class="h-5 w-5"
                        ></i>

                        <span>Calon Santri</span>

                    </a>

                </div>

            </nav>


            {{-- Bottom Sidebar --}}
            <div
                class="border-t
                       border-white/10 p-5"
            >

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="flex w-full
                               items-center gap-3
                               rounded-xl px-4 py-3
                               text-white/60
                               transition
                               hover:bg-red-500/10
                               hover:text-red-400"
                    >

                        <i
                            data-lucide="log-out"
                            class="h-5 w-5"
                        ></i>

                        <span>Keluar</span>

                    </button>

                </form>

            </div>

        </aside>


        {{-- MAIN --}}
        <div class="ml-72 min-h-screen">

            {{-- TOPBAR --}}
            <header
                class="sticky top-0 z-40
                       flex h-20 items-center
                       justify-between
                       border-b border-gray-200
                       bg-white/90 px-8
                       backdrop-blur"
            >

                <div>

                    <p
                        class="text-xs font-semibold
                               uppercase tracking-wider
                               text-[#087443]"
                    >
                        Administrator Panel
                    </p>

                    <h2
                        class="text-lg font-black
                               text-[#111111]"
                    >
                        @yield('title', 'Dashboard')
                    </h2>

                </div>


                {{-- Profile --}}
                <div
                    class="flex items-center gap-3"
                >

                    <div
                        class="hidden text-right sm:block"
                    >

                        <p
                            class="text-sm font-bold
                                   text-gray-800"
                        >
                            {{ auth()->user()->name }}
                        </p>

                        <p
                            class="text-xs
                                   text-gray-400"
                        >
                            Administrator
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11
                               items-center
                               justify-center
                               rounded-full
                               bg-[#087443]
                               font-bold text-white"
                    >
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                </div>

            </header>


            {{-- CONTENT --}}
            <main class="p-8">

                @yield('content')

            </main>

        </div>

    </div>


    @stack('scripts')

</body>

</html>