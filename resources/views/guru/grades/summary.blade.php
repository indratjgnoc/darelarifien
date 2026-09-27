@extends('layouts.guru')
@section('title', 'Rekap Nilai')
@section('content')

    @php
        $minimumPassingGrade = (float) (
            $assignment->subject?->minimum_passing_grade ?? 0
        );
    @endphp

    <div class="space-y-6">

        {{-- ================================================================
             HEADER
        ================================================================= --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500">

                    <a
                        href="{{ route('guru.grades.assignments') }}"
                        class="transition hover:text-[#087443]"
                    >
                        Nilai Santri
                    </a>

                    <i
                        data-lucide="chevron-right"
                        class="h-4 w-4"
                    ></i>

                    <span class="font-medium text-[#087443]">
                        Rekap Nilai
                    </span>

                </div>

                <h1 class="mt-3 text-2xl font-bold text-[#062E1F]">
                    Rekap Nilai Santri
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Rekapitulasi nilai berdasarkan jenis penilaian dan bobot yang telah ditentukan.
                </p>

            </div>


            {{-- ACTION --}}
            <div class="flex flex-wrap gap-2">

                <a
                    href="{{ route('guru.grades.index', $assignment->id) }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-[#087443] px-4 py-2.5
                           text-sm font-semibold text-white
                           shadow-sm transition hover:bg-[#062E1F]"
                >

                    <i
                        data-lucide="pencil"
                        class="h-4 w-4"
                    ></i>

                    Input Nilai

                </a>

            </div>

        </div>


        {{-- ================================================================
             INFO MAPEL
        ================================================================= --}}
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">

            {{-- MAPEL --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Mata Pelajaran
                </p>

                <p class="mt-2 font-bold text-[#062E1F]">
                    {{ $assignment->subject?->name ?? '-' }}
                </p>

            </div>


            {{-- KELAS --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Kelas
                </p>

                <p class="mt-2 font-bold text-[#062E1F]">
                    {{ $assignment->schoolClass?->name ?? '-' }}
                </p>

            </div>


            {{-- TAHUN AKADEMIK --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Tahun Akademik
                </p>

                <p class="mt-2 font-bold text-[#062E1F]">
                    {{ $assignment->academicYear?->name ?? '-' }}
                </p>

            </div>


            {{-- KKM --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    KKM / Nilai Minimum
                </p>

                @if ($minimumPassingGrade > 0)

                    <p class="mt-2 text-xl font-black text-[#087443]">
                        {{ number_format($minimumPassingGrade, 2) }}
                    </p>

                @else

                    <p class="mt-2 font-semibold text-slate-400">
                        Belum ditentukan
                    </p>

                @endif

            </div>

        </div>


        {{-- ================================================================
             BOBOT NILAI
        ================================================================= --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <h2 class="font-bold text-[#062E1F]">
                        Bobot Nilai
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Komponen penilaian yang digunakan dalam perhitungan Nilai Akhir.
                    </p>

                </div>


                <div class="flex flex-wrap gap-2">

                    @forelse ($weights as $weight)

                        <div
                            class="rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-2"
                        >

                            <span class="text-xs font-medium text-slate-500">
                                {{ $weight->assessment_type }}
                            </span>

                            <span class="ml-2 font-bold text-[#087443]">
                                {{ number_format((float) $weight->weight, 0) }}%
                            </span>

                        </div>

                    @empty

                        <span class="text-sm font-medium text-red-500">
                            Bobot belum tersedia.
                        </span>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- ================================================================
             INFORMASI KETUNTASAN
        ================================================================= --}}
        <div
            class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm"
        >

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center
                               rounded-xl bg-emerald-50 text-[#087443]"
                    >

                        <i
                            data-lucide="circle-check"
                            class="h-5 w-5"
                        ></i>

                    </div>

                    <div>

                        <h3 class="font-bold text-[#062E1F]">
                            Ketuntasan Mata Pelajaran
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Status ketuntasan dihitung berdasarkan Nilai Akhir dan KKM mata pelajaran.
                        </p>

                    </div>

                </div>


                <div class="text-left md:text-right">

                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        KKM
                    </p>

                    @if ($minimumPassingGrade > 0)

                        <p class="mt-1 text-lg font-black text-[#087443]">
                            {{ number_format($minimumPassingGrade, 2) }}
                        </p>

                    @else

                        <p class="mt-1 text-sm font-semibold text-slate-400">
                            Belum ditentukan
                        </p>

                    @endif

                </div>

            </div>

        </div>


        {{-- ================================================================
             TABEL REKAP
        ================================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- TABLE HEADER --}}
            <div class="border-b border-slate-100 p-6">

                <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h2 class="font-bold text-[#062E1F]">
                            Rekap Nilai
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Nilai setiap santri dihitung otomatis berdasarkan bobot penilaian.
                        </p>

                    </div>


                    <div
                        class="inline-flex w-fit items-center gap-2
                               rounded-xl bg-emerald-50 px-4 py-2
                               text-sm font-semibold text-emerald-700"
                    >

                        <i
                            data-lucide="users"
                            class="h-4 w-4"
                        ></i>

                        {{ $summaries->count() }} Santri

                    </div>

                </div>

            </div>


            @if ($summaries->isNotEmpty())

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[1000px] text-left">

                        {{-- =================================================
                             TABLE HEAD
                        ================================================== --}}
                        <thead class="bg-slate-50">

                            <tr>

                                <th
                                    class="px-5 py-4 text-xs font-bold
                                           uppercase tracking-wide text-slate-500"
                                >
                                    No
                                </th>


                                <th
                                    class="px-5 py-4 text-xs font-bold
                                           uppercase tracking-wide text-slate-500"
                                >
                                    Santri
                                </th>


                                {{-- DINAMIS BERDASARKAN BOBOT --}}
                                @foreach ($weights as $weight)

                                    <th
                                        class="px-5 py-4 text-center text-xs
                                               font-bold uppercase tracking-wide
                                               text-slate-500"
                                    >
                                        {{ $weight->assessment_type }}
                                    </th>

                                @endforeach


                                <th
                                    class="px-5 py-4 text-center text-xs
                                           font-bold uppercase tracking-wide
                                           text-slate-500"
                                >
                                    Nilai Akhir
                                </th>


                                <th
                                    class="px-5 py-4 text-center text-xs
                                           font-bold uppercase tracking-wide
                                           text-slate-500"
                                >
                                    Ketuntasan
                                </th>

                            </tr>

                        </thead>


                        {{-- =================================================
                             TABLE BODY
                        ================================================== --}}
                        <tbody class="divide-y divide-slate-100">

                            @foreach ($summaries as $index => $summary)

                                @php
                                    $finalScore = $summary->final_score !== null
                                        ? (float) $summary->final_score
                                        : null;

                                    if ($minimumPassingGrade <= 0) {
                                        $completionStatus = 'Belum Ditentukan';
                                    } elseif ($finalScore === null) {
                                        $completionStatus = 'Belum Dinilai';
                                    } elseif ($finalScore >= $minimumPassingGrade) {
                                        $completionStatus = 'Tuntas';
                                    } else {
                                        $completionStatus = 'Belum Tuntas';
                                    }
                                @endphp


                                <tr class="transition hover:bg-slate-50">

                                    {{-- NO --}}
                                    <td class="px-5 py-4 text-sm text-slate-500">
                                        {{ $index + 1 }}
                                    </td>


                                    {{-- SANTRI --}}
                                    <td class="px-5 py-4">

                                        <div class="font-semibold text-[#062E1F]">
                                            {{ $summary->student->name }}
                                        </div>

                                        <div class="mt-0.5 text-xs text-slate-400">
                                            NIS:
                                            {{ $summary->student->nis ?? '-' }}
                                        </div>

                                    </td>


                                    {{-- NILAI DINAMIS --}}
                                    @foreach ($weights as $weight)

                                        <td
                                            class="px-5 py-4 text-center
                                                   text-sm font-semibold text-slate-700"
                                        >

                                            @if ($summary->averages->has($weight->assessment_type))

                                                {{ number_format(
                                                    (float) $summary->averages->get($weight->assessment_type),
                                                    2
                                                ) }}

                                            @else

                                                <span class="text-slate-300">
                                                    -
                                                </span>

                                            @endif

                                        </td>

                                    @endforeach


                                    {{-- NILAI AKHIR --}}
                                    <td class="px-5 py-4 text-center">

                                        @if ($finalScore !== null)

                                            <span
                                                class="inline-flex min-w-20
                                                       justify-center rounded-xl
                                                       bg-[#062E1F] px-3 py-2
                                                       text-sm font-black
                                                       text-[#F4C542]"
                                            >
                                                {{ number_format($finalScore, 2) }}
                                            </span>

                                        @else

                                            <span class="text-sm text-slate-400">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- KETUNTASAN --}}
                                    <td class="px-5 py-4 text-center">

                                        @if ($completionStatus === 'Tuntas')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       rounded-full bg-emerald-50
                                                       px-3 py-1.5 text-xs
                                                       font-bold text-emerald-700"
                                            >

                                                <i
                                                    data-lucide="circle-check"
                                                    class="h-3.5 w-3.5"
                                                ></i>

                                                Tuntas

                                            </span>

                                        @elseif ($completionStatus === 'Belum Tuntas')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       rounded-full bg-red-50
                                                       px-3 py-1.5 text-xs
                                                       font-bold text-red-700"
                                            >

                                                <i
                                                    data-lucide="circle-x"
                                                    class="h-3.5 w-3.5"
                                                ></i>

                                                Belum Tuntas

                                            </span>

                                        @elseif ($completionStatus === 'Belum Dinilai')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       rounded-full bg-amber-50
                                                       px-3 py-1.5 text-xs
                                                       font-bold text-amber-700"
                                            >

                                                <i
                                                    data-lucide="clock-3"
                                                    class="h-3.5 w-3.5"
                                                ></i>

                                                Belum Dinilai

                                            </span>

                                        @else

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       rounded-full bg-slate-100
                                                       px-3 py-1.5 text-xs
                                                       font-bold text-slate-500"
                                            >

                                                <i
                                                    data-lucide="minus-circle"
                                                    class="h-3.5 w-3.5"
                                                ></i>

                                                Belum Ditentukan

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- =========================================================
                     KETERANGAN
                ========================================================== --}}
                <div class="border-t border-slate-100 bg-slate-50 px-6 py-4">

                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-xs">

                        <div class="flex items-center gap-2">

                            <span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>

                            <span class="text-slate-600">
                                Tuntas
                            </span>

                        </div>


                        <div class="flex items-center gap-2">

                            <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>

                            <span class="text-slate-600">
                                Belum Tuntas
                            </span>

                        </div>


                        <div class="flex items-center gap-2">

                            <span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span>

                            <span class="text-slate-600">
                                Belum Dinilai
                            </span>

                        </div>


                        @if ($minimumPassingGrade > 0)

                            <span class="text-slate-400">
                                KKM:
                                <strong class="text-slate-600">
                                    {{ number_format($minimumPassingGrade, 2) }}
                                </strong>
                            </span>

                        @endif

                    </div>

                </div>

            @else

                {{-- =========================================================
                     EMPTY STATE
                ========================================================== --}}
                <div class="p-12 text-center">

                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center
                               rounded-2xl bg-slate-100 text-slate-400"
                    >

                        <i
                            data-lucide="clipboard-list"
                            class="h-6 w-6"
                        ></i>

                    </div>


                    <h3 class="mt-4 font-bold text-[#062E1F]">
                        Belum Ada Data Nilai
                    </h3>


                    <p class="mt-1 text-sm text-slate-500">
                        Nilai santri yang sudah dimasukkan akan muncul di sini.
                    </p>


                    <a
                        href="{{ route('guru.grades.index', $assignment->id) }}"
                        class="mt-5 inline-flex items-center gap-2
                               rounded-xl bg-[#087443] px-4 py-2.5
                               text-sm font-semibold text-white
                               transition hover:bg-[#062E1F]"
                    >

                        <i
                            data-lucide="plus"
                            class="h-4 w-4"
                        ></i>

                        Input Nilai

                    </a>

                </div>

            @endif

        </div>

    </div>

@endsection