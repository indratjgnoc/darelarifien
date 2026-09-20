@extends('layouts.admin')

@section('title', 'Edit santri')

@section('content')

    <div class="max-w-6xl">

        {{-- HEADER --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-12 w-12 items-center justify-center
                       rounded-2xl bg-[#087443]/10 text-[#087443]">
                    <i data-lucide="user-pen" class="h-6 w-6"></i>
                </div>

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-[#087443]">
                        SIAKAD / Kesiswaan
                    </p>

                    <h1 class="mt-1 text-2xl font-black text-gray-900">
                        Edit Data santri
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Perbarui informasi santri
                        <span class="font-bold text-gray-700">
                            {{ $student->name }}
                        </span>.
                    </p>

                </div>

            </div>


            <a href="{{ route('admin.students.show', $student) }}"
                class="inline-flex items-center justify-center gap-2
                   rounded-xl bg-gray-100 px-5 py-3
                   text-sm font-bold text-gray-600
                   transition hover:bg-gray-200">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                Kembali
            </a>

        </div>


        {{-- ERROR --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-200
                   bg-red-50 p-5 text-sm text-red-700">

                <div class="flex items-start gap-3">

                    <i data-lucide="alert-circle" class="mt-0.5 h-5 w-5 shrink-0"></i>

                    <div>

                        <p class="font-black">
                            Data belum dapat diperbarui.
                        </p>

                        <ul class="mt-2 list-disc space-y-1 pl-5">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        <form action="{{ route('admin.students.update', $student) }}" method="POST" class="space-y-6">

            @csrf
            @method('PUT')


            {{-- IDENTITAS --}}

            <div class="rounded-3xl bg-white p-6
                   shadow-sm ring-1 ring-gray-100">

                <div class="mb-6 flex items-start gap-4">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center
                           justify-center rounded-xl
                           bg-[#087443]/10 text-[#087443]">
                        <i data-lucide="user-round" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <h2 class="text-lg font-black text-gray-900">
                            Identitas santri
                        </h2>

                        <p class="mt-1 text-sm text-gray-400">
                            Informasi dasar identitas santri.
                        </p>

                    </div>

                </div>


                <div class="grid gap-5 md:grid-cols-2">

                    {{-- NIS --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            NIS <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="nis" value="{{ old('nis', $student->nis) }}" required
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>


                    {{-- NISN --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            NISN
                        </label>

                        <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>


                    {{-- NAMA --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="name" value="{{ old('name', $student->name) }}" required
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>


                    {{-- GENDER --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Jenis Kelamin
                        </label>

                        <select name="gender"
                            class="w-full rounded-xl border border-gray-200
           bg-gray-50 px-4 py-3 text-sm
           outline-none transition
           focus:border-[#087443]
           focus:bg-white
           focus:ring-2 focus:ring-[#087443]/10">

                            <option value="">
                                Pilih jenis kelamin
                            </option>

                            <option value="L" @selected(old('gender', $student->gender) === 'L')>
                                Laki-laki
                            </option>

                            <option value="P" @selected(old('gender', $student->gender) === 'P')>
                                Perempuan
                            </option>

                        </select>

                    </div>


                    {{-- TELEPON --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Nomor Telepon
                        </label>

                        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}"
                            placeholder="08xxxxxxxxxx"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>


                    {{-- TEMPAT LAHIR --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Tempat Lahir
                        </label>

                        <input type="text" name="birth_place" value="{{ old('birth_place', $student->birth_place) }}"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>


                    {{-- TANGGAL LAHIR --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Tanggal Lahir
                        </label>

                        <input type="date" name="birth_date"
                            value="{{ old('birth_date', optional($student->birth_date)->format('Y-m-d')) }}"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>

                </div>

            </div>


            {{-- DATA KELUARGA --}}

            <div class="rounded-3xl bg-white p-6
                   shadow-sm ring-1 ring-gray-100">

                <div class="mb-6 flex items-start gap-4">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center
                           justify-center rounded-xl
                           bg-[#087443]/10 text-[#087443]">
                        <i data-lucide="users" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <h2 class="text-lg font-black text-gray-900">
                            Data Keluarga
                        </h2>

                        <p class="mt-1 text-sm text-gray-400">
                            Informasi orang tua atau wali santri.
                        </p>

                    </div>

                </div>


                <div class="grid gap-5 md:grid-cols-2">

                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Nama Ayah
                        </label>

                        <input type="text" name="father_name" value="{{ old('father_name', $student->father_name) }}"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>


                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Nama Ibu
                        </label>

                        <input type="text" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>


                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Nama Wali
                        </label>

                        <input type="text" name="guardian_name"
                            value="{{ old('guardian_name', $student->guardian_name) }}"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>


                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Nomor Telepon Orang Tua / Wali
                        </label>

                        <input type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                    </div>


                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Alamat
                        </label>

                        <textarea name="address" rows="4"
                            class="w-full resize-none rounded-xl border
                               border-gray-200 bg-gray-50 px-4 py-3
                               text-sm outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">{{ old('address', $student->address) }}</textarea>

                    </div>

                </div>

            </div>


            {{-- AKADEMIK --}}

            <div class="rounded-3xl bg-white p-6
                   shadow-sm ring-1 ring-gray-100">

                <div class="mb-6 flex items-start gap-4">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center
                           justify-center rounded-xl
                           bg-[#087443]/10 text-[#087443]">
                        <i data-lucide="graduation-cap" class="h-5 w-5"></i>
                    </div>

                    <div>

                        <h2 class="text-lg font-black text-gray-900">
                            Data Akademik
                        </h2>

                        <p class="mt-1 text-sm text-gray-400">
                            Tahun ajaran, kelas dan status santri.
                        </p>

                    </div>

                </div>


                <div class="grid gap-5 md:grid-cols-2">

                    {{-- TAHUN --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Tahun Ajaran
                        </label>

                        <select name="academic_year_id"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                            <option value="">
                                Pilih tahun ajaran
                            </option>

                            @foreach ($academicYears as $year)
                                <option value="{{ $year->id }}" @selected(old('academic_year_id', $student->academic_year_id) == $year->id)>
                                    {{ $year->name }}
                                    @if ($year->semester)
                                        — Semester {{ $year->semester }}
                                    @endif
                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- KELAS --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Kelas
                        </label>

                        <select name="school_class_id"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                            <option value="">
                                Pilih kelas
                            </option>

                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" @selected(old('school_class_id', $student->school_class_id) == $class->id)>
                                    {{ $class->name }}

                                    @if ($class->academicYear)
                                        — {{ $class->academicYear->name }}
                                    @endif
                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- STATUS --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Status santri
                        </label>

                        <select name="is_active"
                            class="w-full rounded-xl border border-gray-200
                               bg-gray-50 px-4 py-3 text-sm
                               outline-none transition
                               focus:border-[#087443]
                               focus:bg-white
                               focus:ring-2 focus:ring-[#087443]/10">

                            <option value="1" @selected(old('is_active', $student->is_active ? '1' : '0') == '1')>
                                Aktif
                            </option>

                            <option value="0" @selected(old('is_active', $student->is_active ? '1' : '0') == '0')>
                                Tidak Aktif
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- ACTION --}}

            <div class="flex flex-col-reverse gap-3 sm:flex-row
                   sm:justify-end">

                <a href="{{ route('admin.students.show', $student) }}"
                    class="inline-flex items-center justify-center
                       rounded-xl bg-gray-100 px-6 py-3
                       text-sm font-bold text-gray-600
                       transition hover:bg-gray-200">
                    Batal
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-[#087443] px-6 py-3
                       text-sm font-black text-white
                       shadow-sm transition
                       hover:bg-[#062E1F]
                       hover:-translate-y-0.5">
                    <i data-lucide="save" class="h-4 w-4"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

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
