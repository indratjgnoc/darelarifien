@extends('layouts.guru')

@section('title', 'Nilai Santri')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>

        <p class="text-sm font-semibold text-[#087443]">
            Akademik
        </p>

        <h1 class="mt-1 text-2xl font-bold text-[#062E1F]">
            Nilai Santri
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Pilih kelas dan mata pelajaran untuk mengelola nilai santri.
        </p>

    </div>


    {{-- INFO --}}
    <div class="rounded-2xl border border-emerald-100
                bg-gradient-to-r from-[#062E1F] to-[#087443]
                p-6 text-white shadow-sm">

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>

                <p class="text-sm text-emerald-100">
                    Guru Pengampu
                </p>

                <h2 class="mt-1 text-xl font-bold">
                    {{ $teacher->name }}
                </h2>

                <p class="mt-1 text-sm text-emerald-100">
                    Berikut daftar kelas dan mata pelajaran yang menjadi tanggung jawab Anda.
                </p>

            </div>

            <div class="flex h-14 w-14 items-center justify-center
                        rounded-2xl bg-white/10">

                <i data-lucide="clipboard-pen-line"
                   class="h-7 w-7 text-[#F4C542]"></i>

            </div>

        </div>

    </div>


    {{-- ASSIGNMENTS --}}
    @if ($assignments->isNotEmpty())

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">

            @foreach ($assignments as $assignment)

                <div class="group overflow-hidden rounded-2xl
                            border border-slate-200 bg-white
                            shadow-sm transition
                            hover:-translate-y-1 hover:shadow-md">

                    {{-- CARD HEADER --}}
                    <div class="relative overflow-hidden
                                bg-[#062E1F] p-5">

                        <div class="absolute -right-8 -top-8
                                    h-24 w-24 rounded-full
                                    bg-[#087443]/40">
                        </div>

                        <div class="relative flex items-start justify-between gap-4">

                            <div>

                                <span class="inline-flex rounded-lg
                                             bg-[#F4C542] px-3 py-1
                                             text-xs font-bold text-[#062E1F]">

                                    {{ $assignment->schoolClass?->name ?? '-' }}

                                </span>

                                <h2 class="mt-3 text-lg font-bold text-white">

                                    {{ $assignment->subject?->name ?? '-' }}

                                </h2>

                            </div>

                            <div class="flex h-11 w-11 shrink-0
                                        items-center justify-center
                                        rounded-xl bg-white/10
                                        text-[#F4C542]">

                                <i data-lucide="book-open"
                                   class="h-5 w-5"></i>

                            </div>

                        </div>

                    </div>


                    {{-- CARD BODY --}}
                    <div class="p-5">

                        <div class="space-y-3">

                            <div class="flex items-center justify-between gap-3">

                                <span class="text-sm text-slate-500">
                                    Tahun Akademik
                                </span>

                                <span class="text-sm font-semibold text-[#062E1F]">
                                    {{ $assignment->academicYear?->name ?? '-' }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between gap-3">

                                <span class="text-sm text-slate-500">
                                    Semester
                                </span>

                                <span class="text-sm font-semibold text-[#062E1F]">
                                    {{ $assignment->academicYear?->semester ?? '-' }}
                                </span>

                            </div>


                            <div class="border-t border-slate-100 pt-3">

                                <div class="flex items-center gap-2 text-sm text-slate-500">

                                    <i data-lucide="users"
                                       class="h-4 w-4 text-[#087443]"></i>

                                    <span>
                                        Santri kelas {{ $assignment->schoolClass?->name ?? '-' }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- ACTION --}}
                        <a
                            href="{{ route('guru.grades.index', $assignment->id) }}"
                            class="mt-5 inline-flex w-full items-center
                                   justify-center gap-2 rounded-xl
                                   bg-[#087443] px-4 py-3
                                   text-sm font-bold text-white
                                   transition hover:bg-[#062E1F]"
                        >

                            <i data-lucide="clipboard-pen-line"
                               class="h-4 w-4"></i>

                            Kelola Nilai

                            <i data-lucide="arrow-right"
                               class="h-4 w-4 transition
                                      group-hover:translate-x-1"></i>

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- EMPTY --}}
        <div class="rounded-2xl border border-dashed
                    border-slate-300 bg-slate-50 p-12
                    text-center">

            <div class="mx-auto flex h-16 w-16
                        items-center justify-center
                        rounded-2xl bg-white
                        text-[#087443] shadow-sm">

                <i data-lucide="clipboard-list"
                   class="h-7 w-7"></i>

            </div>

            <h3 class="mt-4 font-bold text-[#062E1F]">
                Belum Ada Penugasan
            </h3>

            <p class="mx-auto mt-1 max-w-md text-sm text-slate-500">
                Anda belum memiliki penugasan mata pelajaran
                pada kelas yang aktif.
            </p>

        </div>

    @endif

</div>

@endsection