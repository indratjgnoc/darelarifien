@extends('layouts.app')

@section('title', 'Pengasuh Pesantren')

@section('content')

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-[#062E1F]">

        <div class="absolute -right-20 -top-20
                    h-72 w-72 rounded-full
                    bg-[#F4C542]/20 blur-3xl">
        </div>

        <div class="relative mx-auto max-w-7xl
                    px-5 py-20 lg:px-8">

            <p class="text-xs font-black uppercase
                      tracking-[0.25em] text-[#F4C542]">
                Pendidik & Pembina
            </p>

            <h1 class="mt-4 text-4xl font-black
                       leading-tight text-white
                       sm:text-5xl">
                Pengasuh Pesantren
            </h1>

            <p class="mt-5 max-w-2xl text-base
                      leading-7 text-white/60">
                Para pengasuh dan pendidik yang membersamai
                santri dalam perjalanan ilmu, akhlak,
                dan pembentukan karakter.
            </p>

        </div>

    </section>


    {{-- TEACHERS --}}
    <section class="bg-[#F5F7F6]">

        <div class="mx-auto max-w-7xl
                    px-5 py-16 lg:px-8">

            @if ($teachers->count())

                <div class="grid gap-7
                            sm:grid-cols-2
                            lg:grid-cols-4">

                    @foreach ($teachers as $teacher)

                        <article
                            class="group overflow-hidden
                                   rounded-3xl
                                   border border-gray-200
                                   bg-white
                                   shadow-sm
                                   transition duration-300
                                   hover:-translate-y-1
                                   hover:border-[#F4C542]
                                   hover:shadow-xl"
                        >

                            {{-- PHOTO --}}
                            <div class="relative h-72
                                        overflow-hidden
                                        bg-[#062E1F]">

                                @if ($teacher->photo)

                                    <img
                                        src="{{ asset(
                                            'storage/' . $teacher->photo
                                        ) }}"
                                        alt="{{ $teacher->name }}"
                                        class="h-full w-full
                                               object-cover
                                               transition duration-500
                                               group-hover:scale-105"
                                    >

                                @else

                                    <div
                                        class="flex h-full
                                               items-center
                                               justify-center"
                                    >

                                        <i
                                            data-lucide="user-round"
                                            class="h-20 w-20
                                                   text-[#F4C542]"
                                        ></i>

                                    </div>

                                @endif

                            </div>


                            {{-- DATA --}}
                            <div class="p-6">

                                <h2 class="text-lg font-black
                                           text-gray-900">
                                    {{ $teacher->name }}
                                </h2>

                                @if ($teacher->position)

                                    <p class="mt-1 text-sm font-bold
                                              text-[#087F5B]">
                                        {{ $teacher->position }}
                                    </p>

                                @endif

                                @if ($teacher->education)

                                    <p class="mt-4 text-sm
                                              leading-6 text-gray-500">
                                        {{ $teacher->education }}
                                    </p>

                                @endif

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="rounded-3xl border
                            border-gray-200 bg-white
                            px-6 py-16 text-center">

                    <i
                        data-lucide="users-round"
                        class="mx-auto h-12 w-12
                               text-gray-300"
                    ></i>

                    <h2 class="mt-5 text-xl
                               font-black text-gray-800">
                        Data pengasuh belum tersedia
                    </h2>

                </div>

            @endif

        </div>

    </section>

@endsection