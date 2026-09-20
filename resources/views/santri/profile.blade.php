@extends('layouts.santri')

@section('title', 'Profil Santri')

@section('page-title', 'Profil Saya')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <p class="text-sm font-medium text-[#087443]">
            Data Pribadi
        </p>

        <h1 class="mt-1 text-2xl font-bold text-gray-900">
            Profil Saya
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Informasi pribadi dan akademik yang terdaftar di sistem.
        </p>
    </div>


    {{-- PROFILE HEADER --}}
    <div class="overflow-hidden rounded-3xl bg-[#062E1F] shadow-xl">

        <div class="relative p-6 sm:p-8">

            <div class="absolute -right-20 -top-20 h-56 w-56 rounded-full bg-[#087443]/30"></div>

            <div class="relative flex flex-col items-center gap-5 sm:flex-row">

                <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-3xl bg-white/10 text-3xl font-bold text-white ring-1 ring-white/10">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>

                <div class="text-center sm:text-left">

                    <p class="text-xs font-medium uppercase tracking-[0.18em] text-emerald-300">
                        Santri
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-white">
                        {{ $student->name }}
                    </h2>

                    <p class="mt-1 text-sm text-white/60">
                        {{ $user->email }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- DATA PRIBADI --}}
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

        <div class="border-b border-gray-100 px-6 py-5">
            <h2 class="font-bold text-gray-900">
                Data Pribadi
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Informasi identitas santri.
            </p>
        </div>

        <div class="grid gap-x-8 gap-y-6 p-6 sm:grid-cols-2 lg:grid-cols-3">

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    NIS
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->nis ?: '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    NISN
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->nisn ?: '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Jenis Kelamin
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    @if ($student->gender === 'L')
                        Laki-laki
                    @elseif ($student->gender === 'P')
                        Perempuan
                    @else
                        -
                    @endif
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Tempat Lahir
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->birth_place ?: '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Tanggal Lahir
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->birth_date?->format('d F Y') ?: '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    No. HP
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->phone ?: '-' }}
                </p>
            </div>

            <div class="sm:col-span-2 lg:col-span-3">
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Alamat
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->address ?: '-' }}
                </p>
            </div>

        </div>

    </div>


    {{-- DATA AKADEMIK --}}
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

        <div class="border-b border-gray-100 px-6 py-5">
            <h2 class="font-bold text-gray-900">
                Data Akademik
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Informasi kelas dan tahun akademik.
            </p>
        </div>

        <div class="grid gap-x-8 gap-y-6 p-6 sm:grid-cols-2 lg:grid-cols-3">

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Tahun Akademik
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->academicYear?->name ?: '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Semester
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->academicYear?->semester ?: '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Kelas
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->schoolClass?->name ?: '-' }}
                </p>
            </div>

            <div class="sm:col-span-2 lg:col-span-3">
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Wali Kelas
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->schoolClass?->homeroomTeacher?->name ?: '-' }}
                </p>
            </div>

        </div>

    </div>


    {{-- DATA ORANG TUA --}}
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

        <div class="border-b border-gray-100 px-6 py-5">
            <h2 class="font-bold text-gray-900">
                Data Orang Tua / Wali
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Informasi keluarga yang terdaftar.
            </p>
        </div>

        <div class="grid gap-x-8 gap-y-6 p-6 sm:grid-cols-2 lg:grid-cols-3">

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Nama Ayah
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->father_name ?: '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Nama Ibu
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->mother_name ?: '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Nama Wali
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->guardian_name ?: '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    No. HP Orang Tua / Wali
                </p>

                <p class="mt-1 font-semibold text-gray-900">
                    {{ $student->parent_phone ?: '-' }}
                </p>
            </div>

        </div>

    </div>


    {{-- NOTICE --}}
    <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5">

        <div class="flex gap-4">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-[#087443] shadow-sm">
                <i data-lucide="shield-check" class="h-5 w-5"></i>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900">
                    Perubahan Data
                </h3>

                <p class="mt-1 text-sm leading-6 text-gray-600">
                    Data profil dikelola oleh admin pesantren.
                    Jika terdapat data yang tidak sesuai, silakan hubungi admin untuk melakukan perubahan.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection