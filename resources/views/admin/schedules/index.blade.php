@extends('layouts.admin')

@section('title', 'Jadwal Mengajar')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>

            <h1 class="text-2xl font-black text-gray-900">
                Jadwal Mengajar
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola jadwal guru, mata pelajaran, kelas, dan ruangan.
            </p>

        </div>

        <a
            href="{{ route('admin.schedules.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl
                   bg-[#087443] px-5 py-3 text-sm font-black text-white
                   shadow-lg shadow-[#087443]/20 transition
                   hover:bg-[#062E1F]"
        >

            <i data-lucide="plus" class="h-4 w-4"></i>

            Tambah Jadwal

        </a>

    </div>


    {{-- SUCCESS --}}
    @if (session('success'))

        <div
            class="flex items-center gap-3 rounded-2xl
                   border border-green-200 bg-green-50
                   px-5 py-4 text-sm font-semibold text-green-700"
        >

            <i data-lucide="check-circle" class="h-5 w-5"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- ERROR --}}
    @if ($errors->any())

        <div
            class="rounded-2xl border border-red-200
                   bg-red-50 p-5 text-sm text-red-700"
        >

            <div class="flex items-start gap-3">

                <i data-lucide="alert-circle" class="mt-0.5 h-5 w-5"></i>

                <div>

                    <p class="font-black">
                        Jadwal tidak dapat disimpan
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- JADWAL --}}
    <div
        class="overflow-hidden rounded-3xl
               bg-white shadow-sm ring-1 ring-gray-100"
    >

        {{-- HEADER TABLE --}}
        <div class="border-b border-gray-100 px-6 py-5">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-[#EAF4EF] text-[#087F5B]"
                >

                    <i data-lucide="calendar-days" class="h-5 w-5"></i>

                </div>

                <div>

                    <h2 class="font-black text-gray-900">
                        Jadwal Mingguan
                    </h2>

                    <p class="text-sm text-gray-500">
                        Jadwal aktif berdasarkan hari dan waktu.
                    </p>

                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1000px]">

                <thead>

                    <tr class="border-b border-gray-100 bg-gray-50">

                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">
                            Hari
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">
                            Waktu
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">
                            Guru
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">
                            Mata Pelajaran
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">
                            Kelas
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-500">
                            Ruangan
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-black uppercase tracking-wider text-gray-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-black uppercase tracking-wider text-gray-500">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($schedules as $schedule)

                        <tr class="transition hover:bg-gray-50">

                            {{-- HARI --}}
                            <td class="px-6 py-5">

                                <span
                                    class="inline-flex rounded-lg
                                           bg-[#EAF4EF]
                                           px-3 py-1.5
                                           text-xs font-black
                                           text-[#087443]"
                                >
                                    {{ $schedule->day }}
                                </span>

                            </td>


                            {{-- WAKTU --}}
                            <td class="px-6 py-5 whitespace-nowrap">

                                <div class="flex items-center gap-2">

                                    <i
                                        data-lucide="clock"
                                        class="h-4 w-4 text-gray-400"
                                    ></i>

                                    <span class="text-sm font-black text-gray-800">

                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}

                                        -

                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}

                                    </span>

                                </div>

                            </td>


                            {{-- GURU --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 shrink-0
                                               items-center justify-center
                                               rounded-full
                                               bg-[#087443]/10
                                               text-sm font-black
                                               text-[#087443]"
                                    >

                                        {{ strtoupper(substr($schedule->teacher->name ?? '?', 0, 1)) }}

                                    </div>

                                    <span class="text-sm font-bold text-gray-800">

                                        {{ $schedule->teacher->name ?? 'Guru tidak ditemukan' }}

                                    </span>

                                </div>

                            </td>


                            {{-- MAPEL --}}
                            <td class="px-6 py-5">

                                <span class="text-sm font-bold text-gray-800">

                                    {{ $schedule->subject }}

                                </span>

                            </td>


                            {{-- KELAS --}}
                            <td class="px-6 py-5">

                                <span
                                    class="inline-flex rounded-lg
                                           bg-gray-100 px-3 py-1.5
                                           text-xs font-black
                                           text-gray-700"
                                >

                                    {{ $schedule->class_name }}

                                </span>

                            </td>


                            {{-- RUANGAN --}}
                            <td class="px-6 py-5">

                                @if ($schedule->room)

                                    <div class="flex items-center gap-2">

                                        <i
                                            data-lucide="door-open"
                                            class="h-4 w-4 text-gray-400"
                                        ></i>

                                        <span class="text-sm font-semibold text-gray-700">

                                            {{ $schedule->room }}

                                        </span>

                                    </div>

                                @else

                                    <span class="text-sm text-gray-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}
                            <td class="px-6 py-5 text-center">

                                @if ($schedule->is_active)

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               rounded-full
                                               bg-green-50
                                               px-3 py-1.5
                                               text-xs font-black
                                               text-green-700"
                                    >

                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                        Aktif

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1.5
                                               rounded-full
                                               bg-gray-100
                                               px-3 py-1.5
                                               text-xs font-black
                                               text-gray-500"
                                    >

                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                        Nonaktif

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.schedules.edit', $schedule) }}"
                                        class="inline-flex h-9 w-9 items-center
                                               justify-center rounded-lg
                                               bg-gray-100 text-gray-600
                                               transition hover:bg-[#EAF4EF]
                                               hover:text-[#087443]"
                                        title="Edit"
                                    >

                                        <i
                                            data-lucide="pencil"
                                            class="h-4 w-4"
                                        ></i>

                                    </a>


                                    <form
                                        action="{{ route('admin.schedules.destroy', $schedule) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex h-9 w-9 items-center
                                                   justify-center rounded-lg
                                                   bg-red-50 text-red-600
                                                   transition hover:bg-red-100"
                                            title="Hapus"
                                        >

                                            <i
                                                data-lucide="trash-2"
                                                class="h-4 w-4"
                                            ></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="px-6 py-16 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <div
                                        class="flex h-16 w-16
                                               items-center justify-center
                                               rounded-2xl
                                               bg-gray-100
                                               text-gray-400"
                                    >

                                        <i
                                            data-lucide="calendar-x"
                                            class="h-8 w-8"
                                        ></i>

                                    </div>

                                    <h3 class="mt-5 font-black text-gray-800">
                                        Belum ada jadwal
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Tambahkan jadwal mengajar pertama.
                                    </p>

                                    <a
                                        href="{{ route('admin.schedules.create') }}"
                                        class="mt-5 inline-flex items-center gap-2
                                               rounded-xl bg-[#087443]
                                               px-5 py-3 text-sm font-black
                                               text-white hover:bg-[#062E1F]"
                                    >

                                        <i data-lucide="plus" class="h-4 w-4"></i>

                                        Tambah Jadwal

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection