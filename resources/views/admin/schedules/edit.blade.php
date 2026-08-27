@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('content')

<div class="max-w-4xl">

    {{-- HEADER --}}
    <div class="mb-8">

        <a
            href="{{ route('admin.schedules.index') }}"
            class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#087443]"
        >

            <i data-lucide="arrow-left" class="h-4 w-4"></i>

            Kembali ke Jadwal

        </a>

        <h1 class="mt-5 text-2xl font-black text-gray-900">
            Edit Jadwal Mengajar
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Perbarui informasi jadwal mengajar guru.
        </p>

    </div>


    {{-- ERROR BENTROK --}}
    @if ($errors->has('schedule'))

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

            <div class="flex items-start gap-3">

                <div
                    class="mt-0.5 flex h-9 w-9 shrink-0
                           items-center justify-center
                           rounded-xl bg-red-100 text-red-600"
                >

                    <i
                        data-lucide="triangle-alert"
                        class="h-5 w-5"
                    ></i>

                </div>

                <div>

                    <p class="font-black text-red-800">
                        Jadwal Tidak Dapat Disimpan
                    </p>

                    <p class="mt-1 text-sm font-medium leading-6 text-red-700">
                        {{ $errors->first('schedule') }}
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- ERROR VALIDASI --}}
    @if ($errors->any() && !$errors->has('schedule'))

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

            <p class="font-black text-red-800">
                Terdapat kesalahan pada data.
            </p>

            <ul class="mt-2 list-disc pl-5 text-sm text-red-700">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <form
        action="{{ route('admin.schedules.update', $schedule) }}"
        method="POST"
        class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100"
    >

        @csrf
        @method('PUT')


        <div class="grid gap-6 md:grid-cols-2">


            {{-- GURU --}}
            <div class="md:col-span-2">

                <label class="mb-2 block text-sm font-bold text-gray-700">
                    Guru
                </label>

                <select
                    name="teacher_id"
                    required
                    class="w-full rounded-xl border border-gray-200
                           bg-gray-50 px-4 py-3 text-sm outline-none
                           focus:border-[#087443]
                           focus:ring-2 focus:ring-[#087443]/10"
                >

                    <option value="">
                        -- Pilih Guru --
                    </option>

                    @foreach ($teachers as $teacher)

                        <option
                            value="{{ $teacher->id }}"
                            @selected(
                                old(
                                    'teacher_id',
                                    $schedule->teacher_id
                                ) == $teacher->id
                            )
                        >
                            {{ $teacher->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- MAPEL --}}
            <div>

                <label class="mb-2 block text-sm font-bold text-gray-700">
                    Mata Pelajaran
                </label>

                <input
                    type="text"
                    name="subject"
                    value="{{ old('subject', $schedule->subject) }}"
                    required
                    placeholder="Contoh: Al-Qur'an Hadits"
                    class="w-full rounded-xl border border-gray-200
                           bg-gray-50 px-4 py-3 text-sm outline-none
                           focus:border-[#087443]
                           focus:ring-2 focus:ring-[#087443]/10"
                >

            </div>


            {{-- KELAS --}}
            <div>

                <label class="mb-2 block text-sm font-bold text-gray-700">
                    Kelas
                </label>

                <input
                    type="text"
                    name="class_name"
                    value="{{ old('class_name', $schedule->class_name) }}"
                    required
                    placeholder="Contoh: VII"
                    class="w-full rounded-xl border border-gray-200
                           bg-gray-50 px-4 py-3 text-sm outline-none
                           focus:border-[#087443]
                           focus:ring-2 focus:ring-[#087443]/10"
                >

            </div>


            {{-- HARI --}}
            <div>

                <label class="mb-2 block text-sm font-bold text-gray-700">
                    Hari
                </label>

                <select
                    name="day"
                    required
                    class="w-full rounded-xl border border-gray-200
                           bg-gray-50 px-4 py-3 text-sm outline-none
                           focus:border-[#087443]
                           focus:ring-2 focus:ring-[#087443]/10"
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
                                old(
                                    'day',
                                    $schedule->day
                                ) === $day
                            )
                        >
                            {{ $day }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- RUANGAN --}}
            <div>

                <label class="mb-2 block text-sm font-bold text-gray-700">
                    Ruangan
                </label>

                <input
                    type="text"
                    name="room"
                    value="{{ old('room', $schedule->room) }}"
                    placeholder="Contoh: Ruang 1"
                    class="w-full rounded-xl border border-gray-200
                           bg-gray-50 px-4 py-3 text-sm outline-none
                           focus:border-[#087443]
                           focus:ring-2 focus:ring-[#087443]/10"
                >

            </div>


            {{-- JAM MULAI --}}
            <div>

                <label class="mb-2 block text-sm font-bold text-gray-700">
                    Jam Mulai
                </label>

                <input
                    type="time"
                    name="start_time"
                    value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"
                    required
                    class="w-full rounded-xl border border-gray-200
                           bg-gray-50 px-4 py-3 text-sm outline-none
                           focus:border-[#087443]
                           focus:ring-2 focus:ring-[#087443]/10"
                >

            </div>


            {{-- JAM SELESAI --}}
            <div>

                <label class="mb-2 block text-sm font-bold text-gray-700">
                    Jam Selesai
                </label>

                <input
                    type="time"
                    name="end_time"
                    value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"
                    required
                    class="w-full rounded-xl border border-gray-200
                           bg-gray-50 px-4 py-3 text-sm outline-none
                           focus:border-[#087443]
                           focus:ring-2 focus:ring-[#087443]/10"
                >

            </div>


            {{-- STATUS --}}
            <div class="md:col-span-2">

                <label class="inline-flex cursor-pointer items-center gap-3">

                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        class="h-4 w-4 rounded border-gray-300
                               text-[#087443]
                               focus:ring-[#087443]"
                        @checked(
                            old(
                                'is_active',
                                $schedule->is_active
                            )
                        )
                    >

                    <span class="text-sm font-bold text-gray-700">
                        Jadwal aktif
                    </span>

                </label>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="mt-8 flex justify-end gap-3">

            <a
                href="{{ route('admin.schedules.index') }}"
                class="rounded-xl bg-gray-100 px-5 py-3
                       text-sm font-bold text-gray-700
                       hover:bg-gray-200"
            >
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex items-center gap-2
                       rounded-xl bg-[#087443]
                       px-6 py-3 text-sm font-black
                       text-white shadow-lg
                       shadow-[#087443]/20
                       hover:bg-[#062E1F]"
            >

                <i data-lucide="save" class="h-4 w-4"></i>

                Perbarui Jadwal

            </button>

        </div>

    </form>

</div>

@endsection