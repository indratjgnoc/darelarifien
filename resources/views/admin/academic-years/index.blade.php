@extends('layouts.admin')

@section('title', 'Tahun Ajaran')

@section('content')

<div class="space-y-8">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="flex items-center gap-2 text-sm font-semibold text-[#087443]">
                <i data-lucide="calendar-days" class="h-4 w-4"></i>
                Akademik
            </div>

            <h1 class="mt-2 text-2xl font-black tracking-tight text-gray-900">
                Tahun Ajaran
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola tahun ajaran, semester, periode, dan portal akademik pesantren.
            </p>
        </div>

        <a
            href="{{ route('admin.academic-years.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-black text-white shadow-lg shadow-[#087443]/20 transition hover:bg-[#062E1F]"
        >
            <i data-lucide="plus" class="h-4 w-4"></i>
            Tambah Tahun Ajaran
        </a>

    </div>


    {{-- =========================================================
        SUCCESS
    ========================================================== --}}
    @if (session('success'))

        <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">

            <i data-lucide="check-circle" class="mt-0.5 h-5 w-5 shrink-0"></i>

            <div>
                <p class="font-bold">
                    Berhasil
                </p>

                <p class="mt-0.5">
                    {{ session('success') }}
                </p>
            </div>

        </div>

    @endif


    {{-- =========================================================
        ERROR
    ========================================================== --}}
    @if ($errors->any())

        <div class="flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">

            <i data-lucide="alert-circle" class="mt-0.5 h-5 w-5 shrink-0"></i>

            <div>

                <p class="font-bold">
                    Terdapat kesalahan
                </p>

                <ul class="mt-1 list-disc space-y-1 pl-5">

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
        STATISTIK
    ========================================================== --}}

    @php
        $activeYear = $academicYears->firstWhere('is_active', true);
    @endphp

    <div class="grid gap-4 sm:grid-cols-2">

        {{-- TOTAL --}}
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Total Tahun Ajaran
                    </p>

                    <p class="mt-2 text-3xl font-black text-gray-900">
                        {{ $academicYears->count() }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100">

                    <i
                        data-lucide="calendar-range"
                        class="h-5 w-5 text-gray-600"
                    ></i>

                </div>

            </div>

        </div>


        {{-- TAHUN AKTIF --}}
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Tahun Aktif
                    </p>

                    @if ($activeYear)

                        <p class="mt-2 text-xl font-black text-[#087443]">
                            {{ $activeYear->name }}
                        </p>

                        <p class="mt-1 text-xs font-semibold text-gray-500">
                            Semester {{ ucfirst($activeYear->semester) }}
                        </p>

                    @else

                        <p class="mt-2 text-xl font-black text-gray-500">
                            Belum Ada
                        </p>

                    @endif

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50">

                    <i
                        data-lucide="circle-check"
                        class="h-5 w-5 text-[#087443]"
                    ></i>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        TABLE CONTAINER
    ========================================================== --}}

    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-100">

        {{-- TABLE HEADER --}}
        <div class="border-b border-gray-100 px-6 py-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#087443]/10">

                    <i
                        data-lucide="history"
                        class="h-5 w-5 text-[#087443]"
                    ></i>

                </div>

                <div>

                    <h2 class="font-black text-gray-900">
                        Daftar Tahun Ajaran
                    </h2>

                    <p class="text-xs text-gray-500">
                        Kelola periode akademik dan akses pemilihan mata pelajaran.
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            JIKA ADA DATA
        ====================================================== --}}

        @if ($academicYears->count())

            {{-- =================================================
                DESKTOP TABLE
            ================================================== --}}

            <div class="hidden overflow-x-auto md:block">

                <table class="w-full min-w-[1000px] text-left">

                    <thead class="bg-gray-50">

                        <tr class="text-xs font-black uppercase tracking-wider text-gray-500">

                            <th class="px-6 py-4">
                                Tahun Ajaran
                            </th>

                            <th class="px-6 py-4">
                                Semester
                            </th>

                            <th class="px-6 py-4">
                                Periode
                            </th>

                            <th class="px-6 py-4">
                                Status
                            </th>

                            <th class="px-6 py-4">
                                Pemilihan Mapel
                            </th>

                            <th class="px-6 py-4 text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach ($academicYears as $academicYear)

                            <tr class="transition hover:bg-gray-50/70">

                                {{-- =============================
                                    TAHUN AJARAN
                                ============================== --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#087443]/10">

                                            <i
                                                data-lucide="calendar"
                                                class="h-5 w-5 text-[#087443]"
                                            ></i>

                                        </div>

                                        <div class="min-w-0">

                                            <p class="font-black text-gray-900">
                                                {{ $academicYear->name }}
                                            </p>

                                            @if ($academicYear->description)

                                                <p class="mt-0.5 max-w-xs truncate text-xs text-gray-500">
                                                    {{ $academicYear->description }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- =============================
                                    SEMESTER
                                ============================== --}}
                                <td class="px-6 py-5">

                                    @if (strtolower($academicYear->semester) === 'ganjil')

                                        <span class="inline-flex rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700">
                                            Ganjil
                                        </span>

                                    @else

                                        <span class="inline-flex rounded-lg bg-purple-50 px-3 py-1.5 text-xs font-bold text-purple-700">
                                            Genap
                                        </span>

                                    @endif

                                </td>


                                {{-- =============================
                                    PERIODE
                                ============================== --}}
                                <td class="px-6 py-5">

                                    @if ($academicYear->start_date || $academicYear->end_date)

                                        <div class="text-sm">

                                            <div class="flex items-center gap-2 font-semibold text-gray-700">

                                                <i
                                                    data-lucide="calendar"
                                                    class="h-4 w-4 text-gray-400"
                                                ></i>

                                                <span>
                                                    {{ $academicYear->start_date?->format('d M Y') ?? '-' }}
                                                </span>

                                            </div>

                                            <p class="mt-1 pl-6 text-xs text-gray-400">

                                                s/d
                                                {{ $academicYear->end_date?->format('d M Y') ?? '-' }}

                                            </p>

                                        </div>

                                    @else

                                        <span class="text-sm text-gray-400">
                                            Belum diatur
                                        </span>

                                    @endif

                                </td>


                                {{-- =============================
                                    STATUS
                                ============================== --}}
                                <td class="px-6 py-5">

                                    @if ($academicYear->is_active)

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-black text-emerald-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                            Aktif

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-500">

                                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                            Tidak Aktif

                                        </span>

                                    @endif

                                </td>


                                {{-- =============================
                                    PEMILIHAN MAPEL
                                ============================== --}}
                                <td class="px-6 py-5">

                                    <form
                                        action="{{ route('admin.academic-years.toggle-course-selection', $academicYear) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-xs font-bold transition hover:opacity-80
                                            {{ $academicYear->course_selection_open
                                                ? 'bg-emerald-50 text-emerald-700'
                                                : 'bg-gray-100 text-gray-500'
                                            }}"
                                        >

                                            <span
                                                class="h-2 w-2 rounded-full
                                                {{ $academicYear->course_selection_open
                                                    ? 'bg-emerald-500'
                                                    : 'bg-gray-300'
                                                }}"
                                            ></span>

                                            {{ $academicYear->course_selection_open
                                                ? 'Dibuka'
                                                : 'Ditutup'
                                            }}

                                        </button>

                                    </form>

                                </td>


                                {{-- =============================
                                    AKSI
                                ============================== --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.academic-years.edit', $academicYear) }}"
                                            title="Edit"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 text-gray-600 transition hover:bg-[#087443]/10 hover:text-[#087443]"
                                        >

                                            <i
                                                data-lucide="pencil"
                                                class="h-4 w-4"
                                            ></i>

                                        </a>


                                        {{-- AKTIFKAN --}}
                                        @if (!$academicYear->is_active)

                                            <form
                                                action="{{ route('admin.academic-years.activate', $academicYear) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    title="Aktifkan"
                                                    onclick="return confirm('Aktifkan tahun ajaran {{ $academicYear->name }}? Tahun ajaran aktif sebelumnya akan dinonaktifkan.')"
                                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 transition hover:bg-emerald-100"
                                                >

                                                    <i
                                                        data-lucide="power"
                                                        class="h-4 w-4"
                                                    ></i>

                                                </button>

                                            </form>

                                        @endif


                                        {{-- HAPUS --}}
                                        @if (!$academicYear->is_active)

                                            <form
                                                action="{{ route('admin.academic-years.destroy', $academicYear) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus tahun ajaran {{ $academicYear->name }}?')"
                                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-500 transition hover:bg-red-100"
                                                >

                                                    <i
                                                        data-lucide="trash-2"
                                                        class="h-4 w-4"
                                                    ></i>

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                MOBILE
            ================================================== --}}

            <div class="space-y-4 p-4 md:hidden">

                @foreach ($academicYears as $academicYear)

                    <div class="rounded-2xl border border-gray-100 p-4">

                        {{-- HEADER CARD --}}
                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">

                                <p class="text-lg font-black text-gray-900">
                                    {{ $academicYear->name }}
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Semester {{ ucfirst($academicYear->semester) }}
                                </p>

                            </div>


                            @if ($academicYear->is_active)

                                <span class="shrink-0 rounded-full bg-emerald-50 px-3 py-1 text-xs font-black text-emerald-700">
                                    Aktif
                                </span>

                            @else

                                <span class="shrink-0 rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-500">
                                    Tidak Aktif
                                </span>

                            @endif

                        </div>


                        {{-- DESCRIPTION --}}
                        @if ($academicYear->description)

                            <p class="mt-3 text-xs leading-relaxed text-gray-500">
                                {{ $academicYear->description }}
                            </p>

                        @endif


                        {{-- PERIODE --}}
                        <div class="mt-4 grid grid-cols-2 gap-3 text-xs">

                            <div class="rounded-xl bg-gray-50 p-3">

                                <p class="text-gray-400">
                                    Mulai
                                </p>

                                <p class="mt-1 font-bold text-gray-700">
                                    {{ $academicYear->start_date?->format('d M Y') ?? '-' }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-gray-50 p-3">

                                <p class="text-gray-400">
                                    Selesai
                                </p>

                                <p class="mt-1 font-bold text-gray-700">
                                    {{ $academicYear->end_date?->format('d M Y') ?? '-' }}
                                </p>

                            </div>

                        </div>


                        {{-- PEMILIHAN MAPEL --}}
                        <div class="mt-4 rounded-xl bg-gray-50 p-3">

                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap-2">

                                    <i
                                        data-lucide="book-open"
                                        class="h-4 w-4 text-gray-400"
                                    ></i>

                                    <span class="text-xs font-semibold text-gray-500">
                                        Pemilihan Mapel
                                    </span>

                                </div>

                                @if ($academicYear->course_selection_open)

                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600">

                                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                        Dibuka

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-400">

                                        <span class="h-2 w-2 rounded-full bg-gray-300"></span>

                                        Ditutup

                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- AKSI --}}
                        <div class="mt-4 flex items-center gap-2">

                            {{-- EDIT --}}
                            <a
                                href="{{ route('admin.academic-years.edit', $academicYear) }}"
                                class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-gray-100 px-4 py-2.5 text-xs font-bold text-gray-700 transition hover:bg-gray-200"
                            >

                                <i
                                    data-lucide="pencil"
                                    class="h-4 w-4"
                                ></i>

                                Edit

                            </a>


                            {{-- AKTIFKAN --}}
                            @if (!$academicYear->is_active)

                                <form
                                    action="{{ route('admin.academic-years.activate', $academicYear) }}"
                                    method="POST"
                                    class="flex-1"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Aktifkan tahun ajaran {{ $academicYear->name }}? Tahun ajaran aktif sebelumnya akan dinonaktifkan.')"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-50 px-4 py-2.5 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100"
                                    >

                                        <i
                                            data-lucide="power"
                                            class="h-4 w-4"
                                        ></i>

                                        Aktifkan

                                    </button>

                                </form>


                                {{-- HAPUS --}}
                                <form
                                    action="{{ route('admin.academic-years.destroy', $academicYear) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menghapus tahun ajaran {{ $academicYear->name }}?')"
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-100"
                                    >

                                        <i
                                            data-lucide="trash-2"
                                            class="h-4 w-4"
                                        ></i>

                                    </button>

                                </form>

                            @endif

                        </div>


                        {{-- TOGGLE MAPEL --}}
                        <div class="mt-3">

                            <form
                                action="{{ route('admin.academic-years.toggle-course-selection', $academicYear) }}"
                                method="POST"
                            >

                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl px-3 py-2.5 text-xs font-bold transition
                                    {{ $academicYear->course_selection_open
                                        ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100'
                                        : 'bg-gray-100 text-gray-500 hover:bg-gray-200'
                                    }}"
                                >

                                    <i
                                        data-lucide="{{ $academicYear->course_selection_open ? 'unlock' : 'lock' }}"
                                        class="h-4 w-4"
                                    ></i>

                                    {{ $academicYear->course_selection_open
                                        ? 'Tutup Pemilihan Mapel'
                                        : 'Buka Pemilihan Mapel'
                                    }}

                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- =================================================
                EMPTY STATE
            ================================================== --}}

            <div class="px-6 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100">

                    <i
                        data-lucide="calendar-x"
                        class="h-7 w-7 text-gray-400"
                    ></i>

                </div>

                <h3 class="mt-5 text-lg font-black text-gray-900">
                    Belum ada tahun ajaran
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                    Tambahkan tahun ajaran pertama untuk mulai mengatur sistem akademik pesantren.
                </p>

                <a
                    href="{{ route('admin.academic-years.create') }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-black text-white shadow-lg shadow-[#087443]/20 transition hover:bg-[#062E1F]"
                >

                    <i
                        data-lucide="plus"
                        class="h-4 w-4"
                    ></i>

                    Tambah Tahun Ajaran

                </a>

            </div>

        @endif

    </div>

</div>

@endsection


{{-- =============================================================
    LUCIDE ICON
============================================================= --}}

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>

@endpush
