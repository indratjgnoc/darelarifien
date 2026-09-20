@extends('layouts.santri')

@section('title', 'Mata Pelajaran')

@section('page-title', 'Mata Pelajaran')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-900">
            Mata Pelajaran
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Daftar mata pelajaran yang tersedia untuk kelas kamu.
        </p>
    </div>

    {{-- Info Kelas --}}
    <div class="rounded-2xl bg-[#062E1F] p-6 text-white shadow-xl">

        <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

            <div>
                <p class="text-sm text-white/60">
                    Kelas Aktif
                </p>

                <h3 class="mt-1 text-2xl font-bold">
                    {{ $student->schoolClass?->name ?? '-' }}
                </h3>

                <p class="mt-1 text-sm text-white/70">
                    {{ $student->academicYear?->name ?? '-' }}
                </p>
            </div>

            <div class="rounded-xl bg-white/10 px-5 py-3">
                <p class="text-xs uppercase tracking-wider text-white/50">
                    Total Mata Pelajaran
                </p>

                <p class="mt-1 text-2xl font-bold">
                    {{ $subjects->count() }}
                </p>
            </div>

        </div>

    </div>

    {{-- Daftar Mata Pelajaran --}}
    @if ($subjects->count())

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">

            @foreach ($subjects as $assignment)

                <div class="group rounded-2xl border border-gray-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex items-start justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#EAF6F0] text-[#087443]">

                            <i data-lucide="book-open" class="h-6 w-6"></i>

                        </div>

                        <span class="rounded-full bg-[#F4E7B8] px-3 py-1 text-xs font-semibold text-[#765B00]">
                            {{ $assignment->credit ?? 0 }} SKS
                        </span>

                    </div>

                    <div class="mt-5">

                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            {{ $assignment->subject?->code ?? '-' }}
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-gray-900">
                            {{ $assignment->subject?->name ?? 'Mata Pelajaran' }}
                        </h3>

                    </div>

                    <div class="mt-5 flex items-center gap-3 border-t border-gray-100 pt-4">

                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100">

                            <i data-lucide="user-round"
                               class="h-4 w-4 text-gray-500"></i>

                        </div>

                        <div>

                            <p class="text-xs text-gray-400">
                                Guru Pengampu
                            </p>

                            <p class="text-sm font-semibold text-gray-700">
                                {{ $assignment->teacher?->name ?? '-' }}
                            </p>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-14 text-center">

            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100">

                <i data-lucide="book-open"
                   class="h-8 w-8 text-gray-400"></i>

            </div>

            <h3 class="mt-5 text-lg font-bold text-gray-800">
                Belum Ada Mata Pelajaran
            </h3>

            <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                Belum ada mata pelajaran yang ditetapkan untuk kelas kamu
                pada tahun akademik ini.
            </p>

        </div>

    @endif

</div>

@endsection