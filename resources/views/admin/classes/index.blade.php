@extends('layouts.admin')

@section('title', 'Kelas')

@section('content')

<div class="max-w-7xl">

    {{-- HEADER --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex items-center gap-3">

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl
                    bg-[#087443]/10 text-[#087443]"
                >
                    <i data-lucide="school" class="h-6 w-6"></i>
                </div>

                <div>

                    <h1 class="text-2xl font-black text-gray-900">
                        Kelas
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Kelola data kelas dan wali kelas.
                    </p>

                </div>

            </div>

        </div>


        <a
            href="{{ route('admin.classes.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl
            bg-[#087443] px-5 py-3 text-sm font-black text-white
            shadow-lg shadow-[#087443]/20 transition hover:bg-[#062E1F]"
        >

            <i data-lucide="plus" class="h-4 w-4"></i>

            Tambah Kelas

        </a>

    </div>


    {{-- SUCCESS --}}
    @if (session('success'))

        <div
            class="mb-6 flex items-center gap-3 rounded-2xl
            border border-green-200 bg-green-50 px-5 py-4
            text-sm font-semibold text-green-700"
        >

            <i data-lucide="check-circle" class="h-5 w-5"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- TABLE --}}
    <div
        class="overflow-hidden rounded-3xl bg-white shadow-sm
        ring-1 ring-gray-100"
    >

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="border-b border-gray-100 bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-500">
                            #
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-500">
                            Kelas
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-500">
                            Tingkat
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-500">
                            Wali Kelas
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-black uppercase tracking-wider text-gray-500">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($classes as $class)

                        <tr class="transition hover:bg-gray-50">

                            {{-- NO --}}
                            <td class="px-6 py-5 text-sm font-bold text-gray-400">

                                {{ $loop->iteration }}

                            </td>


                            {{-- NAMA --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center
                                        justify-center rounded-xl
                                        bg-[#EAF4EF] text-[#087443]"
                                    >

                                        <i data-lucide="users" class="h-5 w-5"></i>

                                    </div>

                                    <div>

                                        <p class="font-black text-gray-900">
                                            {{ $class->name }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-400">
                                            Urutan {{ $class->sort_order }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- TINGKAT --}}
                            <td class="px-6 py-5 text-sm font-semibold text-gray-600">

                                {{ $class->level ?: '-' }}

                            </td>


                            {{-- WALI --}}
                            <td class="px-6 py-5">

                                @if ($class->homeroomTeacher)

                                    <div>

                                        <p class="text-sm font-bold text-gray-900">
                                            {{ $class->homeroomTeacher->name }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-400">
                                            {{ $class->homeroomTeacher->position }}
                                        </p>

                                    </div>

                                @else

                                    <span class="text-sm font-semibold text-gray-400">
                                        Belum ditentukan
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}
                            <td class="px-6 py-5">

                                @if ($class->is_active)

                                    <span
                                        class="inline-flex items-center gap-2 rounded-full
                                        bg-green-50 px-3 py-1.5 text-xs font-black
                                        text-green-700"
                                    >

                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                        Aktif

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-2 rounded-full
                                        bg-gray-100 px-3 py-1.5 text-xs font-black
                                        text-gray-500"
                                    >

                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                        Tidak Aktif

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('admin.classes.edit', $class) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center
                                        rounded-lg bg-gray-100 text-gray-600
                                        transition hover:bg-[#EAF4EF] hover:text-[#087443]"
                                        title="Edit"
                                    >

                                        <i data-lucide="pencil" class="h-4 w-4"></i>

                                    </a>


                                    <form
                                        action="{{ route('admin.classes.destroy', $class) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kelas ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex h-9 w-9 items-center justify-center
                                            rounded-lg bg-gray-100 text-gray-600
                                            transition hover:bg-red-50 hover:text-red-600"
                                            title="Hapus"
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
                                colspan="6"
                                class="px-6 py-16 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <div
                                        class="flex h-16 w-16 items-center justify-center
                                        rounded-2xl bg-gray-100 text-gray-400"
                                    >

                                        <i data-lucide="school" class="h-8 w-8"></i>

                                    </div>

                                    <h3 class="mt-4 font-black text-gray-900">
                                        Belum ada kelas
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Tambahkan kelas pertama untuk mulai mengatur data kelas.
                                    </p>

                                    <a
                                        href="{{ route('admin.classes.create') }}"
                                        class="mt-5 inline-flex items-center gap-2
                                        rounded-xl bg-[#087443] px-5 py-3
                                        text-sm font-black text-white
                                        hover:bg-[#062E1F]"
                                    >

                                        <i data-lucide="plus" class="h-4 w-4"></i>

                                        Tambah Kelas

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection