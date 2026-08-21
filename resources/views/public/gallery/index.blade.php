@extends('layouts.public')

@section('title', 'Galeri')

@section('content')

{{-- HERO --}}
<section class="bg-[#062E1F] py-20">

    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        <p
            class="text-sm font-black uppercase
                   tracking-widest text-[#F4C542]"
        >
            Dokumentasi
        </p>

        <h1
            class="mt-3 text-4xl font-black
                   text-white sm:text-5xl"
        >
            Galeri Pesantren
        </h1>

        <p
            class="mt-5 max-w-2xl
                   leading-8 text-white/50"
        >
            Dokumentasi kegiatan, pembelajaran,
            dan berbagai aktivitas Pesantren
            Darel Arifien.
        </p>

    </div>

</section>


{{-- GALLERY --}}
<section class="bg-[#F5F7F6] py-20">

    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        @if ($galleries->count())

            <div
                class="grid gap-6
                       sm:grid-cols-2
                       lg:grid-cols-3"
            >

                @foreach ($galleries as $gallery)

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

                        <div
                            class="relative aspect-[4/3]
                                   overflow-hidden
                                   bg-[#062E1F]"
                        >

                            @if ($gallery->image)

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $gallery->image
                                    ) }}"
                                    alt="{{ $gallery->title }}"
                                    class="h-full w-full
                                           object-cover
                                           transition
                                           duration-700
                                           group-hover:scale-110"
                                >

                            @else

                                <div
                                    class="flex h-full
                                           items-center
                                           justify-center"
                                >

                                    <i
                                        data-lucide="image"
                                        class="h-14 w-14
                                               text-[#F4C542]"
                                    ></i>

                                </div>

                            @endif


                            {{-- OVERLAY --}}

                            <div
                                class="absolute inset-0
                                       flex items-end
                                       bg-gradient-to-t
                                       from-black/80
                                       via-black/10
                                       to-transparent
                                       opacity-0
                                       transition
                                       duration-300
                                       group-hover:opacity-100"
                            >

                                <div class="p-6">

                                    @if ($gallery->category)

                                        <span
                                            class="rounded-full
                                                   bg-[#F4C542]
                                                   px-3 py-1
                                                   text-[10px]
                                                   font-black
                                                   uppercase
                                                   text-[#062E1F]"
                                        >
                                            {{ $gallery->category }}
                                        </span>

                                    @endif

                                    <h2
                                        class="mt-3 text-xl
                                               font-black
                                               text-white"
                                    >
                                        {{ $gallery->title }}
                                    </h2>

                                </div>

                            </div>

                        </div>


                        {{-- CONTENT --}}

                        <div class="p-5">

                            @if ($gallery->category)

                                <p
                                    class="text-xs
                                           font-black
                                           uppercase
                                           tracking-wider
                                           text-[#087443]"
                                >
                                    {{ $gallery->category }}
                                </p>

                            @endif


                            <h2
                                class="mt-2 text-lg
                                       font-black"
                            >
                                {{ $gallery->title }}
                            </h2>


                            @if ($gallery->description)

                                <p
                                    class="mt-2 line-clamp-2
                                           text-sm leading-6
                                           text-gray-500"
                                >
                                    {{ $gallery->description }}
                                </p>

                            @endif

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div
                class="rounded-3xl bg-white
                       px-6 py-16
                       text-center
                       shadow-sm"
            >

                <div
                    class="mx-auto flex h-16 w-16
                           items-center justify-center
                           rounded-2xl
                           bg-[#087443]/10
                           text-[#087443]"
                >

                    <i
                        data-lucide="images"
                        class="h-8 w-8"
                    ></i>

                </div>


                <h2
                    class="mt-6 text-xl
                           font-black"
                >
                    Belum Ada Dokumentasi
                </h2>


                <p
                    class="mx-auto mt-2 max-w-md
                           text-sm leading-7
                           text-gray-500"
                >
                    Dokumentasi kegiatan pesantren
                    akan ditampilkan di halaman ini.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection