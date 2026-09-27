@extends('layouts.guru')

@section('title', 'Rapor Santri')

@section('content')

<div class="space-y-6">

{{-- HEADER --}}
<div>
    <div class="flex items-center gap-3">

        <div
            class="flex h-12 w-12 items-center justify-center
                   rounded-2xl bg-[#087443]/10 text-[#087443]"
        >
            <i data-lucide="file-text" class="h-6 w-6"></i>
        </div>

        <div>
            <h1 class="text-2xl font-black text-gray-900">
                Rapor Santri
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola dan periksa kelengkapan nilai rapor kelas yang Anda ampu.
            </p>
        </div>

    </div>
</div>


{{-- INFORMASI --}}
<div
    class="rounded-3xl border border-[#087443]/10
           bg-[#EAF4EF] p-5"
>
    <div class="flex items-start gap-4">

        <div
            class="flex h-11 w-11 shrink-0 items-center justify-center
                   rounded-xl bg-white text-[#087443]
                   shadow-sm"
        >
            <i data-lucide="info" class="h-5 w-5"></i>
        </div>

        <div>
            <h3 class="font-black text-gray-900">
                Pemeriksaan Rapor
            </h3>

            <p class="mt-1 text-sm leading-6 text-gray-600">
                Pilih kelas untuk melihat kelengkapan nilai setiap mata pelajaran.
                Rapor dapat dicetak setelah seluruh nilai yang diperlukan telah lengkap.
            </p>
        </div>

    </div>
</div>


{{-- DATA KELAS --}}
@if ($classes->isEmpty())

    <div
        class="rounded-3xl bg-white p-10 text-center
               shadow-sm ring-1 ring-gray-100"
    >

        <div
            class="mx-auto flex h-16 w-16 items-center justify-center
                   rounded-2xl bg-gray-100 text-gray-400"
        >
            <i data-lucide="school" class="h-7 w-7"></i>
        </div>

        <h3 class="mt-5 font-black text-gray-900">
            Belum Ada Kelas
        </h3>

        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
            Belum ada kelas aktif yang terhubung sebagai kelas binaan
            Anda pada tahun ajaran saat ini.
        </p>

    </div>

@else

    {{-- SECTION TITLE --}}
    <div class="flex items-center justify-between">

        <div>
            <h2 class="text-lg font-black text-gray-900">
                Kelas Binaan
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Pilih kelas untuk melihat status rapor.
            </p>
        </div>

        <div
            class="hidden rounded-xl bg-gray-100 px-3 py-2
                   text-sm font-bold text-gray-600 sm:block"
        >
            {{ $classes->count() }} Kelas
        </div>

    </div>


    {{-- CLASS CARDS --}}
    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">

        @foreach ($classes as $class)

            <a
                href="{{ route('guru.reports.class', $class->id) }}"
                class="group block rounded-3xl bg-white p-6
                       shadow-sm ring-1 ring-gray-100
                       transition duration-200
                       hover:-translate-y-1
                       hover:shadow-md
                       hover:ring-[#087443]/20"
            >

                {{-- TOP --}}
                <div class="flex items-start justify-between gap-4">

                    <div
                        class="flex h-12 w-12 items-center justify-center
                               rounded-2xl bg-[#EAF4EF]
                               text-[#087443]
                               transition
                               group-hover:bg-[#087443]
                               group-hover:text-white"
                    >
                        <i data-lucide="school" class="h-6 w-6"></i>
                    </div>

                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-xl bg-gray-50
                               text-gray-400
                               transition
                               group-hover:bg-[#EAF4EF]
                               group-hover:text-[#087443]"
                    >
                        <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
                    </div>

                </div>


                {{-- CLASS NAME --}}
                <div class="mt-6">

                    <h3
                        class="text-xl font-black text-gray-900
                               transition group-hover:text-[#087443]"
                    >
                        {{ $class->name }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $class->academicYear?->name ?? 'Tahun ajaran belum tersedia' }}
                    </p>

                </div>


                {{-- DIVIDER --}}
                <div class="my-5 border-t border-gray-100"></div>


                {{-- CLASS INFO --}}
                <div class="space-y-3">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-8 w-8 items-center justify-center
                                   rounded-lg bg-gray-50 text-gray-500"
                        >
                            <i data-lucide="user-round" class="h-4 w-4"></i>
                        </div>

                        <div class="min-w-0">

                            <p class="text-xs font-semibold text-gray-400">
                                Wali Kelas
                            </p>

                            <p class="truncate text-sm font-bold text-gray-700">
                                {{ $class->homeroomTeacher?->name ?? 'Belum ditentukan' }}
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-8 w-8 items-center justify-center
                                   rounded-lg bg-gray-50 text-gray-500"
                        >
                            <i data-lucide="calendar-days" class="h-4 w-4"></i>
                        </div>

                        <div>

                            <p class="text-xs font-semibold text-gray-400">
                                Semester
                            </p>

                            <p class="text-sm font-bold text-gray-700">
                                {{ $class->academicYear?->semester ?? '-' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ACTION --}}
                <div
                    class="mt-6 flex items-center justify-between
                           border-t border-gray-100 pt-5"
                >

                    <span
                        class="text-sm font-bold text-gray-500
                               transition group-hover:text-[#087443]"
                    >
                        Periksa Rapor
                    </span>

                    <i
                        data-lucide="arrow-right"
                        class="h-4 w-4 text-gray-400
                               transition
                               group-hover:translate-x-1
                               group-hover:text-[#087443]"
                    ></i>

                </div>

            </a>

        @endforeach

    </div>

@endif


</div>

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>

@endpush

@endsection
