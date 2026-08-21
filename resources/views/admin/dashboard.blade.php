@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}

    <div>

        <p
            class="text-sm font-semibold
                   uppercase tracking-wider
                   text-[#087443]"
        >
            Dashboard Overview
        </p>

        <h1
            class="mt-1 text-3xl font-black
                   text-[#111111]"
        >
            Assalamu'alaikum,
            {{ auth()->user()->name }} 👋
        </h1>

        <p class="mt-2 text-gray-500">
            Pantau dan kelola seluruh informasi
            Pesantren Darel Arifien dari sini.
        </p>

    </div>


    {{-- STATISTICS --}}

    <div
        class="grid gap-5
               sm:grid-cols-2
               xl:grid-cols-4"
    >

        {{-- Berita --}}

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

                    <p class="text-sm text-gray-500">
                        Total Berita
                    </p>

                    <h2
                        class="mt-2 text-3xl
                               font-black"
                    >
                        {{ $stats['news'] }}
                    </h2>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-xl
                           bg-[#087443]/10
                           text-[#087443]"
                >

                    <i
                        data-lucide="newspaper"
                        class="h-6 w-6"
                    ></i>

                </div>

            </div>

        </div>


        {{-- Program --}}

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

                    <p class="text-sm text-gray-500">
                        Program Pendidikan
                    </p>

                    <h2
                        class="mt-2 text-3xl
                               font-black"
                    >
                        {{ $stats['programs'] }}
                    </h2>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-xl
                           bg-[#F4C542]/20
                           text-[#9A7500]"
                >

                    <i
                        data-lucide="graduation-cap"
                        class="h-6 w-6"
                    ></i>

                </div>

            </div>

        </div>


        {{-- Guru --}}

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

                    <p class="text-sm text-gray-500">
                        Ustadz & Ustadzah
                    </p>

                    <h2
                        class="mt-2 text-3xl
                               font-black"
                    >
                        {{ $stats['teachers'] }}
                    </h2>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-xl
                           bg-black/5
                           text-black"
                >

                    <i
                        data-lucide="users"
                        class="h-6 w-6"
                    ></i>

                </div>

            </div>

        </div>


        {{-- Pendaftar --}}

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

                    <p class="text-sm text-gray-500">
                        Calon Santri 
                    </p>

                    <h2
                        class="mt-2 text-3xl
                               font-black"
                    >
                        {{ $stats['registrations'] }}
                    </h2>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center justify-center
                           rounded-xl
                           bg-[#087443]/10
                           text-[#087443]"
                >

                    <i
                        data-lucide="user-plus"
                        class="h-6 w-6"
                    ></i>

                </div>

            </div>

        </div>

    </div>


    {{-- CHART + QUICK ACTION --}}

    <div
        class="grid gap-6
               lg:grid-cols-3"
    >

        {{-- Chart --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100
                   lg:col-span-2"
        >

            <div
                class="mb-6 flex items-center
                       justify-between"
            >

                <div>

                    <h2
                        class="text-lg font-black"
                    >
                        Pendaftaran Santri
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-gray-500"
                    >
                        Statistik pendaftaran
                        tahun {{ now()->year }}
                    </p>

                </div>

            </div>

            <div class="h-72">

                <canvas id="registrationChart"></canvas>

            </div>

        </div>


        {{-- Quick Action --}}

        <div
            class="rounded-2xl
                   bg-[#062E1F]
                   p-6 text-white
                   shadow-sm"
        >

            <p
                class="text-xs font-bold
                       uppercase tracking-widest
                       text-[#F4C542]"
            >
                Quick Action
            </p>

            <h2
                class="mt-3 text-xl font-black"
            >
                Kelola Website
            </h2>

            <p
                class="mt-2 text-sm
                       leading-relaxed
                       text-white/60"
            >
                Akses menu pengelolaan
                website dengan cepat.
            </p>


            <div class="mt-6 space-y-3">

                <a
                    href="#"
                    class="flex items-center
                           justify-between
                           rounded-xl
                           bg-white/5
                           px-4 py-3
                           transition
                           hover:bg-white/10"
                >

                    <span class="text-sm font-semibold">
                        Tambah Berita
                    </span>

                    <i
                        data-lucide="arrow-up-right"
                        class="h-4 w-4
                               text-[#F4C542]"
                    ></i>

                </a>


                <a
                    href="#"
                    class="flex items-center
                           justify-between
                           rounded-xl
                           bg-white/5
                           px-4 py-3
                           transition
                           hover:bg-white/10"
                >

                    <span class="text-sm font-semibold">
                        Tambah Program
                    </span>

                    <i
                        data-lucide="arrow-up-right"
                        class="h-4 w-4
                               text-[#F4C542]"
                    ></i>

                </a>


                <a
                    href="#"
                    class="flex items-center
                           justify-between
                           rounded-xl
                           bg-white/5
                           px-4 py-3
                           transition
                           hover:bg-white/10"
                >

                    <span class="text-sm font-semibold">
                        Lihat Pendaftar
                    </span>

                    <i
                        data-lucide="arrow-up-right"
                        class="h-4 w-4
                               text-[#F4C542]"
                    ></i>

                </a>

            </div>

        </div>

    </div>


    {{-- TABLES --}}

    <div
        class="grid gap-6
               xl:grid-cols-2"
    >

        {{-- Latest News --}}

        <div
            class="overflow-hidden
                   rounded-2xl bg-white
                   shadow-sm
                   ring-1 ring-gray-100"
        >

            <div
                class="flex items-center
                       justify-between
                       border-b border-gray-100
                       px-6 py-5"
            >

                <div>

                    <h2 class="font-black">
                        Berita Terbaru
                    </h2>

                    <p
                        class="mt-1 text-xs
                               text-gray-400"
                    >
                        Konten berita terbaru
                    </p>

                </div>

                <a
                    href="#"
                    class="text-sm font-semibold
                           text-[#087443]"
                >
                    Lihat semua
                </a>

            </div>


            <div class="divide-y divide-gray-100">

                @forelse ($latestNews as $news)

                    <div
                        class="flex items-center
                               gap-4 px-6 py-4"
                    >

                        <div
                            class="flex h-10 w-10
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-lg
                                   bg-[#087443]/10
                                   text-[#087443]"
                        >

                            <i
                                data-lucide="newspaper"
                                class="h-5 w-5"
                            ></i>

                        </div>

                        <div class="min-w-0">

                            <p
                                class="truncate
                                       text-sm
                                       font-semibold"
                            >
                                {{ $news->title }}
                            </p>

                            <p
                                class="mt-1 text-xs
                                       text-gray-400"
                            >
                                {{ $news->created_at->format('d M Y') }}
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-10 text-center">

                        <p class="text-sm text-gray-400">
                            Belum ada berita.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- Latest Registrations --}}

        <div
            class="overflow-hidden
                   rounded-2xl bg-white
                   shadow-sm
                   ring-1 ring-gray-100"
        >

            <div
                class="flex items-center
                       justify-between
                       border-b border-gray-100
                       px-6 py-5"
            >

                <div>

                    <h2 class="font-black">
                        Pendaftar Terbaru
                    </h2>

                    <p
                        class="mt-1 text-xs
                               text-gray-400"
                    >
                        Calon santri terbaru
                    </p>

                </div>

                <a
                    href="#"
                    class="text-sm font-semibold
                           text-[#087443]"
                >
                    Lihat semua
                </a>

            </div>


            <div class="divide-y divide-gray-100">

                @forelse ($latestRegistrations as $registration)

                    <div
                        class="flex items-center
                               gap-4 px-6 py-4"
                    >

                        <div
                            class="flex h-10 w-10
                                   shrink-0
                                   items-center
                                   justify-center
                                   rounded-full
                                   bg-[#F4C542]
                                   font-bold
                                   text-[#111111]"
                        >
                            {{ strtoupper(
                                substr($registration->student_name, 0, 1)
                            ) }}
                        </div>

                        <div class="min-w-0 flex-1">

                            <p
                                class="truncate
                                       text-sm
                                       font-semibold"
                            >
                                {{ $registration->student_name }}
                            </p>

                            <p
                                class="mt-1 text-xs
                                       text-gray-400"
                            >
                                {{ $registration->program }}
                            </p>

                        </div>

                        <span
                            class="rounded-full
                                   bg-[#087443]/10
                                   px-3 py-1
                                   text-xs font-semibold
                                   text-[#087443]"
                        >
                            {{ $registration->status }}
                        </span>

                    </div>

                @empty

                    <div class="px-6 py-10 text-center">

                        <p class="text-sm text-gray-400">
                            Belum ada pendaftar.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const chartLabels = @json($chartLabels);
    const chartData = @json($chartData);

    const ctx = document
        .getElementById('registrationChart');

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: chartLabels,

            datasets: [{

                label: 'Pendaftar',

                data: chartData,

                borderColor: '#087443',

                backgroundColor: 'rgba(8, 116, 67, 0.10)',

                borderWidth: 3,

                fill: true,

                tension: 0.4,

                pointRadius: 4,

                pointHoverRadius: 6

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    }

                }

            }

        }

    });

</script>

@endpush