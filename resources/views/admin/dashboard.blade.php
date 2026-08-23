@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}

    <div
        class="flex flex-col gap-4
               lg:flex-row
               lg:items-end
               lg:justify-between"
    >

        <div>

            <p
                class="text-xs font-black
                       uppercase
                       tracking-[0.2em]
                       text-[#087443]"
            >
                Panel Administrator
            </p>

            <h1
                class="mt-2 text-3xl
                       font-black
                       tracking-tight
                       text-gray-900"
            >
                Dashboard
            </h1>

            <p
                class="mt-2 text-sm
                       text-gray-500"
            >
                Selamat datang kembali.
                Pantau aktivitas Pesantren
                {{ $settings['school_name'] ?? '' }} dari sini.
            </p>

        </div>


        <div
            class="flex items-center gap-3
                   rounded-2xl bg-white
                   px-4 py-3
                   shadow-sm
                   ring-1 ring-gray-100"
        >

            <div
                class="flex h-9 w-9
                       items-center
                       justify-center
                       rounded-xl
                       bg-[#087443]"
            >

                <i
                    data-lucide="calendar-days"
                    class="h-4 w-4
                           text-white"
                ></i>

            </div>

            <div>

                <p
                    class="text-[10px]
                           font-bold uppercase
                           tracking-wider
                           text-gray-400"
                >
                    Hari ini
                </p>

                <p
                    class="text-sm
                           font-black"
                >
                    {{ now()->translatedFormat('d F Y') }}
                </p>

            </div>

        </div>

    </div>


    {{-- STATISTICS --}}

    <div
        class="grid gap-5
               sm:grid-cols-2
               xl:grid-cols-4"
    >

        {{-- PENDAFTAR --}}

        <a
            href="{{ route(
                'admin.registrations.index'
            ) }}"
            class="group rounded-2xl
                   bg-[#062E1F]
                   p-6 shadow-sm
                   transition
                   hover:-translate-y-1
                   hover:shadow-xl"
        >

            <div
                class="flex items-start
                       justify-between"
            >

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-white/40"
                    >
                        Total Pendaftar
                    </p>

                    <p
                        class="mt-3 text-4xl
                               font-black
                               text-white"
                    >
                        {{ $statistics['registrations'] }}
                    </p>

                </div>


                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
                           rounded-xl
                           bg-white/10"
                >

                    <i
                        data-lucide="users"
                        class="h-6 w-6
                               text-[#F4C542]"
                    ></i>

                </div>

            </div>

            <div
                class="mt-6 flex
                       items-center gap-2
                       text-xs font-bold
                       text-white/40
                       transition
                       group-hover:text-white"
            >

                Kelola pendaftaran

                <i
                    data-lucide="arrow-up-right"
                    class="h-4 w-4"
                ></i>

            </div>

        </a>


        {{-- PENDING --}}

        <a
            href="{{ route(
                'admin.registrations.index',
                ['status' => 'pending']
            ) }}"
            class="group rounded-2xl
                   bg-white p-6
                   shadow-sm
                   ring-1 ring-gray-100
                   transition
                   hover:-translate-y-1
                   hover:shadow-lg"
        >

            <div
                class="flex items-start
                       justify-between"
            >

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Perlu Diproses
                    </p>

                    <p
                        class="mt-3 text-4xl
                               font-black
                               text-yellow-600"
                    >
                        {{ $statistics['pending'] }}
                    </p>

                </div>


                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
                           rounded-xl
                           bg-yellow-50"
                >

                    <i
                        data-lucide="clock-3"
                        class="h-6 w-6
                               text-yellow-600"
                    ></i>

                </div>

            </div>

            <p
                class="mt-6 text-xs
                       font-bold text-gray-400
                       group-hover:text-yellow-600"
            >
                Lihat pendaftaran pending →
            </p>

        </a>


        {{-- DITERIMA --}}

        <a
            href="{{ route(
                'admin.registrations.index',
                ['status' => 'accepted']
            ) }}"
            class="group rounded-2xl
                   bg-white p-6
                   shadow-sm
                   ring-1 ring-gray-100
                   transition
                   hover:-translate-y-1
                   hover:shadow-lg"
        >

            <div
                class="flex items-start
                       justify-between"
            >

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Santri Diterima
                    </p>

                    <p
                        class="mt-3 text-4xl
                               font-black
                               text-[#087443]"
                    >
                        {{ $statistics['accepted'] }}
                    </p>

                </div>


                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
                           rounded-xl
                           bg-green-50"
                >

                    <i
                        data-lucide="badge-check"
                        class="h-6 w-6
                               text-[#087443]"
                    ></i>

                </div>

            </div>

            <p
                class="mt-6 text-xs
                       font-bold text-gray-400
                       group-hover:text-[#087443]"
            >
                Lihat santri diterima →
            </p>

        </a>


        {{-- BERITA --}}

        <div
            class="rounded-2xl
                   bg-white p-6
                   shadow-sm
                   ring-1 ring-gray-100"
        >

            <div
                class="flex items-start
                       justify-between"
            >

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Total Berita
                    </p>

                    <p
                        class="mt-3 text-4xl
                               font-black
                               text-gray-900"
                    >
                        {{ $statistics['news'] }}
                    </p>

                </div>


                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
                           rounded-xl
                           bg-[#087443]/10"
                >

                    <i
                        data-lucide="newspaper"
                        class="h-6 w-6
                               text-[#087443]"
                    ></i>

                </div>

            </div>

            <p
                class="mt-6 text-xs
                       font-bold text-gray-400"
            >
                Konten berita pesantren
            </p>

        </div>

    </div>


    {{-- MAIN CONTENT --}}

    <div
        class="grid gap-7
               xl:grid-cols-[1.4fr_1fr]"
    >

        {{-- PENDAFTAR TERBARU --}}

        <div
            class="overflow-hidden
                   rounded-2xl bg-white
                   shadow-sm
                   ring-1 ring-gray-100"
        >

            <div
                class="flex items-center
                       justify-between
                       border-b
                       border-gray-100
                       px-6 py-5"
            >

                <div>

                    <h2
                        class="font-black
                               text-gray-900"
                    >
                        Pendaftar Terbaru
                    </h2>

                    <p
                        class="mt-1 text-xs
                               text-gray-400"
                    >
                        Data pendaftaran
                        yang baru masuk.
                    </p>

                </div>


                <a
                    href="{{ route(
                        'admin.registrations.index'
                    ) }}"
                    class="text-xs
                           font-black
                           text-[#087443]
                           hover:text-[#062E1F]"
                >
                    Lihat Semua
                </a>

            </div>


            <div class="divide-y divide-gray-100">

                @forelse (
                    $latestRegistrations
                    as $registration
                )

                    <a
                        href="{{ route(
                            'admin.registrations.show',
                            $registration
                        ) }}"
                        class="flex items-center
                               gap-4 px-6 py-4
                               transition
                               hover:bg-gray-50"
                    >

                        <div
                            class="flex h-11 w-11
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#087443]/10
                                   font-black
                                   text-[#087443]"
                        >

                            {{
                                strtoupper(
                                    substr(
                                        $registration
                                            ->student_name,
                                        0,
                                        1
                                    )
                                )
                            }}

                        </div>


                        <div class="min-w-0 flex-1">

                            <p
                                class="truncate
                                       text-sm
                                       font-bold"
                            >
                                {{
                                    $registration
                                        ->student_name
                                }}
                            </p>

                            <p
                                class="mt-1
                                       truncate
                                       text-xs
                                       text-gray-400"
                            >
                                {{
                                    $registration
                                        ->registration_number
                                }}

                                ·

                                {{
                                    $registration->program
                                }}
                            </p>

                        </div>


                        @php

                            $statusClasses = [

                                'pending' =>
                                    'bg-yellow-50 text-yellow-700',

                                'processed' =>
                                    'bg-blue-50 text-blue-700',

                                'accepted' =>
                                    'bg-green-50 text-green-700',

                                'rejected' =>
                                    'bg-red-50 text-red-700',

                            ];

                            $statusLabels = [

                                'pending' =>
                                    'Pending',

                                'processed' =>
                                    'Diproses',

                                'accepted' =>
                                    'Diterima',

                                'rejected' =>
                                    'Ditolak',

                            ];

                        @endphp


                        <span
                            class="shrink-0
                                   rounded-full
                                   px-3 py-1
                                   text-[10px]
                                   font-black
                                   {{
                                       $statusClasses[
                                           $registration->status
                                       ]
                                       ??
                                       'bg-gray-100 text-gray-600'
                                   }}"
                        >
                            {{
                                $statusLabels[
                                    $registration->status
                                ]
                                ??
                                ucfirst(
                                    $registration->status
                                )
                            }}
                        </span>

                    </a>

                @empty

                    <div
                        class="px-6 py-14
                               text-center"
                    >

                        <i
                            data-lucide="users-round"
                            class="mx-auto h-8 w-8
                                   text-gray-300"
                        ></i>

                        <p
                            class="mt-3 text-sm
                                   font-bold"
                        >
                            Belum ada pendaftar
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- STATUS PENDAFTARAN --}}

        <div
            class="rounded-2xl
                   bg-[#062E1F]
                   p-6 shadow-sm"
        >

            <div>

                <p
                    class="text-xs font-bold
                           uppercase
                           tracking-widest
                           text-white/40"
                >
                    Overview
                </p>

                <h2
                    class="mt-2 text-xl
                           font-black
                           text-white"
                >
                    Status Pendaftaran
                </h2>

            </div>


            <div class="mt-8 space-y-6">

                {{-- PENDING --}}

                @php
                    $total =
                        max(
                            $statistics['registrations'],
                            1
                        );

                    $pendingPercent =
                        round(
                            (
                                $statistics['pending']
                                / $total
                            ) * 100
                        );

                    $processedPercent =
                        round(
                            (
                                $statistics['processed']
                                / $total
                            ) * 100
                        );

                    $acceptedPercent =
                        round(
                            (
                                $statistics['accepted']
                                / $total
                            ) * 100
                        );

                    $rejectedPercent =
                        round(
                            (
                                $statistics['rejected']
                                / $total
                            ) * 100
                        );
                @endphp


                <div>

                    <div
                        class="flex items-center
                               justify-between"
                    >

                        <span
                            class="text-sm
                                   font-bold
                                   text-white/70"
                        >
                            Pending
                        </span>

                        <span
                            class="text-sm
                                   font-black
                                   text-[#F4C542]"
                        >
                            {{ $statistics['pending'] }}
                        </span>

                    </div>

                    <div
                        class="mt-3 h-2
                               overflow-hidden
                               rounded-full
                               bg-white/10"
                    >

                        <div
                            class="h-full
                                   rounded-full
                                   bg-[#F4C542]"
                            style="
                                width:
                                {{ $pendingPercent }}%
                            "
                        ></div>

                    </div>

                </div>


                {{-- PROCESSED --}}

                <div>

                    <div
                        class="flex items-center
                               justify-between"
                    >

                        <span
                            class="text-sm
                                   font-bold
                                   text-white/70"
                        >
                            Diproses
                        </span>

                        <span
                            class="text-sm
                                   font-black
                                   text-blue-300"
                        >
                            {{ $statistics['processed'] }}
                        </span>

                    </div>

                    <div
                        class="mt-3 h-2
                               overflow-hidden
                               rounded-full
                               bg-white/10"
                    >

                        <div
                            class="h-full
                                   rounded-full
                                   bg-blue-400"
                            style="
                                width:
                                {{ $processedPercent }}%
                            "
                        ></div>

                    </div>

                </div>


                {{-- ACCEPTED --}}

                <div>

                    <div
                        class="flex items-center
                               justify-between"
                    >

                        <span
                            class="text-sm
                                   font-bold
                                   text-white/70"
                        >
                            Diterima
                        </span>

                        <span
                            class="text-sm
                                   font-black
                                   text-green-300"
                        >
                            {{ $statistics['accepted'] }}
                        </span>

                    </div>

                    <div
                        class="mt-3 h-2
                               overflow-hidden
                               rounded-full
                               bg-white/10"
                    >

                        <div
                            class="h-full
                                   rounded-full
                                   bg-green-400"
                            style="
                                width:
                                {{ $acceptedPercent }}%
                            "
                        ></div>

                    </div>

                </div>


                {{-- REJECTED --}}

                <div>

                    <div
                        class="flex items-center
                               justify-between"
                    >

                        <span
                            class="text-sm
                                   font-bold
                                   text-white/70"
                        >
                            Ditolak
                        </span>

                        <span
                            class="text-sm
                                   font-black
                                   text-red-300"
                        >
                            {{ $statistics['rejected'] }}
                        </span>

                    </div>

                    <div
                        class="mt-3 h-2
                               overflow-hidden
                               rounded-full
                               bg-white/10"
                    >

                        <div
                            class="h-full
                                   rounded-full
                                   bg-red-400"
                            style="
                                width:
                                {{ $rejectedPercent }}%
                            "
                        ></div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- KONTEN WEBSITE --}}

    <div
        class="grid gap-7
               lg:grid-cols-3"
    >

        {{-- BERITA --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <div
                class="flex items-center
                       justify-between"
            >

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Konten
                    </p>

                    <h2
                        class="mt-1 font-black"
                    >
                        Berita Terbaru
                    </h2>

                </div>

                <i
                    data-lucide="newspaper"
                    class="h-5 w-5
                           text-[#087443]"
                ></i>

            </div>


            <div
                class="mt-5 space-y-4"
            >

                @forelse (
                    $latestNews
                    as $news
                )

                    <div
                        class="border-b
                               border-gray-100
                               pb-4 last:border-0
                               last:pb-0"
                    >

                        <p
                            class="line-clamp-2
                                   text-sm
                                   font-bold"
                        >
                            {{ $news->title }}
                        </p>

                        <p
                            class="mt-1 text-xs
                                   text-gray-400"
                        >
                            {{
                                $news->created_at
                                    ->diffForHumans()
                            }}
                        </p>

                    </div>

                @empty

                    <p
                        class="py-5 text-center
                               text-sm
                               text-gray-400"
                    >
                        Belum ada berita.
                    </p>

                @endforelse

            </div>

        </div>


        {{-- PENGUMUMAN --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <div
                class="flex items-center
                       justify-between"
            >

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Informasi
                    </p>

                    <h2
                        class="mt-1 font-black"
                    >
                        Pengumuman
                    </h2>

                </div>

                <i
                    data-lucide="megaphone"
                    class="h-5 w-5
                           text-[#087443]"
                ></i>

            </div>


            <div class="mt-5 space-y-4">

                @forelse (
                    $latestAnnouncements
                    as $announcement
                )

                    <div
                        class="border-b
                               border-gray-100
                               pb-4 last:border-0
                               last:pb-0"
                    >

                        <p
                            class="line-clamp-2
                                   text-sm
                                   font-bold"
                        >
                            {{ $announcement->title }}
                        </p>

                        <p
                            class="mt-1 text-xs
                                   text-gray-400"
                        >
                            {{
                                $announcement
                                    ->created_at
                                    ->diffForHumans()
                            }}
                        </p>

                    </div>

                @empty

                    <p
                        class="py-5 text-center
                               text-sm
                               text-gray-400"
                    >
                        Belum ada pengumuman.
                    </p>

                @endforelse

            </div>

        </div>


        {{-- EVENT --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <div
                class="flex items-center
                       justify-between"
            >

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Agenda
                    </p>

                    <h2
                        class="mt-1 font-black"
                    >
                        Event Mendatang
                    </h2>

                </div>

                <i
                    data-lucide="calendar-days"
                    class="h-5 w-5
                           text-[#087443]"
                ></i>

            </div>


            <div class="mt-5 space-y-4">

                @forelse (
                    $upcomingEvents
                    as $event
                )

                    <div
                        class="flex gap-3
                               border-b
                               border-gray-100
                               pb-4
                               last:border-0
                               last:pb-0"
                    >

                        <div
                            class="flex h-10 w-10
                                   shrink-0
                                   flex-col
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#087443]/10"
                        >

                            <span
                                class="text-[9px]
                                       font-bold
                                       uppercase
                                       text-[#087443]"
                            >
                                {{
                                    $event->start_at
                                        ->format('M')
                                }}
                            </span>

                            <span
                                class="text-sm
                                       font-black
                                       text-[#087443]"
                            >
                                {{
                                    $event->start_at
                                        ->format('d')
                                }}
                            </span>

                        </div>


                        <div class="min-w-0">

                            <p
                                class="line-clamp-2
                                       text-sm
                                       font-bold"
                            >
                                {{ $event->title }}
                            </p>

                            <p
                                class="mt-1
                                       text-xs
                                       text-gray-400"
                            >
                                {{ $event->location }}
                            </p>

                        </div>

                    </div>

                @empty

                    <p
                        class="py-5 text-center
                               text-sm
                               text-gray-400"
                    >
                        Belum ada event mendatang.
                    </p>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection