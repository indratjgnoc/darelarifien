@extends('layouts.admin')

@section('title', 'Agenda & Event')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div
        class="flex flex-col gap-4
               sm:flex-row
               sm:items-center
               sm:justify-between"
    >

        <div>

            <p
                class="text-sm font-semibold
                       uppercase tracking-wider
                       text-[#087443]"
            >
                Content Management
            </p>

            <h1
                class="mt-1 text-3xl
                       font-black text-[#111111]"
            >
                Agenda & Event
            </h1>

            <p class="mt-2 text-gray-500">
                Kelola kegiatan dan agenda
                Pesantren {{ $settings['school_name'] ?? '' }}.
            </p>

        </div>

        <a
            href="{{ route('admin.events.create') }}"
            class="inline-flex items-center
                   justify-center gap-2
                   rounded-xl
                   bg-[#087443]
                   px-5 py-3
                   font-bold text-white
                   shadow-lg
                   transition
                   hover:bg-[#062E1F]"
        >

            <i
                data-lucide="calendar-plus"
                class="h-5 w-5"
            ></i>

            Tambah Agenda

        </a>

    </div>


    {{-- SUCCESS --}}

    @if (session('success'))

        <div
            class="flex items-center gap-3
                   rounded-xl
                   border border-green-200
                   bg-green-50 px-5 py-4"
        >

            <i
                data-lucide="circle-check"
                class="h-5 w-5
                       text-[#087443]"
            ></i>

            <p
                class="text-sm font-semibold
                       text-[#087443]"
            >
                {{ session('success') }}
            </p>

        </div>

    @endif


    {{-- EVENTS --}}

    <div
        class="grid gap-6
               lg:grid-cols-2"
    >

        @forelse ($events as $event)

            <div
                class="group overflow-hidden
                       rounded-2xl
                       bg-white
                       shadow-sm
                       ring-1 ring-gray-100
                       transition
                       hover:-translate-y-1
                       hover:shadow-xl"
            >

                {{-- IMAGE --}}

                <div
                    class="relative h-52
                           overflow-hidden
                           bg-[#062E1F]"
                >

                    @if ($event->image)

                        <img
                            src="{{ asset(
                                'storage/' . $event->image
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
                                class="h-16 w-16
                                       text-[#F4C542]"
                            ></i>

                        </div>

                    @endif


                    {{-- STATUS --}}

                    <div
                        class="absolute right-4
                               top-4"
                    >

                        @if ($event->is_published)

                            <span
                                class="inline-flex
                                       items-center gap-1.5
                                       rounded-full
                                       bg-green-500
                                       px-3 py-1
                                       text-xs font-bold
                                       text-white shadow"
                            >

                                <span
                                    class="h-1.5 w-1.5
                                           rounded-full
                                           bg-white"
                                ></span>

                                Published

                            </span>

                        @else

                            <span
                                class="rounded-full
                                       bg-black/60
                                       px-3 py-1
                                       text-xs font-bold
                                       text-white
                                       backdrop-blur"
                            >
                                Draft
                            </span>

                        @endif

                    </div>


                    {{-- DATE BADGE --}}

                    <div
                        class="absolute bottom-4
                               left-4 flex
                               overflow-hidden
                               rounded-xl
                               bg-white shadow-lg"
                    >

                        <div
                            class="bg-[#087443]
                                   px-4 py-2
                                   text-center
                                   text-white"
                        >

                            <p
                                class="text-xl
                                       font-black
                                       leading-none"
                            >
                                {{ $event->start_at->format('d') }}
                            </p>

                            <p
                                class="mt-1 text-[10px]
                                       font-bold
                                       uppercase"
                            >
                                {{ $event->start_at
                                    ->translatedFormat('M') }}
                            </p>

                        </div>

                        <div
                            class="flex items-center
                                   px-3"
                        >

                            <p
                                class="text-xs
                                       font-bold
                                       text-gray-600"
                            >
                                {{ $event->start_at
                                    ->format('Y') }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- CONTENT --}}

                <div class="p-6">

                    <h2
                        class="text-xl
                               font-black
                               text-gray-900
                               group-hover:text-[#087443]"
                    >
                        {{ $event->title }}
                    </h2>


                    <div
                        class="mt-4 space-y-2"
                    >

                        <div
                            class="flex items-center
                                   gap-2 text-sm
                                   text-gray-500"
                        >

                            <i
                                data-lucide="clock-3"
                                class="h-4 w-4
                                       text-[#087443]"
                            ></i>

                            <span>
                                {{ $event->start_at
                                    ->format('d M Y, H:i') }}

                                @if ($event->end_at)
                                    -
                                    {{ $event->end_at
                                        ->format('H:i') }}
                                @endif

                            </span>

                        </div>


                        @if ($event->location)

                            <div
                                class="flex items-center
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

                    </div>


                    @if ($event->description)

                        <p
                            class="mt-4 line-clamp-2
                                   text-sm leading-6
                                   text-gray-500"
                        >
                            {{ Str::limit(
                                strip_tags(
                                    $event->description
                                ),
                                150
                            ) }}
                        </p>

                    @endif


                    {{-- ACTION --}}

                    <div
                        class="mt-5 flex gap-2
                               border-t
                               border-gray-100
                               pt-4"
                    >

                        <a
                            href="{{ route(
                                'admin.events.edit',
                                $event
                            ) }}"
                            class="flex flex-1
                                   items-center
                                   justify-center
                                   gap-2
                                   rounded-xl
                                   bg-gray-100
                                   py-2.5
                                   text-sm font-bold
                                   text-gray-600
                                   transition
                                   hover:bg-[#087443]
                                   hover:text-white"
                        >

                            <i
                                data-lucide="pencil"
                                class="h-4 w-4"
                            ></i>

                            Edit

                        </a>


                        <form
                            action="{{ route(
                                'admin.events.destroy',
                                $event
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Yakin ingin menghapus agenda ini?'
                            )"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="flex h-full
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-red-50
                                       px-4
                                       text-red-500
                                       transition
                                       hover:bg-red-500
                                       hover:text-white"
                            >

                                <i
                                    data-lucide="trash-2"
                                    class="h-4 w-4"
                                ></i>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div
                class="lg:col-span-2
                       rounded-2xl
                       bg-white px-6 py-16
                       text-center
                       shadow-sm
                       ring-1 ring-gray-100"
            >

                <div
                    class="mx-auto flex h-16 w-16
                           items-center
                           justify-center
                           rounded-2xl
                           bg-[#087443]/10
                           text-[#087443]"
                >

                    <i
                        data-lucide="calendar-days"
                        class="h-8 w-8"
                    ></i>

                </div>

                <h3
                    class="mt-4 text-lg
                           font-black"
                >
                    Belum Ada Agenda
                </h3>

                <p
                    class="mt-2 text-sm
                           text-gray-400"
                >
                    Tambahkan agenda kegiatan
                    pesantren.
                </p>

                <a
                    href="{{ route(
                        'admin.events.create'
                    ) }}"
                    class="mt-6 inline-flex
                           items-center gap-2
                           rounded-xl
                           bg-[#087443]
                           px-5 py-3
                           text-sm font-bold
                           text-white
                           hover:bg-[#062E1F]"
                >

                    <i
                        data-lucide="plus"
                        class="h-4 w-4"
                    ></i>

                    Tambah Agenda

                </a>

            </div>

        @endforelse

    </div>


    @if ($events->hasPages())

        <div>
            {{ $events->links() }}
        </div>

    @endif

</div>

@endsection