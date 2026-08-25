@extends('layouts.admin')

@section('title', 'Jadwal Mengajar')

@section('content')

<div class="max-w-7xl">

    {{-- HEADER --}}
    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>

            <div class="flex items-center gap-3">

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#087443]/10 text-[#087443]">

                    <i data-lucide="calendar-days" class="h-6 w-6"></i>

                </div>

                <div>

                    <h1 class="text-2xl font-black text-gray-900">
                        Jadwal Mengajar
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Kelola jadwal mengajar guru pesantren.
                    </p>

                </div>

            </div>

        </div>


        <a
            href="{{ route('admin.schedules.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-black text-white shadow-lg shadow-[#087443]/20 transition hover:bg-[#062E1F]"
        >

            <i data-lucide="plus" class="h-4 w-4"></i>

            Tambah Jadwal

        </a>

    </div>


    {{-- SUCCESS --}}
    @if (session('success'))

        <div class="mb-6 flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700">

            <i data-lucide="check-circle" class="h-5 w-5"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- TABLE --}}
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-100">

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                            Guru
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                            Mata Pelajaran
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                            Kelas
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                            Hari
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                            Waktu
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                            Ruangan
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-black uppercase tracking-wider text-gray-400">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($schedules as $schedule)

                        <tr class="transition hover:bg-gray-50">

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#087443]/10 text-[#087443]">

                                        <i data-lucide="user-round" class="h-5 w-5"></i>

                                    </div>

                                    <span class="font-bold text-gray-900">
                                        {{ $schedule->teacher->name ?? '-' }}
                                    </span>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span class="font-semibold text-gray-800">
                                    {{ $schedule->subject }}
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span class="rounded-lg bg-gray-100 px-3 py-1 text-xs font-bold text-gray-700">
                                    {{ $schedule->class_name }}
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span class="font-semibold text-gray-700">
                                    {{ $schedule->day }}
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span class="text-sm font-bold text-[#087443]">

                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}

                                    -

                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}

                                </span>

                            </td>


                            <td class="px-6 py-5 text-sm text-gray-500">

                                {{ $schedule->room ?: '-' }}

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.schedules.edit', $schedule) }}"
                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition hover:bg-blue-100"
                                    >

                                        <i data-lucide="pencil" class="h-4 w-4"></i>

                                    </a>


                                    <form
                                        action="{{ route('admin.schedules.destroy', $schedule) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus jadwal ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-red-50 text-red-600 transition hover:bg-red-100"
                                        >

                                            <i data-lucide="trash-2" class="h-4 w-4"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400">

                                    <i data-lucide="calendar-x" class="h-8 w-8"></i>

                                </div>

                                <h3 class="mt-5 font-black text-gray-900">
                                    Belum Ada Jadwal
                                </h3>

                                <p class="mt-2 text-sm text-gray-500">
                                    Silakan tambahkan jadwal mengajar.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection