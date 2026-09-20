@extends('layouts.santri')

@section('title', 'Jadwal Pelajaran')

@section('page-title', 'Jadwal Pelajaran')

@section('content')

<div class="space-y-6">

    <div>
        <h2 class="text-2xl font-bold text-gray-900">
            Jadwal Pelajaran
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Jadwal pelajaran untuk kelas
            <span class="font-semibold text-[#087443]">
                {{ $student->schoolClass?->name ?? '-' }}
            </span>
        </p>
    </div>

    <div class="rounded-2xl bg-[#062E1F] p-6 text-white shadow-xl">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>
                <p class="text-sm text-white/60">
                    Kelas
                </p>

                <h3 class="mt-1 text-2xl font-bold">
                    {{ $student->schoolClass?->name ?? '-' }}
                </h3>

                <p class="mt-1 text-sm text-white/60">
                    {{ $student->academicYear?->name ?? '-' }}
                </p>
            </div>

            <div class="rounded-xl bg-white/10 px-5 py-3">
                <p class="text-xs uppercase tracking-wider text-white/50">
                    Total Jadwal
                </p>

                <p class="mt-1 text-2xl font-bold">
                    {{ $schedules->count() }}
                </p>
            </div>

        </div>

    </div>

    @if ($schedules->count())

        @php
            $days = [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu',
            ];
        @endphp

        <div class="space-y-6">

            @foreach ($days as $day)

                @php
                    $daySchedules = $schedules->where('day', $day);
                @endphp

                @if ($daySchedules->count())

                    <div>

                        <div class="mb-3 flex items-center gap-3">

                            <div class="h-8 w-1 rounded-full bg-[#087443]"></div>

                            <h3 class="text-lg font-bold text-gray-900">
                                {{ $day }}
                            </h3>

                        </div>

                        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">

                            @foreach ($daySchedules as $schedule)

                                <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                                    <div class="flex items-start justify-between">

                                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#EAF6F0] text-[#087443]">

                                            <i data-lucide="book-open"
                                               class="h-5 w-5"></i>

                                        </div>

                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                        </span>

                                    </div>

                                    <h4 class="mt-4 text-lg font-bold text-gray-900">
                                        {{ $schedule->subject }}
                                    </h4>

                                    <div class="mt-3 space-y-2 text-sm text-gray-500">

                                        <div class="flex items-center gap-2">

                                            <i data-lucide="clock"
                                               class="h-4 w-4"></i>

                                            <span>
                                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                                -
                                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </span>

                                        </div>

                                        <div class="flex items-center gap-2">

                                            <i data-lucide="user-round"
                                               class="h-4 w-4"></i>

                                            <span>
                                                {{ $schedule->teacher?->name ?? '-' }}
                                            </span>

                                        </div>

                                        @if ($schedule->room)

                                            <div class="flex items-center gap-2">

                                                <i data-lucide="map-pin"
                                                   class="h-4 w-4"></i>

                                                <span>
                                                    {{ $schedule->room }}
                                                </span>

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif

            @endforeach

        </div>

    @else

        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-14 text-center">

            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100">

                <i data-lucide="calendar-x"
                   class="h-8 w-8 text-gray-400"></i>

            </div>

            <h3 class="mt-5 text-lg font-bold text-gray-800">
                Jadwal Belum Tersedia
            </h3>

            <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                Belum ada jadwal pelajaran yang tersedia untuk kelas kamu.
            </p>

        </div>

    @endif

</div>

@endsection