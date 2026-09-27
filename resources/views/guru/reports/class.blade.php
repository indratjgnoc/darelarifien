@extends('layouts.guru')

@section('title', 'Kelengkapan Rapor')

@section('content')

<div class="space-y-6">

{{-- HEADER --}}
<div>

    <div class="mb-3 flex items-center gap-2">

        <a
            href="{{ route('guru.reports.index') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold
                   text-gray-500 transition hover:text-[#087443]"
        >
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Kembali
        </a>

    </div>

    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">

        <div>

            <div class="flex items-center gap-3">

                <div
                    class="flex h-12 w-12 items-center justify-center
                           rounded-2xl bg-[#087443]/10
                           text-[#087443]"
                >
                    <i data-lucide="file-text" class="h-6 w-6"></i>
                </div>

                <div>

                    <h1 class="text-2xl font-black text-gray-900">
                        Kelengkapan Rapor
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ $schoolClass->name }}
                        <span class="mx-1 text-gray-300">·</span>
                        {{ $schoolClass->academicYear->name ?? '-' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- CETAK --}}
        <div>

            @if ($isReadyToPrint)

                <a
    href="{{ route('guru.reports.print', $schoolClass->id) }}"
                    class="inline-flex items-center gap-2 rounded-xl
                           bg-[#087443] px-5 py-3
                           text-sm font-bold text-white
                           shadow-sm transition
                           hover:bg-[#066238]"
                >
                    <i data-lucide="printer" class="h-4 w-4"></i>
                    Cetak Rapor
                </a>

            @else

                <button
                    type="button"
                    disabled
                    class="inline-flex cursor-not-allowed items-center gap-2
                           rounded-xl bg-gray-100 px-5 py-3
                           text-sm font-bold text-gray-400"
                >
                    <i data-lucide="lock" class="h-4 w-4"></i>
                    Cetak Rapor
                </button>

            @endif

        </div>

    </div>

</div>


{{-- SUMMARY --}}
<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">

    {{-- SANTRI --}}
    <div
        class="rounded-3xl bg-white p-5
               shadow-sm ring-1 ring-gray-100"
    >

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-semibold text-gray-500">
                    Santri Aktif
                </p>

                <p class="mt-2 text-2xl font-black text-gray-900">
                    {{ $students->count() }}
                </p>

            </div>

            <div
                class="flex h-11 w-11 items-center justify-center
                       rounded-xl bg-[#EAF4EF]
                       text-[#087443]"
            >
                <i data-lucide="users" class="h-5 w-5"></i>
            </div>

        </div>

    </div>


    {{-- MAPEL --}}
    <div
        class="rounded-3xl bg-white p-5
               shadow-sm ring-1 ring-gray-100"
    >

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-semibold text-gray-500">
                    Total Mata Pelajaran
                </p>

                <p class="mt-2 text-2xl font-black text-gray-900">
                    {{ $totalSubjects }}
                </p>

            </div>

            <div
                class="flex h-11 w-11 items-center justify-center
                       rounded-xl bg-gray-100
                       text-gray-500"
            >
                <i data-lucide="book-open" class="h-5 w-5"></i>
            </div>

        </div>

    </div>


    {{-- LENGKAP --}}
    <div
        class="rounded-3xl bg-white p-5
               shadow-sm ring-1 ring-gray-100"
    >

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-semibold text-gray-500">
                    Mapel Lengkap
                </p>

                <p class="mt-2 text-2xl font-black text-[#087443]">
                    {{ $completedSubjects }}
                </p>

            </div>

            <div
                class="flex h-11 w-11 items-center justify-center
                       rounded-xl bg-[#EAF4EF]
                       text-[#087443]"
            >
                <i data-lucide="check-circle-2" class="h-5 w-5"></i>
            </div>

        </div>

    </div>


    {{-- BELUM LENGKAP --}}
    <div
        class="rounded-3xl bg-white p-5
               shadow-sm ring-1 ring-gray-100"
    >

        <div class="flex items-start justify-between">

            <div>

                <p class="text-sm font-semibold text-gray-500">
                    Belum Lengkap
                </p>

                <p
                    class="mt-2 text-2xl font-black
                    {{ $incompleteSubjects > 0
                        ? 'text-red-500'
                        : 'text-[#087443]' }}"
                >
                    {{ $incompleteSubjects }}
                </p>

            </div>

            <div
                class="flex h-11 w-11 items-center justify-center
                rounded-xl
                {{ $incompleteSubjects > 0
                    ? 'bg-red-50 text-red-500'
                    : 'bg-[#EAF4EF] text-[#087443]' }}"
            >
                <i
                    data-lucide="{{ $incompleteSubjects > 0
                        ? 'alert-circle'
                        : 'check-circle-2' }}"
                    class="h-5 w-5"
                ></i>
            </div>

        </div>

    </div>

</div>


{{-- STATUS --}}
<div
    class="rounded-3xl bg-white p-6
           shadow-sm ring-1 ring-gray-100"
>

    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

        {{-- TEXT --}}
        <div>

            @if ($isReadyToPrint)

                <div class="flex items-center gap-2">

                    <span
                        class="inline-flex items-center gap-1.5
                               rounded-full bg-[#EAF4EF]
                               px-3 py-1.5
                               text-xs font-bold text-[#087443]"
                    >
                        <i data-lucide="check-circle-2" class="h-3.5 w-3.5"></i>
                        Siap
                    </span>

                    <span class="text-sm font-bold text-gray-800">
                        Seluruh nilai sudah lengkap
                    </span>

                </div>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Semua mata pelajaran dan komponen nilai wajib
                    sudah memiliki nilai untuk seluruh santri aktif.
                </p>

            @else

                <div class="flex items-center gap-2">

                    <span
                        class="inline-flex items-center gap-1.5
                               rounded-full bg-amber-50
                               px-3 py-1.5
                               text-xs font-bold text-amber-700"
                    >
                        <i data-lucide="clock-3" class="h-3.5 w-3.5"></i>
                        Belum Siap
                    </span>

                    <span class="text-sm font-bold text-gray-800">
                        Masih ada nilai yang harus dilengkapi
                    </span>

                </div>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Lengkapi seluruh nilai sebelum rapor dapat dicetak.
                </p>

            @endif

        </div>


        {{-- PROGRESS --}}
        <div class="w-full lg:w-72">

            <div class="mb-2 flex items-center justify-between">

                <span class="text-xs font-semibold text-gray-500">
                    Progress
                </span>

                <span class="text-sm font-black text-gray-800">

                    @if ($totalSubjects > 0)
                        {{ round(($completedSubjects / $totalSubjects) * 100) }}%
                    @else
                        0%
                    @endif

                </span>

            </div>

            <div class="h-2 overflow-hidden rounded-full bg-gray-100">

                <div
                    class="h-full rounded-full transition-all duration-500
                    {{ $isReadyToPrint
                        ? 'bg-[#087443]'
                        : 'bg-amber-400' }}"
                    style="width:
                        {{ $totalSubjects > 0
                            ? (($completedSubjects / $totalSubjects) * 100)
                            : 0 }}%"
                ></div>

            </div>

            <p class="mt-2 text-right text-xs text-gray-400">
                {{ $completedSubjects }} / {{ $totalSubjects }} mapel
            </p>

        </div>

    </div>

</div>


{{-- KOMPONEN PENILAIAN --}}
<div
    class="rounded-3xl bg-white p-6
           shadow-sm ring-1 ring-gray-100"
>

    <div class="flex items-center gap-3">

        <div
            class="flex h-10 w-10 items-center justify-center
                   rounded-xl bg-gray-100 text-gray-600"
        >
            <i data-lucide="percent" class="h-5 w-5"></i>
        </div>

        <div>

            <h2 class="text-base font-black text-gray-900">
                Komponen Penilaian
            </h2>

            <p class="mt-1 text-xs text-gray-500">
                Komponen yang wajib tersedia sebelum rapor dicetak.
            </p>

        </div>

    </div>


    <div class="mt-5 flex flex-wrap gap-2">

        @forelse ($weights as $weight)

            <span
                class="inline-flex items-center gap-1.5
                       rounded-xl border border-gray-200
                       bg-gray-50 px-3 py-2
                       text-sm font-semibold text-gray-700"
            >
                {{ $weight->assessment_type }}

                <span class="text-[#087443]">
                    {{ number_format((float) $weight->weight, 0) }}%
                </span>
            </span>

        @empty

            <span class="text-sm font-semibold text-red-500">
                Bobot nilai belum tersedia.
            </span>

        @endforelse

    </div>

</div>


{{-- STATUS MAPEL --}}
<div
    class="overflow-hidden rounded-3xl bg-white
           shadow-sm ring-1 ring-gray-100"
>

    {{-- HEADER --}}
    <div class="border-b border-gray-100 p-6">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-lg font-black text-gray-900">
                    Status Nilai Mata Pelajaran
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Pemeriksaan dilakukan untuk
                    {{ $students->count() }} santri aktif.
                </p>

            </div>

            <span
                class="inline-flex w-fit items-center rounded-xl
                       bg-gray-100 px-3 py-2
                       text-xs font-bold text-gray-600"
            >
                {{ $totalSubjects }} Mata Pelajaran
            </span>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full min-w-[900px]">

            <thead>

                <tr class="border-b border-gray-100 bg-gray-50/80">

                    <th
                        class="px-6 py-4 text-left
                               text-xs font-black uppercase
                               tracking-wider text-gray-500"
                    >
                        #
                    </th>

                    <th
                        class="px-6 py-4 text-left
                               text-xs font-black uppercase
                               tracking-wider text-gray-500"
                    >
                        Mata Pelajaran
                    </th>

                    <th
                        class="px-6 py-4 text-left
                               text-xs font-black uppercase
                               tracking-wider text-gray-500"
                    >
                        Guru
                    </th>

                    <th
                        class="px-6 py-4 text-left
                               text-xs font-black uppercase
                               tracking-wider text-gray-500"
                    >
                        Status
                    </th>

                    <th
                        class="px-6 py-4 text-left
                               text-xs font-black uppercase
                               tracking-wider text-gray-500"
                    >
                        Kekurangan
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-100">

                @forelse ($subjects as $index => $item)

                    <tr class="transition hover:bg-gray-50">

                        {{-- NO --}}
                        <td class="px-6 py-5">

                            <span
                                class="text-sm font-bold text-gray-400"
                            >
                                {{ $index + 1 }}
                            </span>

                        </td>


                        {{-- MAPEL --}}
                        <td class="px-6 py-5">

                            <div>

                                <p class="font-black text-gray-900">
                                    {{ $item->subject->name ?? '-' }}
                                </p>

                                @if (!empty($item->subject->code))

                                    <p class="mt-1 text-xs font-semibold text-gray-400">
                                        {{ $item->subject->code }}
                                    </p>

                                @endif

                            </div>

                        </td>


                        {{-- GURU --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-2">

                                <div
                                    class="flex h-8 w-8 shrink-0
                                           items-center justify-center
                                           rounded-lg bg-gray-100
                                           text-gray-500"
                                >
                                    <i data-lucide="user-round" class="h-4 w-4"></i>
                                </div>

                                <span class="text-sm font-semibold text-gray-700">
                                    {{ $item->teacher->name ?? '-' }}
                                </span>

                            </div>

                        </td>


                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if ($item->is_complete)

                                <span
                                    class="inline-flex items-center gap-1.5
                                           rounded-full bg-[#EAF4EF]
                                           px-3 py-1.5
                                           text-xs font-bold text-[#087443]"
                                >
                                    <i data-lucide="check-circle-2" class="h-3.5 w-3.5"></i>
                                    Lengkap
                                </span>

                            @else

                                <span
                                    class="inline-flex items-center gap-1.5
                                           rounded-full bg-red-50
                                           px-3 py-1.5
                                           text-xs font-bold text-red-600"
                                >
                                    <i data-lucide="x-circle" class="h-3.5 w-3.5"></i>
                                    Belum Lengkap
                                </span>

                            @endif

                        </td>


                        {{-- KEKURANGAN --}}
                        <td class="px-6 py-5">

                            @if ($item->is_complete)

                                <div class="flex items-center gap-2 text-sm font-semibold text-[#087443]">

                                    <i data-lucide="check-check" class="h-4 w-4"></i>

                                    Semua nilai tersedia

                                </div>

                            @else

                                <div class="space-y-2">

                                    @foreach ($item->missing as $missing)

                                        <div
                                            class="flex items-start gap-2
                                                   text-sm text-red-600"
                                        >

                                            <i
                                                data-lucide="alert-triangle"
                                                class="mt-0.5 h-4 w-4 shrink-0"
                                            ></i>

                                            <span>
                                                <strong>
                                                    {{ $missing['type'] }}
                                                </strong>
                                                —
                                                {{ $missing['count'] }}
                                                santri belum memiliki nilai
                                            </span>

                                        </div>

                                    @endforeach

                                </div>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="px-6 py-12 text-center">

                            <div
                                class="mx-auto flex h-14 w-14 items-center
                                       justify-center rounded-2xl
                                       bg-gray-100 text-gray-400"
                            >
                                <i data-lucide="book-x" class="h-6 w-6"></i>
                            </div>

                            <p class="mt-4 text-sm font-bold text-gray-700">
                                Belum ada mata pelajaran
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                Belum ada mata pelajaran yang terdaftar untuk kelas ini.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- KOMPONEN WAJIB --}}
@if ($requiredTypes->isNotEmpty())

    <div
        class="rounded-3xl bg-white p-6
               shadow-sm ring-1 ring-gray-100"
    >

        <div>

            <h2 class="text-base font-black text-gray-900">
                Komponen yang Diperiksa
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Setiap komponen berikut wajib tersedia untuk seluruh santri.
            </p>

        </div>


        <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">

            @foreach ($requiredTypes as $type)

                <div
                    class="rounded-2xl border border-gray-100
                           bg-gray-50/70 p-4"
                >

                    <div class="flex items-center gap-2">

                        <div
                            class="flex h-8 w-8 items-center justify-center
                                   rounded-lg bg-[#EAF4EF]
                                   text-[#087443]"
                        >
                            <i data-lucide="check" class="h-4 w-4"></i>
                        </div>

                        <span class="text-sm font-bold text-gray-800">
                            {{ $type }}
                        </span>

                    </div>

                    <p class="mt-2 text-xs leading-5 text-gray-500">
                        Wajib tersedia untuk seluruh santri.
                    </p>

                </div>

            @endforeach

        </div>

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
