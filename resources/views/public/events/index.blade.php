@extends('layouts.public')

@section('title', 'Agenda Pesantren')

@section('content')

<section class="bg-[#062E1F] py-20">

    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        <p
            class="text-sm font-black uppercase
                   tracking-widest text-[#F4C542]"
        >
            Kegiatan
        </p>

        <h1
            class="mt-3 text-4xl font-black
                   text-white sm:text-5xl"
        >
            Agenda Pesantren
        </h1>

        <p
            class="mt-5 max-w-2xl
                   leading-8 text-white/50"
        >
            Lihat berbagai kegiatan dan agenda
            yang dilaksanakan di Pesantren
            Darel Arifien.
        </p>

    </div>

</section>


<section class="bg-[#F5F7F6] py-20">

    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        @if ($events->count())

            <div
                class="grid gap-7
                       md:grid-cols-2
                       lg:grid-cols-3"
            >

                @foreach ($events as $event)

                    <article
                        class="group overflow-hidden
                               rounded-2xl bg-white
                               shadow-sm
                               ring-1 ring-gray-100
                               transition
                               hover:-translate-y-1
                               hover:shadow-xl"
                    >

                        {{-- IMAGE --}}

                        <a
                            href="{{ route(
                                'events.show',
                                $event->slug
                            ) }}"
                        >

                            <div
                                class="aspect-[16/10]
                                       overflow-hidden
                                       bg-[#062E1F]"
                            >

                                @if ($event->image)

                                    <img
                                        src="{{ asset(
                                            'storage/' .
                                            $event->image
                                        ) }}"
                                        alt="{{ $event->title }}"
                                        class="h-full w-full
                                               object-cover
                                               transition
                                               duration-500
                                               group-hover:scale-105"
                                    >

                                @else

                                    <div
                                        class="flex h-full
                                               items-center
                                               justify-center"
                                    >

                                        <i
                                            data-lucide="calendar-days"
                                            class="h-14 w-14
                                                   text-[#F4C542]"
                                        ></i>

                                    </div>

                                @endif

                            </div>

                        </a>


                        {{-- CONTENT --}}

                        <div class="p-6">

                            {{-- DATE --}}

                            @if ($event->start_at)

                                <div
                                    class="flex items-center
                                           gap-3"
                                >

                                    <div
                                        class="flex h-12 w-12
                                               shrink-0
                                               flex-col
                                               items-center
                                               justify-center
                                               rounded-xl
                                               bg-[#087443]
                                               text-white"
                                    >

                                        <span
                                            class="text-lg
                                                   font-black
                                                   leading-none"
                                        >
                                            {{ $event->start_at->format('d') }}
                                        </span>

                                        <span
                                            class="mt-1 text-[9px]
                                                   font-bold
                                                   uppercase"
                                        >
                                            {{ $event->start_at->format('M') }}
                                        </span>

                                    </div>


                                    <div>

                                        <p
                                            class="text-xs
                                                   font-semibold
                                                   text-gray-400"
                                        >
                                            {{ $event->start_at->format('l, d F Y') }}
                                        </p>


                                        <p
                                            class="mt-1 text-xs
                                                   font-semibold
                                                   text-gray-400"
                                        >
                                            {{ $event->start_at->format('H:i') }}
                                            WIB
                                        </p>

                                    </div>

                                </div>

                            @endif


                            <h2
                                class="mt-6 text-xl
                                       font-black
                                       leading-7
                                       transition
                                       group-hover:text-[#087443]"
                            >

                                <a
                                    href="{{ route(
                                        'events.show',
                                        $event->slug
                                    ) }}"
                                >
                                    {{ $event->title }}
                                </a>

                            </h2>


                            @if ($event->location)

                                <div
                                    class="mt-3 flex
                                           items-center
                                           gap-2 text-sm
                                           text-gray-500"
                                >

                                    <i
                                        data-lucide="map-pin"
                                        class="h-4 w-4
                                               text-[#087443]"
                                    ></i>

                                    <span>
                                        {{ $event->location }}
                                    </span>

                                </div>

                            @endif


                            <p
                                class="mt-4 line-clamp-3
                                       text-sm leading-7
                                       text-gray-500"
                            >
                                {{ $event->description }}
                            </p>


                            <a
                                href="{{ route(
                                    'events.show',
                                    $event->slug
                                ) }}"
                                class="mt-5 inline-flex
                                       items-center gap-2
                                       text-sm font-black
                                       text-[#087443]"
                            >

                                Lihat Detail

                                <i
                                    data-lucide="arrow-right"
                                    class="h-4 w-4"
                                ></i>

                            </a>

                        </div>

                    </article>

                @endforeach

            </div>


            <div class="mt-12">

                {{ $events->links() }}

            </div>

        @else

            <div
                class="rounded-2xl bg-white
                       p-12 text-center"
            >

                <i
                    data-lucide="calendar-x"
                    class="mx-auto h-12 w-12
                           text-gray-300"
                ></i>

                <p
                    class="mt-5 font-semibold
                           text-gray-500"
                >
                    Belum ada agenda yang tersedia.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection