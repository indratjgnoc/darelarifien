@extends('layouts.admin')

@section('title', 'Detail santri')

@section('content')

    <div class="max-w-6xl">

        {{-- HEADER --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <p class="text-xs font-bold uppercase tracking-wider text-[#087443]">
                    SIAKAD / Kesiswaan
                </p>

                <h1 class="mt-1 text-2xl font-black text-gray-900">
                    Detail santri
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Informasi lengkap data akademik dan keluarga santri.
                </p>

            </div>


            <div class="flex flex-wrap gap-2">

                <a href="{{ route('admin.students.index') }}"
                    class="inline-flex items-center gap-2
                       rounded-xl bg-gray-100 px-4 py-2.5
                       text-sm font-bold text-gray-600
                       transition hover:bg-gray-200">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    Kembali
                </a>

                <a href="{{ route('admin.students.edit', $student) }}"
                    class="inline-flex items-center gap-2
                       rounded-xl bg-[#087443] px-4 py-2.5
                       text-sm font-bold text-white
                       transition hover:bg-[#062E1F]">
                    <i data-lucide="pencil" class="h-4 w-4"></i>
                    Edit
                </a>

            </div>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))
            <div
                class="mb-6 flex items-center gap-3 rounded-2xl
                   border border-green-200 bg-green-50
                   px-5 py-4 text-sm font-semibold text-green-700">

                <i data-lucide="check-circle" class="h-5 w-5"></i>

                {{ session('success') }}

            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- PROFILE CARD --}}
        {{-- ========================================================= --}}

        <div class="mb-6 overflow-hidden rounded-3xl
               bg-[#062E1F] text-white shadow-sm">

            <div class="p-6 sm:p-8">

                <div class="flex flex-col gap-6 sm:flex-row sm:items-center">

                    {{-- AVATAR --}}
                    <div
                        class="flex h-24 w-24 shrink-0 items-center
                           justify-center rounded-3xl
                           bg-[#F4C542] text-3xl font-black
                           text-[#062E1F]">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </div>


                    {{-- INFO --}}
                    <div class="flex-1">

                        <div class="flex flex-wrap items-center gap-3">

                            <h2 class="text-2xl font-black">
                                {{ $student->name }}
                            </h2>

                            @if ($student->is_active)
                                <span
                                    class="rounded-full bg-emerald-400/15
                                       px-3 py-1 text-xs font-bold
                                       text-emerald-300">
                                    Aktif
                                </span>
                            @else
                                <span
                                    class="rounded-full bg-red-400/15
                                       px-3 py-1 text-xs font-bold
                                       text-red-300">
                                    Tidak Aktif
                                </span>
                            @endif

                        </div>


                        <div
                            class="mt-3 flex flex-wrap gap-x-6 gap-y-2
                               text-sm text-white/65">

                            <span class="inline-flex items-center gap-2">

                                <i data-lucide="badge" class="h-4 w-4"></i>

                                NIS:
                                <strong class="text-white">
                                    {{ $student->nis }}
                                </strong>

                            </span>


                            @if ($student->nisn)
                                <span class="inline-flex items-center gap-2">

                                    <i data-lucide="hash" class="h-4 w-4"></i>

                                    NISN:
                                    <strong class="text-white">
                                        {{ $student->nisn }}
                                    </strong>

                                </span>
                            @endif


                            @if ($student->schoolClass)
                                <span class="inline-flex items-center gap-2">

                                    <i data-lucide="graduation-cap" class="h-4 w-4"></i>

                                    {{ $student->schoolClass->name }}

                                </span>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- AKADEMIK + AKUN --}}
        {{-- ========================================================= --}}

        <div class="mb-6 grid gap-6 lg:grid-cols-2">


            {{-- AKADEMIK --}}
            <div class="rounded-3xl bg-white p-6
                   shadow-sm ring-1 ring-gray-100">

                <div class="mb-6 flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-[#087443]/10 text-[#087443]">
                        <i data-lucide="graduation-cap" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <h2 class="font-black text-gray-900">
                            Informasi Akademik
                        </h2>

                        <p class="text-xs text-gray-400">
                            Data akademik santri
                        </p>

                    </div>

                </div>


                <div class="space-y-4">

                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            NIS
                        </span>

                        <span class="text-sm font-bold text-gray-900">
                            {{ $student->nis }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            NISN
                        </span>

                        <span class="text-sm font-bold text-gray-900">
                            {{ $student->nisn ?: '-' }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            Tahun Ajaran
                        </span>

                        <span class="text-right text-sm font-bold text-gray-900">

                            {{ $student->academicYear?->name ?? '-' }}

                            @if ($student->academicYear?->semester)
                                <span class="block text-xs font-medium text-gray-400">
                                    Semester {{ $student->academicYear->semester }}
                                </span>
                            @endif

                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            Kelas
                        </span>

                        <span class="text-sm font-bold text-gray-900">
                            {{ $student->schoolClass?->name ?? '-' }}
                        </span>

                    </div>


                    @if ($student->schoolClass?->homeroomTeacher)
                        <div class="flex items-center justify-between gap-4">

                            <span class="text-sm text-gray-400">
                                Wali Kelas
                            </span>

                            <span class="text-right text-sm font-bold text-gray-900">
                                {{ $student->schoolClass->homeroomTeacher->name }}
                            </span>

                        </div>
                    @endif

                </div>

            </div>


            {{-- AKUN --}}
            <div class="rounded-3xl bg-white p-6
                   shadow-sm ring-1 ring-gray-100">

                <div class="mb-6 flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-[#087443]/10 text-[#087443]">
                        <i data-lucide="key-round" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <h2 class="font-black text-gray-900">
                            Akun santri
                        </h2>

                        <p class="text-xs text-gray-400">
                            Akses santri ke sistem
                        </p>

                    </div>

                </div>


                @if ($student->user)
                    <div class="rounded-2xl bg-green-50 p-4">

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-10 w-10 shrink-0
                                   items-center justify-center
                                   rounded-xl bg-green-100
                                   text-green-700">
                                <i data-lucide="circle-check" class="h-5 w-5"></i>
                            </div>

                            <div>

                                <p class="font-black text-green-800">
                                    Akun sudah tersedia
                                </p>

                                <p class="mt-1 text-sm text-green-700">
                                    {{ $student->user->email }}
                                </p>

                                <p class="mt-1 text-xs text-green-600">
                                    Role: {{ ucfirst($student->user->role) }}
                                </p>

                            </div>

                        </div>

                    </div>
                @else
                    <div class="rounded-2xl bg-amber-50 p-4">

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-10 w-10 shrink-0
                                   items-center justify-center
                                   rounded-xl bg-amber-100
                                   text-amber-700">
                                <i data-lucide="circle-alert" class="h-5 w-5"></i>
                            </div>

                            <div class="flex-1">

                                <p class="font-black text-amber-800">
                                    Akun belum dibuat
                                </p>

                                <p class="mt-1 text-sm text-amber-700">
                                    santri belum dapat login ke sistem.
                                </p>

                            </div>

                        </div>


                        <form action="{{ route('admin.students.create-account', $student) }}" method="POST" class="mt-4"
                            onsubmit="return confirm('Buat akun login untuk santri ini?')">

                            @csrf

                            <button type="submit"
                                class="inline-flex items-center gap-2
                                   rounded-xl bg-[#087443]
                                   px-4 py-2.5 text-sm font-bold
                                   text-white transition
                                   hover:bg-[#062E1F]">

                                <i data-lucide="user-plus" class="h-4 w-4"></i>

                                Buat Akun santri

                            </button>

                        </form>

                    </div>
                @endif

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- IDENTITAS --}}
        {{-- ========================================================= --}}

        <div class="mb-6 grid gap-6 lg:grid-cols-2">


            {{-- DATA PRIBADI --}}
            <div class="rounded-3xl bg-white p-6
                   shadow-sm ring-1 ring-gray-100">

                <div class="mb-6 flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-[#087443]/10 text-[#087443]">
                        <i data-lucide="user-round" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <h2 class="font-black text-gray-900">
                            Data Pribadi
                        </h2>

                        <p class="text-xs text-gray-400">
                            Informasi identitas santri
                        </p>

                    </div>

                </div>


                <div class="space-y-4">

                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            Jenis Kelamin
                        </span>

                        <span class="text-sm font-bold text-gray-900">
                            @if ($student->gender === 'L')
                                Laki-laki
                            @elseif ($student->gender === 'P')
                                Perempuan
                            @else
                                -
                            @endif
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            Tempat Lahir
                        </span>

                        <span class="text-right text-sm font-bold text-gray-900">
                            {{ $student->birth_place ?: '-' }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            Tanggal Lahir
                        </span>

                        <span class="text-sm font-bold text-gray-900">

                            @if ($student->birth_date)
                                {{ $student->birth_date->format('d F Y') }}
                            @else
                                -
                            @endif

                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            Nomor Telepon
                        </span>

                        <span class="text-sm font-bold text-gray-900">
                            {{ $student->phone ?: '-' }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- KELUARGA --}}
            <div class="rounded-3xl bg-white p-6
                   shadow-sm ring-1 ring-gray-100">

                <div class="mb-6 flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center
                           rounded-xl bg-[#087443]/10 text-[#087443]">
                        <i data-lucide="users" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <h2 class="font-black text-gray-900">
                            Data Keluarga
                        </h2>

                        <p class="text-xs text-gray-400">
                            Informasi orang tua / wali
                        </p>

                    </div>

                </div>


                <div class="space-y-4">

                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            Ayah
                        </span>

                        <span class="text-right text-sm font-bold text-gray-900">
                            {{ $student->father_name ?: '-' }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            Ibu
                        </span>

                        <span class="text-right text-sm font-bold text-gray-900">
                            {{ $student->mother_name ?: '-' }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            Wali
                        </span>

                        <span class="text-right text-sm font-bold text-gray-900">
                            {{ $student->guardian_name ?: '-' }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-gray-400">
                            Telepon Orang Tua
                        </span>

                        <span class="text-sm font-bold text-gray-900">
                            {{ $student->parent_phone ?: '-' }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- ALAMAT --}}
        {{-- ========================================================= --}}

        <div class="mb-6 rounded-3xl bg-white p-6
               shadow-sm ring-1 ring-gray-100">

            <div class="mb-5 flex items-center gap-3">

                <div
                    class="flex h-11 w-11 items-center justify-center
                       rounded-xl bg-[#087443]/10 text-[#087443]">
                    <i data-lucide="map-pin" class="h-5 w-5"></i>
                </div>

                <div>

                    <h2 class="font-black text-gray-900">
                        Alamat
                    </h2>

                    <p class="text-xs text-gray-400">
                        Alamat tempat tinggal santri
                    </p>

                </div>

            </div>


            <div class="rounded-2xl bg-gray-50 p-5
                   text-sm leading-7 text-gray-600">
                {{ $student->address ?: 'Alamat belum diisi.' }}
            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- DELETE --}}
        {{-- ========================================================= --}}

        <div
            class="flex flex-col gap-4 rounded-3xl
               border border-red-100 bg-red-50 p-5
               sm:flex-row sm:items-center sm:justify-between">

            <div>

                <p class="font-black text-red-800">
                    Hapus Data santri
                </p>

                <p class="mt-1 text-sm text-red-600">
                    Tindakan ini akan menghapus data santri
                    dari sistem.
                </p>

            </div>


            <form action="{{ route('admin.students.destroy', $student) }}" method="POST"
                onsubmit="return confirm(
                'Yakin ingin menghapus santri {{ addslashes($student->name) }}?'
            )">

                @csrf
                @method('DELETE')

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-red-600 px-5 py-3
                       text-sm font-bold text-white
                       transition hover:bg-red-700">
                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                    Hapus santri
                </button>

            </form>

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            if (window.lucide) {
                lucide.createIcons();
            }

        });
    </script>
@endpush
