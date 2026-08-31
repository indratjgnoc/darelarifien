@extends('layouts.guru')

@section('title', 'Jadwal Mengajar')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}

    <div>

        <div class="flex items-center gap-3">

            <div
                class="flex h-12 w-12 items-center justify-center
                       rounded-2xl bg-[#087443]/10 text-[#087443]"
            >

                <i data-lucide="calendar-days" class="h-6 w-6"></i>

            </div>

            <div>

                <h1 class="text-2xl font-black text-gray-900">
                    Jadwal Mengajar
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Jadwal mengajar Anda selama kegiatan pembelajaran.
                </p>

            </div>

        </div>

    </div>


    {{-- JIKA DATA GURU BELUM TERHUBUNG --}}

    @if (!$teacher)

        <div
            class="rounded-3xl border border-yellow-200
                   bg-yellow-50 p-6"
        >

            <div class="flex items-start gap-4">

                <div
                    class="flex h-11 w-11 shrink-0
                           items-center justify-center
                           rounded-xl bg-yellow-100
                           text-yellow-700"
                >

                    <i data-lucide="alert-triangle" class="h-5 w-5"></i>

                </div>

                <div>

                    <h3 class="font-black text-yellow-900">
                        Data guru belum terhubung
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-yellow-700">
                        Akun Anda belum terhubung dengan data guru.
                        Silakan hubungi administrator.
                    </p>

                </div>

            </div>

        </div>

    @else


        {{-- IDENTITAS GURU --}}

        <div
            class="rounded-3xl bg-white p-6
                   shadow-sm ring-1 ring-gray-100"
        >

            <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                {{-- FOTO --}}

                <div class="shrink-0">

                    @if ($teacher->photo)

                        <img
                            src="{{ asset('storage/' . $teacher->photo) }}"
                            alt="{{ $teacher->name }}"
                            class="h-20 w-20 rounded-2xl
                                   object-cover ring-4
                                   ring-[#087443]/10"
                        >

                    @else

                        <div
                            class="flex h-20 w-20 items-center
                                   justify-center rounded-2xl
                                   bg-[#EAF4EF]
                                   text-[#087443]"
                        >

                            <i data-lucide="user" class="h-8 w-8"></i>

                        </div>

                    @endif

                </div>


                {{-- DATA --}}

                <div>

                    <h2 class="text-xl font-black text-gray-900">
                        {{ $teacher->name }}
                    </h2>

                    <p class="mt-1 text-sm font-semibold text-[#087443]">
                        {{ $teacher->position ?: 'Guru' }}
                    </p>

                    <p class="mt-2 text-sm text-gray-500">
                        Total {{ $schedules->count() }} jadwal aktif
                    </p>

                </div>

            </div>

        </div>


        {{-- JADWAL --}}

        @if ($schedules->isEmpty())

            <div
                class="rounded-3xl bg-white p-10 text-center
                       shadow-sm ring-1 ring-gray-100"
            >

                <div
                    class="mx-auto flex h-16 w-16 items-center
                           justify-center rounded-2xl
                           bg-gray-100 text-gray-400"
                >

                    <i data-lucide="calendar-x" class="h-7 w-7"></i>

                </div>

                <h3 class="mt-5 font-black text-gray-900">
                    Belum Ada Jadwal
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Belum ada jadwal mengajar aktif yang diberikan
                    kepada Anda.
                </p>

            </div>

        @else

            <div
                class="overflow-hidden rounded-3xl bg-white
                       shadow-sm ring-1 ring-gray-100"
            >

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[750px]">

                        <thead>

                            <tr
                                class="border-b border-gray-100
                                       bg-gray-50/80"
                            >

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-black
                                           uppercase tracking-wider
                                           text-gray-500"
                                >
                                    Hari
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-black
                                           uppercase tracking-wider
                                           text-gray-500"
                                >
                                    Waktu
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-black
                                           uppercase tracking-wider
                                           text-gray-500"
                                >
                                    Mata Pelajaran
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-black
                                           uppercase tracking-wider
                                           text-gray-500"
                                >
                                    Kelas
                                </th>

                                <th
                                    class="px-6 py-4 text-left
                                           text-xs font-black
                                           uppercase tracking-wider
                                           text-gray-500"
                                >
                                    Ruangan
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @foreach ($schedules as $schedule)

                                <tr class="transition hover:bg-gray-50">

                                    {{-- HARI --}}

                                    <td class="px-6 py-5">

                                        <span
                                            class="inline-flex rounded-xl
                                                   bg-[#EAF4EF]
                                                   px-3 py-2
                                                   text-sm font-black
                                                   text-[#087443]"
                                        >
                                            {{ $schedule->day }}
                                        </span>

                                    </td>


                                    {{-- WAKTU --}}

                                    <td class="px-6 py-5">

                                        <div
                                            class="flex items-center gap-2
                                                   text-sm font-bold
                                                   text-gray-700"
                                        >

                                            <i
                                                data-lucide="clock"
                                                class="h-4 w-4
                                                       text-gray-400"
                                            ></i>

                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                            –
                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}

                                        </div>

                                    </td>


                                    {{-- MAPEL --}}

                                    <td class="px-6 py-5">

                                        <p class="font-black text-gray-900">
                                            {{ $schedule->subject }}
                                        </p>

                                    </td>


                                    {{-- KELAS --}}

                                    <td class="px-6 py-5">

                                        <span
                                            class="text-sm font-bold
                                                   text-gray-700"
                                        >
                                            {{ $schedule->class_name }}
                                        </span>

                                    </td>


                                    {{-- RUANGAN --}}

                                    <td class="px-6 py-5">

                                        <div
                                            class="flex items-center gap-2
                                                   text-sm text-gray-600"
                                        >

                                            <i
                                                data-lucide="door-open"
                                                class="h-4 w-4
                                                       text-gray-400"
                                            ></i>

                                            {{ $schedule->room ?: '-' }}

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @endif

    @endif

</div>

@endsection