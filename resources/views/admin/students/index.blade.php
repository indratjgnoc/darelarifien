@extends('layouts.admin')

@section('title', 'Data santri')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

        <div>
            <p class="mb-2 text-xs font-black uppercase tracking-[0.18em] text-[#087443]">
                SIAKAD / Kesiswaan
            </p>

            <h1 class="text-3xl font-black tracking-tight text-gray-900">
                Data santri
            </h1>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500">
                Kelola data peserta didik, kelas, tahun akademik, dan akun santri.
            </p>
        </div>

        <a href="{{ route('admin.students.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#062E1F]">

            <i data-lucide="user-plus" class="h-4 w-4"></i>

            Tambah santri

        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4">

            <i data-lucide="circle-check"
               class="h-5 w-5 text-[#087443]">
            </i>

            <p class="text-sm font-semibold text-[#087443]">
                {{ session('success') }}
            </p>

        </div>

    @endif


    {{-- ERROR --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4">

            <div class="flex items-start gap-3">

                <i data-lucide="circle-alert"
                   class="mt-0.5 h-5 w-5 text-red-500">
                </i>

                <div>

                    <p class="text-sm font-bold text-red-700">
                        Terjadi kesalahan
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- FILTER --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

        <div class="mb-5 flex items-center gap-3">

            <div class="rounded-xl bg-[#F3F7F4] p-2.5 text-[#087443]">

                <i data-lucide="filter" class="h-4 w-4"></i>

            </div>

            <div>

                <h2 class="font-black text-[#062E1F]">
                    Filter Data
                </h2>

                <p class="text-xs text-gray-400">
                    Gunakan filter untuk menemukan santri dengan cepat.
                </p>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.students.index') }}">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                {{-- SEARCH --}}
                <div class="xl:col-span-2">

                    <label for="search"
                           class="mb-2 block text-sm font-bold text-gray-700">

                        Cari santri

                    </label>

                    <div class="relative">

                        <i data-lucide="search"
                           class="absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400">
                        </i>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Nama, NIS, atau NISN..."
                            class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 pl-11 pr-4 text-sm outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                        >

                    </div>

                </div>


                {{-- YEAR --}}
                <div>

                    <label for="academic_year_id"
                           class="mb-2 block text-sm font-bold text-gray-700">

                        Tahun Akademik

                    </label>

                    <select
                        id="academic_year_id"
                        name="academic_year_id"
                        class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                    >

                        <option value="">
                            Semua Tahun
                        </option>

                        @foreach($academicYears as $academicYear)

                            <option value="{{ $academicYear->id }}"
                                {{ request('academic_year_id') == $academicYear->id ? 'selected' : '' }}>

                                {{ $academicYear->name }}

                                @if($academicYear->semester)
                                    — {{ $academicYear->semester }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- CLASS --}}
                <div>

                    <label for="school_class_id"
                           class="mb-2 block text-sm font-bold text-gray-700">

                        Kelas

                    </label>

                    <select
                        id="school_class_id"
                        name="school_class_id"
                        class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                    >

                        <option value="">
                            Semua Kelas
                        </option>

                        @foreach($classes as $class)

                            <option value="{{ $class->id }}"
                                {{ request('school_class_id') == $class->id ? 'selected' : '' }}>

                                {{ $class->name }}

                                @if($class->academicYear)
                                    — {{ $class->academicYear->name }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:justify-end">

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#062E1F]">

                    <i data-lucide="search" class="h-4 w-4"></i>

                    Terapkan Filter

                </button>


                @if(request()->hasAny(['search', 'academic_year_id', 'school_class_id']))

                    <a href="{{ route('admin.students.index') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl bg-gray-100 px-5 py-3 text-sm font-bold text-gray-600 transition hover:bg-gray-200">

                        <i data-lucide="rotate-ccw" class="h-4 w-4"></i>

                        Reset

                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- SUMMARY --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-center gap-4">

                <div class="rounded-xl bg-[#F3F7F4] p-3 text-[#087443]">

                    <i data-lucide="users" class="h-5 w-5"></i>

                </div>

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Data Ditampilkan
                    </p>

                    <p class="mt-1 text-2xl font-black text-[#062E1F]">
                        {{ $students->total() }}
                    </p>

                </div>

            </div>

        </div>


        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">

            <div class="flex items-center gap-4">

                <div class="rounded-xl bg-emerald-50 p-3 text-emerald-600">

                    <i data-lucide="graduation-cap" class="h-5 w-5"></i>

                </div>

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Status Filter
                    </p>

                    <p class="mt-1 text-sm font-black text-gray-800">

                        @if(request('academic_year_id'))
                            Tahun Terpilih
                        @else
                            Semua Tahun
                        @endif

                    </p>

                </div>

            </div>

        </div>


        <div class="rounded-2xl bg-[#062E1F] p-5 text-white shadow-sm">

            <div class="flex items-center gap-4">

                <div class="rounded-xl bg-white/10 p-3">

                    <i data-lucide="school" class="h-5 w-5"></i>

                </div>

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-white/40">
                        Kelas
                    </p>

                    <p class="mt-1 text-sm font-black">

                        @if(request('school_class_id'))
                            Kelas Terpilih
                        @else
                            Semua Kelas
                        @endif

                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- STUDENT LIST --}}
    <div class="space-y-4">

        @forelse($students as $student)

            <div class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 transition hover:shadow-lg">

                <div class="flex flex-col gap-5 lg:flex-row lg:items-center">

                    {{-- AVATAR --}}
                    <div class="flex shrink-0 items-center gap-4">

                        @if($student->photo)

                            <img
                                src="{{ asset('storage/' . $student->photo) }}"
                                alt="{{ $student->name }}"
                                class="h-16 w-16 rounded-2xl object-cover ring-1 ring-gray-100"
                            >

                        @else

                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#062E1F] text-lg font-black text-white">

                                {{ strtoupper(substr($student->name, 0, 1)) }}

                            </div>

                        @endif

                    </div>


                    {{-- IDENTITY --}}
                    <div class="min-w-0 flex-1">

                        <div class="flex flex-wrap items-center gap-2">

                            <span class="rounded-full bg-[#062E1F] px-3 py-1 text-xs font-bold text-white">

                                NIS {{ $student->nis }}

                            </span>


                            @if($student->nisn)

                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-500">

                                    NISN {{ $student->nisn }}

                                </span>

                            @endif


                            @if($student->is_active)

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-bold text-[#087443]">

                                    <span class="h-1.5 w-1.5 rounded-full bg-[#087443]"></span>

                                    Aktif

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-500">

                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                    Nonaktif

                                </span>

                            @endif

                        </div>


                        <h2 class="mt-3 text-xl font-black text-gray-900 group-hover:text-[#087443]">

                            {{ $student->name }}

                        </h2>


                        <div class="mt-3 flex flex-wrap gap-x-5 gap-y-2 text-sm text-gray-500">

                            <span class="inline-flex items-center gap-2">

                                <i data-lucide="school"
                                   class="h-4 w-4 text-[#087443]">
                                </i>

                                {{ $student->schoolClass?->name ?? 'Belum ditempatkan' }}

                            </span>


                            <span class="inline-flex items-center gap-2">

                                <i data-lucide="calendar-days"
                                   class="h-4 w-4 text-[#087443]">
                                </i>

                                {{ $student->academicYear?->name ?? 'Belum ada tahun akademik' }}

                            </span>


                            @if($student->gender)

                                <span class="inline-flex items-center gap-2">

                                    <i data-lucide="user"
                                       class="h-4 w-4 text-[#087443]">
                                    </i>

                                    {{ $student->gender }}

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- ACCOUNT --}}
                    <div class="shrink-0">

                        @if($student->user)

                            <div class="rounded-xl border border-green-100 bg-green-50 px-4 py-3">

                                <div class="flex items-center gap-2">

                                    <i data-lucide="circle-check"
                                       class="h-4 w-4 text-[#087443]">
                                    </i>

                                    <span class="text-xs font-bold text-[#087443]">
                                        Akun tersedia
                                    </span>

                                </div>

                                <p class="mt-1 max-w-[220px] truncate text-xs text-gray-500">
                                    {{ $student->user->email }}
                                </p>

                            </div>

                        @else

                            <div class="rounded-xl border border-amber-100 bg-amber-50 px-4 py-3">

                                <div class="flex items-center gap-2">

                                    <i data-lucide="circle-alert"
                                       class="h-4 w-4 text-amber-600">
                                    </i>

                                    <span class="text-xs font-bold text-amber-700">
                                        Belum punya akun
                                    </span>

                                </div>

                            </div>

                        @endif

                    </div>


                    {{-- ACTION --}}
                    <div class="flex shrink-0 items-center gap-2 border-t border-gray-100 pt-4 lg:border-0 lg:pt-0">

                        <a href="{{ route('admin.students.show', $student) }}"
                           class="inline-flex items-center justify-center rounded-xl bg-[#F3F7F4] p-2.5 text-[#087443] transition hover:bg-[#087443] hover:text-white"
                           title="Lihat detail">

                            <i data-lucide="eye" class="h-4 w-4"></i>

                        </a>


                        <a href="{{ route('admin.students.edit', $student) }}"
                           class="inline-flex items-center justify-center rounded-xl bg-gray-100 p-2.5 text-gray-600 transition hover:bg-[#087443] hover:text-white"
                           title="Edit">

                            <i data-lucide="pencil" class="h-4 w-4"></i>

                        </a>


                        @if(!$student->user)

                            <form action="{{ route('admin.students.create-account', $student) }}"
                                  method="POST"
                                  onsubmit="return confirm('Buat akun santri untuk {{ addslashes($student->name) }}?');">

                                @csrf

                                <button type="submit"
                                        class="inline-flex items-center justify-center rounded-xl bg-amber-50 p-2.5 text-amber-600 transition hover:bg-amber-500 hover:text-white"
                                        title="Buat akun">

                                    <i data-lucide="key-round" class="h-4 w-4"></i>

                                </button>

                            </form>

                        @endif


                        <form action="{{ route('admin.students.destroy', $student) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data santri ini?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-red-50 p-2.5 text-red-500 transition hover:bg-red-500 hover:text-white"
                                    title="Hapus">

                                <i data-lucide="trash-2" class="h-4 w-4"></i>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm ring-1 ring-gray-100">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#F3F7F4] text-[#087443]">

                    <i data-lucide="users-round"
                       class="h-7 w-7">
                    </i>

                </div>

                <h3 class="mt-5 text-lg font-black text-gray-900">
                    Belum Ada Data santri
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-400">
                    Tambahkan data santri terlebih dahulu agar dapat ditempatkan ke kelas dan dibuatkan akun.
                </p>

                <a href="{{ route('admin.students.create') }}"
                   class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#062E1F]">

                    <i data-lucide="user-plus" class="h-4 w-4"></i>

                    Tambah santri

                </a>

            </div>

        @endforelse

    </div>


    {{-- PAGINATION --}}
    @if($students->hasPages())

        <div>
            {{ $students->links() }}
        </div>

    @endif

</div>


@push('scripts')
<script>
    if (window.lucide) {
        lucide.createIcons();
    }
</script>
@endpush

@endsection