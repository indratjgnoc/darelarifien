@extends('layouts.public')

@section('title', 'Pesantren ')

@section('content')

{{-- ========================================= --}}
{{-- HERO --}}
{{-- ========================================= --}}

<section
    class="relative overflow-hidden
           bg-[#062E1F]"
>

    {{-- DECORATION --}}

    <div
        class="absolute -right-32
               -top-32 h-96 w-96
               rounded-full
               bg-[#F4C542]/10
               blur-3xl"
    ></div>


    <div
        class="absolute -left-32
               bottom-0 h-96 w-96
               rounded-full
               bg-green-400/10
               blur-3xl"
    ></div>


    <div
        class="relative mx-auto
               max-w-7xl
               px-5 py-24
               lg:px-8
               lg:py-32"
    >

        <div
            class="grid items-center
                   gap-14
                   lg:grid-cols-2"
        >


            {{-- TEXT --}}

            <div>

                <div
                    class="inline-flex
                           items-center gap-2
                           rounded-full
                           border border-[#F4C542]/20
                           bg-[#F4C542]/10
                           px-4 py-2"
                >

                    <span
                        class="h-2 w-2
                               rounded-full
                               bg-[#F4C542]"
                    ></span>

                    <span
                        class="text-xs
                               font-bold
                               uppercase
                               tracking-widest
                               text-[#F4C542]"
                    >
                        Selamat Datang
                    </span>

                </div>


                <h1
                    class="mt-7
                           text-4xl
                           font-black
                           leading-tight
                           text-white
                           sm:text-5xl
                           lg:text-6xl"
                >

                    Membangun Generasi
                    <span
                        class="text-[#F4C542]"
                    >
                        Berilmu
                    </span>
                    & Berakhlak.

                </h1>


                <p
                    class="mt-6 max-w-xl
                           text-lg
                           leading-8
                           text-white/60"
                >
                    Pesantren {{ $settings['school_name'] ?? '' }} hadir
                    sebagai tempat menuntut ilmu,
                    membentuk karakter dan
                    mempersiapkan generasi Islam
                    yang unggul.
                </p>


                <div
                    class="mt-8 flex
                           flex-col gap-3
                           sm:flex-row"
                >

                    <a
                        href="#pendaftaran"
                        class="inline-flex
                               items-center
                               justify-center gap-2
                               rounded-xl
                               bg-[#F4C542]
                               px-6 py-4
                               font-black
                               text-[#062E1F]
                               shadow-xl
                               transition
                               hover:-translate-y-1"
                    >

                        Daftar Sekarang

                        <i
                            data-lucide="arrow-right"
                            class="h-5 w-5"
                        ></i>

                    </a>


                    <a
                        href="#profil"
                        class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               rounded-xl
                               border
                               border-white/15
                               px-6 py-4
                               font-bold
                               text-white
                               transition
                               hover:bg-white/10"
                    >

                        Kenali Pesantren

                    </a>

                </div>


                {{-- TRUST --}}

                <div
                    class="mt-10 flex
                           flex-wrap gap-8"
                >

                    <div>

                        <p
                            class="text-2xl
                                   font-black
                                   text-white"
                        >
                            Islami
                        </p>

                        <p
                            class="mt-1 text-xs
                                   text-white/40"
                        >
                            Pendidikan Berkarakter
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-2xl
                                   font-black
                                   text-white"
                        >
                            Terarah
                        </p>

                        <p
                            class="mt-1 text-xs
                                   text-white/40"
                        >
                            Pembinaan Santri
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-2xl
                                   font-black
                                   text-white"
                        >
                            Unggul
                        </p>

                        <p
                            class="mt-1 text-xs
                                   text-white/40"
                        >
                            Generasi Masa Depan
                        </p>

                    </div>

                </div>

            </div>


            {{-- HERO VISUAL --}}

            <div
                class="relative"
            >

                <div
                    class="relative
                           overflow-hidden
                           rounded-[2rem]
                           border
                           border-white/10
                           bg-white/5
                           p-3
                           shadow-2xl"
                >

                    <div
                        class="flex aspect-[4/3]
                               items-center
                               justify-center
                               rounded-[1.5rem]
                               bg-gradient-to-br
                               from-[#087443]
                               to-[#041D14]"
                    >

                        <div
                            class="text-center"
                        >

                            <div
                                class="mx-auto flex
                                       h-24 w-24
                                       items-center
                                       justify-center
                                       rounded-3xl
                                       bg-[#F4C542]
                                       text-[#062E1F]
                                       shadow-2xl"
                            >

                                <i
                                    data-lucide="landmark"
                                    class="h-12 w-12"
                                ></i>

                            </div>


                            <p
                                class="mt-6 text-2xl
                                       font-black
                                       text-white"
                            >
                                {{ $settings['school_name'] ?? '' }}
                            </p>


                            <p
                                class="mt-2 text-sm
                                       text-white/50"
                            >
                                Pesantren
                            </p>

                        </div>

                    </div>

                </div>
  

                        </div>
                        
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ========================================= --}}
{{-- PROFIL --}}
{{-- ========================================= --}}

<section
    id="profil"
    class="bg-white py-24"
>

    <div
        class="mx-auto max-w-7xl
               px-5 lg:px-8"
    >

        <div
            class="max-w-2xl"
        >

            <p
                class="text-sm
                       font-black
                       uppercase
                       tracking-widest
                       text-[#087443]"
            >
                Tentang Kami
            </p>


            <h2
                class="mt-3 text-3xl
                       font-black
                       text-[#111111]
                       sm:text-4xl"
            >
                Tempat Tumbuhnya
                Generasi Islami
            </h2>


            <p
                class="mt-5
                       leading-8
                       text-gray-500"
            >
                Pesantren {{ $settings['school_name'] ?? '' }} berkomitmen
                memberikan pendidikan yang
                mengintegrasikan ilmu agama,
                ilmu pengetahuan dan pembentukan
                akhlak.
            </p>

        </div>


        <div
            class="mt-14 grid gap-6
                   md:grid-cols-3"
        >

            <div
                class="rounded-2xl
                       bg-[#F5F7F6]
                       p-7"
            >

                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
                           rounded-xl
                           bg-[#087443]
                           text-white"
                >

                    <i
                        data-lucide="book-open"
                        class="h-6 w-6"
                    ></i>

                </div>


                <h3
                    class="mt-5 text-lg
                           font-black"
                >
                    Pendidikan
                </h3>


                <p
                    class="mt-3 text-sm
                           leading-7
                           text-gray-500"
                >
                    Pembelajaran yang terarah
                    dan seimbang antara ilmu
                    agama dan ilmu umum.
                </p>

            </div>


            <div
                class="rounded-2xl
                       bg-[#F5F7F6]
                       p-7"
            >

                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
                           rounded-xl
                           bg-[#F4C542]
                           text-[#062E1F]"
                >

                    <i
                        data-lucide="heart-handshake"
                        class="h-6 w-6"
                    ></i>

                </div>


                <h3
                    class="mt-5 text-lg
                           font-black"
                >
                    Akhlak
                </h3>


                <p
                    class="mt-3 text-sm
                           leading-7
                           text-gray-500"
                >
                    Membentuk pribadi santri
                    yang santun, disiplin dan
                    bertanggung jawab.
                </p>

            </div>


            <div
                class="rounded-2xl
                       bg-[#F5F7F6]
                       p-7"
            >

                <div
                    class="flex h-12 w-12
                           items-center
                           justify-center
                           rounded-xl
                           bg-[#062E1F]
                           text-[#F4C542]"
                >

                    <i
                        data-lucide="users"
                        class="h-6 w-6"
                    ></i>

                </div>


                <h3
                    class="mt-5 text-lg
                           font-black"
                >
                    Pembinaan
                </h3>


                <p
                    class="mt-3 text-sm
                           leading-7
                           text-gray-500"
                >
                    Lingkungan yang mendukung
                    perkembangan santri secara
                    akademik dan spiritual.
                </p>

            </div>

        </div>

    </div>

</section>


{{-- ========================================= --}}
{{-- PROGRAM --}}
{{-- ========================================= --}}

<section
    id="program"
    class="bg-[#F5F7F6]
           py-24"
>

    <div
        class="mx-auto max-w-7xl
               px-5 lg:px-8"
    >

        <div
            class="flex flex-col
                   gap-5
                   md:flex-row
                   md:items-end
                   md:justify-between"
        >

            <div>

                <p
                    class="text-sm
                           font-black
                           uppercase
                           tracking-widest
                           text-[#087443]"
                >
                    Pendidikan
                </p>


                <h2
                    class="mt-3 text-3xl
                           font-black
                           sm:text-4xl"
                >
                    Program Pendidikan
                </h2>

            </div>

        </div>


        <div
            class="mt-12 grid gap-6
                   md:grid-cols-2
                   lg:grid-cols-3"
        >

            @forelse ($programs as $program)

                <div
                    class="group rounded-2xl
                           bg-white p-7
                           shadow-sm
                           ring-1 ring-gray-100
                           transition
                           hover:-translate-y-1
                           hover:shadow-xl"
                >

                    <div
                        class="flex h-14 w-14
                               items-center
                               justify-center
                               rounded-2xl
                               bg-[#087443]/10
                               text-[#087443]"
                    >

                        <i
                            data-lucide="{{ $program->icon ?: 'book-open' }}"
                            class="h-7 w-7"
                        ></i>

                    </div>


                    <a
    href="{{ route('program.show', $program->slug) }}"
    class="mt-6 block text-xl
           font-black
           transition
           group-hover:text-[#087443]"
>
    {{ $program->title }}
</a>


                    <p
                        class="mt-3 line-clamp-3
                               text-sm
                               leading-7
                               text-gray-500"
                    >
                        {{ $program->description }}
                    </p>
<a
    href="{{ route('program.show', $program->slug) }}"
    class="mt-5 inline-flex
           items-center gap-2
           text-sm font-black
           text-[#087443]"
>
    Selengkapnya

    <i
        data-lucide="arrow-right"
        class="h-4 w-4"
    ></i>
</a>
                </div>

            @empty

                <div
                    class="md:col-span-2
                           lg:col-span-3
                           rounded-2xl
                           bg-white
                           p-10 text-center"
                >

                    <p
                        class="text-gray-400"
                    >
                        Program pendidikan
                        belum tersedia.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- ========================================= --}}
{{-- BERITA --}}
{{-- ========================================= --}}

<section
    id="berita"
    class="bg-white py-24"
>

    <div
        class="mx-auto max-w-7xl
               px-5 lg:px-8"
    >

        <p
            class="text-sm
                   font-black
                   uppercase
                   tracking-widest
                   text-[#087443]"
        >
            Informasi
        </p>


        <h2
            class="mt-3 text-3xl
                   font-black
                   sm:text-4xl"
        >
            Berita Terbaru
        </h2>


        <div
            class="mt-12 grid gap-6
                   md:grid-cols-3"
        >

            @forelse ($news as $item)

                <article
                    class="overflow-hidden
                           rounded-2xl
                           bg-white
                           shadow-sm
                           ring-1 ring-gray-100
                           transition
                           hover:-translate-y-1
                           hover:shadow-xl"
                >

                    <div
                        class="aspect-[16/10]
                               bg-[#062E1F]"
                    >

                        @if ($item->thumbnail)

                            <img
                                src="{{ asset(
                                    'storage/' .
                                    $item->thumbnail
                                ) }}"
                                alt="{{ $item->title }}"
                                class="h-full w-full
                                       object-cover"
                            >

                        @else

                            <div
                                class="flex h-full
                                       items-center
                                       justify-center"
                            >

                                <i
                                    data-lucide="newspaper"
                                    class="h-12 w-12
                                           text-[#F4C542]"
                                ></i>

                            </div>

                        @endif

                    </div>


                    <div class="p-6">

                        <p
                            class="text-xs
                                   font-bold
                                   uppercase
                                   tracking-wider
                                   text-[#087443]"
                        >
                            {{ $item->category ?: 'Berita' }}
                        </p>


                        <h3
                            class="mt-3 text-lg
                                   font-black"
                        >
                            {{ $item->title }}
                        </h3>


                        <p
                            class="mt-3 line-clamp-2
                                   text-sm
                                   leading-6
                                   text-gray-500"
                        >
                            {{ $item->excerpt }}
                        </p>

                    </div>

                </article>

            @empty

                <div
                    class="md:col-span-3
                           py-12 text-center
                           text-gray-400"
                >
                    Belum ada berita.
                </div>

            @endforelse

        </div>

    </div>

</section>

{{-- ========================================= --}}
{{-- AGENDA --}}
{{-- ========================================= --}}

<section
    id="agenda"
    class="bg-[#F5F7F6] py-24"
>

    <div
        class="mx-auto max-w-7xl
               px-5 lg:px-8"
    >

        <div
            class="flex flex-col gap-5
                   md:flex-row
                   md:items-end
                   md:justify-between"
        >

            <div>

                <p
                    class="text-sm font-black
                           uppercase
                           tracking-widest
                           text-[#087443]"
                >
                    Kegiatan
                </p>

                <h2
                    class="mt-3 text-3xl
                           font-black
                           sm:text-4xl"
                >
                    Agenda Pesantren
                </h2>

            </div>


            <a
                href="{{ route('events.index') }}"
                class="inline-flex
                       items-center gap-2
                       text-sm font-black
                       text-[#087443]"
            >

                Lihat Semua

                <i
                    data-lucide="arrow-right"
                    class="h-4 w-4"
                ></i>

            </a>

        </div>


        <div
            class="mt-12 grid gap-5
                   md:grid-cols-2
                   lg:grid-cols-4"
        >

            @forelse ($events as $event)

                <a
                    href="{{ route(
                        'events.show',
                        $event->slug
                    ) }}"
                    class="group rounded-2xl
                           bg-white p-6
                           shadow-sm
                           ring-1 ring-gray-100
                           transition
                           hover:-translate-y-1
                           hover:shadow-xl"
                >

                    @if ($event->start_at)

                        <div
                            class="flex h-14 w-14
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

                    @else

                        <div
                            class="flex h-14 w-14
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#F4C542]
                                   text-[#062E1F]"
                        >

                            <i
                                data-lucide="calendar"
                                class="h-6 w-6"
                            ></i>

                        </div>

                    @endif


                    <h3
                        class="mt-6 text-lg
                               font-black
                               leading-7
                               transition
                               group-hover:text-[#087443]"
                    >
                        {{ $event->title }}
                    </h3>


                    @if ($event->location)

                        <div
                            class="mt-3 flex
                                   items-center gap-2
                                   text-xs
                                   text-gray-400"
                        >

                            <i
                                data-lucide="map-pin"
                                class="h-4 w-4
                                       text-[#087443]"
                            ></i>

                            {{ $event->location }}

                        </div>

                    @endif

                </a>

            @empty

                <div
                    class="md:col-span-2
                           lg:col-span-4
                           rounded-2xl
                           bg-white
                           p-10 text-center"
                >

                    <p
                        class="text-gray-400"
                    >
                        Belum ada agenda.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>

{{-- ========================================= --}}
{{-- GALERI --}}
{{-- ========================================= --}}

<section
    id="galeri"
    class="bg-white py-24"
>

    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        <div
            class="flex flex-col gap-5
                   md:flex-row
                   md:items-end
                   md:justify-between"
        >

            <div>

                <p
                    class="text-sm font-black
                           uppercase
                           tracking-widest
                           text-[#087443]"
                >
                    Dokumentasi
                </p>

                <h2
                    class="mt-3 text-3xl
                           font-black
                           sm:text-4xl"
                >
                    Galeri Pesantren
                </h2>

            </div>


            <a
                href="{{ route('gallery.index') }}"
                class="inline-flex
                       items-center gap-2
                       text-sm font-black
                       text-[#087443]"
            >

                Lihat Semua

                <i
                    data-lucide="arrow-right"
                    class="h-4 w-4"
                ></i>

            </a>

        </div>


        @if ($galleries->count())

            <div
                class="mt-12 grid gap-5
                       sm:grid-cols-2
                       lg:grid-cols-3"
            >

                @foreach ($galleries as $gallery)

                    <a
                        href="{{ route('gallery.index') }}"
                        class="group relative
                               aspect-[4/3]
                               overflow-hidden
                               rounded-2xl
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
                                    class="h-12 w-12
                                           text-[#F4C542]"
                                ></i>

                            </div>

                        @endif


                        <div
                            class="absolute inset-0
                                   bg-gradient-to-t
                                   from-black/80
                                   via-transparent
                                   to-transparent"
                        ></div>


                        <div
                            class="absolute bottom-0
                                   left-0 right-0
                                   p-6"
                        >

                            @if ($gallery->category)

                                <p
                                    class="text-[10px]
                                           font-black
                                           uppercase
                                           tracking-widest
                                           text-[#F4C542]"
                                >
                                    {{ $gallery->category }}
                                </p>

                            @endif


                            <h3
                                class="mt-2 text-lg
                                       font-black
                                       text-white"
                            >
                                {{ $gallery->title }}
                            </h3>

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            <div
                class="mt-12 rounded-2xl
                       bg-[#F5F7F6]
                       p-10 text-center"
            >
                <p class="text-gray-400">
                    Belum ada dokumentasi.
                </p>
            </div>

        @endif

    </div>

</section>

{{-- ========================================= --}}
{{-- PENDAFTARAN --}}
{{-- ========================================= --}}

<section
    id="pendaftaran"
    class="bg-[#062E1F]
           py-20"
>

    <div
        class="mx-auto max-w-5xl
               px-5 text-center
               lg:px-8"
    >

        <p
            class="text-sm
                   font-black
                   uppercase
                   tracking-widest
                   text-[#F4C542]"
        >
            Bergabung Bersama Kami
        </p>


        <h2
            class="mt-4 text-3xl
                   font-black
                   text-white
                   sm:text-4xl"
        >
            Siapkan Masa Depan
            Bersama {{ $settings['school_name'] ?? '' }}
        </h2>


        <p
            class="mx-auto mt-5
                   max-w-2xl
                   leading-7
                   text-white/50"
        >
            Jadilah bagian dari lingkungan
            pendidikan yang membentuk ilmu,
            karakter dan akhlak.
        </p>


        <a
            href="#"
            class="mt-8 inline-flex
                   items-center gap-2
                   rounded-xl
                   bg-[#F4C542]
                   px-7 py-4
                   font-black
                   text-[#062E1F]
                   shadow-xl
                   transition
                   hover:-translate-y-1"
        >

            Mulai Pendaftaran

            <i
                data-lucide="arrow-right"
                class="h-5 w-5"
            ></i>

        </a>

    </div>

</section>

@endsection