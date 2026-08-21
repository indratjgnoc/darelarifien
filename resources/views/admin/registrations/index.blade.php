@extends('layouts.admin')

@section('title', 'Pendaftaran Santri')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}

    <div
        class="flex flex-col gap-4
               lg:flex-row
               lg:items-center
               lg:justify-between"
    >

        <div>

            <p
                class="text-xs font-black
                       uppercase tracking-widest
                       text-[#087443]"
            >
                Manajemen Pendaftaran
            </p>

            <h1
                class="mt-2 text-3xl
                       font-black text-gray-900"
            >
                Pendaftaran Santri
            </h1>

            <p
                class="mt-2 text-sm
                       text-gray-500"
            >
                Kelola data calon santri
                yang masuk melalui website.
            </p>

        </div>

    </div>


    {{-- SUCCESS --}}

    @if (session('success'))

        <div
            class="flex items-center gap-3
                   rounded-2xl
                   border border-green-200
                   bg-green-50 px-5 py-4
                   text-sm font-semibold
                   text-green-700"
        >

            <i
                data-lucide="check-circle"
                class="h-5 w-5"
            ></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- STATISTICS --}}

    <div
        class="grid gap-5
               sm:grid-cols-2
               xl:grid-cols-5"
    >

        {{-- TOTAL --}}

        <div
            class="rounded-2xl bg-white
                   p-5 shadow-sm
                   ring-1 ring-gray-100"
        >

            <div class="flex items-center
                        justify-between">

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Total
                    </p>

                    <p
                        class="mt-2 text-3xl
                               font-black"
                    >
                        {{ $statistics['total'] }}
                    </p>

                </div>

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-gray-100"
                >

                    <i
                        data-lucide="users"
                        class="h-5 w-5
                               text-gray-600"
                    ></i>

                </div>

            </div>

        </div>


        {{-- PENDING --}}

        <div
            class="rounded-2xl bg-white
                   p-5 shadow-sm
                   ring-1 ring-gray-100"
        >

            <div class="flex items-center
                        justify-between">

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Pending
                    </p>

                    <p
                        class="mt-2 text-3xl
                               font-black
                               text-yellow-600"
                    >
                        {{ $statistics['pending'] }}
                    </p>

                </div>

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-yellow-50"
                >

                    <i
                        data-lucide="clock-3"
                        class="h-5 w-5
                               text-yellow-600"
                    ></i>

                </div>

            </div>

        </div>


        {{-- PROCESSED --}}

        <div
            class="rounded-2xl bg-white
                   p-5 shadow-sm
                   ring-1 ring-gray-100"
        >

            <div class="flex items-center
                        justify-between">

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Diproses
                    </p>

                    <p
                        class="mt-2 text-3xl
                               font-black
                               text-blue-600"
                    >
                        {{ $statistics['processed'] }}
                    </p>

                </div>

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-blue-50"
                >

                    <i
                        data-lucide="loader-circle"
                        class="h-5 w-5
                               text-blue-600"
                    ></i>

                </div>

            </div>

        </div>


        {{-- ACCEPTED --}}

        <div
            class="rounded-2xl bg-white
                   p-5 shadow-sm
                   ring-1 ring-gray-100"
        >

            <div class="flex items-center
                        justify-between">

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Diterima
                    </p>

                    <p
                        class="mt-2 text-3xl
                               font-black
                               text-[#087443]"
                    >
                        {{ $statistics['accepted'] }}
                    </p>

                </div>

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-green-50"
                >

                    <i
                        data-lucide="circle-check"
                        class="h-5 w-5
                               text-[#087443]"
                    ></i>

                </div>

            </div>

        </div>


        {{-- REJECTED --}}

        <div
            class="rounded-2xl bg-white
                   p-5 shadow-sm
                   ring-1 ring-gray-100"
        >

            <div class="flex items-center
                        justify-between">

                <div>

                    <p
                        class="text-xs font-bold
                               uppercase
                               tracking-wider
                               text-gray-400"
                    >
                        Ditolak
                    </p>

                    <p
                        class="mt-2 text-3xl
                               font-black
                               text-red-600"
                    >
                        {{ $statistics['rejected'] }}
                    </p>

                </div>

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-red-50"
                >

                    <i
                        data-lucide="circle-x"
                        class="h-5 w-5
                               text-red-600"
                    ></i>

                </div>

            </div>

        </div>

    </div>


    {{-- FILTER --}}

    <div
        class="rounded-2xl bg-white
               p-5 shadow-sm
               ring-1 ring-gray-100"
    >

        <form
            method="GET"
            action="{{ route(
                'admin.registrations.index'
            ) }}"
            class="grid gap-4
                   md:grid-cols-[1fr_220px_auto]"
        >

            <div class="relative">

                <i
                    data-lucide="search"
                    class="absolute left-4 top-1/2
                           h-5 w-5
                           -translate-y-1/2
                           text-gray-400"
                ></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama, nomor pendaftaran..."
                    class="w-full rounded-xl
                           border border-gray-200
                           bg-gray-50
                           py-3 pl-11 pr-4
                           text-sm outline-none
                           focus:border-[#087443]"
                >

            </div>


            <select
                name="status"
                class="rounded-xl
                       border border-gray-200
                       bg-gray-50
                       px-4 py-3
                       text-sm outline-none
                       focus:border-[#087443]"
            >

                <option value="">
                    Semua Status
                </option>

                <option
                    value="pending"
                    @selected(
                        request('status') === 'pending'
                    )
                >
                    Pending
                </option>

                <option
                    value="processed"
                    @selected(
                        request('status') === 'processed'
                    )
                >
                    Diproses
                </option>

                <option
                    value="accepted"
                    @selected(
                        request('status') === 'accepted'
                    )
                >
                    Diterima
                </option>

                <option
                    value="rejected"
                    @selected(
                        request('status') === 'rejected'
                    )
                >
                    Ditolak
                </option>

            </select>


            <button
                type="submit"
                class="rounded-xl
                       bg-[#087443]
                       px-6 py-3
                       text-sm font-black
                       text-white
                       transition
                       hover:bg-[#062E1F]"
            >
                Filter
            </button>

        </form>

    </div>


    {{-- TABLE --}}

    <div
        class="overflow-hidden
               rounded-2xl bg-white
               shadow-sm
               ring-1 ring-gray-100"
    >

        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px]">

                <thead
                    class="border-b
                           border-gray-100
                           bg-gray-50"
                >

                    <tr>

                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Pendaftar
                        </th>

                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Nomor
                        </th>

                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Program
                        </th>

                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Status
                        </th>

                        <th
                            class="px-6 py-4
                                   text-right
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody
                    class="divide-y
                           divide-gray-100"
                >

                    @forelse (
                        $registrations
                        as $registration
                    )

                        <tr
                            class="transition
                                   hover:bg-gray-50"
                        >

                            {{-- NAMA --}}

                            <td class="px-6 py-5">

                                <div>

                                    <p
                                        class="font-bold
                                               text-gray-900"
                                    >
                                        {{
                                            $registration
                                                ->student_name
                                        }}
                                    </p>

                                    <p
                                        class="mt-1
                                               text-xs
                                               text-gray-400"
                                    >
                                        {{
                                            $registration
                                                ->parent_name
                                        }}
                                    </p>

                                </div>

                            </td>


                            {{-- NOMOR --}}

                            <td class="px-6 py-5">

                                <span
                                    class="font-mono
                                           text-sm
                                           font-bold
                                           text-[#087443]"
                                >
                                    {{
                                        $registration
                                            ->registration_number
                                    }}
                                </span>

                            </td>


                            {{-- PROGRAM --}}

                            <td
                                class="px-6 py-5
                                       text-sm
                                       text-gray-600"
                            >
                                {{
                                    $registration->program
                                }}
                            </td>


                            {{-- STATUS --}}

                            <td class="px-6 py-5">

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
                                    class="inline-flex
                                           rounded-full
                                           px-3 py-1
                                           text-xs font-bold
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

                            </td>


                            {{-- AKSI --}}

                            <td class="px-6 py-5">

                                <div
                                    class="flex
                                           justify-end
                                           gap-2"
                                >

                                    <a
                                        href="{{
                                            route(
                                                'admin.registrations.show',
                                                $registration
                                            )
                                        }}"
                                        class="flex h-9 w-9
                                               items-center
                                               justify-center
                                               rounded-lg
                                               bg-gray-100
                                               text-gray-600
                                               transition
                                               hover:bg-[#087443]
                                               hover:text-white"
                                        title="Detail"
                                    >

                                        <i
                                            data-lucide="eye"
                                            class="h-4 w-4"
                                        ></i>

                                    </a>


                                    @if ($registration->document)

                                        <a
                                            href="{{
                                                route(
                                                    'admin.registrations.document',
                                                    $registration
                                                )
                                            }}"
                                            class="flex h-9 w-9
                                                   items-center
                                                   justify-center
                                                   rounded-lg
                                                   bg-yellow-50
                                                   text-yellow-700
                                                   transition
                                                   hover:bg-[#F4C542]
                                                   hover:text-[#062E1F]"
                                            title="Download dokumen"
                                        >

                                            <i
                                                data-lucide="download"
                                                class="h-4 w-4"
                                            ></i>

                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-16
                                       text-center"
                            >

                                <div
                                    class="mx-auto flex
                                           h-14 w-14
                                           items-center
                                           justify-center
                                           rounded-2xl
                                           bg-gray-100"
                                >

                                    <i
                                        data-lucide="inbox"
                                        class="h-7 w-7
                                               text-gray-400"
                                    ></i>

                                </div>

                                <p
                                    class="mt-4
                                           font-bold"
                                >
                                    Belum ada pendaftaran
                                </p>

                                <p
                                    class="mt-1
                                           text-sm
                                           text-gray-400"
                                >
                                    Data calon santri
                                    akan muncul di sini.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        @if ($registrations->hasPages())

            <div
                class="border-t
                       border-gray-100
                       px-6 py-4"
            >

                {{ $registrations->links() }}

            </div>

        @endif

    </div>

</div>

@endsection