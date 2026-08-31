@extends('layouts.admin')

@section('title', 'Tambah Tahun Ajaran')

@section('content')

<div class="max-w-4xl">
{{-- =========================================================
    HEADER
========================================================== --}}
<div class="mb-8">

    <a
        href="{{ route('admin.academic-years.index') }}"
        class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 transition hover:text-[#087443]"
    >
        <i data-lucide="arrow-left" class="h-4 w-4"></i>
        Kembali ke Tahun Ajaran
    </a>

    <div class="mt-5 flex items-start gap-4">

        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#087443]/10">

            <i
                data-lucide="calendar-plus"
                class="h-6 w-6 text-[#087443]"
            ></i>

        </div>

        <div>

            <h1 class="text-2xl font-black tracking-tight text-gray-900">
                Tambah Tahun Ajaran
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Buat periode akademik baru untuk sistem pesantren.
            </p>

        </div>

    </div>

</div>


{{-- =========================================================
    ERROR VALIDATION
========================================================== --}}
@if ($errors->any())

    <div class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-5 text-sm text-red-700">

        <i
            data-lucide="alert-circle"
            class="mt-0.5 h-5 w-5 shrink-0"
        ></i>

        <div>

            <p class="font-black">
                Terdapat kesalahan
            </p>

            <ul class="mt-2 list-disc space-y-1 pl-5">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    </div>

@endif


{{-- =========================================================
    FORM
========================================================== --}}
<form
    action="{{ route('admin.academic-years.store') }}"
    method="POST"
>

    @csrf


    <div class="space-y-6">

        {{-- =================================================
            INFORMASI DASAR
        ================================================== --}}
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-100">

            <div class="border-b border-gray-100 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#087443]/10">

                        <i
                            data-lucide="info"
                            class="h-5 w-5 text-[#087443]"
                        ></i>

                    </div>

                    <div>

                        <h2 class="font-black text-gray-900">
                            Informasi Tahun Ajaran
                        </h2>

                        <p class="text-xs text-gray-500">
                            Informasi dasar periode akademik.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid gap-6 p-6 md:grid-cols-2">

                {{-- TAHUN AJARAN --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Tahun Ajaran
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder="Contoh: 2026/2027"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                    >

                    <p class="mt-2 text-xs text-gray-400">
                        Format: 2026/2027
                    </p>

                    @error('name')

                        <p class="mt-1.5 text-xs font-semibold text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- SEMESTER --}}
                <div>

                    <label
                        for="semester"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Semester
                    </label>

                    <select
                        id="semester"
                        name="semester"
                        required
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                    >

                        <option value="">
                            -- Pilih Semester --
                        </option>

                        <option
                            value="Ganjil"
                            @selected(old('semester') === 'Ganjil')
                        >
                            Ganjil
                        </option>

                        <option
                            value="Genap"
                            @selected(old('semester') === 'Genap')
                        >
                            Genap
                        </option>

                    </select>

                    @error('semester')

                        <p class="mt-1.5 text-xs font-semibold text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- TANGGAL MULAI --}}
                <div>

                    <label
                        for="start_date"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Tanggal Mulai
                    </label>

                    <input
                        id="start_date"
                        type="date"
                        name="start_date"
                        value="{{ old('start_date') }}"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                    >

                    @error('start_date')

                        <p class="mt-1.5 text-xs font-semibold text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- TANGGAL SELESAI --}}
                <div>

                    <label
                        for="end_date"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Tanggal Selesai
                    </label>

                    <input
                        id="end_date"
                        type="date"
                        name="end_date"
                        value="{{ old('end_date') }}"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                    >

                    @error('end_date')

                        <p class="mt-1.5 text-xs font-semibold text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- DESKRIPSI --}}
                <div class="md:col-span-2">

                    <label
                        for="description"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Keterangan
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Keterangan tambahan tentang tahun ajaran..."
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                    >{{ old('description') }}</textarea>

                    @error('description')

                        <p class="mt-1.5 text-xs font-semibold text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

        </div>


        {{-- =================================================
            PENGATURAN AKADEMIK
        ================================================== --}}
        <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-100">

            <div class="border-b border-gray-100 px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#087443]/10">

                        <i
                            data-lucide="settings-2"
                            class="h-5 w-5 text-[#087443]"
                        ></i>

                    </div>

                    <div>

                        <h2 class="font-black text-gray-900">
                            Pengaturan Akademik
                        </h2>

                        <p class="text-xs text-gray-500">
                            Atur status dan akses akademik tahun ajaran ini.
                        </p>

                    </div>

                </div>

            </div>


            <div class="space-y-5 p-6">

                {{-- TAHUN AKTIF --}}
                <label
                    for="is_active"
                    class="flex cursor-pointer items-start gap-4 rounded-2xl border border-gray-100 bg-gray-50 p-4 transition hover:border-[#087443]/20 hover:bg-[#087443]/5"
                >

                    <input
                        id="is_active"
                        type="checkbox"
                        name="is_active"
                        value="1"
                        @checked(old('is_active'))
                        class="mt-1 h-5 w-5 rounded border-gray-300 text-[#087443] focus:ring-[#087443]"
                    >

                    <span>

                        <span class="block text-sm font-black text-gray-800">
                            Jadikan tahun ajaran aktif
                        </span>

                        <span class="mt-1 block text-xs leading-relaxed text-gray-500">
                            Tahun ajaran lain akan otomatis menjadi tidak aktif.
                            Hanya satu tahun ajaran yang dapat aktif.
                        </span>

                    </span>

                </label>


                {{-- PEMILIHAN MAPEL --}}
                <label
                    for="course_selection_open"
                    class="flex cursor-pointer items-start gap-4 rounded-2xl border border-gray-100 bg-gray-50 p-4 transition hover:border-[#087443]/20 hover:bg-[#087443]/5"
                >

                    <input
                        id="course_selection_open"
                        type="checkbox"
                        name="course_selection_open"
                        value="1"
                        @checked(old('course_selection_open'))
                        class="mt-1 h-5 w-5 rounded border-gray-300 text-[#087443] focus:ring-[#087443]"
                    >

                    <span>

                        <span class="block text-sm font-black text-gray-800">
                            Pemilihan mata pelajaran dibuka
                        </span>

                        <span class="mt-1 block text-xs leading-relaxed text-gray-500">
                            Izinkan siswa melakukan pemilihan mata pelajaran
                            untuk tahun ajaran ini.
                        </span>

                    </span>

                </label>

            </div>

        </div>


        {{-- =================================================
            INFORMASI
        ================================================== --}}
        <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5">

            <div class="flex items-start gap-3">

                <i
                    data-lucide="info"
                    class="mt-0.5 h-5 w-5 shrink-0 text-blue-600"
                ></i>

                <div>

                    <p class="text-sm font-black text-blue-800">
                        Informasi
                    </p>

                    <p class="mt-1 text-xs leading-relaxed text-blue-700">
                        Jika tahun ajaran ini dijadikan aktif, tahun ajaran aktif
                        sebelumnya akan dinonaktifkan.
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =================================================
        ACTION
    ================================================== --}}
    <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

        <a
            href="{{ route('admin.academic-years.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-100 px-5 py-3 text-sm font-bold text-gray-700 transition hover:bg-gray-200"
        >

            <i
                data-lucide="x"
                class="h-4 w-4"
            ></i>

            Batal

        </a>


        <button
            type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-6 py-3 text-sm font-black text-white shadow-lg shadow-[#087443]/20 transition hover:bg-[#062E1F]"
        >

            <i
                data-lucide="save"
                class="h-4 w-4"
            ></i>

            Simpan Tahun Ajaran

        </button>

    </div>

</form>

</div>

@endsection

{{-- =============================================================
LUCIDE ICON
============================================================= --}}

@push('scripts')

<script> document.addEventListener('DOMContentLoaded', function () { if (typeof lucide !== 'undefined') { lucide.createIcons(); } }); </script>

@endpush
