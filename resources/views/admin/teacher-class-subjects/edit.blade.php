@extends('layouts.admin')

@section('title', 'Edit Penugasan Guru')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <div class="mb-2 text-xs font-bold uppercase tracking-[0.18em] text-[#087443]">
            SIAKAD / Akademik
        </div>

        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-[#062E1F]">
                    Edit Penugasan Guru
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500">
                    Perbarui guru, kelas, mata pelajaran, atau status penugasan.
                </p>
            </div>

            <a href="{{ route('admin.teacher-class-subjects.index') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 shadow-sm transition hover:border-gray-300 hover:bg-gray-50">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                Kembali
            </a>
        </div>
    </div>


    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="rounded-2xl border border-red-100 bg-red-50 p-5 text-red-800">
            <div class="flex items-start gap-3">
                <div class="mt-0.5 rounded-lg bg-red-100 p-2">
                    <i data-lucide="circle-alert" class="h-4 w-4"></i>
                </div>

                <div>
                    <p class="font-bold">Periksa kembali data</p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif


    <form action="{{ route('admin.teacher-class-subjects.update', $teacherClassSubject) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

            {{-- Main Form --}}
            <div class="xl:col-span-2">

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                    {{-- Card Header --}}
                    <div class="border-b border-gray-100 px-6 py-5">
                        <div class="flex items-center gap-3">

                            <div class="rounded-xl bg-[#062E1F] p-2.5 text-white">
                                <i data-lucide="pencil-line" class="h-4 w-4"></i>
                            </div>

                            <div>
                                <h2 class="font-bold text-[#062E1F]">
                                    Informasi Penugasan
                                </h2>

                                <p class="mt-0.5 text-xs text-gray-500">
                                    Perbarui informasi pengajaran.
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="space-y-6 p-6">

                        {{-- Tahun Akademik --}}
                        <div>
                            <label for="academic_year_id"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Tahun Akademik
                                <span class="text-red-500">*</span>
                            </label>

                            <select id="academic_year_id"
                                    name="academic_year_id"
                                    required
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10">

                                <option value="">Pilih Tahun Akademik</option>

                                @foreach($academicYears as $academicYear)
                                    <option value="{{ $academicYear->id }}"
                                        {{ old('academic_year_id', $teacherClassSubject->academic_year_id) == $academicYear->id ? 'selected' : '' }}>
                                        {{ $academicYear->name }}

                                        @if($academicYear->semester)
                                            — {{ $academicYear->semester }}
                                        @endif
                                    </option>
                                @endforeach

                            </select>

                            @error('academic_year_id')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Kelas --}}
                        <div>
                            <label for="school_class_id"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Kelas
                                <span class="text-red-500">*</span>
                            </label>

                            <select id="school_class_id"
                                    name="school_class_id"
                                    required
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10">

                                <option value="">Pilih Kelas</option>

                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('school_class_id', $teacherClassSubject->school_class_id) == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}

                                        @if($class->academicYear)
                                            — {{ $class->academicYear->name }}
                                        @endif
                                    </option>
                                @endforeach

                            </select>

                            @error('school_class_id')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Guru --}}
                        <div>
                            <label for="teacher_id"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Guru Pengajar
                                <span class="text-red-500">*</span>
                            </label>

                            <select id="teacher_id"
                                    name="teacher_id"
                                    required
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10">

                                <option value="">Pilih Guru</option>

                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ old('teacher_id', $teacherClassSubject->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}

                                        @if($teacher->position)
                                            — {{ $teacher->position }}
                                        @endif
                                    </option>
                                @endforeach

                            </select>

                            @error('teacher_id')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Mata Pelajaran --}}
                        <div>
                            <label for="subject_id"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Mata Pelajaran
                                <span class="text-red-500">*</span>
                            </label>

                            <select id="subject_id"
                                    name="subject_id"
                                    required
                                    class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10">

                                <option value="">Pilih Mata Pelajaran</option>

                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id', $teacherClassSubject->subject_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->code }} — {{ $subject->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('subject_id')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- SKS --}}
                        <div>
                            <label for="credit"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Jumlah SKS
                                <span class="text-red-500">*</span>
                            </label>

                            <input type="number"
                                   id="credit"
                                   name="credit"
                                   min="1"
                                   max="20"
                                   required
                                   value="{{ old('credit', $teacherClassSubject->credit) }}"
                                   class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10">

                            @error('credit')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Deskripsi --}}
                        <div>
                            <label for="description"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Keterangan
                                <span class="font-normal text-gray-400">(opsional)</span>
                            </label>

                            <textarea id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="Tambahkan keterangan jika diperlukan..."
                                      class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition placeholder:text-gray-400 focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10">{{ old('description', $teacherClassSubject->description) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                </div>

            </div>


            {{-- Sidebar --}}
            <div class="space-y-6">

                {{-- Status --}}
                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                    <div class="border-b border-gray-100 px-6 py-5">
                        <div class="flex items-center gap-3">

                            <div class="rounded-xl bg-[#087443]/10 p-2.5 text-[#087443]">
                                <i data-lucide="toggle-right" class="h-4 w-4"></i>
                            </div>

                            <div>
                                <h2 class="font-bold text-[#062E1F]">
                                    Status
                                </h2>

                                <p class="mt-0.5 text-xs text-gray-500">
                                    Status penugasan saat ini.
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="p-6">

                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-gray-100 bg-[#F8FAF9] p-4 transition hover:border-[#087443]/20">

                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', $teacherClassSubject->is_active) ? 'checked' : '' }}
                                   class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#087443] focus:ring-[#087443]">

                            <span>
                                <span class="block text-sm font-bold text-gray-800">
                                    Penugasan Aktif
                                </span>

                                <span class="mt-1 block text-xs leading-5 text-gray-500">
                                    Guru dapat melihat penugasan ini pada sistem akademik.
                                </span>
                            </span>

                        </label>

                    </div>
                </div>


                {{-- Detail --}}
                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                    <div class="border-b border-gray-100 px-6 py-5">
                        <div class="flex items-center gap-3">

                            <div class="rounded-xl bg-[#F3F7F4] p-2.5 text-[#087443]">
                                <i data-lucide="info" class="h-4 w-4"></i>
                            </div>

                            <div>
                                <h2 class="font-bold text-[#062E1F]">
                                    Detail
                                </h2>

                                <p class="mt-0.5 text-xs text-gray-500">
                                    Ringkasan penugasan.
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="divide-y divide-gray-100">

                        <div class="px-6 py-4">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                Guru
                            </p>

                            <p class="mt-1 text-sm font-semibold text-gray-800">
                                {{ $teacherClassSubject->teacher?->name ?? '-' }}
                            </p>
                        </div>

                        <div class="px-6 py-4">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                Kelas
                            </p>

                            <p class="mt-1 text-sm font-semibold text-gray-800">
                                {{ $teacherClassSubject->schoolClass?->name ?? '-' }}
                            </p>
                        </div>

                        <div class="px-6 py-4">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                Mata Pelajaran
                            </p>

                            <p class="mt-1 text-sm font-semibold text-gray-800">
                                {{ $teacherClassSubject->subject?->name ?? '-' }}
                            </p>
                        </div>

                    </div>
                </div>


                {{-- Warning --}}
                <div class="rounded-2xl border border-amber-100 bg-amber-50 p-5">

                    <div class="flex items-start gap-3">

                        <div class="rounded-xl bg-amber-100 p-2.5 text-amber-700">
                            <i data-lucide="triangle-alert" class="h-4 w-4"></i>
                        </div>

                        <div>
                            <p class="text-sm font-bold text-amber-900">
                                Perhatian
                            </p>

                            <p class="mt-1 text-xs leading-5 text-amber-800">
                                Pastikan perubahan guru, kelas, dan mata pelajaran sudah benar sebelum disimpan.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Actions --}}
        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a href="{{ route('admin.teacher-class-subjects.index') }}"
               class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-bold text-gray-600 transition hover:bg-gray-50">
                Batal
            </a>

            <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#062E1F]">
                <i data-lucide="save" class="h-4 w-4"></i>
                Simpan Perubahan
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