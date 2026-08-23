@extends('layouts.app')

@section('title', 'Beranda')

@section(
    'description',
    'Website resmi Pesantren {{ $settings['school_name'] ?? '' }}. Informasi pendidikan, program, kegiatan dan pendaftaran santri.'
)

@section('content')

{{-- =========================================================
   HERO
========================================================= --}}

<section
    class="relative overflow-hidden
           bg-[#062E1F]"
>

    {{-- Decorative --}}

    <div
        class="absolute -right-40
               -top-40
               h-[500px] w-[500px]
               rounded-full
               bg-[#087443]/30
               blur-3xl"
    ></div>

    <div
        class="absolute -bottom-40
               -left-40
               h-[500px] w-[500px]
               rounded-full
               bg-[#F4C542]/10
               blur-3xl"
    ></div>


    <div
        class="relative mx-auto
               grid min-h-[680px]
               max-w-7xl
               items-center
               gap-12
               px-6 py-20
               sm:px-10
               lg:grid-cols-2
               lg:px-16"
    >

        {{-- LEFT --}}

        <div>

            <div
                class="inline-flex
                       items-center gap-2
                       rounded-full
                       border
                       border-[#F4C542]/20
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
                           font-black
                           uppercase
                           tracking-[0.15em]
                           text-[#F4C542]"
                >
                    Selamat Datang
                </span>

            </div>


            <h1
                class="mt-7
                       text-4xl
                       font-black
                       leading-[1.08]
                       tracking-tight
                       text-white
                       sm:text-6xl"
            >

                Membangun Generasi
                <span
                    class="text-[#F4C542]"
                >
                    Berilmu
                </span>
                dan
                <span
                    class="text-[#F4C542]"
                >
                    Berakhlak
                </span>
            </h1>


            <p
                class="mt-7
                       max-w-xl
                       text-base
                       leading-8
                       text-white/60
                       sm:text-lg"
            >
                Pesantren {{ $settings['school_name'] ?? '' }} hadir
                sebagai tempat pendidikan
                yang memadukan ilmu,
                pembentukan karakter,
                dan nilai-nilai keislaman.
            </p>


            <div
                class="mt-9
                       flex flex-wrap
                       gap-4"
            >

            </div>

        </div>


        {{-- RIGHT VISUAL --}}

        <div
            class="relative hidden
                   lg:block"
        >

            <div
                class="relative
                       mx-auto
                       h-[470px]
                       max-w-[470px]"
            >

                <div
                    class="absolute
                           inset-8
                           rounded-[3rem]
                           bg-[#087443]/30
                           rotate-6"
                ></div>


                <div
                    class="absolute
                           inset-0
                           overflow-hidden
                           rounded-[3rem]
                           border
                           border-white/10
                           bg-gradient-to-br
                           from-[#087443]
                           to-[#041F15]
                           shadow-2xl"
                >

                    <div
                        class="absolute
                               inset-0
                               bg-[radial-gradient(circle_at_30%_20%,rgba(244,197,66,0.2),transparent_30%)]"
                    ></div>


                    <div
                        class="relative
                               flex h-full
                               flex-col
                               items-center
                               justify-center
                               p-10
                               text-center"
                    >

                        <div
                            class="flex h-28 w-28
                                   items-center
                                   justify-center
                                   rounded-3xl
                                   bg-[#F4C542]
                                   shadow-2xl"
                        >

                            <span
                                class="text-4xl
                                       font-black
                                       text-[#062E1F]"
                            >
                                DA
                            </span>

                        </div>


                        <p
                            class="mt-8
                                   text-xs
                                   font-black
                                   uppercase
                                   tracking-[0.3em]
                                   text-[#F4C542]"
                        >
                            Pesantren
                        </p>


                        <h2
                            class="mt-3
                                   text-3xl
                                   font-black
                                   text-white"
                        >
                           {{ $settings['school_name'] ?? '' }}
                        </h2>


                        <p
                            class="mt-4
                                   max-w-xs
                                   text-sm
                                   leading-6
                                   text-white/50"
                        >
                            Tempat tumbuh,
                            belajar dan
                            membentuk generasi
                            masa depan.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
   PROFIL
========================================================= --}}

<section
    id="profil"
    class="bg-white"
>

    <div
        class="mx-auto
               grid max-w-7xl
               gap-12
               px-6 py-20
               sm:px-10
               lg:grid-cols-2
               lg:px-16"
    >

        <div>

            <p
                class="text-xs
                       font-black
                       uppercase
                       tracking-[0.2em]
                       text-[#087443]"
            >
                Tentang Kami
            </p>


            <h2
                class="mt-4
                       text-3xl
                       font-black
                       leading-tight
                       sm:text-4xl"
            >
                Pendidikan yang
                membentuk ilmu
                sekaligus karakter.
            </h2>

        </div>


        <div>

            <p
                class="text-base
                       leading-8
                       text-gray-500"
            >
                Pesantren {{ $settings['school_name'] ?? '' }}
                berkomitmen menghadirkan
                lingkungan pendidikan yang
                mendorong santri untuk
                berkembang secara akademik,
                spiritual dan sosial.
            </p>


            <div
                class="mt-8
                       grid gap-4
                       sm:grid-cols-2"
            >

                <div
                    class="rounded-2xl
                           bg-[#F5F7F6]
                           p-5"
                >

                    <i
                        data-lucide="book-open"
                        class="h-7 w-7
                               text-[#087443]"
                    ></i>

                    <h3
                        class="mt-4
                               font-black"
                    >
                        Pendidikan
                    </h3>

                    <p
                        class="mt-2
                               text-sm
                               leading-6
                               text-gray-500"
                    >
                        Pembelajaran yang
                        terarah dan
                        berkelanjutan.
                    </p>

                </div>


                <div
                    class="rounded-2xl
                           bg-[#F5F7F6]
                           p-5"
                >

                    <i
                        data-lucide="heart-handshake"
                        class="h-7 w-7
                               text-[#087443]"
                    ></i>

                    <h3
                        class="mt-4
                               font-black"
                    >
                        Akhlak
                    </h3>

                    <p
                        class="mt-2
                               text-sm
                               leading-6
                               text-gray-500"
                    >
                        Membentuk karakter
                        dan akhlak mulia.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
   PROGRAM
========================================================= --}}

<section
    id="program"
    class="bg-[#F5F7F6]"
>

    <div
        class="mx-auto
               max-w-7xl
               px-6 py-20
               sm:px-10
               lg:px-16"
    >

        <div
            class="flex flex-col
                   gap-4
                   sm:flex-row
                   sm:items-end
                   sm:justify-between"
        >

            <div>

                <p
                    class="text-xs
                           font-black
                           uppercase
                           tracking-[0.2em]
                           text-[#087443]"
                >
                    Program Pendidikan
                </p>


                <h2
                    class="mt-3
                           text-3xl
                           font-black"
                >
                    Pilihan Program
                    {{ $settings['school_name'] ?? '' }}
                </h2>

            </div>

        </div>


        <div
            class="mt-10
                   grid gap-6
                   md:grid-cols-3"
        >

            @forelse (
                $programs as $program
            )

                <div
                    class="group
                           rounded-3xl
                           bg-white
                           p-7
                           shadow-sm
                           ring-1
                           ring-gray-100
                           transition
                           hover:-translate-y-1
                           hover:shadow-xl"
                >

                    <div
                        class="flex h-14 w-14
                               items-center
                               justify-center
                               rounded-2xl
                               bg-[#087443]/10"
                    >

                        @if ($program->icon)

                            <i
                                data-lucide="{{ $program->icon }}"
                                class="h-7 w-7
                                       text-[#087443]"
                            ></i>

                        @else

                            <i
                                data-lucide="graduation-cap"
                                class="h-7 w-7
                                       text-[#087443]"
                            ></i>

                        @endif

                    </div>


                    <h3
                        class="mt-6
                               text-xl
                               font-black"
                    >
                        {{ $program->title }}
                    </h3>


                    <p
                        class="mt-3
                               text-sm
                               leading-7
                               text-gray-500"
                    >
                        {{ $program->description }}
                    </p>

                </div>

            @empty

                <div
                    class="md:col-span-3
                           rounded-2xl
                           bg-white
                           p-10
                           text-center
                           text-gray-400"
                >
                    Program pendidikan
                    belum tersedia.
                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- =========================================================
   GURU
========================================================= --}}

<section
    id="guru"
    class="bg-white"
>

    <div
        class="mx-auto
               max-w-7xl
               px-6 py-20
               sm:px-10
               lg:px-16"
    >

        <p
            class="text-xs
                   font-black
                   uppercase
                   tracking-[0.2em]
                   text-[#087443]"
        >
            Pengasuh & Tenaga Pendidik
        </p>


        <h2
            class="mt-3
                   text-3xl
                   font-black"
        >
            Dibimbing oleh
            pendidik terbaik
        </h2>


        <div
            class="mt-10
                   grid gap-6
                   sm:grid-cols-2
                   lg:grid-cols-4"
        >

            @forelse (
                $teachers as $teacher
            )

                <div
                    class="overflow-hidden
                           rounded-3xl
                           bg-[#F5F7F6]
                           transition
                           hover:-translate-y-1
                           hover:shadow-xl"
                >

                    @if ($teacher->photo)

                        <img
                            src="{{ asset(
                                'storage/' .
                                $teacher->photo
                            ) }}"
                            alt="{{ $teacher->name }}"
                            class="h-72 w-full
                                   object-cover"
                        >

                    @else

                        <div
                            class="flex h-72
                                   items-center
                                   justify-center
                                   bg-[#062E1F]"
                        >

                            <i
                                data-lucide="user-round"
                                class="h-16 w-16
                                       text-[#F4C542]"
                            ></i>

                        </div>

                    @endif


                    <div
                        class="p-6"
                    >

                        <h3
                            class="font-black"
                        >
                            {{ $teacher->name }}
                        </h3>


                        <p
                            class="mt-1
                                   text-sm
                                   font-bold
                                   text-[#087443]"
                        >
                            {{ $teacher->position }}
                        </p>


                        @if ($teacher->education)

                            <p
                                class="mt-3
                                       text-xs
                                       leading-5
                                       text-gray-500"
                            >
                                {{ $teacher->education }}
                            </p>

                        @endif

                    </div>

                </div>

            @empty

                <div
                    class="sm:col-span-2
                           lg:col-span-4
                           rounded-2xl
                           bg-[#F5F7F6]
                           p-10
                           text-center
                           text-gray-400"
                >
                    Data pengasuh dan guru
                    belum tersedia.
                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- =========================================================
   BERITA
========================================================= --}}

<section
    class="bg-[#F5F7F6]"
>

    <div
        class="mx-auto
               max-w-7xl
               px-6 py-20
               sm:px-10
               lg:px-16"
    >

        <div
            class="flex
                   items-end
                   justify-between"
        >

            <div>

                <p
                    class="text-xs
                           font-black
                           uppercase
                           tracking-[0.2em]
                           text-[#087443]"
                >
                    Informasi Terbaru
                </p>


                <h2
                    class="mt-3
                           text-3xl
                           font-black"
                >
                    Berita Pesantren
                </h2>

            </div>


            <a
                href="{{ route(
                    'news.index'
                ) }}"
                class="hidden
                       items-center
                       gap-2
                       text-sm
                       font-black
                       text-[#087443]
                       sm:flex"
            >

                Semua Berita

                <i
                    data-lucide="arrow-right"
                    class="h-4 w-4"
                ></i>

            </a>

        </div>


        <div
            class="mt-10
                   grid gap-7
                   md:grid-cols-3"
        >

            @forelse ($news as $item)

                <article
                    class="group overflow-hidden
                           rounded-3xl
                           bg-white
                           shadow-sm
                           ring-1
                           ring-gray-100"
                >

                    @if ($item->thumbnail)

                        <img
                            src="{{ asset(
                                'storage/' .
                                $item->thumbnail
                            ) }}"
                            alt="{{ $item->title }}"
                            class="h-56 w-full
                                   object-cover
                                   transition
                                   duration-500
                                   group-hover:scale-105"
                        >

                    @else

                        <div
                            class="flex h-56
                                   items-center
                                   justify-center
                                   bg-[#062E1F]"
                        >

                            <i
                                data-lucide="newspaper"
                                class="h-10 w-10
                                       text-[#F4C542]"
                            ></i>

                        </div>

                    @endif


                    <div
                        class="p-6"
                    >

                        <div
                            class="flex
                                   items-center
                                   justify-between"
                        >

                            <span
                                class="text-xs
                                       font-black
                                       text-[#087443]"
                            >
                                {{ $item->category }}
                            </span>


                            <span
                                class="text-xs
                                       text-gray-400"
                            >
                                {{
                                    $item->published_at
                                        ?->format(
                                            'd M Y'
                                        )
                                }}
                            </span>

                        </div>


                        <h3
                            class="mt-4
                                   line-clamp-2
                                   text-xl
                                   font-black
                                   leading-snug
                                   group-hover:text-[#087443]"
                        >

                            <a
                                href="{{ route(
                                    'news.show',
                                    $item
                                ) }}"
                            >
                                {{ $item->title }}
                            </a>

                        </h3>


                        <p
                            class="mt-3
                                   line-clamp-2
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
                           rounded-2xl
                           bg-white
                           p-10
                           text-center
                           text-gray-400"
                >
                    Belum ada berita
                    yang dipublikasikan.
                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- =========================================================
   CTA
========================================================= --}}

<section
    class="bg-[#062E1F]"
>

    <div
        class="mx-auto
               max-w-5xl
               px-6 py-20
               text-center
               sm:px-10"
    >

        <p
            class="text-xs
                   font-black
                   uppercase
                   tracking-[0.25em]
                   text-[#F4C542]"
        >
            Bergabung Bersama Kami
        </p>


        <h2
            class="mt-5
                   text-3xl
                   font-black
                   text-white
                   sm:text-4xl"
        >
            Mari tumbuh dan belajar
            bersama {{ $settings['school_name'] ?? '' }}.
        </h2>


        <p
            class="mx-auto mt-5
                   max-w-2xl
                   text-sm
                   leading-7
                   text-white/50"
        >
            Jadilah bagian dari lingkungan
            pendidikan yang mengutamakan
            ilmu, akhlak dan kemandirian.
        </p>


        <a
            href="{{ route(
                'registration.create'
            ) }}"
            class="mt-8
                   inline-flex
                   items-center
                   gap-2
                   rounded-xl
                   bg-[#F4C542]
                   px-7 py-3.5
                   text-sm
                   font-black
                   text-[#062E1F]
                   transition
                   hover:-translate-y-1
                   hover:bg-[#FFD85C]"
        >

            Daftar Sekarang

            <i
                data-lucide="arrow-right"
                class="h-4 w-4"
            ></i>

        </a>

    </div>

</section>

@endsection 