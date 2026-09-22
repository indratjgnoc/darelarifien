@extends('layouts.guru')

@section('title', 'Kelas ' . $schoolClass->name)

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                    <a href="{{ route('guru.class.index') }}" class="hover:text-emerald-600 transition">
                        Kelas Saya
                    </a>

                    <span>/</span>

                    <span class="text-gray-700">
                        {{ $schoolClass->name }}
                    </span>
                </div>

                <h1 class="text-2xl font-bold text-gray-900">
                    {{ $schoolClass->name }}
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Daftar mata pelajaran yang Anda ampu pada kelas ini.
                </p>
            </div>

            <a href="{{ route('guru.class.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                  rounded-xl border border-gray-200 bg-white
                  text-sm font-semibold text-gray-700
                  hover:bg-gray-50 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>

                Kembali
            </a>

        </div>


        {{-- Informasi Kelas --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Kelas
                        </p>

                        <p class="text-lg font-bold text-gray-900 mt-1">
                            {{ $schoolClass->name }}
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-xl bg-emerald-50
                            flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5z" />

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l6.16-3.42A12.08 12.08 0 0118 16.5c-1.67 1-3.75 1.5-6 1.5s-4.33-.5-6-1.5a12.08 12.08 0 01-.16-5.92L12 14z" />
                        </svg>

                    </div>

                </div>

            </div>


            <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Tahun Akademik
                        </p>

                        <p class="text-lg font-bold text-gray-900 mt-1">
                            {{ $assignments->first()->academicYear->name ?? '-' }}
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-xl bg-amber-50
                            flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>

                    </div>

                </div>

            </div>


            <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Mata Pelajaran
                        </p>

                        <p class="text-lg font-bold text-gray-900 mt-1">
                            {{ $assignments->count() }}
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-xl bg-green-50
                            flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                        </svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- Daftar Mata Pelajaran --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100">

                <h2 class="text-lg font-bold text-gray-900">
                    Mata Pelajaran yang Diampu
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Pilih mata pelajaran untuk mengelola nilai siswa.
                </p>

            </div>


            @if ($assignments->count())

                <div class="divide-y divide-gray-100">

                    @foreach ($assignments as $assignment)
                        <div class="p-5 hover:bg-gray-50 transition">

                            <div
                                class="flex flex-col lg:flex-row
                                    lg:items-center lg:justify-between gap-4">

                                <div class="flex items-center gap-4">

                                    <div
                                        class="w-12 h-12 rounded-xl
                                            bg-gradient-to-br from-emerald-600
                                            to-green-800
                                            flex items-center justify-center
                                            text-white font-bold shadow-sm">

                                        {{ strtoupper(substr($assignment->subject->name ?? 'M', 0, 1)) }}

                                    </div>


                                    <div>

                                        <h3 class="font-bold text-gray-900">

                                            {{ $assignment->subject->name ?? 'Mata Pelajaran' }}

                                        </h3>

                                        <div class="flex flex-wrap items-center gap-2 mt-1">

                                            @if ($assignment->subject?->code)
                                                <span
                                                    class="text-xs px-2 py-1
                                                         rounded-lg bg-gray-100
                                                         text-gray-600 font-medium">

                                                    {{ $assignment->subject->code }}

                                                </span>
                                            @endif

                                            @if ($assignment->credit)
                                                <span
                                                    class="text-xs px-2 py-1
                                                         rounded-lg bg-emerald-50
                                                         text-emerald-700 font-medium">

                                                    {{ $assignment->credit }} SKS

                                                </span>
                                            @endif

                                        </div>

                                    </div>

                                </div>


                                <div class="flex items-center gap-2">

                                    {{-- Tombol Nilai --}}
                                    <a href="{{ route('guru.grades.index', $assignment->id) }}"
                                        class="inline-flex items-center justify-center
                                          gap-2 px-4 py-2.5 rounded-xl
                                          bg-emerald-600 text-white
                                          text-sm font-semibold
                                          hover:bg-emerald-700 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17v-2a4 4 0 014-4h4a4 4 0 014 4v2M9 17H5a2 2 0 01-2-2v-1a4 4 0 014-4h2m4-6a4 4 0 110 8 4 4 0 010-8z" />

                                        </svg>

                                        Kelola Nilai

                                    </a>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <div class="p-10 text-center">

                    <div
                        class="w-14 h-14 mx-auto rounded-2xl
                            bg-gray-100 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />

                        </svg>

                    </div>

                    <h3 class="mt-4 font-bold text-gray-900">
                        Belum Ada Mata Pelajaran
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Belum ada penugasan mata pelajaran untuk kelas ini.
                    </p>

                </div>

            @endif

        </div>

    </div>

@endsection
