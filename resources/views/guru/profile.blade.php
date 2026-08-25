@extends('layouts.guru')

@section('title', 'Profil Guru')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-8">

        <h1 class="text-2xl font-black text-gray-900">
            Profil Saya
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Informasi profil dan data akademik Anda.
        </p>

    </div>


    {{-- PROFILE CARD --}}
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-100">

        <div class="h-32 bg-gradient-to-r from-[#062E1F] to-[#087443]">
        </div>


        <div class="px-6 pb-8">

            <div class="-mt-16 mb-6 flex flex-col gap-5 sm:flex-row sm:items-end">

                {{-- FOTO --}}
                <div class="h-32 w-32 overflow-hidden rounded-3xl border-4 border-white bg-gray-100 shadow-lg">

                    @if ($teacher && $teacher->photo)

                        <img
                            src="{{ asset('storage/' . $teacher->photo) }}"
                            alt="{{ $teacher->name }}"
                            class="h-full w-full object-cover"
                        >

                    @else

                        <div class="flex h-full w-full items-center justify-center text-gray-400">

                            <i data-lucide="user" class="h-14 w-14"></i>

                        </div>

                    @endif

                </div>


                {{-- NAMA --}}
                <div class="pb-1">

                    <h2 class="text-2xl font-black text-gray-900">

                        {{ $teacher->name ?? $user->name }}

                    </h2>

                    <p class="mt-1 text-sm font-semibold text-[#087443]">

                        {{ $teacher->position ?? 'Guru' }}

                    </p>

                </div>

            </div>


            {{-- DATA --}}
            <div class="grid gap-5 md:grid-cols-2">

                {{-- EMAIL --}}
                <div class="rounded-2xl bg-gray-50 p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Email
                    </p>

                    <p class="mt-2 font-semibold text-gray-900">
                        {{ $user->email }}
                    </p>

                </div>


                {{-- JABATAN --}}
                <div class="rounded-2xl bg-gray-50 p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Jabatan
                    </p>

                    <p class="mt-2 font-semibold text-gray-900">
                        {{ $teacher->position ?? '-' }}
                    </p>

                </div>


                {{-- PENDIDIKAN --}}
                <div class="rounded-2xl bg-gray-50 p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Pendidikan
                    </p>

                    <p class="mt-2 font-semibold text-gray-900">
                        {{ $teacher->education ?? '-' }}
                    </p>

                </div>


                {{-- STATUS --}}
                <div class="rounded-2xl bg-gray-50 p-5">

                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                        Status
                    </p>

                    <div class="mt-2">

                        @if ($teacher?->is_active)

                            <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">

                                <span class="h-2 w-2 rounded-full bg-green-500"></span>

                                Aktif

                            </span>

                        @else

                            <span class="inline-flex items-center gap-2 rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">

                                <span class="h-2 w-2 rounded-full bg-red-500"></span>

                                Tidak Aktif

                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- BIO --}}
            <div class="mt-5 rounded-2xl bg-gray-50 p-5">

                <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                    Biografi
                </p>

                <p class="mt-3 leading-7 text-gray-700">

                    {{ $teacher->bio ?? 'Belum ada informasi biografi.' }}

                </p>

            </div>

        </div>

    </div>

</div>

@endsection