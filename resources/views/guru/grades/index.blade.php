@extends('layouts.guru')

@section('title', 'Input Nilai')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>

                <div class="flex items-center gap-2 text-sm text-slate-500">

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

                <h1 class="mt-3 text-2xl font-bold text-[#062E1F]">
                    Input Nilai Santri
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Masukkan nilai untuk seluruh santri pada mata pelajaran ini.
                </p>

            </div>

            <div class="flex flex-wrap gap-2">

                <a href="{{ route('guru.grades.summary', $assignment->id) }}"
                    class="inline-flex items-center justify-center
               gap-2 rounded-xl
               bg-[#087443] px-4 py-2.5
               text-sm font-semibold text-white
               shadow-sm transition
               hover:bg-[#062E1F]">

                    <i data-lucide="chart-no-axes-column" class="h-4 w-4"></i>

                    Rekap Nilai

                </a>


                <a href="{{ route('guru.grades.assignments') }}"
                    class="inline-flex items-center justify-center
               gap-2 rounded-xl border border-slate-200
               bg-white px-4 py-2.5
               text-sm font-semibold text-slate-700
               shadow-sm hover:bg-slate-50">

                    <i data-lucide="arrow-left" class="h-4 w-4"></i>

                    Kembali

                </a>

            </div>

        </div>


        {{-- INFO MAPEL --}}
        <div class="grid gap-4 md:grid-cols-3">

            <div class="rounded-2xl border border-slate-200
                    bg-white p-5 shadow-sm">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-[#062E1F] text-[#F4C542]">

                        <i data-lucide="book-open" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Mata Pelajaran
                        </p>

                        <p class="mt-1 font-bold text-[#062E1F]">
                            {{ $assignment->subject?->name ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="rounded-2xl border border-slate-200
                    bg-white p-5 shadow-sm">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-[#087443] text-white">

                        <i data-lucide="school" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Kelas
                        </p>

                        <p class="mt-1 font-bold text-[#062E1F]">
                            {{ $assignment->schoolClass?->name ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="rounded-2xl border border-slate-200
                    bg-white p-5 shadow-sm">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-[#F4C542] text-[#062E1F]">

                        <i data-lucide="users" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Jumlah Santri
                        </p>

                        <p class="mt-1 font-bold text-[#062E1F]">
                            {{ $students->count() }} Santri
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))
            <div
                class="flex items-center gap-3 rounded-xl border border-emerald-200
                    bg-emerald-50 px-4 py-3 text-sm text-emerald-700">

                <i data-lucide="circle-check" class="h-5 w-5"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>
        @endif


        {{-- ERROR --}}
        @if ($errors->any())

            <div class="rounded-xl border border-red-200
                    bg-red-50 px-4 py-4 text-sm text-red-700">

                <div class="flex items-center gap-2 font-bold">

                    <i data-lucide="circle-alert" class="h-5 w-5"></i>

                    <span>
                        Terdapat kesalahan:
                    </span>

                </div>

                <ul class="mt-2 list-disc space-y-1 pl-6">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- FORM INPUT NILAI --}}
        <form method="POST" action="{{ route('guru.grades.store', $assignment->id) }}" class="space-y-6">

            @csrf


            {{-- JENIS PENILAIAN --}}
            <div class="rounded-2xl border border-slate-200
                    bg-white p-6 shadow-sm">

                <div class="mb-5">

                    <h2 class="font-bold text-[#062E1F]">
                        Informasi Penilaian
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Tentukan jenis dan nama penilaian sebelum memasukkan nilai.
                    </p>

                </div>


                <div class="grid gap-5 md:grid-cols-2">

                    <div>

                        <label for="assessment_type" class="mb-2 block text-sm font-semibold text-slate-700">
                            Jenis Penilaian
                        </label>

                        <select id="assessment_type" name="assessment_type" required
                            class="w-full rounded-xl border border-slate-200
                               bg-white px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:ring-2 focus:ring-[#087443]/10">

                            <option value="">
                                Pilih jenis penilaian
                            </option>

                            @foreach (['Tugas', 'Kuis', 'Praktik', 'UTS', 'UAS', 'Lainnya'] as $type)
                                <option value="{{ $type }}" @selected(old('assessment_type') === $type)>
                                    {{ $type }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <div>

                        <label for="assessment_name" class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Penilaian
                        </label>

                        <input type="text" id="assessment_name" name="assessment_name"
                            value="{{ old('assessment_name') }}" placeholder="Contoh: Tugas 1, UTS Semester Ganjil"
                            maxlength="150" required
                            class="w-full rounded-xl border border-slate-200
                               bg-white px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>

                </div>


                <div class="mt-5">

                    <label for="notes" class="mb-2 block text-sm font-semibold text-slate-700">
                        Keterangan
                        <span class="font-normal text-slate-400">
                            (opsional)
                        </span>
                    </label>

                    <textarea id="notes" name="notes" rows="3" maxlength="1000"
                        placeholder="Keterangan tambahan untuk penilaian ini..."
                        class="w-full rounded-xl border border-slate-200
                           bg-white px-4 py-3 text-sm
                           outline-none transition
                           focus:border-[#087443]
                           focus:ring-2 focus:ring-[#087443]/10">{{ old('notes') }}</textarea>

                </div>

            </div>


            {{-- DAFTAR SANTRI --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200
                    bg-white shadow-sm">

                <div
                    class="flex flex-col gap-3 border-b border-slate-100
                        p-6 md:flex-row md:items-center md:justify-between">

                    <div>

                        <h2 class="font-bold text-[#062E1F]">
                            Daftar Santri
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Masukkan nilai 0 sampai 100 untuk setiap santri.
                        </p>

                    </div>

                    <div
                        class="rounded-xl bg-emerald-50 px-4 py-2
                            text-sm font-semibold text-emerald-700">

                        {{ $students->count() }} Santri

                    </div>

                </div>


                @if ($students->isNotEmpty())

                    <div class="overflow-x-auto">

                        <table class="w-full text-left">

                            <thead class="bg-slate-50">

                                <tr>

                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                        No
                                    </th>

                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                        NIS
                                    </th>

                                    <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Nama Santri
                                    </th>

                                    <th class="w-48 px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Nilai
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-slate-100">

                                @foreach ($students as $index => $student)
                                    <tr class="transition hover:bg-slate-50">

                                        <td class="px-5 py-4 text-sm text-slate-500">
                                            {{ $index + 1 }}
                                        </td>

                                        <td class="px-5 py-4 text-sm font-medium text-slate-600">
                                            {{ $student->nis ?? '-' }}
                                        </td>

                                        <td class="px-5 py-4">

                                            <div class="font-semibold text-[#062E1F]">
                                                {{ $student->name }}
                                            </div>

                                            @if ($student->gender)
                                                <div class="mt-0.5 text-xs text-slate-400">

                                                    {{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}

                                                </div>
                                            @endif

                                        </td>

                                        <td class="px-5 py-4">

                                            <input type="number" name="scores[{{ $student->id }}]"
                                                value="{{ old('scores.' . $student->id) }}" min="0"
                                                max="100" step="0.01" placeholder="0 - 100"
                                                class="w-full rounded-xl border border-slate-200
                                                   px-4 py-2.5 text-sm font-semibold
                                                   text-[#062E1F]
                                                   outline-none transition
                                                   focus:border-[#087443]
                                                   focus:ring-2 focus:ring-[#087443]/10">

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                @else
                    <div class="p-10 text-center">

                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center
                                rounded-2xl bg-slate-100 text-slate-400">

                            <i data-lucide="users-round" class="h-6 w-6"></i>

                        </div>

                        <h3 class="mt-4 font-bold text-[#062E1F]">
                            Belum Ada Santri
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Belum ada santri aktif pada kelas ini.
                        </p>

                    </div>

                @endif

            </div>


            {{-- ACTION --}}
            @if ($students->isNotEmpty())
                <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">

                    <a href="{{ route('guru.classes.show', $assignment->school_class_id) }}"
                        class="inline-flex items-center justify-center gap-2
                           rounded-xl border border-slate-200
                           bg-white px-6 py-3
                           text-sm font-semibold text-slate-700
                           transition hover:bg-slate-50">
                        Batal
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-[#087443] px-6 py-3
                           text-sm font-bold text-white
                           shadow-sm transition hover:bg-[#062E1F]">

                        <i data-lucide="save" class="h-4 w-4"></i>

                        Simpan Semua Nilai

                    </button>

                </div>
            @endif

        </form>

        {{-- RIWAYAT NILAI --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 p-6">

                <h2 class="font-bold text-[#062E1F]">
                    Riwayat Penilaian
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Daftar penilaian yang sebelumnya sudah dimasukkan untuk mata pelajaran ini.
                </p>

            </div>


            @if ($assessments->isNotEmpty())

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                    No
                                </th>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Jenis
                                </th>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Penilaian
                                </th>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Jumlah
                                </th>

                                <th class="px-5 py-4 text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Rata-rata
                                </th>

                                <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach ($assessments as $index => $assessment)
                                <tr class="transition hover:bg-slate-50">

                                    {{-- NO --}}
                                    <td class="px-5 py-4 text-sm text-slate-500">
                                        {{ $index + 1 }}
                                    </td>


                                    {{-- JENIS --}}
                                    <td class="px-5 py-4">

                                        <span
                                            class="inline-flex rounded-lg
                                           bg-[#062E1F] px-3 py-1
                                           text-xs font-bold text-[#F4C542]">

                                            {{ $assessment->type }}

                                        </span>

                                    </td>


                                    {{-- NAMA PENILAIAN --}}
                                    <td class="px-5 py-4">

                                        <div class="font-semibold text-[#062E1F]">
                                            {{ $assessment->name }}
                                        </div>

                                    </td>


                                    {{-- JUMLAH --}}
                                    <td class="px-5 py-4">

                                        <span
                                            class="inline-flex rounded-lg
                                           bg-slate-100 px-3 py-1.5
                                           text-sm font-semibold text-slate-700">

                                            {{ $assessment->count }} Nilai

                                        </span>

                                    </td>


                                    {{-- RATA-RATA --}}
                                    <td class="px-5 py-4">

                                        <span
                                            class="inline-flex min-w-16
                                           justify-center rounded-lg
                                           bg-emerald-50 px-3 py-1.5
                                           text-sm font-bold text-emerald-700">

                                            {{ number_format((float) $assessment->average, 2) }}

                                        </span>

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="px-5 py-4 text-right">

                                        <div class="flex justify-end gap-2">

                                            {{-- EDIT --}}
                                            <a href="{{ route('guru.grades.assessment.edit', [
                                                'assignmentId' => $assignment->id,
                                                'type' => $assessment->type,
                                                'name' => $assessment->name,
                                            ]) }}"
                                                class="inline-flex items-center gap-1.5 rounded-lg
                                               border border-slate-200 bg-white
                                               px-3 py-2 text-xs font-semibold
                                               text-slate-700
                                               transition hover:bg-slate-50">

                                                <i data-lucide="pencil" class="h-3.5 w-3.5"></i>

                                                Edit

                                            </a>


                                            {{-- HAPUS --}}
                                            <form method="POST"
                                                action="{{ route('guru.grades.assessment.destroy', [
                                                    'assignmentId' => $assignment->id,
                                                    'type' => $assessment->type,
                                                    'name' => $assessment->name,
                                                ]) }}"
                                                onsubmit="return confirm('Hapus penilaian ini beserta seluruh nilai santri?')">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 rounded-lg
                                                   border border-red-200 bg-red-50
                                                   px-3 py-2 text-xs font-semibold
                                                   text-red-600
                                                   transition hover:bg-red-100">

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
            @else
                <div class="p-10 text-center">

                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center
                       rounded-2xl bg-slate-100 text-slate-400">

                        <i data-lucide="clipboard-list" class="h-6 w-6"></i>

                    </div>

                    <h3 class="mt-4 font-bold text-[#062E1F]">
                        Belum Ada Riwayat Penilaian
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Penilaian yang sudah disimpan akan muncul di sini.
                    </p>

                </div>

            @endif

        </div>

    @endsection
