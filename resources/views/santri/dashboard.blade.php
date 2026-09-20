@extends('layouts.santri')

@section('title', 'Dashboard Santri')

@section('page-title', 'Dashboard')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <p class="text-sm font-medium text-[#087443]">
            Selamat datang kembali
        </p>

        <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
            Assalamu'alaikum, {{ $student?->name ?? $user->name }}
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Pantau informasi akademik kamu melalui halaman ini.
        </p>
    </div>


    {{-- PROFILE CARD --}}
    <div class="overflow-hidden rounded-3xl bg-[#062E1F] shadow-xl">

        <div class="relative p-6 sm:p-8">

            {{-- decorative --}}
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-[#087443]/30"></div>
            <div class="absolute -bottom-20 right-24 h-40 w-40 rounded-full bg-emerald-400/10"></div>

            <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-4">

                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/10 text-xl font-bold text-white ring-1 ring-white/10">
                        {{ strtoupper(substr($student?->name ?? $user->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wider text-emerald-300">
                            Santri
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-white sm:text-2xl">
                            {{ $student?->name ?? $user->name }}
                        </h2>

                        <p class="mt-1 text-sm text-white/60">
                            {{ $user->email }}
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-3">

                    <div class="rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/10">
                        <p class="text-[11px] uppercase tracking-wider text-white/50">
                            NIS
                        </p>

                        <p class="mt-1 font-semibold text-white">
                            {{ $student?->nis ?? '-' }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- INFORMATION --}}
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

        {{-- KELAS --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Kelas
                    </p>

                    <p class="mt-2 text-xl font-bold text-gray-900">
                        {{ $student?->schoolClass?->name ?? '-' }}
                    </p>

                    @if ($student?->schoolClass?->homeroomTeacher)
                        <p class="mt-1 text-xs text-gray-500">
                            Wali Kelas:
                            {{ $student->schoolClass->homeroomTeacher->name }}
                        </p>
                    @endif
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-[#087443]">
                    <i data-lucide="graduation-cap" class="h-5 w-5"></i>
                </div>

            </div>

        </div>


        {{-- TAHUN AKADEMIK --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Tahun Akademik
                    </p>

                    <p class="mt-2 text-xl font-bold text-gray-900">
                        {{ $student?->academicYear?->name ?? '-' }}
                    </p>

                    @if ($student?->academicYear?->semester)
                        <p class="mt-1 text-xs text-gray-500">
                            Semester {{ $student->academicYear->semester }}
                        </p>
                    @endif
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-[#087443]">
                    <i data-lucide="calendar-days" class="h-5 w-5"></i>
                </div>

            </div>

        </div>


        {{-- STATUS --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Status Akademik
                    </p>

                    <p class="mt-2 text-xl font-bold text-gray-900">
                        {{ $student?->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </p>

                    <p class="mt-1 text-xs text-gray-500">
                        Status akun dan data santri
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl
                    {{ $student?->is_active
                        ? 'bg-emerald-50 text-[#087443]'
                        : 'bg-red-50 text-red-600' }}">

                    <i
                        data-lucide="{{ $student?->is_active ? 'badge-check' : 'circle-alert' }}"
                        class="h-5 w-5"
                    ></i>

                </div>

            </div>

        </div>

    </div>


    {{-- QUICK MENU --}}
    <div>

        <div class="mb-4">
            <h2 class="text-lg font-bold text-gray-900">
                Akses Cepat
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Akses informasi akademik kamu dengan cepat.
            </p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- JADWAL --}}
            <a
                href="#"
                class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-0.5 hover:shadow-md"
            >
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-[#087443] transition group-hover:bg-[#087443] group-hover:text-white">
                    <i data-lucide="calendar-clock" class="h-5 w-5"></i>
                </div>

                <h3 class="mt-4 font-semibold text-gray-900">
                    Jadwal
                </h3>

                <p class="mt-1 text-xs leading-5 text-gray-500">
                    Lihat jadwal pelajaran kamu.
                </p>
            </a>


            {{-- MATA PELAJARAN --}}
            <a
                href="{{ route('santri.subjects.index') }}"
                class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-0.5 hover:shadow-md"
            >
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-[#087443] transition group-hover:bg-[#087443] group-hover:text-white">
                    <i data-lucide="book-open" class="h-5 w-5"></i>
                </div>

                <h3 class="mt-4 font-semibold text-gray-900">
                    Mata Pelajaran
                </h3>

                <p class="mt-1 text-xs leading-5 text-gray-500">
                    Lihat mata pelajaran yang kamu ikuti.
                </p>
            </a>


            {{-- NILAI --}}
            <a
                href="#"
                class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-0.5 hover:shadow-md"
            >
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-[#087443] transition group-hover:bg-[#087443] group-hover:text-white">
                    <i data-lucide="chart-no-axes-column" class="h-5 w-5"></i>
                </div>

                <h3 class="mt-4 font-semibold text-gray-900">
                    Nilai
                </h3>

                <p class="mt-1 text-xs leading-5 text-gray-500">
                    Pantau nilai akademik kamu.
                </p>
            </a>


            {{-- RAPOR --}}
            <a
                href="#"
                class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-0.5 hover:shadow-md"
            >
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-[#087443] transition group-hover:bg-[#087443] group-hover:text-white">
                    <i data-lucide="file-text" class="h-5 w-5"></i>
                </div>

                <h3 class="mt-4 font-semibold text-gray-900">
                    Rapor
                </h3>

                <p class="mt-1 text-xs leading-5 text-gray-500">
                    Lihat dan cetak rapor akademik.
                </p>
            </a>

        </div>

    </div>


    {{-- INFORMATION NOTICE --}}
    <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5">

        <div class="flex gap-4">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-[#087443] shadow-sm">
                <i data-lucide="info" class="h-5 w-5"></i>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900">
                    Informasi Akademik
                </h3>

                <p class="mt-1 text-sm leading-6 text-gray-600">
                    Pastikan data diri dan kelas kamu sudah sesuai.
                    Jika terdapat kesalahan data, silakan hubungi admin pesantren.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection