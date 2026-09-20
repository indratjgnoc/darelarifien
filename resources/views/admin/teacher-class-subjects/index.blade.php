@extends('layouts.admin')

@section('title', 'Penugasan Guru')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 text-xs font-bold uppercase tracking-[0.18em] text-[#087443]">
                SIAKAD / Akademik
            </div>

            <h1 class="text-3xl font-black tracking-tight text-[#062E1F]">
                Penugasan Guru
            </h1>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500">
                Atur guru yang mengajar mata pelajaran pada setiap kelas dan tahun akademik.
            </p>
        </div>

        <a href="{{ route('admin.teacher-class-subjects.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#062E1F]">
            <i data-lucide="plus" class="h-4 w-4"></i>
            Tambah Penugasan
        </a>
    </div>


    {{-- Flash Success --}}
    @if(session('success'))
        <div class="flex items-start gap-3 rounded-2xl border border-emerald-100 bg-emerald-50 p-4 text-emerald-800">
            <div class="mt-0.5 rounded-lg bg-emerald-100 p-2">
                <i data-lucide="check-circle-2" class="h-4 w-4"></i>
            </div>

            <div>
                <p class="font-bold">Berhasil</p>
                <p class="mt-1 text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif


    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="rounded-2xl border border-red-100 bg-red-50 p-5 text-red-800">
            <div class="flex items-start gap-3">
                <div class="mt-0.5 rounded-lg bg-red-100 p-2">
                    <i data-lucide="circle-alert" class="h-4 w-4"></i>
                </div>

                <div>
                    <p class="font-bold">Terjadi kesalahan</p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif


    {{-- Filter --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
        <div class="border-b border-gray-100 px-6 py-5">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-[#062E1F] p-2.5 text-white">
                    <i data-lucide="filter" class="h-4 w-4"></i>
                </div>

                <div>
                    <h2 class="font-bold text-[#062E1F]">
                        Filter Penugasan
                    </h2>

                    <p class="mt-0.5 text-xs text-gray-500">
                        Gunakan filter untuk menemukan penugasan tertentu.
                    </p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.teacher-class-subjects.index') }}"
              method="GET"
              class="p-6">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

                {{-- Tahun Akademik --}}
                <div>
                    <label for="academic_year_id"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Tahun Akademik
                    </label>

                    <select id="academic_year_id"
                            name="academic_year_id"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10">

                        <option value="">Semua Tahun Akademik</option>

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


                {{-- Kelas --}}
                <div>
                    <label for="school_class_id"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Kelas
                    </label>

                    <select id="school_class_id"
                            name="school_class_id"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10">

                        <option value="">Semua Kelas</option>

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


                {{-- Guru --}}
                <div>
                    <label for="teacher_id"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Guru
                    </label>

                    <select id="teacher_id"
                            name="teacher_id"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10">

                        <option value="">Semua Guru</option>

                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- Mata Pelajaran --}}
                <div>
                    <label for="subject_id"
                           class="mb-2 block text-sm font-semibold text-gray-700">
                        Mata Pelajaran
                    </label>

                    <select id="subject_id"
                            name="subject_id"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10">

                        <option value="">Semua Mata Pelajaran</option>

                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->code }} — {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>


            {{-- Filter Buttons --}}
            <div class="mt-5 flex flex-col gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">

                <a href="{{ route('admin.teacher-class-subjects.index') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 transition hover:border-gray-300 hover:bg-gray-50">
                    <i data-lucide="rotate-ccw" class="h-4 w-4"></i>
                    Reset
                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#062E1F]">
                    <i data-lucide="search" class="h-4 w-4"></i>
                    Terapkan Filter
                </button>

            </div>
        </form>
    </div>


    {{-- Data --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

        {{-- Table Header --}}
        <div class="flex flex-col gap-3 border-b border-gray-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-bold text-[#062E1F]">
                    Daftar Penugasan
                </h2>

                <p class="mt-1 text-xs text-gray-500">
                    {{ $assignments->total() }} penugasan ditemukan.
                </p>
            </div>

            <div class="flex items-center gap-2 rounded-xl bg-[#F5F7F6] px-3 py-2 text-xs font-semibold text-gray-600">
                <i data-lucide="book-open-check" class="h-4 w-4 text-[#087443]"></i>
                Guru & Mata Pelajaran
            </div>
        </div>


        @if($assignments->count())

            {{-- Desktop Table --}}
            <div class="hidden overflow-x-auto lg:block">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-[#F8FAF9]">
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                Tahun / Kelas
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                Guru
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                Mata Pelajaran
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500">
                                SKS
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @foreach($assignments as $assignment)
                            <tr class="group transition hover:bg-[#F8FAF9]">

                                {{-- Tahun / Kelas --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-start gap-3">
                                        <div class="rounded-xl bg-[#062E1F] p-2.5 text-white">
                                            <i data-lucide="school" class="h-4 w-4"></i>
                                        </div>

                                        <div>
                                            <div class="font-bold text-[#062E1F]">
                                                {{ $assignment->schoolClass?->name ?? '-' }}
                                            </div>

                                            <div class="mt-1 text-xs text-gray-500">
                                                {{ $assignment->academicYear?->name ?? '-' }}

                                                @if($assignment->academicYear?->semester)
                                                    · {{ $assignment->academicYear->semester }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>


                                {{-- Guru --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#087443]/10 text-sm font-black text-[#087443]">
                                            {{ strtoupper(substr($assignment->teacher?->name ?? 'G', 0, 1)) }}
                                        </div>

                                        <div>
                                            <div class="font-semibold text-gray-800">
                                                {{ $assignment->teacher?->name ?? '-' }}
                                            </div>

                                            @if($assignment->teacher?->position)
                                                <div class="mt-0.5 text-xs text-gray-500">
                                                    {{ $assignment->teacher->position }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>


                                {{-- Subject --}}
                                <td class="px-6 py-5">
                                    <div class="font-semibold text-gray-800">
                                        {{ $assignment->subject?->name ?? '-' }}
                                    </div>

                                    <div class="mt-1 inline-flex rounded-lg bg-gray-100 px-2 py-1 text-[11px] font-bold text-gray-600">
                                        {{ $assignment->subject?->code ?? '-' }}
                                    </div>
                                </td>


                                {{-- Credit --}}
                                <td class="px-6 py-5 text-center">
                                    <span class="inline-flex min-w-9 items-center justify-center rounded-lg bg-[#F3F7F4] px-2.5 py-1.5 text-sm font-bold text-[#087443]">
                                        {{ $assignment->credit }}
                                    </span>
                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-5 text-center">
                                    @if($assignment->is_active)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-500">
                                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>


                                {{-- Actions --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-end gap-2">

                                        <a href="{{ route('admin.teacher-class-subjects.edit', $assignment) }}"
                                           class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white p-2.5 text-gray-600 transition hover:border-[#087443]/30 hover:bg-[#087443]/5 hover:text-[#087443]"
                                           title="Edit">
                                            <i data-lucide="pencil" class="h-4 w-4"></i>
                                        </a>

                                        <form action="{{ route('admin.teacher-class-subjects.destroy', $assignment) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus penugasan ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="inline-flex items-center justify-center rounded-xl border border-red-100 bg-white p-2.5 text-red-500 transition hover:bg-red-50"
                                                    title="Hapus">
                                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>


            {{-- Mobile / Tablet Cards --}}
            <div class="divide-y divide-gray-100 lg:hidden">

                @foreach($assignments as $assignment)
                    <div class="p-5 sm:p-6">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex min-w-0 items-start gap-3">
                                <div class="rounded-xl bg-[#062E1F] p-2.5 text-white">
                                    <i data-lucide="book-open" class="h-4 w-4"></i>
                                </div>

                                <div class="min-w-0">
                                    <h3 class="truncate font-bold text-[#062E1F]">
                                        {{ $assignment->subject?->name ?? '-' }}
                                    </h3>

                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $assignment->subject?->code ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            @if($assignment->is_active)
                                <span class="shrink-0 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700">
                                    Aktif
                                </span>
                            @else
                                <span class="shrink-0 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-500">
                                    Nonaktif
                                </span>
                            @endif

                        </div>


                        <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-3">

                            <div class="rounded-xl bg-[#F8FAF9] p-4">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                    Guru
                                </p>

                                <p class="mt-1 text-sm font-semibold text-gray-800">
                                    {{ $assignment->teacher?->name ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-[#F8FAF9] p-4">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                    Kelas
                                </p>

                                <p class="mt-1 text-sm font-semibold text-gray-800">
                                    {{ $assignment->schoolClass?->name ?? '-' }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-[#F8FAF9] p-4">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                    Tahun Akademik
                                </p>

                                <p class="mt-1 text-sm font-semibold text-gray-800">
                                    {{ $assignment->academicYear?->name ?? '-' }}
                                </p>
                            </div>

                        </div>


                        <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-4">

                            <div class="text-sm text-gray-500">
                                <span class="font-semibold text-gray-700">
                                    {{ $assignment->credit }}
                                </span>
                                SKS
                            </div>

                            <div class="flex items-center gap-2">

                                <a href="{{ route('admin.teacher-class-subjects.edit', $assignment) }}"
                                   class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 text-xs font-bold text-gray-600 transition hover:border-[#087443]/30 hover:bg-[#087443]/5 hover:text-[#087443]">
                                    <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                                    Edit
                                </a>

                                <form action="{{ route('admin.teacher-class-subjects.destroy', $assignment) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus penugasan ini?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="inline-flex items-center gap-2 rounded-xl border border-red-100 bg-white px-3.5 py-2.5 text-xs font-bold text-red-500 transition hover:bg-red-50">
                                        <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                                        Hapus
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        @else

            {{-- Empty State --}}
            <div class="px-6 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#F3F7F4] text-[#087443]">
                    <i data-lucide="book-open-check" class="h-7 w-7"></i>
                </div>

                <h3 class="mt-5 text-lg font-bold text-[#062E1F]">
                    Belum Ada Penugasan
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                    Belum ada guru yang ditugaskan untuk mengajar mata pelajaran pada kelas tertentu.
                    Silakan tambahkan penugasan baru.
                </p>

                <a href="{{ route('admin.teacher-class-subjects.create') }}"
                   class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#062E1F]">
                    <i data-lucide="plus" class="h-4 w-4"></i>
                    Tambah Penugasan
                </a>

            </div>

        @endif


        {{-- Pagination --}}
        @if($assignments->hasPages())
            <div class="border-t border-gray-100 px-6 py-5">
                {{ $assignments->links() }}
            </div>
        @endif

    </div>

</div>

@push('scripts')
<script>
    if (window.lucide) {
        lucide.createIcons();
    }
</script>
@endpush

@endsection