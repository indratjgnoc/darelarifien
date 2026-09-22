@extends('layouts.guru')

@section('title', 'Rekap Nilai')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500">

                    <a href="{{ route('guru.grades.assignments') }}"
                        class="transition hover:text-[#087443]">
                        Nilai Santri
                    </a>

                    <i data-lucide="chevron-right" class="h-4 w-4"></i>

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

            <div class="flex flex-wrap gap-2">

                <a href="{{ route('guru.grades.index', $assignment->id) }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-[#087443] px-4 py-2.5
                           text-sm font-semibold text-white
                           shadow-sm transition hover:bg-[#062E1F]">

                    <i data-lucide="pencil" class="h-4 w-4"></i>

                    Input Nilai

                </a>

            </div>

        </div>


        {{-- INFO MAPEL --}}
        <div class="grid gap-4 md:grid-cols-3">

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Mata Pelajaran
                </p>

                <p class="mt-2 font-bold text-[#062E1F]">
                    {{ $assignment->subject?->name ?? '-' }}
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Kelas
                </p>

                <p class="mt-2 font-bold text-[#062E1F]">
                    {{ $assignment->schoolClass?->name ?? '-' }}
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Tahun Akademik
                </p>

                <p class="mt-2 font-bold text-[#062E1F]">
                    {{ $assignment->academicYear?->name ?? '-' }}
                </p>

            </div>

        </div>


        {{-- BOBOT NILAI --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <h2 class="font-bold text-[#062E1F]">
                        Bobot Nilai
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Bobot yang digunakan untuk menghitung Nilai Akhir.
                    </p>

                </div>

                <div class="flex flex-wrap gap-2">

                    @forelse ($weights as $weight)

                        <div
                            class="rounded-xl border border-slate-200
                                   bg-slate-50 px-4 py-2">

                            <span class="text-xs font-medium text-slate-500">
                                {{ $weight->assessment_type }}
                            </span>

                            <span class="ml-2 font-bold text-[#087443]">
                                {{ number_format((float) $weight->weight, 0) }}%
                            </span>

                        </div>

                    @empty

                        <span class="text-sm text-red-500">
                            Bobot belum tersedia.
                        </span>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- TABEL REKAP --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

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
                               text-sm font-semibold text-emerald-700">

                        <i data-lucide="users" class="h-4 w-4"></i>

                        {{ $summaries->count() }} Santri

                    </div>

                </div>

            </div>


            @if ($summaries->isNotEmpty())

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[900px] text-left">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                    No
                                </th>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Santri
                                </th>

                                <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Tugas
                                </th>

                                <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Kuis
                                </th>

                                <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Praktik
                                </th>

                                <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                    UTS
                                </th>

                                <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                    UAS
                                </th>

                                <th class="px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Nilai Akhir
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach ($summaries as $index => $summary)

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
                                            NIS: {{ $summary->student->nis ?? '-' }}
                                        </div>

                                    </td>


                                    {{-- TUGAS --}}
                                    <td class="px-5 py-4 text-center text-sm font-semibold text-slate-700">

                                        {{ isset($summary->averages['Tugas'])
                                            ? number_format((float) $summary->averages['Tugas'], 2)
                                            : '-' }}

                                    </td>


                                    {{-- KUIS --}}
                                    <td class="px-5 py-4 text-center text-sm font-semibold text-slate-700">

                                        {{ isset($summary->averages['Kuis'])
                                            ? number_format((float) $summary->averages['Kuis'], 2)
                                            : '-' }}

                                    </td>


                                    {{-- PRAKTIK --}}
                                    <td class="px-5 py-4 text-center text-sm font-semibold text-slate-700">

                                        {{ isset($summary->averages['Praktik'])
                                            ? number_format((float) $summary->averages['Praktik'], 2)
                                            : '-' }}

                                    </td>


                                    {{-- UTS --}}
                                    <td class="px-5 py-4 text-center text-sm font-semibold text-slate-700">

                                        {{ isset($summary->averages['UTS'])
                                            ? number_format((float) $summary->averages['UTS'], 2)
                                            : '-' }}

                                    </td>


                                    {{-- UAS --}}
                                    <td class="px-5 py-4 text-center text-sm font-semibold text-slate-700">

                                        {{ isset($summary->averages['UAS'])
                                            ? number_format((float) $summary->averages['UAS'], 2)
                                            : '-' }}

                                    </td>


                                    {{-- NILAI AKHIR --}}
                                    <td class="px-5 py-4 text-center">

                                        @if ($summary->final_score !== null)

                                            <span
                                                class="inline-flex min-w-20 justify-center
                                                       rounded-xl bg-[#062E1F]
                                                       px-3 py-2
                                                       text-sm font-black text-[#F4C542]">

                                                {{ number_format(
                                                    (float) $summary->final_score,
                                                    2
                                                ) }}

                                            </span>

                                        @else

                                            <span class="text-sm text-slate-400">
                                                -
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="p-12 text-center">

                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center
                               rounded-2xl bg-slate-100 text-slate-400">

                        <i data-lucide="clipboard-list" class="h-6 w-6"></i>

                    </div>

                    <h3 class="mt-4 font-bold text-[#062E1F]">
                        Belum Ada Data Nilai
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Nilai santri yang sudah dimasukkan akan muncul di sini.
                    </p>

                </div>

            @endif

        </div>

    </div>

@endsection