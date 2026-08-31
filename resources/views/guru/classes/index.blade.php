@extends('layouts.guru')

@section('title', 'Kelas Saya')

@section('content')

<div class="max-w-7xl">

    {{-- HEADER --}}
    <div class="mb-8">

        <div class="flex items-center gap-3">

            <div
                class="flex h-12 w-12 items-center justify-center
                       rounded-2xl bg-[#087443]/10 text-[#087443]"
            >
                <i data-lucide="school" class="h-6 w-6"></i>
            </div>

            <div>

                <h1 class="text-2xl font-black text-gray-900">
                    Kelas Saya
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Daftar kelas yang Anda ajar.
                </p>

            </div>

        </div>

    </div>


    {{-- BELUM TERHUBUNG --}}
    @if (!$teacher)

        <div
            class="rounded-3xl border border-yellow-200
                   bg-yellow-50 p-8"
        >

            <div class="flex items-center gap-4">

                <div
                    class="flex h-12 w-12 shrink-0 items-center
                           justify-center rounded-xl
                           bg-yellow-100 text-yellow-600"
                >
                    <i data-lucide="alert-circle" class="h-6 w-6"></i>
                </div>

                <div>

                    <h3 class="font-black text-yellow-800">
                        Data Guru Belum Terhubung
                    </h3>

                    <p class="mt-1 text-sm text-yellow-700">
                        Akun Anda belum terhubung dengan data guru.
                    </p>

                </div>

            </div>

        </div>


    {{-- TIDAK ADA KELAS --}}
    @elseif ($classes->isEmpty())

        <div
            class="rounded-3xl bg-white p-10 text-center
                   shadow-sm ring-1 ring-gray-100"
        >

            <div
                class="mx-auto flex h-16 w-16 items-center
                       justify-center rounded-2xl
                       bg-gray-100 text-gray-400"
            >

                <i data-lucide="school" class="h-7 w-7"></i>

            </div>

            <h3 class="mt-5 text-lg font-black text-gray-800">
                Belum Ada Kelas
            </h3>

            <p class="mt-2 text-sm text-gray-500">
                Anda belum memiliki jadwal mengajar pada kelas manapun.
            </p>

        </div>


    {{-- DAFTAR KELAS --}}
    @else

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

            @foreach ($classes as $className => $schedules)

                <div
                    class="group rounded-3xl bg-white p-6
                           shadow-sm ring-1 ring-gray-100
                           transition hover:-translate-y-1
                           hover:shadow-xl"
                >

                    {{-- ICON --}}
                    <div class="flex items-start justify-between">

                        <div
                            class="flex h-14 w-14 items-center
                                   justify-center rounded-2xl
                                   bg-[#EAF4EF]
                                   text-[#087443]"
                        >

                            <i
                                data-lucide="graduation-cap"
                                class="h-7 w-7"
                            ></i>

                        </div>


                        <span
                            class="rounded-full bg-green-50
                                   px-3 py-1 text-xs font-black
                                   text-green-700"
                        >
                            Aktif
                        </span>

                    </div>


                    {{-- NAMA KELAS --}}
                    <div class="mt-6">

                        <p class="text-xs font-bold uppercase
                                  tracking-wider text-gray-400">
                            Kelas
                        </p>

                        <h2 class="mt-1 text-2xl font-black text-gray-900">
                            {{ $className }}
                        </h2>

                    </div>


                    {{-- JUMLAH MAPEL --}}
                    <div
                        class="mt-6 flex items-center
                               justify-between border-t
                               border-gray-100 pt-5"
                    >

                        <div>

                            <p class="text-xs text-gray-400">
                                Mata Pelajaran
                            </p>

                            <p class="mt-1 font-black text-gray-800">
                                {{ $schedules->unique('subject')->count() }}
                                Mapel
                            </p>

                        </div>


                        <div>

                            <p class="text-xs text-gray-400">
                                Jadwal
                            </p>

                            <p class="mt-1 font-black text-gray-800">
                                {{ $schedules->count() }}
                            </p>

                        </div>

                    </div>


                    {{-- MAPEL --}}
                    <div class="mt-5 space-y-2">

                        @foreach ($schedules->unique('subject') as $schedule)

                            <div
                                class="flex items-center gap-3
                                       rounded-xl bg-gray-50
                                       px-3 py-3"
                            >

                                <div
                                    class="flex h-8 w-8 shrink-0
                                           items-center justify-center
                                           rounded-lg bg-white
                                           text-[#087443]
                                           shadow-sm"
                                >

                                    <i
                                        data-lucide="book-open"
                                        class="h-4 w-4"
                                    ></i>

                                </div>

                                <span
                                    class="text-sm font-bold text-gray-700"
                                >
                                    {{ $schedule->subject }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>

@endsection