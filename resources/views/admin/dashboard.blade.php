@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1
            class="text-3xl font-black
                   text-[#111111]"
        >
            Assalamu'alaikum,
            {{ auth()->user()->name }} 👋
        </h1>

        <p class="mt-2 text-gray-500">
            Selamat datang di pusat pengelolaan
            website Pesantren Darel Arifien.
        </p>

    </div>


    {{-- Statistics --}}
    <div
        class="grid gap-5
               sm:grid-cols-2
               xl:grid-cols-4"
    >

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
                        Berita
                    </p>

                    <h3
                        class="mt-2 text-3xl
                               font-black"
                    >
                        0
                    </h3>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
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
                        Galeri
                    </p>

                    <h3
                        class="mt-2 text-3xl
                               font-black"
                    >
                        0
                    </h3>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
                           rounded-xl
                           bg-[#F4C542]/20
                           text-[#9A7500]"
                >

                    <i
                        data-lucide="images"
                        class="h-6 w-6"
                    ></i>

                </div>

            </div>

        </div>


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
                        Program
                    </p>

                    <h3
                        class="mt-2 text-3xl
                               font-black"
                    >
                        0
                    </h3>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
                           rounded-xl
                           bg-black/5
                           text-black"
                >

                    <i
                        data-lucide="graduation-cap"
                        class="h-6 w-6"
                    ></i>

                </div>

            </div>

        </div>


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
                        Pendaftar
                    </p>

                    <h3
                        class="mt-2 text-3xl
                               font-black"
                    >
                        0
                    </h3>

                </div>

                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
                           rounded-xl
                           bg-[#087443]/10
                           text-[#087443]"
                >

                    <i
                        data-lucide="users"
                        class="h-6 w-6"
                    ></i>

                </div>

            </div>

        </div>

    </div>


    {{-- Welcome Card --}}
    <div
        class="overflow-hidden
               rounded-3xl
               bg-[#062E1F]
               p-8 text-white
               shadow-xl"
    >

        <div class="max-w-2xl">

            <p
                class="text-sm font-semibold
                       uppercase tracking-widest
                       text-[#F4C542]"
            >
                Pesantren Darel Arifien
            </p>

            <h2
                class="mt-3 text-3xl
                       font-black"
            >
                Pusat Pengelolaan Website
            </h2>

            <p
                class="mt-4 leading-relaxed
                       text-white/60"
            >
                Kelola informasi pesantren,
                berita, program pendidikan,
                galeri, agenda kegiatan,
                dan pendaftaran calon santri
                melalui satu dashboard.
            </p>

        </div>

    </div>

</div>

@endsection