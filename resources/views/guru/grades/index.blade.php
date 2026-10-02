@extends('layouts.guru')

@section('title', 'Input Nilai')

@section('content')

    <div class="space-y-6">

        {{-- ================================================================
         HEADER
    ================================================================= --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <div class="flex flex-wrap items-center gap-2 text-sm text-slate-500">

                    <a href="{{ route('guru.class.index') }}" class="transition hover:text-[#087443]">
                        Kelas Saya
                    </a>

                    <i data-lucide="chevron-right" class="h-4 w-4"></i>

                    <a href="{{ route('guru.classes.show', $assignment->school_class_id) }}"
                        class="transition hover:text-[#087443]">
                        {{ $assignment->schoolClass?->name ?? 'Kelas' }}
                    </a>

                    <i data-lucide="chevron-right" class="h-4 w-4"></i>

                    <span class="font-medium text-[#087443]">
                        Nilai
                    </span>

                </div>

                <h1 class="mt-3 text-2xl font-bold tracking-tight text-[#062E1F]">
                    Input Nilai Santri
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola nilai {{ $assignment->subject?->name ?? '-' }}
                    untuk kelas {{ $assignment->schoolClass?->name ?? '-' }}.
                </p>

            </div>


            {{-- ACTION --}}
            <div class="flex flex-wrap items-center gap-2">

                <a href="{{ route('guru.grades.summary', $assignment->id) }}"
                    class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-[#087443] px-4 py-2.5
                       text-sm font-semibold text-white
                       shadow-sm transition hover:bg-[#062E1F]">
                    <i data-lucide="chart-no-axes-column" class="h-4 w-4"></i>
                    Rekap Nilai
                </a>

                <a href="{{ route('guru.classes.show', $assignment->school_class_id) }}"
                    class="inline-flex items-center justify-center gap-2
                       rounded-xl border border-slate-200
                       bg-white px-4 py-2.5
                       text-sm font-semibold text-slate-700
                       shadow-sm transition hover:bg-slate-50">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    Kembali
                </a>

            </div>

        </div>


        {{-- ================================================================
         FLASH SUCCESS
    ================================================================= --}}
        @if (session('success'))
            <div
                class="flex items-start gap-3 rounded-2xl border
                   border-emerald-200 bg-emerald-50
                   px-4 py-4 text-emerald-800">

                <i data-lucide="circle-check" class="mt-0.5 h-5 w-5 shrink-0"></i>

                <div class="text-sm font-medium">
                    {{ session('success') }}
                </div>

            </div>
        @endif


        {{-- ================================================================
         FLASH ERROR
    ================================================================= --}}
        @if (session('error'))
            <div
                class="flex items-start gap-3 rounded-2xl border
                   border-red-200 bg-red-50
                   px-4 py-4 text-red-800">

                <i data-lucide="circle-alert" class="mt-0.5 h-5 w-5 shrink-0"></i>

                <div class="text-sm font-medium">
                    {{ session('error') }}
                </div>

            </div>
        @endif


        {{-- ================================================================
         VALIDATION ERROR
    ================================================================= --}}
        @if ($errors->any())

            <div class="rounded-2xl border border-red-200
                   bg-red-50 px-4 py-4 text-red-800">

                <div class="flex items-start gap-3">

                    <i data-lucide="circle-alert" class="mt-0.5 h-5 w-5 shrink-0"></i>

                    <div>

                        <p class="text-sm font-semibold">
                            Terdapat kesalahan pada input.
                        </p>

                        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">

                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- ================================================================
         INFORMASI MAPEL
    ================================================================= --}}
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- MAPEL --}}
            <div class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center
                           justify-center rounded-xl
                           bg-[#062E1F] text-[#F4C542]">
                        <i data-lucide="book-open" class="h-5 w-5"></i>
                    </div>

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Mata Pelajaran
                        </p>

                        <p class="mt-1 truncate font-bold text-[#062E1F]">
                            {{ $assignment->subject?->name ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- KELAS --}}
            <div class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center
                           justify-center rounded-xl
                           bg-[#087443] text-white">
                        <i data-lucide="school" class="h-5 w-5"></i>
                    </div>

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Kelas
                        </p>

                        <p class="mt-1 truncate font-bold text-[#062E1F]">
                            {{ $assignment->schoolClass?->name ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- JUMLAH SANTRI --}}
            <div class="rounded-2xl border border-slate-200
                   bg-white p-5 shadow-sm">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center
                           justify-center rounded-xl
                           bg-[#F4C542] text-[#062E1F]">
                        <i data-lucide="users" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Jumlah Santri
                        </p>

                        <p class="mt-1 font-bold text-[#062E1F]">
                            {{ $students->count() }} Santri
                        </p>

                    </div>

                </div>

            </div>


            {{-- KKM --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-11 w-11 items-center justify-center
                    rounded-xl bg-amber-50 text-amber-600">
                        <i data-lucide="target" class="h-5 w-5"></i>
                    </div>

                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            KKM
                        </p>

                        <p class="mt-1 font-bold text-slate-900">
                            @if (($assignment->subject->minimum_passing_grade ?? 0) > 0)
                                {{ number_format((float) $assignment->subject->minimum_passing_grade, 0) }}
                            @else
                                Belum Ditentukan
                            @endif
                        </p>
                    </div>
                </div>
            </div>

        </div>


        {{-- ================================================================
         BOBOT NILAI
    ================================================================= --}}
        <div class="rounded-2xl border border-slate-200
               bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center
                           justify-center rounded-xl
                           bg-emerald-50 text-[#087443]">
                        <i data-lucide="percent" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <h2 class="font-bold text-[#062E1F]">
                            Bobot Penilaian
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Bobot ini digunakan dalam perhitungan Nilai Akhir.
                        </p>

                    </div>

                </div>

            </div>


            <div class="flex flex-wrap gap-2 px-5 py-4">

                @forelse($weights as $weight)
                    @php
                        $weightValue = (float) $weight->weight;
                    @endphp

                    <div
                        class="inline-flex items-center gap-2 rounded-xl border px-3 py-2
                    {{ $weightValue > 0 ? 'border-emerald-100 bg-emerald-50' : 'border-slate-200 bg-slate-50' }}">

                        <span
                            class="text-sm font-semibold
                        {{ $weightValue > 0 ? 'text-emerald-800' : 'text-slate-500' }}">
                            {{ $weight->assessment_type }}
                        </span>

                        <span
                            class="rounded-lg bg-white px-2 py-0.5
                               text-xs font-bold
                        {{ $weightValue > 0 ? 'text-[#087443]' : 'text-slate-500' }}">
                            {{ number_format($weightValue, 0) }}%
                        </span>

                        @if ($weightValue <= 0)
                            <span class="text-[11px] text-slate-400">
                                tidak dihitung
                            </span>
                        @endif

                    </div>

                @empty

                    <span class="text-sm text-slate-400">
                        Belum ada pengaturan bobot penilaian.
                    </span>
                @endforelse

            </div>

        </div>


        {{-- ================================================================
         FORM INPUT NILAI
    ================================================================= --}}
        <div class="overflow-hidden rounded-2xl
               border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-5">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center
                           justify-center rounded-xl
                           bg-[#087443] text-white">
                        <i data-lucide="file-pen-line" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <h2 class="font-bold text-[#062E1F]">
                            Input Penilaian
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Masukkan satu jenis penilaian untuk seluruh santri.
                        </p>

                    </div>

                </div>

            </div>


            <form method="POST" action="{{ route('guru.grades.store', $assignment->id) }}" id="gradeForm">

                @csrf


                {{-- ============================================================
                 DETAIL PENILAIAN
            ============================================================= --}}
                <div class="grid gap-5 border-b
                       border-slate-100 p-5 md:grid-cols-2">

                    {{-- JENIS --}}
                    <div>

                        <label for="assessment_type" class="mb-2 block text-sm font-semibold text-slate-700">
                            Jenis Penilaian
                        </label>

                        <select name="assessment_type" id="assessment_type" required
                            class="w-full rounded-xl border border-slate-200
                               bg-white px-4 py-3 text-sm text-slate-800
                               outline-none transition
                               focus:border-[#087443]
                               focus:ring-2 focus:ring-[#087443]/10">

                            <option value="">
                                Pilih jenis penilaian
                            </option>

                            @foreach ($weights as $weight)
                                @php
                                    $weightValue = (float) $weight->weight;
                                @endphp

                                <option value="{{ $weight->assessment_type }}" @selected(old('assessment_type') === $weight->assessment_type)>
                                    {{ $weight->assessment_type }}
                                    — {{ number_format($weightValue, 0) }}%

                                    @if ($weightValue <= 0)
                                        (tidak masuk Nilai Akhir)
                                    @endif

                                </option>
                            @endforeach

                        </select>

                        <p id="assessmentWeightInfo" class="mt-2 text-xs text-slate-500">
                            Pilih jenis penilaian untuk melihat informasi bobotnya.
                        </p>

                    </div>


                    {{-- NAMA --}}
                    <div>

                        <label for="assessment_name" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Penilaian
                        </label>

                        <input type="text" name="assessment_name" id="assessment_name"
                            value="{{ old('assessment_name') }}" required maxlength="150"
                            placeholder="Contoh: Tugas 1 / UTS Semester Ganjil"
                            class="w-full rounded-xl border border-slate-200
                               bg-white px-4 py-3 text-sm text-slate-800
                               outline-none transition
                               placeholder:text-slate-400
                               focus:border-[#087443]
                               focus:ring-2 focus:ring-[#087443]/10">

                        <p class="mt-2 text-xs text-slate-400">
                            Gunakan nama yang jelas agar mudah ditemukan pada riwayat nilai.
                        </p>

                    </div>

                </div>


                {{-- ============================================================
                 CATATAN
            ============================================================= --}}
                <div class="border-b border-slate-100 p-5">

                    <label for="notes" class="mb-2 block text-sm font-semibold text-slate-700">
                        Catatan

                        <span class="font-normal text-slate-400">
                            (opsional)
                        </span>

                    </label>

                    <textarea name="notes" id="notes" rows="3" maxlength="1000" placeholder="Catatan penilaian..."
                        class="w-full rounded-xl border border-slate-200
                           bg-white px-4 py-3 text-sm text-slate-800
                           outline-none transition
                           placeholder:text-slate-400
                           focus:border-[#087443]
                           focus:ring-2 focus:ring-[#087443]/10">{{ old('notes') }}</textarea>

                </div>


                {{-- ============================================================
                 DAFTAR SANTRI
            ============================================================= --}}
                <div class="p-5">

                    <div
                        class="mb-4 flex flex-col gap-3
                           sm:flex-row sm:items-center
                           sm:justify-between">

                        <div>

                            <h3 class="font-bold text-[#062E1F]">
                                Daftar Santri
                            </h3>

                            <p class="mt-1 text-xs text-slate-500">
                                Masukkan nilai pada rentang 0 sampai 100.
                            </p>

                        </div>


                        @if ($students->isNotEmpty())
                            <div class="flex flex-wrap items-center gap-2">

                                <button type="button" id="fillEmptyButton"
                                    class="inline-flex items-center gap-2
                                       rounded-xl border border-slate-200
                                       bg-white px-3 py-2 text-xs
                                       font-semibold text-slate-600
                                       transition hover:bg-slate-50">
                                    <i data-lucide="copy-check" class="h-4 w-4"></i>
                                    Isi yang kosong
                                </button>

                                <button type="button" id="clearScoresButton"
                                    class="inline-flex items-center gap-2
                                       rounded-xl border border-red-100
                                       bg-red-50 px-3 py-2 text-xs
                                       font-semibold text-red-600
                                       transition hover:bg-red-100">
                                    <i data-lucide="eraser" class="h-4 w-4"></i>
                                    Kosongkan
                                </button>

                            </div>
                        @endif

                    </div>


                    @if ($students->isEmpty())

                        <div
                            class="rounded-2xl border border-dashed
                               border-slate-300 bg-slate-50
                               px-6 py-12 text-center">

                            <div
                                class="mx-auto flex h-14 w-14 items-center
                                   justify-center rounded-2xl
                                   bg-white text-slate-400 shadow-sm">
                                <i data-lucide="users-round" class="h-7 w-7"></i>
                            </div>

                            <h3 class="mt-4 font-bold text-slate-800">
                                Belum Ada Santri
                            </h3>

                            <p class="mx-auto mt-1 max-w-md text-sm text-slate-500">
                                Belum ada santri aktif pada kelas ini.
                            </p>

                        </div>
                    @else
                        <div class="overflow-x-auto rounded-2xl
                               border border-slate-200">

                            <table class="min-w-full divide-y divide-slate-200">

                                <thead class="bg-slate-50">

                                    <tr>

                                        <th
                                            class="w-14 px-4 py-3 text-center
                                               text-xs font-bold uppercase
                                               tracking-wider text-slate-500">
                                            No
                                        </th>

                                        <th
                                            class="px-4 py-3 text-left
                                               text-xs font-bold uppercase
                                               tracking-wider text-slate-500">
                                            NIS
                                        </th>

                                        <th
                                            class="px-4 py-3 text-left
                                               text-xs font-bold uppercase
                                               tracking-wider text-slate-500">
                                            Nama Santri
                                        </th>

                                        <th
                                            class="w-40 px-4 py-3 text-center
                                               text-xs font-bold uppercase
                                               tracking-wider text-slate-500">
                                            Nilai
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-slate-100 bg-white">

                                    @foreach ($students as $index => $student)
                                        @php

                                            /*
                                             * Ambil nilai lama jika ada.
                                             * Support struktur field:
                                             * - student_id
                                             * - assessment_type
                                             * - assessment_name
                                             */

                                            $existingGrade = collect($grades ?? [])
                                                ->where('student_id', $student->id)
                                                ->where('assessment_type', old('assessment_type'))
                                                ->where('assessment_name', old('assessment_name'))
                                                ->first();

                                            $oldScore = old('scores.' . $student->id, $existingGrade?->score);

                                            $oldNote = old('notes.' . $student->id, $existingGrade?->notes);

                                        @endphp


                                        <tr class="transition hover:bg-slate-50/70">

                                            {{-- NO --}}
                                            <td
                                                class="px-4 py-3 text-center
                                                   text-sm text-slate-500">
                                                {{ $index + 1 }}
                                            </td>


                                            {{-- NIS --}}
                                            <td class="px-4 py-3">

                                                <span class="font-mono text-sm text-slate-600">
                                                    {{ $student->NIS ?? ($student->nis ?? '-') }}
                                                </span>

                                            </td>


                                            {{-- NAMA --}}
                                            <td class="px-4 py-3">

                                                <div class="flex items-center gap-3">

                                                    @if ($student->photo)
                                                        <img src="{{ asset('storage/' . $student->photo) }}"
                                                            alt="{{ $student->name }}"
                                                            class="h-9 w-9 rounded-xl object-cover">
                                                    @else
                                                        <div
                                                            class="flex h-9 w-9 shrink-0
                                                               items-center justify-center
                                                               rounded-xl bg-emerald-50
                                                               text-xs font-bold
                                                               text-[#087443]">
                                                            {{ strtoupper(substr($student->name, 0, 1)) }}
                                                        </div>
                                                    @endif


                                                    <div class="min-w-0">

                                                        <p
                                                            class="truncate text-sm
                                                               font-semibold text-slate-800">
                                                            {{ $student->name }}
                                                        </p>

                                                        @if ($student->NISN)
                                                            <p class="text-xs text-slate-400">
                                                                NISN: {{ $student->NISN }}
                                                            </p>
                                                        @endif

                                                        @if ($student->gender)
                                                            <p class="text-xs text-slate-400">
                                                                {{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                            </p>
                                                        @endif

                                                    </div>

                                                </div>

                                            </td>


                                            {{-- NILAI --}}
                                            <td class="px-4 py-3">

                                                <input type="number" name="scores[{{ $student->id }}]"
                                                    value="{{ $oldScore }}" min="0" max="100"
                                                    step="0.01" inputmode="decimal" placeholder="0–100"
                                                    class="score-input w-full rounded-xl
                                                       border border-slate-200
                                                       bg-white px-3 py-2.5
                                                       text-center text-sm
                                                       font-semibold text-slate-800
                                                       outline-none transition
                                                       placeholder:font-normal
                                                       placeholder:text-slate-300
                                                       focus:border-[#087443]
                                                       focus:ring-2
                                                       focus:ring-[#087443]/10">

                                                @if ($oldNote)
                                                    <p
                                                        class="mt-1 text-[11px]
                                                           text-slate-400">
                                                        {{ $oldNote }}
                                                    </p>
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                        {{-- ====================================================
                         FOOTER FORM
                    ===================================================== --}}
                        <div
                            class="mt-5 flex flex-col gap-3
                               rounded-2xl bg-slate-50 p-4
                               sm:flex-row sm:items-center
                               sm:justify-between">

                            <div class="flex items-center gap-2
                                   text-xs text-slate-500">

                                <i data-lucide="info" class="h-4 w-4"></i>

                                <span>
                                    Nilai yang dikosongkan tidak akan disimpan.
                                </span>

                            </div>


                            <button type="submit"
                                class="inline-flex items-center
                                   justify-center gap-2
                                   rounded-xl bg-[#087443]
                                   px-5 py-3 text-sm font-bold
                                   text-white shadow-sm transition
                                   hover:bg-[#062E1F]
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#087443]/20">

                                <i data-lucide="save" class="h-4 w-4"></i>

                                Simpan Semua Nilai

                            </button>

                        </div>

                    @endif

                </div>

            </form>

        </div>


        {{-- ================================================================
         RIWAYAT PENILAIAN
    ================================================================= --}}
        <div class="overflow-hidden rounded-2xl
               border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-5">

                <div
                    class="flex flex-col gap-3
                       md:flex-row md:items-center
                       md:justify-between">

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0
                               items-center justify-center
                               rounded-xl bg-slate-100
                               text-slate-600">
                            <i data-lucide="history" class="h-5 w-5"></i>
                        </div>

                        <div>

                            <h2 class="font-bold text-[#062E1F]">
                                Riwayat Penilaian
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Daftar penilaian yang sudah dibuat
                                untuk mata pelajaran ini.
                            </p>

                        </div>

                    </div>


                    @if ($assessments->isNotEmpty())

                        @php

                            $completedAssessments = $assessments->where('is_complete', true)->count();

                            $incompleteAssessments = $assessments->where('is_complete', false)->count();

                        @endphp

                        <div class="flex flex-wrap gap-2">

                            <span
                                class="inline-flex items-center gap-1.5
                                   rounded-full bg-emerald-50
                                   px-3 py-1.5 text-xs
                                   font-bold text-emerald-700">

                                <i data-lucide="circle-check" class="h-3.5 w-3.5"></i>

                                {{ $completedAssessments }} Lengkap

                            </span>


                            @if ($incompleteAssessments > 0)
                                <span
                                    class="inline-flex items-center gap-1.5
                                       rounded-full bg-amber-50
                                       px-3 py-1.5 text-xs
                                       font-bold text-amber-700">

                                    <i data-lucide="clock-3" class="h-3.5 w-3.5"></i>

                                    {{ $incompleteAssessments }} Belum Lengkap

                                </span>
                            @endif

                        </div>

                    @endif

                </div>

            </div>


            @if ($assessments->isEmpty())

                <div class="px-6 py-12 text-center">

                    <div
                        class="mx-auto flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-slate-100
                           text-slate-400">
                        <i data-lucide="clipboard-list" class="h-7 w-7"></i>
                    </div>

                    <h3 class="mt-4 font-bold text-slate-800">
                        Belum Ada Penilaian
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Penilaian yang telah dibuat akan muncul di sini.
                    </p>

                </div>
            @else
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">

                        <thead class="bg-slate-50">

                            <tr>

                                <th
                                    class="px-5 py-3 text-left
                                       text-xs font-bold uppercase
                                       tracking-wider text-slate-500">
                                    No
                                </th>

                                <th
                                    class="px-5 py-3 text-left
                                       text-xs font-bold uppercase
                                       tracking-wider text-slate-500">
                                    Jenis
                                </th>

                                <th
                                    class="px-5 py-3 text-left
                                       text-xs font-bold uppercase
                                       tracking-wider text-slate-500">
                                    Penilaian
                                </th>

                                <th
                                    class="px-5 py-3 text-center
                                       text-xs font-bold uppercase
                                       tracking-wider text-slate-500">
                                    Terisi
                                </th>

                                <th
                                    class="px-5 py-3 text-center
                                       text-xs font-bold uppercase
                                       tracking-wider text-slate-500">
                                    Rata-rata
                                </th>

                                <th
                                    class="px-5 py-3 text-center
                                       text-xs font-bold uppercase
                                       tracking-wider text-slate-500">
                                    Status
                                </th>

                                <th
                                    class="px-5 py-3 text-right
                                       text-xs font-bold uppercase
                                       tracking-wider text-slate-500">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach ($assessments as $index => $assessment)
                                @php

                                    /*
                                     * Mendukung dua kemungkinan struktur data:
                                     *
                                     * assessment_type / assessment_name
                                     * atau
                                     * type / name
                                     */

                                    $assessmentType = $assessment->assessment_type ?? ($assessment->type ?? '-');

                                    $assessmentName = $assessment->assessment_name ?? ($assessment->name ?? '-');

                                    $weight = $weights->firstWhere('assessment_type', $assessmentType);

                                    $weightValue = $weight ? (float) $weight->weight : 0;

                                    $count = $assessment->count ?? 0;

                                    $totalStudents = $assessment->total_students ?? $students->count();

                                    $missingCount = $assessment->missing_count ?? max(0, $totalStudents - $count);

                                    $average = $assessment->average ?? 0;

                                @endphp


                                <tr class="transition hover:bg-slate-50/70">

                                    {{-- NO --}}
                                    <td
                                        class="px-5 py-4
                                           text-sm text-slate-500">
                                        {{ $index + 1 }}
                                    </td>


                                    {{-- JENIS --}}
                                    <td class="px-5 py-4">

                                        <div
                                            class="flex flex-col
                                               items-start gap-1">

                                            <span
                                                class="inline-flex w-fit
                                                   rounded-lg
                                                   bg-[#062E1F]
                                                   px-3 py-1
                                                   text-xs font-bold
                                                   text-[#F4C542]">
                                                {{ $assessmentType }}
                                            </span>

                                            @if ($weight)
                                                <span
                                                    class="text-[11px]
                                                       text-slate-400">
                                                    Bobot
                                                    {{ number_format($weightValue, 0) }}%
                                                </span>
                                            @endif

                                        </div>

                                    </td>


                                    {{-- NAMA --}}
                                    <td class="px-5 py-4">

                                        <p
                                            class="text-sm font-semibold
                                               text-[#062E1F]">
                                            {{ $assessmentName }}
                                        </p>

                                    </td>


                                    {{-- TERISI --}}
                                    <td class="px-5 py-4 text-center">

                                        <span
                                            class="font-semibold
                                               text-slate-700">
                                            {{ $count }}
                                        </span>

                                        <span class="text-slate-400">
                                            /
                                            {{ $totalStudents }}
                                        </span>

                                        @if ($missingCount > 0)
                                            <p
                                                class="mt-1 text-[11px]
                                                   text-amber-600">
                                                {{ $missingCount }} belum diisi
                                            </p>
                                        @endif

                                    </td>


                                    {{-- RATA-RATA --}}
                                    <td class="px-5 py-4 text-center">

                                        <span
                                            class="inline-flex min-w-16
                                               justify-center
                                               rounded-lg bg-emerald-50
                                               px-3 py-1.5
                                               text-sm font-bold
                                               text-emerald-700">
                                            {{ number_format((float) $average, 2) }}
                                        </span>

                                    </td>


                                    {{-- STATUS --}}
                                    <td class="px-5 py-4 text-center">

                                        @if ($assessment->is_complete)
                                            <span
                                                class="inline-flex items-center
                                                   gap-1.5 rounded-full
                                                   bg-emerald-50 px-2.5 py-1
                                                   text-xs font-bold
                                                   text-emerald-700">

                                                <i data-lucide="circle-check" class="h-3.5 w-3.5"></i>

                                                Lengkap

                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center
                                                   gap-1.5 rounded-full
                                                   bg-amber-50 px-2.5 py-1
                                                   text-xs font-bold
                                                   text-amber-700">

                                                <i data-lucide="clock-3" class="h-3.5 w-3.5"></i>

                                                {{ $missingCount }} belum

                                            </span>
                                        @endif

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="px-5 py-4">

                                        <div
                                            class="flex items-center
                                               justify-end gap-2">

                                            {{-- EDIT --}}
                                            <a href="{{ route('guru.grades.assessment.edit', [
                                                'assignmentId' => $assignment->id,
                                                'type' => $assessmentType,
                                                'name' => $assessmentName,
                                            ]) }}"
                                                class="inline-flex items-center
                                                   gap-1.5 rounded-xl
                                                   border border-slate-200
                                                   bg-white px-3 py-2
                                                   text-xs font-semibold
                                                   text-slate-600
                                                   transition
                                                   hover:bg-slate-50">

                                                <i data-lucide="pencil" class="h-3.5 w-3.5"></i>

                                                Edit

                                            </a>


                                            {{-- HAPUS --}}
                                            <form method="POST"
                                                action="{{ route('guru.grades.assessment.destroy', [
                                                    'assignmentId' => $assignment->id,
                                                    'type' => $assessmentType,
                                                    'name' => $assessmentName,
                                                ]) }}"
                                                onsubmit="return confirm(
                                                'Hapus penilaian ini beserta seluruh nilai santri?'
                                            )">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex items-center
                                                       gap-1.5 rounded-xl
                                                       border border-red-100
                                                       bg-red-50 px-3 py-2
                                                       text-xs font-semibold
                                                       text-red-600
                                                       transition
                                                       hover:bg-red-100">

                                                    <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- INFO --}}
                <div class="border-t border-slate-100
                       bg-slate-50 px-6 py-4">

                    <div
                        class="flex flex-col gap-2 text-xs
                           text-slate-500 md:flex-row
                           md:items-center md:justify-between">

                        <p>
                            <strong class="text-slate-700">
                                Lengkap
                            </strong>
                            berarti seluruh santri aktif sudah memiliki nilai
                            pada penilaian tersebut.
                        </p>

                        <p>
                            Penilaian dengan bobot
                            <strong class="text-slate-700">
                                0%
                            </strong>
                            tidak menjadi komponen wajib rapor.
                        </p>

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection


{{-- ================================================================
     JAVASCRIPT
================================================================= --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            const weights = @json(
                $weights->mapWithKeys(function ($weight) {
                    return [
                        $weight->assessment_type => (float) $weight->weight,
                    ];
                }));

            const assessmentType =
                document.getElementById('assessment_type');

            const assessmentName =
                document.getElementById('assessment_name');

            const weightInfo =
                document.getElementById('assessmentWeightInfo');

            const gradeForm =
                document.getElementById('gradeForm');

            const fillEmptyButton =
                document.getElementById('fillEmptyButton');

            const clearScoresButton =
                document.getElementById('clearScoresButton');

            function updateWeightInfo() {

                if (!assessmentType || !weightInfo) {
                    return;
                }

                const type = assessmentType.value;

                if (!type) {

                    weightInfo.textContent =
                        'Pilih jenis penilaian untuk melihat informasi bobotnya.';

                    weightInfo.className =
                        'mt-2 text-xs text-slate-500';

                    return;
                }

                const weight =
                    Number(weights[type] ?? 0);


                if (weight > 0) {

                    weightInfo.textContent =
                        `${type} memiliki bobot ${weight}% dan akan masuk dalam perhitungan Nilai Akhir.`;

                    weightInfo.className =
                        'mt-2 text-xs font-medium text-emerald-700';

                } else {

                    weightInfo.textContent =
                        `${type} memiliki bobot 0% sehingga tidak memengaruhi Nilai Akhir.`;

                    weightInfo.className =
                        'mt-2 text-xs font-medium text-amber-700';

                }

            }

            if (assessmentType) {

                assessmentType.addEventListener(
                    'change',
                    updateWeightInfo
                );

                updateWeightInfo();

            }

            if (fillEmptyButton) {

                fillEmptyButton.addEventListener(
                    'click',
                    function() {

                        const inputs =
                            document.querySelectorAll('.score-input');

                        const firstFilled =
                            Array.from(inputs).find(
                                input => input.value !== ''
                            );


                        if (!firstFilled) {

                            alert(
                                'Belum ada nilai yang bisa dijadikan acuan.'
                            );

                            return;
                        }


                        const value =
                            firstFilled.value;


                        inputs.forEach(function(input) {

                            if (input.value === '') {
                                input.value = value;
                            }

                        });

                    }
                );

            }

            if (clearScoresButton) {

                clearScoresButton.addEventListener(
                    'click',
                    function() {

                        const confirmed =
                            confirm(
                                'Kosongkan seluruh nilai pada form ini?'
                            );


                        if (!confirmed) {
                            return;
                        }


                        document
                            .querySelectorAll('.score-input')
                            .forEach(function(input) {

                                input.value = '';

                            });

                    }
                );

            }

            document
                .querySelectorAll('.score-input')
                .forEach(function(input) {

                    input.addEventListener(
                        'input',
                        function() {

                            let value =
                                parseFloat(this.value);


                            if (Number.isNaN(value)) {
                                return;
                            }


                            if (value < 0) {
                                this.value = 0;
                            }


                            if (value > 100) {
                                this.value = 100;
                            }

                        }
                    );


                    input.addEventListener(
                        'blur',
                        function() {

                            let value =
                                parseFloat(this.value);


                            if (Number.isNaN(value)) {
                                return;
                            }


                            if (value < 0) {
                                this.value = 0;
                            }


                            if (value > 100) {
                                this.value = 100;
                            }

                        }
                    );

                });

            if (gradeForm) {

                gradeForm.addEventListener(
                    'submit',
                    function(event) {

                        const type =
                            assessmentType?.value;

                        const name =
                            assessmentName?.value.trim();

                        if (!type || !name) {
                            return;
                        }


                        const scores =
                            Array.from(
                                document.querySelectorAll(
                                    '.score-input'
                                )
                            );


                        const filled =
                            scores.filter(
                                input => input.value !== ''
                            ).length;

                        if (filled === 0) {

                            event.preventDefault();

                            alert(
                                'Masukkan minimal satu nilai sebelum menyimpan.'
                            );

                            return;
                        }

                        if (filled < scores.length) {

                            const proceed =
                                confirm(
                                    `Baru ${filled} dari ${scores.length} santri yang memiliki nilai.\n\n` +
                                    'Santri yang kosong tidak akan disimpan. Lanjutkan?'
                                );


                            if (!proceed) {
                                event.preventDefault();
                            }

                        }

                    }
                );

            }

            document
                .querySelectorAll('.score-input')
                .forEach(function(input) {

                    input.addEventListener(
                        'keydown',
                        function(event) {

                            if (event.key !== 'Enter') {
                                return;
                            }

                            event.preventDefault();

                        }
                    );

                });


        });
    </script>
@endpush
