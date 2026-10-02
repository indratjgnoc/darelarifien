@extends('layouts.guru')

@section('title', 'Rekap Nilai')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('guru.grades.assignments') }}"
                   class="transition hover:text-[#087443]">
                    Nilai
                </a>

                <span>/</span>

                <span class="text-slate-700">
                    Rekap Nilai
                </span>
            </div>

            <h1 class="mt-2 text-2xl font-bold tracking-tight text-slate-900">
                Rekap Nilai Santri
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Rekapitulasi nilai {{ $assignment->subject->name }}
                untuk kelas {{ $assignment->schoolClass->name }}.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">

            <a href="{{ route('guru.grades.index', $assignment->id) }}"
               class="inline-flex items-center gap-2 rounded-xl bg-[#087443]
                      px-4 py-2.5 text-sm font-semibold text-white shadow-sm
                      transition hover:bg-[#066238]">
                <i data-lucide="file-pen-line" class="h-4 w-4"></i>
                Input Nilai
            </a>

            <a href="{{ route('guru.grades.assignments') }}"
               class="inline-flex items-center gap-2 rounded-xl border
                      border-slate-200 bg-white px-4 py-2.5 text-sm
                      font-semibold text-slate-700 shadow-sm transition
                      hover:bg-slate-50">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                Kembali
            </a>

        </div>

    </div>


    {{-- Informasi --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Mata Pelajaran --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-emerald-50 text-[#087443]">
                    <i data-lucide="book-open" class="h-5 w-5"></i>
                </div>

                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Mata Pelajaran
                    </p>

                    <p class="mt-1 truncate font-bold text-slate-900">
                        {{ $assignment->subject->name }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Kelas --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-emerald-50 text-[#087443]">
                    <i data-lucide="school" class="h-5 w-5"></i>
                </div>

                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Kelas
                    </p>

                    <p class="mt-1 truncate font-bold text-slate-900">
                        {{ $assignment->schoolClass->name }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Tahun Akademik --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-emerald-50 text-[#087443]">
                    <i data-lucide="calendar-days" class="h-5 w-5"></i>
                </div>

                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Tahun Akademik
                    </p>

                    <p class="mt-1 truncate font-bold text-slate-900">
                        {{ $assignment->academicYear->name }}
                    </p>

                </div>

            </div>

        </div>


        {{-- KKM --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-amber-50 text-amber-600">
                    <i data-lucide="target" class="h-5 w-5"></i>
                </div>

                <div class="min-w-0">

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        KKM
                    </p>

                    <p class="mt-1 truncate font-bold text-slate-900">
                        @if(($assignment->subject->minimum_passing_grade ?? 0) > 0)
                            {{ number_format((float) $assignment->subject->minimum_passing_grade, 0) }}
                        @else
                            -
                        @endif
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- Bobot --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center
                            rounded-xl bg-emerald-50 text-[#087443]">
                    <i data-lucide="percent" class="h-5 w-5"></i>
                </div>

                <div>
                    <h2 class="font-bold text-slate-900">
                        Bobot Nilai
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Bobot yang digunakan dalam perhitungan Nilai Akhir.
                    </p>
                </div>

            </div>

        </div>

        <div class="flex flex-wrap gap-2 px-5 py-4">

            @foreach($weights as $weight)

                @php
                    $weightValue = (float) $weight->weight;
                @endphp

                <div class="inline-flex items-center gap-2 rounded-xl border
                            {{ $weightValue > 0
                                ? 'border-emerald-100 bg-emerald-50'
                                : 'border-slate-200 bg-slate-50' }}
                            px-3 py-2">

                    <span class="text-sm font-semibold
                                 {{ $weightValue > 0
                                    ? 'text-emerald-800'
                                    : 'text-slate-500' }}">
                        {{ $weight->assessment_type }}
                    </span>

                    <span class="rounded-lg bg-white px-2 py-0.5 text-xs font-bold
                                 {{ $weightValue > 0
                                    ? 'text-[#087443]'
                                    : 'text-slate-500' }}">
                        {{ number_format($weightValue, 0) }}%
                    </span>

                    @if($weightValue <= 0)
                        <span class="text-[11px] text-slate-400">
                            tidak dihitung
                        </span>
                    @endif

                </div>

            @endforeach

        </div>

    </div>


    {{-- Tabel Rekap --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-5">

            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center
                                rounded-xl bg-slate-100 text-slate-600">
                        <i data-lucide="table-properties" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <h2 class="font-bold text-slate-900">
                            Rekap Nilai
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Rata-rata setiap komponen penilaian dan Nilai Akhir.
                        </p>

                    </div>

                </div>

                <div class="text-xs text-slate-400">
                    {{ $summaries->count() }} Santri
                </div>

            </div>

        </div>


        @if($summaries->isEmpty())

            <div class="px-6 py-14 text-center">

                <div class="mx-auto flex h-14 w-14 items-center justify-center
                            rounded-2xl bg-slate-100 text-slate-400">
                    <i data-lucide="clipboard-x" class="h-7 w-7"></i>
                </div>

                <h3 class="mt-4 font-bold text-slate-800">
                    Belum ada data nilai
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Data rekap nilai santri akan muncul setelah penilaian dimasukkan.
                </p>

            </div>

        @else

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="sticky left-0 z-10 min-w-[55px]
                                       border-r border-slate-200 bg-slate-50
                                       px-4 py-3 text-center text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                No
                            </th>

                            <th class="sticky left-[55px] z-10 min-w-[230px]
                                       border-r border-slate-200 bg-slate-50
                                       px-4 py-3 text-left text-xs font-bold
                                       uppercase tracking-wider text-slate-500">
                                Santri
                            </th>

                            {{-- Dynamic Assessment Columns --}}
                            @foreach($weights as $weight)

                                @php
                                    $weightValue = (float) $weight->weight;
                                @endphp

                                <th class="min-w-[115px] px-4 py-3 text-center
                                           text-xs font-bold uppercase tracking-wider
                                           text-slate-500">

                                    <div>
                                        {{ $weight->assessment_type }}
                                    </div>

                                    <div class="mt-1 text-[10px] font-medium
                                                normal-case tracking-normal
                                                {{ $weightValue > 0
                                                    ? 'text-[#087443]'
                                                    : 'text-slate-400' }}">
                                        {{ number_format($weightValue, 0) }}%
                                    </div>

                                </th>

                            @endforeach

                            {{-- Nilai Akhir --}}
                            <th class="min-w-[125px] bg-emerald-50 px-4 py-3 text-center
                                       text-xs font-bold uppercase tracking-wider
                                       text-[#087443]">
                                Nilai Akhir
                            </th>

                            {{-- KKM --}}
                            <th class="min-w-[100px] bg-amber-50 px-4 py-3 text-center
                                       text-xs font-bold uppercase tracking-wider
                                       text-amber-700">
                                KKM
                            </th>

                            {{-- Status --}}
                            <th class="min-w-[140px] px-4 py-3 text-center
                                       text-xs font-bold uppercase tracking-wider
                                       text-slate-500">
                                Ketuntasan
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 bg-white">

                        @foreach($summaries as $index => $summary)

                            @php
                                $student = $summary->student;

                                $finalScore = $summary->final_score !== null
                                    ? (float) $summary->final_score
                                    : null;

                                $kkm = (float) (
                                    $assignment->subject->minimum_passing_grade ?? 0
                                );

                                $isComplete = $finalScore !== null;

                                if ($kkm > 0 && $finalScore !== null) {
                                    $isPassed = $finalScore >= $kkm;
                                } else {
                                    $isPassed = null;
                                }
                            @endphp

                            <tr class="transition hover:bg-slate-50/70">

                                {{-- No --}}
                                <td class="sticky left-0 z-[1] border-r border-slate-100
                                           bg-white px-4 py-4 text-center text-sm
                                           text-slate-500">
                                    {{ $index + 1 }}
                                </td>


                                {{-- Santri --}}
                                <td class="sticky left-[55px] z-[1] border-r border-slate-100
                                           bg-white px-4 py-4">

                                    <div class="flex items-center gap-3">

                                        @if($student->photo)

                                            <img src="{{ asset('storage/' . $student->photo) }}"
                                                 alt="{{ $student->name }}"
                                                 class="h-9 w-9 rounded-xl object-cover">

                                        @else

                                            <div class="flex h-9 w-9 shrink-0 items-center
                                                        justify-center rounded-xl bg-emerald-50
                                                        text-xs font-bold text-[#087443]">
                                                {{ strtoupper(substr($student->name, 0, 1)) }}
                                            </div>

                                        @endif

                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-semibold text-slate-800">
                                                {{ $student->name }}
                                            </p>

                                            <p class="font-mono text-xs text-slate-400">
                                                {{ $student->NIS ?? '-' }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Dynamic Assessment Scores --}}
                                @foreach($weights as $weight)

                                    @php
                                        $type = $weight->assessment_type;

                                        $average = $summary->averages[$type] ?? null;

                                        $weightValue = (float) $weight->weight;
                                    @endphp

                                    <td class="px-4 py-4 text-center">

                                        @if($average !== null)

                                            <span class="font-semibold
                                                {{ $weightValue > 0
                                                    ? 'text-slate-700'
                                                    : 'text-slate-400' }}">
                                                {{ number_format((float) $average, 2) }}
                                            </span>

                                        @else

                                            <span class="text-sm text-slate-300">
                                                —
                                            </span>

                                        @endif

                                    </td>

                                @endforeach


                                {{-- Nilai Akhir --}}
                                <td class="bg-emerald-50/50 px-4 py-4 text-center">

                                    @if($finalScore !== null)

                                        <span class="inline-flex min-w-[58px]
                                                     items-center justify-center
                                                     rounded-xl bg-[#087443] px-3 py-2
                                                     text-sm font-bold text-white">
                                            {{ number_format($finalScore, 2) }}
                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5
                                                     rounded-xl bg-slate-100 px-3 py-2
                                                     text-xs font-semibold text-slate-500">
                                            <i data-lucide="minus" class="h-3.5 w-3.5"></i>
                                            Belum lengkap
                                        </span>

                                    @endif

                                </td>


                                {{-- KKM --}}
                                <td class="bg-amber-50/30 px-4 py-4 text-center">

                                    @if($kkm > 0)

                                        <span class="font-semibold text-slate-700">
                                            {{ number_format($kkm, 0) }}
                                        </span>

                                    @else

                                        <span class="text-sm text-slate-300">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Ketuntasan --}}
                                <td class="px-4 py-4 text-center">

                                    @if(!$isComplete)

                                        <span class="inline-flex items-center gap-1.5
                                                     rounded-full bg-slate-100 px-3 py-1.5
                                                     text-xs font-bold text-slate-500">
                                            <i data-lucide="clock-3" class="h-3.5 w-3.5"></i>
                                            Belum Lengkap
                                        </span>

                                    @elseif($kkm <= 0)

                                        <span class="inline-flex items-center gap-1.5
                                                     rounded-full bg-slate-100 px-3 py-1.5
                                                     text-xs font-bold text-slate-500">
                                            <i data-lucide="minus-circle" class="h-3.5 w-3.5"></i>
                                            Belum Ditentukan
                                        </span>

                                    @elseif($isPassed)

                                        <span class="inline-flex items-center gap-1.5
                                                     rounded-full bg-emerald-50 px-3 py-1.5
                                                     text-xs font-bold text-emerald-700">
                                            <i data-lucide="circle-check" class="h-3.5 w-3.5"></i>
                                            Tuntas
                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5
                                                     rounded-full bg-red-50 px-3 py-1.5
                                                     text-xs font-bold text-red-700">
                                            <i data-lucide="circle-x" class="h-3.5 w-3.5"></i>
                                            Belum Tuntas
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

});
</script>
@endpush