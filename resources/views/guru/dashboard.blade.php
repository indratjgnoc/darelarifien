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
                <div class="inline-flex items-center gap-3 rounded-2xl border border-[#087443]/10 bg-white px-5 py-3 shadow-sm">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#087443]/10 text-[#087443]">
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
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i data-lucide="calendar-days" class="h-6 w-6"></i>
                </div>

                <p class="mt-5 text-sm font-semibold text-gray-400">
                    Jadwal Mengajar
                </p>

                <p class="mt-1 text-3xl font-black text-gray-900">
                    {{ $schedules->count() }}
                </p>
            </div>


            {{-- KELAS --}}
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#087443]/10 text-[#087443]">
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
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-yellow-50 text-yellow-600">
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
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-50 text-purple-600">
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


        {{-- JADWAL MENGAJAR --}}
        <div class="mt-8">

            <div class="mb-5">
                <h2 class="text-xl font-black text-gray-900">
                    Jadwal Mengajar
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Jadwal pembelajaran yang harus Anda laksanakan.
                </p>
            </div>


            @if ($schedules->count())

                <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-100">

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                                        Hari
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                                        Waktu
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                                        Mata Pelajaran
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                                        Kelas
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                                        Ruangan
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @foreach ($schedules as $schedule)
                                    <tr class="transition hover:bg-gray-50">

                                        <td class="px-6 py-5">
                                            <span class="font-bold text-gray-900">
                                                {{ $schedule->day }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-5">
                                            <span class="text-sm font-semibold text-[#087443]">
                                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                                -
                                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-5">
                                            <span class="font-semibold text-gray-900">
                                                {{ $schedule->subject }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-5">
                                            <span class="rounded-lg bg-gray-100 px-3 py-1 text-xs font-bold text-gray-700">
                                                {{ $schedule->class_name }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-5 text-sm text-gray-500">
                                            {{ $schedule->room ?: '-' }}
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

            @else

                <div class="rounded-3xl bg-white p-10 text-center shadow-sm ring-1 ring-gray-100">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">
                        <i data-lucide="calendar-x" class="h-8 w-8"></i>
                    </div>

                    <h3 class="mt-5 font-black text-gray-900">
                        Belum Ada Jadwal
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        Jadwal mengajar Anda belum tersedia.
                        Silakan hubungi administrator pesantren.
                    </p>

                </div>

            @endif

        </div>

    </div>
</div>

@endsection