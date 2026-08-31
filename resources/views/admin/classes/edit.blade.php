@extends('layouts.admin')

@section('title', 'Edit Kelas')

@section('content')

<div class="max-w-4xl">

{{-- HEADER --}}
<div class="mb-8">

    <a
        href="{{ route('admin.classes.index') }}"
        class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 transition hover:text-[#087443]"
    >
        <i data-lucide="arrow-left" class="h-4 w-4"></i>

        Kembali ke Kelas
    </a>

    <h1 class="mt-5 text-2xl font-black text-gray-900">
        Edit Kelas
    </h1>

    <p class="mt-1 text-sm text-gray-500">
        Perbarui informasi kelas.
    </p>

</div>


{{-- ERROR --}}
@if ($errors->any())

    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 text-sm text-red-700">

        <div class="flex items-center gap-2 font-black">
            <i data-lucide="alert-circle" class="h-5 w-5"></i>

            Terdapat kesalahan:
        </div>

        <ul class="mt-3 list-disc pl-5">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


{{-- FORM --}}
<form
    action="{{ route('admin.classes.update', ['class' => $schoolClass->id]) }}"
    method="POST"
    class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100"
>

    @csrf
    @method('PUT')


    <div class="grid gap-6 md:grid-cols-2">


        {{-- NAMA KELAS --}}
        <div>

            <label class="mb-2 block text-sm font-bold text-gray-700">
                Nama Kelas
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $schoolClass->name) }}"
                required
                placeholder="Contoh: VII A"
                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:ring-2 focus:ring-[#087443]/10"
            >

        </div>


        {{-- TINGKAT --}}
        <div>

            <label class="mb-2 block text-sm font-bold text-gray-700">
                Tingkat
            </label>

            <input
                type="text"
                name="level"
                value="{{ old('level', $schoolClass->level) }}"
                required
                placeholder="Contoh: VII"
                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:ring-2 focus:ring-[#087443]/10"
            >

        </div>


        {{-- TAHUN AJARAN --}}
        <div class="md:col-span-2">

            <label class="mb-2 block text-sm font-bold text-gray-700">
                Tahun Ajaran
            </label>

            @if ($academicYears->count() > 0)

                <select
                    name="academic_year_id"
                    required
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:ring-2 focus:ring-[#087443]/10"
                >

                    <option value="">
                        -- Pilih Tahun Ajaran --
                    </option>

                    @foreach ($academicYears as $academicYear)

                        <option
                            value="{{ $academicYear->id }}"
                            @selected(
                                old(
                                    'academic_year_id',
                                    $schoolClass->academic_year_id
                                ) == $academicYear->id
                            )
                        >
                            {{ $academicYear->name }}

                            @if ($academicYear->semester)
                                — Semester {{ $academicYear->semester }}
                            @endif

                        </option>

                    @endforeach

                </select>

            @else

                <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">

                    <div class="flex items-start gap-3">

                        <i
                            data-lucide="alert-triangle"
                            class="mt-0.5 h-5 w-5 shrink-0 text-amber-600"
                        ></i>

                        <div>

                            <p class="font-black text-amber-800">
                                Belum ada tahun ajaran
                            </p>

                            <p class="mt-1 text-sm text-amber-700">
                                Silakan buat tahun ajaran terlebih dahulu.
                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>


        {{-- WALI KELAS --}}
        <div class="md:col-span-2">

            <label class="mb-2 block text-sm font-bold text-gray-700">
                Wali Kelas
            </label>

            <select
                name="homeroom_teacher_id"
                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:ring-2 focus:ring-[#087443]/10"
            >

                <option value="">
                    -- Belum Ditentukan --
                </option>

                @foreach ($teachers as $teacher)

                    <option
                        value="{{ $teacher->id }}"
                        @selected(
                            old(
                                'homeroom_teacher_id',
                                $schoolClass->homeroom_teacher_id
                            ) == $teacher->id
                        )
                    >
                        {{ $teacher->name }}
                    </option>

                @endforeach

            </select>

            <p class="mt-2 text-xs text-gray-400">
                Wali kelas nantinya dapat mengatur perangkat kelas
                seperti ketua, sekretaris, dan bendahara.
            </p>

        </div>


        {{-- STATUS --}}
        <div class="md:col-span-2">

            <label class="inline-flex cursor-pointer items-center gap-3">

                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    class="h-4 w-4 rounded border-gray-300 text-[#087443] focus:ring-[#087443]"
                    @checked(
                        old(
                            'is_active',
                            $schoolClass->is_active
                        )
                    )
                >

                <span class="text-sm font-bold text-gray-700">
                    Kelas aktif
                </span>

            </label>

        </div>

    </div>


    {{-- BUTTON --}}
    <div class="mt-8 flex justify-end gap-3">

        <a
            href="{{ route('admin.classes.index') }}"
            class="rounded-xl bg-gray-100 px-5 py-3 text-sm font-bold text-gray-700 transition hover:bg-gray-200"
        >
            Batal
        </a>

        @if ($academicYears->count() > 0)

            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-xl bg-[#087443] px-6 py-3 text-sm font-black text-white shadow-lg shadow-[#087443]/20 transition hover:bg-[#062E1F]"
            >

                <i data-lucide="save" class="h-4 w-4"></i>

                Simpan Perubahan

            </button>

        @endif

    </div>

</form>

</div>

@endsection
