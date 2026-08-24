@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')

<div class="min-h-screen bg-gray-50">

    <div class="mx-auto max-w-7xl px-5 py-8 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-8">

            <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

                <div>

                    <p class="text-sm font-semibold text-[#087443]">
                        Panel Guru
                    </p>

                    <h1 class="mt-1 text-3xl font-black text-gray-900">
                        Dashboard Guru
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Selamat datang,
                        <span class="font-bold text-gray-700">
                            {{ auth()->user()->name }}
                        </span>.
                        Kelola aktivitas pembelajaran Anda dari sini.
                    </p>

                </div>


                {{-- ROLE --}}
                <div
                    class="inline-flex items-center gap-3
                           rounded-2xl
                           border border-[#087443]/10
                           bg-white
                           px-5 py-3
                           shadow-sm"
                >

                    <div
                        class="flex h-10 w-10
                               items-center justify-center
                               rounded-xl
                               bg-[#087443]/10
                               text-[#087443]"
                    >

                        <i data-lucide="graduation-cap" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                            Role
                        </p>

                        <p class="text-sm font-black text-gray-800">
                            Guru
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- STATISTIK --}}
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">


            {{-- JADWAL --}}
            <div
                class="rounded-3xl
                       bg-white
                       p-6
                       shadow-sm
                       ring-1 ring-gray-100"
            >

                <div class="flex items-center justify-between">

                    <div
                        class="flex h-12 w-12
                               items-center justify-center
                               rounded-2xl
                               bg-blue-50
                               text-blue-600"
                    >

                        <i data-lucide="calendar-days" class="h-6 w-6"></i>

                    </div>

                </div>

                <p class="mt-5 text-sm font-semibold text-gray-400">
                    Jadwal Hari Ini
                </p>

                <p class="mt-1 text-3xl font-black text-gray-900">
                    0
                </p>

            </div>


            {{-- KELAS --}}
            <div
                class="rounded-3xl
                       bg-white
                       p-6
                       shadow-sm
                       ring-1 ring-gray-100"
            >

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-2xl
                           bg-[#087443]/10
                           text-[#087443]"
                >

                    <i data-lucide="school" class="h-6 w-6"></i>

                </div>

                <p class="mt-5 text-sm font-semibold text-gray-400">
                    Kelas Diampu
                </p>

                <p class="mt-1 text-3xl font-black text-gray-900">
                    0
                </p>

            </div>


            {{-- TUGAS --}}
            <div
                class="rounded-3xl
                       bg-white
                       p-6
                       shadow-sm
                       ring-1 ring-gray-100"
            >

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-2xl
                           bg-yellow-50
                           text-yellow-600"
                >

                    <i data-lucide="clipboard-list" class="h-6 w-6"></i>

                </div>

                <p class="mt-5 text-sm font-semibold text-gray-400">
                    Tugas
                </p>

                <p class="mt-1 text-3xl font-black text-gray-900">
                    0
                </p>

            </div>


            {{-- PESAN --}}
            <div
                class="rounded-3xl
                       bg-white
                       p-6
                       shadow-sm
                       ring-1 ring-gray-100"
            >

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-2xl
                           bg-purple-50
                           text-purple-600"
                >

                    <i data-lucide="message-square" class="h-6 w-6"></i>

                </div>

                <p class="mt-5 text-sm font-semibold text-gray-400">
                    Pesan Baru
                </p>

                <p class="mt-1 text-3xl font-black text-gray-900">
                    0
                </p>

            </div>

        </div>


        {{-- MENU CEPAT --}}
        <div class="mt-8">

            <div class="mb-5">

                <h2 class="text-xl font-black text-gray-900">
                    Menu Guru
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Akses fitur yang berkaitan dengan aktivitas mengajar.
                </p>

            </div>


            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">


                {{-- JADWAL --}}
                <a
                    href="#"
                    class="group rounded-3xl
                           bg-white
                           p-6
                           shadow-sm
                           ring-1 ring-gray-100
                           transition
                           hover:-translate-y-1
                           hover:shadow-lg"
                >

                    <div
                        class="flex h-12 w-12
                               items-center justify-center
                               rounded-2xl
                               bg-blue-50
                               text-blue-600
                               transition
                               group-hover:bg-blue-600
                               group-hover:text-white"
                    >

                        <i data-lucide="calendar-days" class="h-6 w-6"></i>

                    </div>

                    <h3 class="mt-5 font-black text-gray-900">
                        Jadwal Mengajar
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Lihat jadwal mengajar dan kelas yang harus diampu.
                    </p>

                </a>


                {{-- KELAS --}}
                <a
                    href="#"
                    class="group rounded-3xl
                           bg-white
                           p-6
                           shadow-sm
                           ring-1 ring-gray-100
                           transition
                           hover:-translate-y-1
                           hover:shadow-lg"
                >

                    <div
                        class="flex h-12 w-12
                               items-center justify-center
                               rounded-2xl
                               bg-[#087443]/10
                               text-[#087443]
                               transition
                               group-hover:bg-[#087443]
                               group-hover:text-white"
                    >

                        <i data-lucide="school" class="h-6 w-6"></i>

                    </div>

                    <h3 class="mt-5 font-black text-gray-900">
                        Kelas Saya
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Kelola kelas dan peserta didik yang Anda ampu.
                    </p>

                </a>


                {{-- TUGAS --}}
                <a
                    href="#"
                    class="group rounded-3xl
                           bg-white
                           p-6
                           shadow-sm
                           ring-1 ring-gray-100
                           transition
                           hover:-translate-y-1
                           hover:shadow-lg"
                >

                    <div
                        class="flex h-12 w-12
                               items-center justify-center
                               rounded-2xl
                               bg-yellow-50
                               text-yellow-600
                               transition
                               group-hover:bg-yellow-500
                               group-hover:text-white"
                    >

                        <i data-lucide="clipboard-list" class="h-6 w-6"></i>

                    </div>

                    <h3 class="mt-5 font-black text-gray-900">
                        Tugas & Penilaian
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Kelola tugas dan nilai peserta didik.
                    </p>

                </a>


            </div>

        </div>


        {{-- PROFIL GURU --}}
        <div class="mt-8 rounded-3xl bg-[#062E1F] p-7 text-white">

            <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-widest text-[#F4C542]">
                        Akun Anda
                    </p>

                    <h2 class="mt-2 text-xl font-black">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="mt-1 text-sm text-white/60">
                        {{ auth()->user()->email }}
                    </p>

                </div>


                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2
                               rounded-xl
                               bg-white/10
                               px-5 py-3
                               text-sm font-bold
                               text-white
                               transition
                               hover:bg-red-500"
                    >

                        <i data-lucide="log-out" class="h-4 w-4"></i>

                        Keluar

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection