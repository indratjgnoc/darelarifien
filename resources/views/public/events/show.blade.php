@extends('layouts.public')

@section('title', $event->title)

@section('content')

<section class="bg-[#062E1F] py-16">

    <div class="mx-auto max-w-5xl px-5 lg:px-8">

        <a
            href="{{ route('events.index') }}"
            class="inline-flex items-center
                   gap-2 text-sm font-semibold
                   text-white/60
                   transition
                   hover:text-[#F4C542]"
        >

            <i
                data-lucide="arrow-left"
                class="h-4 w-4"
            ></i>

            Kembali ke Agenda

        </a>


        <div class="mt-10">

            <div
                class="inline-flex h-14 w-14
                       items-center justify-center
                       rounded-2xl
                       bg-[#F4C542]
                       text-[#062E1F]"
            >

                <i
                    data-lucide="calendar-days"
                    class="h-7 w-7"
                ></i>

            </div>


            <h1
                class="mt-7 text-4xl
                       font-black leading-tight
                       text-white sm:text-5xl"
            >
                {{ $event->title }}
            </h1>


            @if ($event->start_at)

                <div
                    class="mt-7 flex flex-wrap
                           gap-5 text-sm
                           text-white/50"
                >

                    <div class="flex items-center gap-2">

                        <i
                            data-lucide="calendar"
                            class="h-4 w-4
                                   text-[#F4C542]"
                        ></i>

                        {{ $event->start_at->format('d F Y') }}

                    </div>


                    <div class="flex items-center gap-2">

                        <i
                            data-lucide="clock"
                            class="h-4 w-4
                                   text-[#F4C542]"
                        ></i>

                        {{ $event->start_at->format('H:i') }}
                        WIB

                    </div>

                </div>

            @endif


            @if ($event->location)

                <div
                    class="mt-4 flex items-center
                           gap-2 text-sm
                           text-white/50"
                >

                    <i
                        data-lucide="map-pin"
                        class="h-4 w-4
                               text-[#F4C542]"
                    ></i>

                    {{ $event->location }}

                </div>

            @endif

        </div>

    </div>

</section>


<section class="bg-white py-16">

    <div class="mx-auto max-w-5xl px-5 lg:px-8">

        @if ($event->image)

            <div
                class="overflow-hidden
                       rounded-3xl"
            >

                <img
                    src="{{ asset(
                        'storage/' . $event->image
                    ) }}"
                    alt="{{ $event->title }}"
                    class="max-h-[600px] w-full
                           object-cover"
                >

            </div>

        @endif


        <div
            class="mt-12
                   grid gap-10
                   lg:grid-cols-[1fr_280px]"
        >

            {{-- DESCRIPTION --}}

            <div>

                <h2
                    class="text-2xl font-black"
                >
                    Tentang Kegiatan
                </h2>


                <div
                    class="mt-6 text-base
                           leading-8 text-gray-700"
                >

                    {!! nl2br(
                        e($event->description)
                    ) !!}

                </div>

            </div>


            {{-- INFO CARD --}}

            <aside>

                <div
                    class="rounded-2xl
                           bg-[#F5F7F6]
                           p-6"
                >

                    <p
                        class="text-xs
                               font-black
                               uppercase
                               tracking-widest
                               text-[#087443]"
                    >
                        Informasi
                    </p>


                    @if ($event->start_at)

                        <div class="mt-5">

                            <p
                                class="text-xs
                                       text-gray-400"
                            >
                                Mulai
                            </p>

                            <p
                                class="mt-1
                                       font-bold"
                            >
                                {{ $event->start_at->format('d F Y, H:i') }}
                            </p>

                        </div>

                    @endif


                    @if ($event->end_at)

                        <div class="mt-5">

                            <p
                                class="text-xs
                                       text-gray-400"
                            >
                                Selesai
                            </p>

                            <p
                                class="mt-1
                                       font-bold"
                            >
                                {{ $event->end_at->format('d F Y, H:i') }}
                            </p>

                        </div>

                    @endif


                    @if ($event->location)

                        <div class="mt-5">

                            <p
                                class="text-xs
                                       text-gray-400"
                            >
                                Lokasi
                            </p>

                            <p
                                class="mt-1 font-bold"
                            >
                                {{ $event->location }}
                            </p>

                        </div>

                    @endif

                </div>

            </aside>

        </div>

    </div>

</section>

@endsection