@extends('layouts.guru')

@section('title', 'Profil Saya')

@section('page-title', 'Profil Saya')

@section('content')

<div class="mx-auto max-w-5xl">

    @if (!$teacher)

        <div
            class="rounded-3xl
                   border border-yellow-200
                   bg-yellow-50
                   p-6
                   text-yellow-800"
        >

            <div class="flex items-start gap-4">

                <div
                    class="flex h-11 w-11
                           shrink-0
                           items-center justify-center
                           rounded-xl
                           bg-yellow-100"
                >

                    <i data-lucide="triangle-alert" class="h-5 w-5"></i>

                </div>

                <div>

                    <h2 class="font-black">
                        Profil guru belum terhubung
                    </h2>

                    <p class="mt-1 text-sm">
                        Akun Anda sudah memiliki role guru,
                        tetapi belum terhubung dengan data guru.
                    </p>

                </div>

            </div>

        </div>

    @else

        {{-- HEADER PROFIL --}}

        <div
            class="overflow-hidden
                   rounded-3xl
                   bg-[#062E1F]
                   shadow-xl"
        >

            <div class="p-8">

                <div
                    class="flex flex-col
                           gap-6
                           md:flex-row
                           md:items-center"
                >

                    {{-- FOTO --}}

                    <div
                        class="flex h-28 w-28
                               shrink-0
                               items-center
                               justify-center
                               overflow-hidden
                               rounded-3xl
                               bg-[#087443]
                               text-white"
                    >

                        @if ($teacher->photo)

                            <img
                                src="{{ asset('storage/' . $teacher->photo) }}"
                                alt="{{ $teacher->name }}"
                                class="h-full w-full object-cover"
                            >

                        @else

                            <i
                                data-lucide="user"
                                class="h-12 w-12"
                            ></i>

                        @endif

                    </div>


                    {{-- DATA UTAMA --}}

                    <div>

                        <p
                            class="text-xs
                                   font-bold
                                   uppercase
                                   tracking-widest
                                   text-[#F4C542]"
                        >
                            Profil Guru
                        </p>

                        <h2
                            class="mt-2
                                   text-3xl
                                   font-black
                                   text-white"
                        >
                            {{ $teacher->name }}
                        </h2>

                        <p class="mt-2 text-white/60">
                            {{ $teacher->position ?: 'Guru' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- DETAIL --}}

        <div class="mt-6 grid gap-6 md:grid-cols-2">

            {{-- PENDIDIKAN --}}

            <div
                class="rounded-3xl
                       bg-white
                       p-6
                       shadow-sm
                       ring-1 ring-gray-100"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-xl
                               bg-[#087443]/10
                               text-[#087443]"
                    >

                        <i data-lucide="graduation-cap" class="h-5 w-5"></i>

                    </div>

                    <div>

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                            Pendidikan
                        </p>

                        <p class="mt-1 font-black text-gray-900">
                            {{ $teacher->education ?: 'Belum diisi' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- EMAIL AKUN --}}

            <div
                class="rounded-3xl
                       bg-white
                       p-6
                       shadow-sm
                       ring-1 ring-gray-100"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-xl
                               bg-blue-50
                               text-blue-600"
                    >

                        <i data-lucide="mail" class="h-5 w-5"></i>

                    </div>

                    <div class="min-w-0">

                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                            Email Akun
                        </p>

                        <p class="mt-1 truncate font-black text-gray-900">
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- BIO --}}

        <div
            class="mt-6
                   rounded-3xl
                   bg-white
                   p-6
                   shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2 class="text-lg font-black text-gray-900">
                Tentang Saya
            </h2>

            <div class="mt-4 text-sm leading-7 text-gray-600">

                @if ($teacher->bio)

                    {!! nl2br(e($teacher->bio)) !!}

                @else

                    <span class="text-gray-400">
                        Belum ada biodata.
                    </span>

                @endif

            </div>

        </div>

    @endif

</div>

@endsection
