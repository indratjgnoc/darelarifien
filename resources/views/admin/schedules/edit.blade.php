@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-gray-50 py-8">

    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-gray-400">
                    <a
                        href="{{ route('admin.schedules.index') }}"
                        class="transition hover:text-[#087443]"
                    >
                        Jadwal
                    </a>

                    <span>/</span>

                    <span>Edit</span>
                </div>

                <h1 class="text-2xl font-black tracking-tight text-gray-900 sm:text-3xl">
                    Edit Jadwal
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Perbarui penugasan dan waktu jadwal pembelajaran.
                </p>
            </div>

            <a
                href="{{ route('admin.schedules.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-700 shadow-sm transition hover:border-[#087443] hover:text-[#087443]"
            >
                ← Kembali
            </a>

        </div>


        {{-- ERROR GLOBAL --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-100 bg-red-50 p-5">

                <div class="flex gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                        !
                    </div>

                    <div>
                        <h3 class="font-bold text-red-800">
                            Ada data yang perlu diperiksa
                        </h3>

                        <ul class="mt-2 space-y-1 text-sm text-red-700">

                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>

                </div>

            </div>

        @endif


        {{-- FORM --}}
        <form
            action="{{ route('admin.schedules.update', $schedule) }}"
            method="POST"
            class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm"
        >

            @csrf
            @method('PUT')


            {{-- TOP --}}
            <div class="border-b border-gray-100 bg-gradient-to-r from-[#063d27] to-[#087443] px-6 py-6 text-white sm:px-8">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-xl">
                        📅
                    </div>

                    <div>
                        <h2 class="text-lg font-black">
                            Informasi Jadwal
                        </h2>

                        <p class="mt-1 text-sm text-white/70">
                            Tentukan penugasan mengajar, hari, waktu, dan ruangan.
                        </p>
                    </div>

                </div>

            </div>


            <div class="space-y-8 p-6 sm:p-8">

                {{-- PENUGASAN MENGAJAR --}}
                <div>

                    <label
                        for="teacher_class_subject_id"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Penugasan Mengajar
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="teacher_class_subject_id"
                        name="teacher_class_subject_id"
                        required
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                    >

                        <option value="">
                            -- Pilih Penugasan Mengajar --
                        </option>

                        @foreach ($teacherClassSubjects as $assignment)

                            <option
                                value="{{ $assignment->id }}"
                                @selected(
                                    old(
                                        'teacher_class_subject_id',
                                        $schedule->teacher_class_subject_id
                                    ) == $assignment->id
                                )
                            >

                                {{ $assignment->schoolClass?->name ?? 'Tanpa Kelas' }}
                                —
                                {{ $assignment->subject?->name ?? 'Tanpa Mata Pelajaran' }}
                                —
                                {{ $assignment->teacher?->name ?? 'Tanpa Guru' }}
                                —
                                {{ $assignment->academicYear?->name ?? 'Tanpa Tahun Akademik' }}

                            </option>

                        @endforeach

                    </select>

                    <p class="mt-2 text-xs font-medium text-gray-400">
                        Penugasan menentukan guru, kelas, mata pelajaran,
                        dan tahun akademik.
                    </p>

                    @error('teacher_class_subject_id')
                        <p class="mt-2 text-sm font-semibold text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- RINGKASAN PENUGASAN SAAT INI --}}
                @if ($schedule->teacherClassSubject)

                    <div class="rounded-2xl border border-[#087443]/10 bg-[#087443]/5 p-5">

                        <div class="mb-4 flex items-center justify-between">

                            <div>
                                <h3 class="text-sm font-black text-gray-800">
                                    Penugasan Saat Ini
                                </h3>

                                <p class="mt-1 text-xs text-gray-400">
                                    Data berasal dari TeacherClassSubject.
                                </p>
                            </div>

                            @if ($schedule->teacherClassSubject->is_active)

                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                    Aktif
                                </span>

                            @else

                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                                    Tidak Aktif
                                </span>

                            @endif

                        </div>


                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

                            <div class="rounded-xl bg-white p-4 shadow-sm">

                                <p class="text-xs font-semibold text-gray-400">
                                    Kelas
                                </p>

                                <p class="mt-1 text-sm font-black text-gray-800">
                                    {{ $schedule->teacherClassSubject->schoolClass?->name ?? '-' }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-white p-4 shadow-sm">

                                <p class="text-xs font-semibold text-gray-400">
                                    Mata Pelajaran
                                </p>

                                <p class="mt-1 text-sm font-black text-gray-800">
                                    {{ $schedule->teacherClassSubject->subject?->name ?? '-' }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-white p-4 shadow-sm">

                                <p class="text-xs font-semibold text-gray-400">
                                    Guru
                                </p>

                                <p class="mt-1 text-sm font-black text-gray-800">
                                    {{ $schedule->teacherClassSubject->teacher?->name ?? '-' }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-white p-4 shadow-sm">

                                <p class="text-xs font-semibold text-gray-400">
                                    Tahun Akademik
                                </p>

                                <p class="mt-1 text-sm font-black text-gray-800">
                                    {{ $schedule->teacherClassSubject->academicYear?->name ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- HARI --}}
                <div>

                    <label
                        for="day"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Hari
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="day"
                        name="day"
                        required
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                    >

                        <option value="">
                            -- Pilih Hari --
                        </option>

                        @foreach ([
                            'Senin',
                            'Selasa',
                            'Rabu',
                            'Kamis',
                            'Jumat',
                            'Sabtu',
                            'Minggu'
                        ] as $day)

                            <option
                                value="{{ $day }}"
                                @selected(
                                    old('day', $schedule->day) === $day
                                )
                            >
                                {{ $day }}
                            </option>

                        @endforeach

                    </select>

                    @error('day')
                        <p class="mt-2 text-sm font-semibold text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- WAKTU --}}
                <div class="grid gap-5 md:grid-cols-2">

                    {{-- JAM MULAI --}}
                    <div>

                        <label
                            for="start_time"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Jam Mulai
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="time"
                            id="start_time"
                            name="start_time"
                            value="{{ old('start_time', $schedule->start_time ? substr($schedule->start_time, 0, 5) : '') }}"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                        >

                        @error('start_time')
                            <p class="mt-2 text-sm font-semibold text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- JAM SELESAI --}}
                    <div>

                        <label
                            for="end_time"
                            class="mb-2 block text-sm font-bold text-gray-700"
                        >
                            Jam Selesai
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="time"
                            id="end_time"
                            name="end_time"
                            value="{{ old('end_time', $schedule->end_time ? substr($schedule->end_time, 0, 5) : '') }}"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                        >

                        @error('end_time')
                            <p class="mt-2 text-sm font-semibold text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- RUANGAN --}}
                <div>

                    <label
                        for="room"
                        class="mb-2 block text-sm font-bold text-gray-700"
                    >
                        Ruangan
                    </label>

                    <input
                        type="text"
                        id="room"
                        name="room"
                        value="{{ old('room', $schedule->room) }}"
                        placeholder="Contoh: Ruang Kelas 1"
                        maxlength="100"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-medium text-gray-700 outline-none transition placeholder:text-gray-400 focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                    >

                    <p class="mt-2 text-xs font-medium text-gray-400">
                        Kosongkan jika jadwal tidak menggunakan ruangan tertentu.
                    </p>

                    @error('room')
                        <p class="mt-2 text-sm font-semibold text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- STATUS --}}
                <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5">

                    <div class="flex items-start gap-4">

                        <div class="pt-1">

                            <input
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                @checked(
                                    old(
                                        'is_active',
                                        $schedule->is_active
                                    )
                                )
                                class="h-5 w-5 rounded border-gray-300 text-[#087443] focus:ring-[#087443]"
                            >

                        </div>

                        <div>

                            <label
                                for="is_active"
                                class="cursor-pointer text-sm font-black text-gray-800"
                            >
                                Jadwal Aktif
                            </label>

                            <p class="mt-1 text-xs leading-5 text-gray-500">
                                Jadwal aktif akan ditampilkan kepada
                                pengguna yang memiliki akses ke jadwal.
                            </p>

                        </div>

                    </div>

                    @error('is_active')
                        <p class="mt-2 text-sm font-semibold text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="flex flex-col-reverse gap-3 border-t border-gray-100 bg-gray-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-end sm:px-8">

                <a
                    href="{{ route('admin.schedules.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-bold text-gray-700 transition hover:border-gray-300 hover:bg-gray-100"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-6 py-3 text-sm font-black text-white shadow-lg shadow-[#087443]/20 transition hover:bg-[#063d27] active:scale-[0.98]"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection