@extends('layouts.admin')

@section('title', 'Tambah Mata Pelajaran')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <p class="mb-2 text-xs font-black uppercase tracking-[0.18em] text-[#087443]">
                SIAKAD / Akademik
            </p>

            <h1 class="text-3xl font-black tracking-tight text-gray-900">
                Tambah Mata Pelajaran
            </h1>

            <p class="mt-2 text-sm leading-6 text-gray-500">
                Tambahkan mata pelajaran baru ke dalam sistem akademik.
            </p>

        </div>


        <a href="{{ route('admin.subjects.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 shadow-sm transition hover:bg-gray-50">

            <i data-lucide="arrow-left" class="h-4 w-4"></i>

            Kembali

        </a>

    </div>


    {{-- ERRORS --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4">

            <p class="text-sm font-bold text-red-700">
                Periksa kembali data yang dimasukkan.
            </p>

            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <form action="{{ route('admin.subjects.store') }}"
          method="POST">

        @csrf

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- MAIN --}}
            <div class="lg:col-span-2">

                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                    <div class="border-b border-gray-100 px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div class="rounded-xl bg-[#062E1F] p-2.5 text-white">

                                <i data-lucide="book-open"
                                   class="h-4 w-4">
                                </i>

                            </div>

                            <div>

                                <h2 class="font-black text-[#062E1F]">
                                    Informasi Mata Pelajaran
                                </h2>

                                <p class="mt-0.5 text-xs text-gray-400">
                                    Masukkan informasi dasar mata pelajaran.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-6 p-6">

                        {{-- CODE --}}
                        <div>

                            <label for="code"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                Kode Mata Pelajaran
                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="text"
                                id="code"
                                name="code"
                                value="{{ old('code') }}"
                                required
                                maxlength="50"
                                placeholder="Contoh: MAT-01"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm uppercase outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >

                            @error('code')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- NAME --}}
                        <div>

                            <label for="name"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                Nama Mata Pelajaran
                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                placeholder="Contoh: Matematika"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >

                            @error('name')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- CATEGORY --}}
                        <div>

                            <label for="category"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                Kategori

                            </label>

                            <input
                                type="text"
                                id="category"
                                name="category"
                                value="{{ old('category') }}"
                                placeholder="Contoh: Umum, Keagamaan, Bahasa"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >

                            @error('category')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- DESCRIPTION --}}
                        <div>

                            <label for="description"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                Deskripsi

                                <span class="font-normal text-gray-400">
                                    (opsional)
                                </span>

                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Tuliskan keterangan mata pelajaran..."
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm leading-6 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- SIDE --}}
            <div class="space-y-6">

                {{-- ACADEMIC --}}
                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                    <div class="border-b border-gray-100 px-6 py-5">

                        <h2 class="font-black text-[#062E1F]">
                            Pengaturan Akademik
                        </h2>

                    </div>


                    <div class="space-y-5 p-6">

                        {{-- PASSING --}}
                        <div>

                            <label for="minimum_passing_grade"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                Nilai Minimum

                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="number"
                                id="minimum_passing_grade"
                                name="minimum_passing_grade"
                                min="0"
                                max="100"
                                value="{{ old('minimum_passing_grade', 75) }}"
                                required
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >

                            <p class="mt-2 text-xs text-gray-400">
                                Nilai batas minimum kelulusan mata pelajaran.
                            </p>

                        </div>


                        {{-- CREDIT --}}
                        <div>

                            <label for="credit"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                SKS / Bobot

                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="number"
                                id="credit"
                                name="credit"
                                min="1"
                                max="20"
                                value="{{ old('credit', 2) }}"
                                required
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >

                        </div>


                        {{-- STATUS --}}
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-gray-100 bg-[#F8FAF9] p-4">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#087443] focus:ring-[#087443]"
                            >

                            <span>

                                <span class="block text-sm font-bold text-gray-800">
                                    Mata Pelajaran Aktif
                                </span>

                                <span class="mt-1 block text-xs leading-5 text-gray-500">
                                    Mata pelajaran dapat digunakan untuk penugasan guru.
                                </span>

                            </span>

                        </label>

                    </div>

                </div>


                {{-- INFO --}}
                <div class="rounded-2xl bg-[#062E1F] p-6 text-white">

                    <div class="flex items-center gap-3">

                        <div class="rounded-xl bg-white/10 p-2.5">

                            <i data-lucide="info"
                               class="h-4 w-4">
                            </i>

                        </div>

                        <h2 class="font-bold">
                            Catatan
                        </h2>

                    </div>

                    <p class="mt-4 text-sm leading-6 text-white/60">
                        Kode mata pelajaran harus unik. Mata pelajaran yang sudah digunakan dalam penugasan guru sebaiknya tidak dihapus.
                    </p>

                </div>

            </div>

        </div>


        {{-- ACTION --}}
        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a href="{{ route('admin.subjects.index') }}"
               class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-bold text-gray-600 transition hover:bg-gray-50">

                Batal

            </a>


            <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#062E1F]">

                <i data-lucide="save" class="h-4 w-4"></i>

                Simpan Mata Pelajaran

            </button>

        </div>

    </form>

</div>

@push('scripts')
<script>
    if (window.lucide) {
        lucide.createIcons();
    }
</script>
@endpush

@endsection