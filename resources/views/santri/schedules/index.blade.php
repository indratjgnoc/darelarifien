@extends('layouts.santri')

@section('content')

<div class="min-h-screen bg-gray-50 py-6">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-8">

            <div class="mb-2 flex items-center gap-2 text-sm text-gray-400">
                <span>Santri</span>
                <span>/</span>
                <span>Jadwal</span>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <h1 class="text-2xl font-black tracking-tight text-gray-900 sm:text-3xl">
                        Jadwal Pelajaran
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Jadwal pembelajaran kelas kamu.
                    </p>

                </div>


                {{-- INFO KELAS --}}
                <div class="rounded-2xl border border-gray-100 bg-white px-5 py-4 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#087443]/10 text-lg">
                            🎓
                        </div>

                        <div>

                            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                Kelas Saya
                            </p>

                            <p class="mt-1 font-black text-gray-900">
                                {{ $student->schoolClass?->name ?? '-' }}
                            </p>

                            <p class="mt-0.5 text-xs font-medium text-gray-400">
                                {{ $student->academicYear?->name ?? '-' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- JIKA TIDAK ADA JADWAL --}}
        @if ($schedules->isEmpty())

            <div class="rounded-3xl border border-gray-100 bg-white px-6 py-16 text-center shadow-sm">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-[#087443]/10 text-3xl">
                    📅
                </div>

                <h2 class="mt-5 text-lg font-black text-gray-800">
                    Jadwal Belum Tersedia
                </h2>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-400">
                    Jadwal pelajaran untuk kelas
                    <strong>
                        {{ $student->schoolClass?->name ?? '-' }}
                    </strong>
                    belum tersedia.
                </p>

            </div>

        @else


            {{-- DESKTOP --}}
            <div class="hidden overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm md:block">

                <div class="border-b border-gray-100 px-6 py-5">

                    <h2 class="text-lg font-black text-gray-900">
                        Jadwal Mingguan
                    </h2>

                    <p class="mt-1 text-xs font-medium text-gray-400">
                        {{ $schedules->count() }} jadwal pembelajaran
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead>

                            <tr class="border-b border-gray-100 bg-gray-50">

                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">
                                    Hari
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-gray-400">
                                    Waktu
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

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @foreach ($schedules as $schedule)

                                @php
                                    $assignment = $schedule->teacherClassSubject;
                                @endphp

                                <tr class="transition hover:bg-gray-50">

                                    {{-- NO --}}
                                    <td class="px-6 py-5 text-sm font-bold text-gray-400">
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- HARI --}}
                                    <td class="px-6 py-5">

                                        <span class="inline-flex rounded-xl bg-[#087443]/10 px-3 py-2 text-xs font-black text-[#087443]">
                                            {{ $schedule->day }}
                                        </span>

                                    </td>


                                    {{-- WAKTU --}}
                                    <td class="whitespace-nowrap px-6 py-5">

                                        <div class="font-black text-gray-800">

                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}

                                            <span class="mx-1 text-gray-300">
                                                —
                                            </span>

                                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}

                                        </div>

                                    </td>


                                    {{-- MAPEL --}}
                                    <td class="px-6 py-5">

                                        <div class="font-black text-gray-800">
                                            {{ $assignment?->subject?->name ?? '-' }}
                                        </div>

                                        @if ($assignment?->subject?->code)

                                            <div class="mt-1 text-xs font-medium text-gray-400">
                                                {{ $assignment->subject->code }}
                                            </div>

                                        @endif

                                    </td>


                                    {{-- GURU --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#087443]/10 text-sm font-black text-[#087443]">
                                                {{
                                                    strtoupper(
                                                        substr(
                                                            $assignment?->teacher?->name ?? '-',
                                                            0,
                                                            1
                                                        )
                                                    )
                                                }}
                                            </div>

                                            <span class="font-bold text-gray-700">
                                                {{ $assignment?->teacher?->name ?? '-' }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- RUANG --}}
                                    <td class="px-6 py-5">

                                        @if ($schedule->room)

                                            <span class="rounded-lg bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-600">
                                                {{ $schedule->room }}
                                            </span>

                                        @else

                                            <span class="text-sm text-gray-400">
                                                -
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- MOBILE --}}
            <div class="space-y-4 md:hidden">

                @foreach ($schedules as $schedule)

                    @php
                        $assignment = $schedule->teacherClassSubject;
                    @endphp

                    <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">

                        {{-- CARD HEADER --}}
                        <div class="flex items-center justify-between border-b border-gray-100 bg-gray-50 px-5 py-4">

                            <span class="rounded-xl bg-[#087443]/10 px-3 py-2 text-xs font-black text-[#087443]">
                                {{ $schedule->day }}
                            </span>

                            <span class="text-sm font-black text-gray-800">

                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}

                                —

                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}

                            </span>

                        </div>


                        {{-- CARD BODY --}}
                        <div class="space-y-4 p-5">

                            {{-- MAPEL --}}
                            <div>

                                <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                    Mata Pelajaran
                                </p>

                                <p class="mt-1 text-lg font-black text-gray-900">
                                    {{ $assignment?->subject?->name ?? '-' }}
                                </p>

                                @if ($assignment?->subject?->code)

                                    <p class="mt-0.5 text-xs font-medium text-gray-400">
                                        {{ $assignment->subject->code }}
                                    </p>

                                @endif

                            </div>


                            {{-- GURU --}}
                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#087443]/10 font-black text-[#087443]">

                                    {{
                                        strtoupper(
                                            substr(
                                                $assignment?->teacher?->name ?? '-',
                                                0,
                                                1
                                            )
                                        )
                                    }}

                                </div>

                                <div>

                                    <p class="text-xs font-bold text-gray-400">
                                        Guru
                                    </p>

                                    <p class="font-bold text-gray-800">
                                        {{ $assignment?->teacher?->name ?? '-' }}
                                    </p>

                                </div>

                            </div>


                            {{-- RUANGAN --}}
                            <div class="flex items-center justify-between rounded-2xl bg-gray-50 px-4 py-3">

                                <span class="text-xs font-bold text-gray-400">
                                    Ruangan
                                </span>

                                <span class="text-sm font-black text-gray-700">
                                    {{ $schedule->room ?: 'Belum ditentukan' }}
                                </span>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</div>

@endsection