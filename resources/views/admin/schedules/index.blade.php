@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-gray-50 py-8">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="mb-2 flex items-center gap-2 text-sm text-gray-400">
                    <span>Akademik</span>
                    <span>/</span>
                    <span>Jadwal</span>
                </div>

                <h1 class="text-2xl font-black tracking-tight text-gray-900 sm:text-3xl">
                    Jadwal Pelajaran
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola jadwal pembelajaran berdasarkan penugasan guru, kelas,
                    dan mata pelajaran.
                </p>

            </div>


            <a
                href="{{ route('admin.schedules.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-black text-white shadow-lg shadow-[#087443]/20 transition hover:bg-[#063d27] active:scale-[0.98]"
            >
                <span class="text-lg leading-none">+</span>
                Tambah Jadwal
            </a>

        </div>


        {{-- FLASH SUCCESS --}}
        @if (session('success'))

            <div class="mb-6 rounded-2xl border border-green-100 bg-green-50 p-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-green-100 text-green-700">
                        ✓
                    </div>

                    <p class="text-sm font-bold text-green-800">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- ERROR --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-100 bg-red-50 p-5">

                <div class="flex gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                        !
                    </div>

                    <div>

                        <h3 class="font-bold text-red-800">
                            Terjadi kesalahan
                        </h3>

                        <ul class="mt-2 space-y-1 text-sm text-red-700">

                            @foreach ($errors->all() as $error)

                                <li>
                                    • {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- STATISTIK --}}
        <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                            Total Jadwal
                        </p>

                        <p class="mt-2 text-2xl font-black text-gray-900">
                            {{ $schedules->count() }}
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#087443]/10 text-xl">
                        📅
                    </div>

                </div>

            </div>


            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                            Jadwal Aktif
                        </p>

                        <p class="mt-2 text-2xl font-black text-gray-900">
                            {{ $schedules->where('is_active', true)->count() }}
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-100 text-xl">
                        ✓
                    </div>

                </div>

            </div>


            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                            Kelas
                        </p>

                        <p class="mt-2 text-2xl font-black text-gray-900">

                            {{
                                $schedules
                                    ->map(fn ($schedule) =>
                                        $schedule->teacherClassSubject?->school_class_id
                                    )
                                    ->filter()
                                    ->unique()
                                    ->count()
                            }}

                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-xl">
                        🏫
                    </div>

                </div>

            </div>


            <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                            Mata Pelajaran
                        </p>

                        <p class="mt-2 text-2xl font-black text-gray-900">

                            {{
                                $schedules
                                    ->map(fn ($schedule) =>
                                        $schedule->teacherClassSubject?->subject_id
                                    )
                                    ->filter()
                                    ->unique()
                                    ->count()
                            }}

                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-yellow-100 text-xl">
                        📚
                    </div>

                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">

            {{-- TABLE HEADER --}}
            <div class="flex flex-col gap-3 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-lg font-black text-gray-900">
                        Daftar Jadwal
                    </h2>

                    <p class="mt-1 text-xs text-gray-400">
                        Data jadwal berdasarkan penugasan mengajar.
                    </p>

                </div>

                <div class="rounded-full bg-[#087443]/10 px-4 py-2 text-xs font-bold text-[#087443]">
                    {{ $schedules->count() }} Jadwal
                </div>

            </div>


            @if ($schedules->count())

                {{-- DESKTOP --}}
                <div class="hidden overflow-x-auto md:block">

                    <table class="min-w-full">

                        <thead>

                            <tr class="border-b border-gray-100 bg-gray-50">

                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">
                                    Hari / Waktu
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">
                                    Kelas
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">
                                    Mata Pelajaran
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">
                                    Guru
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">
                                    Ruangan
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-black uppercase tracking-wider text-gray-400">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @foreach ($schedules as $schedule)

                                @php
                                    $assignment = $schedule->teacherClassSubject;
                                @endphp

                                <tr class="transition hover:bg-gray-50/80">

                                    {{-- NO --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-sm font-bold text-gray-400">
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- HARI / WAKTU --}}
                                    <td class="whitespace-nowrap px-6 py-5">

                                        <div class="font-black text-gray-800">
                                            {{ $schedule->day }}
                                        </div>

                                        <div class="mt-1 text-xs font-semibold text-gray-400">
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                            —
                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                        </div>

                                    </td>


                                    {{-- KELAS --}}
                                    <td class="px-6 py-5">

                                        @if ($assignment?->schoolClass)

                                            <div class="font-black text-gray-800">
                                                {{ $assignment->schoolClass->name }}
                                            </div>

                                            @if ($assignment->academicYear)

                                                <div class="mt-1 text-xs font-medium text-gray-400">
                                                    {{ $assignment->academicYear->name }}
                                                </div>

                                            @endif

                                        @else

                                            <span class="text-sm text-gray-400">
                                                {{ $schedule->class_name ?? '-' }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- MAPEL --}}
                                    <td class="px-6 py-5">

                                        @if ($assignment?->subject)

                                            <div class="font-black text-gray-800">
                                                {{ $assignment->subject->name }}
                                            </div>

                                            @if ($assignment->subject->code)

                                                <div class="mt-1 text-xs font-medium text-gray-400">
                                                    {{ $assignment->subject->code }}
                                                </div>

                                            @endif

                                        @else

                                            <span class="text-sm text-gray-400">
                                                {{ $schedule->subject ?? '-' }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- GURU --}}
                                    <td class="px-6 py-5">

                                        @if ($assignment?->teacher)

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#087443]/10 text-sm font-black text-[#087443]">
                                                    {{ strtoupper(substr($assignment->teacher->name, 0, 1)) }}
                                                </div>

                                                <div>

                                                    <div class="font-bold text-gray-800">
                                                        {{ $assignment->teacher->name }}
                                                    </div>

                                                </div>

                                            </div>

                                        @elseif ($schedule->teacher)

                                            <div class="font-bold text-gray-700">
                                                {{ $schedule->teacher->name }}
                                            </div>

                                        @else

                                            <span class="text-sm text-gray-400">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- RUANGAN --}}
                                    <td class="px-6 py-5">

                                        @if ($schedule->room)

                                            <span class="inline-flex rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-600">
                                                {{ $schedule->room }}
                                            </span>

                                        @else

                                            <span class="text-sm text-gray-400">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- STATUS --}}
                                    <td class="px-6 py-5">

                                        @if ($schedule->is_active)

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-3 py-1.5 text-xs font-black text-green-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                                Aktif
                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-black text-gray-500">
                                                <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                                Tidak Aktif
                                            </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="whitespace-nowrap px-6 py-5 text-right">

                                        <div class="flex items-center justify-end gap-2">

                                            <a
                                                href="{{ route('admin.schedules.edit', $schedule) }}"
                                                class="rounded-xl bg-[#087443]/10 px-4 py-2 text-xs font-black text-[#087443] transition hover:bg-[#087443] hover:text-white"
                                            >
                                                Edit
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
                                                    class="rounded-xl bg-red-50 px-4 py-2 text-xs font-black text-red-600 transition hover:bg-red-600 hover:text-white"
                                                >
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- MOBILE --}}
                <div class="divide-y divide-gray-100 md:hidden">

                    @foreach ($schedules as $schedule)

                        @php
                            $assignment = $schedule->teacherClassSubject;
                        @endphp

                        <div class="p-5">

                            <div class="mb-4 flex items-start justify-between gap-4">

                                <div>

                                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                        {{ $schedule->day }}
                                    </p>

                                    <p class="mt-1 text-lg font-black text-gray-900">
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                        —
                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                    </p>

                                </div>


                                @if ($schedule->is_active)

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-black text-green-700">
                                        Aktif
                                    </span>

                                @else

                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-black text-gray-500">
                                        Tidak Aktif
                                    </span>

                                @endif

                            </div>


                            <div class="space-y-3">

                                {{-- KELAS --}}
                                <div>

                                    <p class="text-xs font-bold text-gray-400">
                                        Kelas
                                    </p>

                                    <p class="mt-1 font-black text-gray-800">

                                        {{
                                            $assignment?->schoolClass?->name
                                            ?? $schedule->class_name
                                            ?? '-'
                                        }}

                                    </p>

                                </div>


                                {{-- MAPEL --}}
                                <div>

                                    <p class="text-xs font-bold text-gray-400">
                                        Mata Pelajaran
                                    </p>

                                    <p class="mt-1 font-black text-gray-800">

                                        {{
                                            $assignment?->subject?->name
                                            ?? $schedule->subject
                                            ?? '-'
                                        }}

                                    </p>

                                </div>


                                {{-- GURU --}}
                                <div>

                                    <p class="text-xs font-bold text-gray-400">
                                        Guru
                                    </p>

                                    <p class="mt-1 font-black text-gray-800">

                                        {{
                                            $assignment?->teacher?->name
                                            ?? $schedule->teacher?->name
                                            ?? '-'
                                        }}

                                    </p>

                                </div>


                                {{-- TAHUN AKADEMIK --}}
                                <div>

                                    <p class="text-xs font-bold text-gray-400">
                                        Tahun Akademik
                                    </p>

                                    <p class="mt-1 font-black text-gray-800">
                                        {{ $assignment?->academicYear?->name ?? '-' }}
                                    </p>

                                </div>


                                {{-- RUANG --}}
                                <div>

                                    <p class="text-xs font-bold text-gray-400">
                                        Ruangan
                                    </p>

                                    <p class="mt-1 font-black text-gray-800">
                                        {{ $schedule->room ?: '-' }}
                                    </p>

                                </div>

                            </div>


                            {{-- AKSI MOBILE --}}
                            <div class="mt-5 flex gap-2">

                                <a
                                    href="{{ route('admin.schedules.edit', $schedule) }}"
                                    class="flex-1 rounded-xl bg-[#087443]/10 px-4 py-3 text-center text-xs font-black text-[#087443] transition hover:bg-[#087443] hover:text-white"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('admin.schedules.destroy', $schedule) }}"
                                    method="POST"
                                    class="flex-1"
                                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="w-full rounded-xl bg-red-50 px-4 py-3 text-xs font-black text-red-600 transition hover:bg-red-600 hover:text-white"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                {{-- EMPTY STATE --}}
                <div class="px-6 py-16 text-center">

                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-[#087443]/10 text-3xl">
                        📅
                    </div>

                    <h3 class="mt-5 text-lg font-black text-gray-800">
                        Belum Ada Jadwal
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-400">
                        Belum ada jadwal pembelajaran yang dibuat.
                        Tambahkan jadwal berdasarkan penugasan guru,
                        kelas, dan mata pelajaran.
                    </p>

                    <a
                        href="{{ route('admin.schedules.create') }}"
                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-black text-white shadow-lg shadow-[#087443]/20 transition hover:bg-[#063d27]"
                    >
                        <span class="text-lg leading-none">+</span>
                        Tambah Jadwal
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection