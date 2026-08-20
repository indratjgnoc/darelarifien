@extends('layouts.app')

@section('title', 'Pesantren Darel Arifien | Membentuk Generasi Qurani')

@section('content')

{{-- =========================================================
    HERO
========================================================= --}}
<section
    class="relative min-h-screen overflow-hidden
           bg-[#04532F] pt-28"
>

    {{-- Decorative Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div
            class="absolute -right-32 -top-32 h-96 w-96
                   rounded-full border-[40px] border-[#F4C542]"
        ></div>

        <div
            class="absolute -bottom-40 -left-40 h-[500px] w-[500px]
                   rounded-full border-[50px] border-white"
        ></div>
    </div>

    {{-- Gradient --}}
    <div
        class="absolute inset-0
               bg-gradient-to-r
               from-[#04532F]
               via-[#087443]/95
               to-[#087443]/70"
    ></div>

    <div
        class="relative mx-auto flex min-h-[calc(100vh-7rem)]
               max-w-7xl items-center px-4
               sm:px-6 lg:px-8"
    >

        <div class="grid w-full items-center gap-12 lg:grid-cols-2">

            {{-- Hero Content --}}
            <div class="max-w-2xl">

                <div
                    class="mb-6 inline-flex items-center gap-3
                           rounded-full border border-[#F4C542]/40
                           bg-black/10 px-4 py-2
                           backdrop-blur-sm"
                >
                    <span
                        class="h-2 w-2 rounded-full bg-[#F4C542]"
                    ></span>

                    <span
                        class="text-sm font-semibold
                               tracking-wide text-white"
                    >
                        PESANTREN DAREL ARIFIEN
                    </span>
                </div>

                <h1
                    class="text-4xl font-black leading-tight
                           tracking-tight text-white
                           sm:text-5xl lg:text-6xl xl:text-7xl"
                >
                    Mencetak Generasi

                    <span class="block text-[#F4C542]">
                        Qur'ani
                    </span>

                    yang Berilmu & Berakhlak
                </h1>

                <p
                    class="mt-6 max-w-xl text-base
                           leading-8 text-white/80
                           sm:text-lg"
                >
                    Pesantren Darel Arifien hadir untuk
                    membentuk generasi yang kuat dalam ilmu,
                    kokoh dalam iman, mulia dalam akhlak,
                    serta siap memberikan manfaat bagi umat.
                </p>

                <div
                    class="mt-8 flex flex-col gap-4
                           sm:flex-row"
                >

                    <a
                        href="#profil"
                        class="group inline-flex items-center
                               justify-center gap-3 rounded-xl
                               bg-[#F4C542] px-7 py-4
                               font-bold text-[#111111]
                               shadow-xl transition
                               hover:-translate-y-1
                               hover:bg-[#e8b82f]"
                    >
                        Kenali Pesantren

                        <i
                            data-lucide="arrow-right"
                            class="h-5 w-5 transition
                                   group-hover:translate-x-1"
                        ></i>
                    </a>

                    <a
                        href="#pendaftaran"
                        class="inline-flex items-center
                               justify-center gap-3 rounded-xl
                               border border-white/30
                               bg-white/10 px-7 py-4
                               font-bold text-white
                               backdrop-blur-sm transition
                               hover:bg-white/20"
                    >
                        <i
                            data-lucide="file-pen-line"
                            class="h-5 w-5"
                        ></i>

                        Daftar Sekarang
                    </a>

                </div>

            </div>


            {{-- Hero Visual --}}
            <div class="relative hidden lg:block">

                <div
                    class="absolute -right-5 -top-5 h-24 w-24
                           rounded-2xl border
                           border-[#F4C542]/40
                           bg-[#F4C542]/10"
                ></div>

                <div
                    class="absolute -bottom-8 -left-8 h-32 w-32
                           rounded-full border
                           border-white/20"
                ></div>

                <div
                    class="relative overflow-hidden rounded-[2rem]
                           border border-white/20
                           bg-white/10 p-3 shadow-2xl
                           backdrop-blur-sm"
                >

                    {{-- Ganti URL ini dengan foto pesantren --}}
                    <img
                        src="https://images.unsplash.com/photo-1564121211835-e88c852648ab?auto=format&fit=crop&w=1200&q=85"
                        alt="Pesantren Darel Arifien"
                        class="h-[520px] w-full
                               rounded-[1.5rem]
                               object-cover"
                    >

                    <div
                        class="absolute bottom-8 left-8
                               right-8 rounded-2xl
                               border border-white/20
                               bg-black/60 p-5
                               backdrop-blur-md"
                    >

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-12 w-12 shrink-0
                                       items-center justify-center
                                       rounded-xl bg-[#F4C542]"
                            >
                                <i
                                    data-lucide="book-open"
                                    class="h-6 w-6 text-[#111111]"
                                ></i>
                            </div>

                            <div>
                                <p
                                    class="text-xs font-medium
                                           uppercase tracking-wider
                                           text-white/60"
                                >
                                    Pendidikan
                                </p>

                                <p
                                    class="font-bold text-white"
                                >
                                    Ilmu, Iman & Akhlak
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    STATISTICS
========================================================= --}}
<section class="relative z-10 -mt-8">

    <div
        class="mx-auto max-w-6xl px-4
               sm:px-6 lg:px-8"
    >

        <div
            class="grid overflow-hidden rounded-2xl
                   bg-white shadow-2xl
                   sm:grid-cols-2 lg:grid-cols-4"
        >

            <div
                class="border-b border-gray-100 p-7
                       text-center sm:border-r
                       lg:border-b-0"
            >
                <p
                    class="text-3xl font-black text-[#087443]"
                >
                    10+
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Tahun Pengabdian
                </p>
            </div>

            <div
                class="border-b border-gray-100 p-7
                       text-center lg:border-b-0
                       lg:border-r"
            >
                <p
                    class="text-3xl font-black text-[#087443]"
                >
                    500+
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Santri
                </p>
            </div>

            <div
                class="border-b border-gray-100 p-7
                       text-center sm:border-r
                       sm:border-b-0"
            >
                <p
                    class="text-3xl font-black text-[#087443]"
                >
                    50+
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Pendidik & Pembina
                </p>
            </div>

            <div
                class="p-7 text-center"
            >
                <p
                    class="text-3xl font-black text-[#087443]"
                >
                    20+
                </p>

                <p class="mt-2 text-sm text-gray-500">
                    Program Kegiatan
                </p>
            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    PROFIL
========================================================= --}}
<section
    id="profil"
    class="scroll-mt-24 bg-white py-24"
>

    <div
        class="mx-auto max-w-7xl px-4
               sm:px-6 lg:px-8"
    >

        <div
            class="grid items-center gap-14
                   lg:grid-cols-2"
        >

            {{-- Image --}}
            <div class="relative">

                <div
                    class="absolute -left-5 -top-5
                           h-24 w-24 rounded-2xl
                           bg-[#F4C542]"
                ></div>

                <div
                    class="absolute -bottom-5 -right-5
                           h-32 w-32 rounded-2xl
                           bg-[#EAF7F0]"
                ></div>

                <div
                    class="relative overflow-hidden
                           rounded-3xl"
                >

                    <img
                        src="https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=1000&q=85"
                        alt="Pendidikan Pesantren"
                        class="h-[480px] w-full
                               object-cover"
                    >

                </div>

            </div>


            {{-- Content --}}
            <div>

                <div
                    class="mb-4 flex items-center gap-3"
                >

                    <span
                        class="h-[2px] w-10 bg-[#F4C542]"
                    ></span>

                    <span
                        class="text-sm font-bold uppercase
                               tracking-[0.2em] text-[#087443]"
                    >
                        Tentang Kami
                    </span>

                </div>

                <h2
                    class="text-3xl font-black leading-tight
                           text-[#111111]
                           sm:text-4xl"
                >
                    Membangun Generasi
                    <span class="text-[#087443]">
                        Berilmu & Berakhlak
                    </span>
                </h2>

                <p
                    class="mt-6 leading-8 text-gray-600"
                >
                    Pesantren Darel Arifien merupakan lembaga
                    pendidikan Islam yang berkomitmen dalam
                    membina generasi melalui pendidikan,
                    pembinaan karakter, penguatan ilmu agama,
                    serta pengembangan potensi santri.
                </p>

                <p
                    class="mt-4 leading-8 text-gray-600"
                >
                    Dengan lingkungan pendidikan yang kondusif
                    dan pembinaan yang berkesinambungan,
                    kami berusaha menghadirkan pendidikan
                    yang mengintegrasikan ilmu, iman,
                    amal dan akhlak.
                </p>

                <div class="mt-8">

                    <a
                        href="#"
                        class="group inline-flex items-center
                               gap-3 font-bold text-[#087443]"
                    >
                        Selengkapnya tentang pesantren

                        <i
                            data-lucide="arrow-right"
                            class="h-5 w-5 transition
                                   group-hover:translate-x-1"
                        ></i>
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    PROGRAM UNGGULAN
========================================================= --}}
<section
    id="pendidikan"
    class="scroll-mt-24 bg-[#F5F7F6] py-24"
>

    <div
        class="mx-auto max-w-7xl px-4
               sm:px-6 lg:px-8"
    >

        <div class="mx-auto max-w-2xl text-center">

            <div
                class="mb-4 flex items-center
                       justify-center gap-3"
            >

                <span
                    class="h-[2px] w-10 bg-[#F4C542]"
                ></span>

                <span
                    class="text-sm font-bold uppercase
                           tracking-[0.2em] text-[#087443]"
                >
                    Program Pendidikan
                </span>

                <span
                    class="h-[2px] w-10 bg-[#F4C542]"
                ></span>

            </div>

            <h2
                class="text-3xl font-black text-[#111111]
                       sm:text-4xl"
            >
                Program Unggulan
            </h2>

            <p
                class="mt-4 leading-7 text-gray-600"
            >
                Berbagai program pendidikan dan pembinaan
                dirancang untuk mengembangkan ilmu,
                karakter dan potensi setiap santri.
            </p>

        </div>


        <div
            class="mt-14 grid gap-6
                   md:grid-cols-2 lg:grid-cols-3"
        >

            {{-- Card --}}
            <div
                class="group rounded-2xl border
                       border-gray-100 bg-white p-8
                       shadow-sm transition duration-300
                       hover:-translate-y-2
                       hover:shadow-xl"
            >

                <div
                    class="mb-6 flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-[#EAF7F0]
                           transition
                           group-hover:bg-[#087443]"
                >

                    <i
                        data-lucide="book-open-check"
                        class="h-7 w-7 text-[#087443]
                               group-hover:text-white"
                    ></i>

                </div>

                <h3
                    class="text-xl font-bold text-[#111111]"
                >
                    Pendidikan Qur'ani
                </h3>

                <p
                    class="mt-3 leading-7 text-gray-500"
                >
                    Membentuk kecintaan santri terhadap
                    Al-Qur'an melalui pembelajaran,
                    tahsin, tahfiz dan pembinaan.
                </p>

            </div>


            {{-- Card --}}
            <div
                class="group rounded-2xl border
                       border-gray-100 bg-white p-8
                       shadow-sm transition duration-300
                       hover:-translate-y-2
                       hover:shadow-xl"
            >

                <div
                    class="mb-6 flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-[#FFF8DE]
                           transition
                           group-hover:bg-[#F4C542]"
                >

                    <i
                        data-lucide="languages"
                        class="h-7 w-7 text-[#C99B20]
                               group-hover:text-[#111111]"
                    ></i>

                </div>

                <h3
                    class="text-xl font-bold text-[#111111]"
                >
                    Bahasa Arab
                </h3>

                <p
                    class="mt-3 leading-7 text-gray-500"
                >
                    Pembelajaran bahasa Arab secara
                    bertahap untuk mendukung kemampuan
                    komunikasi dan pemahaman literatur Islam.
                </p>

            </div>


            {{-- Card --}}
            <div
                class="group rounded-2xl border
                       border-gray-100 bg-white p-8
                       shadow-sm transition duration-300
                       hover:-translate-y-2
                       hover:shadow-xl"
            >

                <div
                    class="mb-6 flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-[#EAF7F0]
                           transition
                           group-hover:bg-[#087443]"
                >

                    <i
                        data-lucide="graduation-cap"
                        class="h-7 w-7 text-[#087443]
                               group-hover:text-white"
                    ></i>

                </div>

                <h3
                    class="text-xl font-bold text-[#111111]"
                >
                    Pendidikan Akademik
                </h3>

                <p
                    class="mt-3 leading-7 text-gray-500"
                >
                    Mengembangkan kemampuan akademik santri
                    agar mampu berprestasi dan melanjutkan
                    pendidikan ke jenjang berikutnya.
                </p>

            </div>


            {{-- Card --}}
            <div
                class="group rounded-2xl border
                       border-gray-100 bg-white p-8
                       shadow-sm transition duration-300
                       hover:-translate-y-2
                       hover:shadow-xl"
            >

                <div
                    class="mb-6 flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-[#EAF7F0]
                           transition
                           group-hover:bg-[#087443]"
                >

                    <i
                        data-lucide="heart-handshake"
                        class="h-7 w-7 text-[#087443]
                               group-hover:text-white"
                    ></i>

                </div>

                <h3
                    class="text-xl font-bold text-[#111111]"
                >
                    Pembinaan Akhlak
                </h3>

                <p
                    class="mt-3 leading-7 text-gray-500"
                >
                    Pembinaan karakter dan adab sebagai
                    bagian penting dalam kehidupan
                    setiap santri.
                </p>

            </div>


            {{-- Card --}}
            <div
                class="group rounded-2xl border
                       border-gray-100 bg-white p-8
                       shadow-sm transition duration-300
                       hover:-translate-y-2
                       hover:shadow-xl"
            >

                <div
                    class="mb-6 flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-[#FFF8DE]
                           transition
                           group-hover:bg-[#F4C542]"
                >

                    <i
                        data-lucide="trophy"
                        class="h-7 w-7 text-[#C99B20]
                               group-hover:text-[#111111]"
                    ></i>

                </div>

                <h3
                    class="text-xl font-bold text-[#111111]"
                >
                    Pengembangan Prestasi
                </h3>

                <p
                    class="mt-3 leading-7 text-gray-500"
                >
                    Mendorong santri mengembangkan bakat
                    dan kemampuan melalui berbagai
                    kegiatan akademik maupun non-akademik.
                </p>

            </div>


            {{-- Card --}}
            <div
                class="group rounded-2xl border
                       border-gray-100 bg-white p-8
                       shadow-sm transition duration-300
                       hover:-translate-y-2
                       hover:shadow-xl"
            >

                <div
                    class="mb-6 flex h-14 w-14
                           items-center justify-center
                           rounded-2xl bg-[#EAF7F0]
                           transition
                           group-hover:bg-[#087443]"
                >

                    <i
                        data-lucide="users-round"
                        class="h-7 w-7 text-[#087443]
                               group-hover:text-white"
                    ></i>

                </div>

                <h3
                    class="text-xl font-bold text-[#111111]"
                >
                    Kepemimpinan
                </h3>

                <p
                    class="mt-3 leading-7 text-gray-500"
                >
                    Melatih kemandirian, tanggung jawab,
                    kepemimpinan dan kepedulian sosial
                    dalam kehidupan santri.
                </p>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    KEUNGGULAN
========================================================= --}}
<section class="bg-white py-24">

    <div
        class="mx-auto max-w-7xl px-4
               sm:px-6 lg:px-8"
    >

        <div
            class="overflow-hidden rounded-[2rem]
                   bg-[#04532F]"
        >

            <div
                class="grid items-center
                       lg:grid-cols-2"
            >

                <div class="p-8 sm:p-12 lg:p-16">

                    <div
                        class="mb-5 inline-flex rounded-full
                               bg-white/10 px-4 py-2"
                    >
                        <span
                            class="text-sm font-semibold
                                   text-[#F4C542]"
                        >
                            NILAI KAMI
                        </span>
                    </div>

                    <h2
                        class="text-3xl font-black
                               text-white sm:text-4xl"
                    >
                        Pendidikan yang
                        <span class="text-[#F4C542]">
                            Menguatkan Karakter
                        </span>
                    </h2>

                    <p
                        class="mt-5 leading-8 text-white/70"
                    >
                        Kami percaya bahwa pendidikan bukan
                        hanya tentang kecerdasan akademik,
                        tetapi juga tentang iman, akhlak,
                        kemandirian dan kemampuan memberikan
                        manfaat bagi orang lain.
                    </p>

                    <div class="mt-8 space-y-5">

                        <div class="flex gap-4">

                            <div
                                class="flex h-10 w-10 shrink-0
                                       items-center justify-center
                                       rounded-xl bg-[#F4C542]"
                            >
                                <i
                                    data-lucide="check"
                                    class="h-5 w-5 text-[#111111]"
                                ></i>
                            </div>

                            <div>
                                <h3
                                    class="font-bold text-white"
                                >
                                    Lingkungan Islami
                                </h3>

                                <p
                                    class="mt-1 text-sm
                                           text-white/60"
                                >
                                    Lingkungan yang mendukung
                                    pembentukan karakter Islami.
                                </p>
                            </div>

                        </div>


                        <div class="flex gap-4">

                            <div
                                class="flex h-10 w-10 shrink-0
                                       items-center justify-center
                                       rounded-xl bg-[#F4C542]"
                            >
                                <i
                                    data-lucide="check"
                                    class="h-5 w-5 text-[#111111]"
                                ></i>
                            </div>

                            <div>
                                <h3
                                    class="font-bold text-white"
                                >
                                    Pembinaan Terarah
                                </h3>

                                <p
                                    class="mt-1 text-sm
                                           text-white/60"
                                >
                                    Pendampingan santri secara
                                    akademik dan karakter.
                                </p>
                            </div>

                        </div>


                        <div class="flex gap-4">

                            <div
                                class="flex h-10 w-10 shrink-0
                                       items-center justify-center
                                       rounded-xl bg-[#F4C542]"
                            >
                                <i
                                    data-lucide="check"
                                    class="h-5 w-5 text-[#111111]"
                                ></i>
                            </div>

                            <div>
                                <h3
                                    class="font-bold text-white"
                                >
                                    Pengembangan Potensi
                                </h3>

                                <p
                                    class="mt-1 text-sm
                                           text-white/60"
                                >
                                    Memberikan ruang bagi santri
                                    untuk berkembang dan berprestasi.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>


                <div
                    class="relative h-full min-h-[450px]"
                >

                    <img
                        src="https://images.unsplash.com/photo-1591543620764-3d7d0d6d0d3c?auto=format&fit=crop&w=1000&q=85"
                        alt="Kegiatan Santri"
                        class="absolute inset-0 h-full
                               w-full object-cover"
                    >

                    <div
                        class="absolute inset-0
                               bg-[#04532F]/20"
                    ></div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    BERITA
========================================================= --}}
<section
    id="berita"
    class="scroll-mt-24 bg-[#F5F7F6] py-24"
>

    <div
        class="mx-auto max-w-7xl px-4
               sm:px-6 lg:px-8"
    >

        <div
            class="flex flex-col justify-between gap-5
                   md:flex-row md:items-end"
        >

            <div>

                <div
                    class="mb-4 flex items-center gap-3"
                >

                    <span
                        class="h-[2px] w-10 bg-[#F4C542]"
                    ></span>

                    <span
                        class="text-sm font-bold uppercase
                               tracking-[0.2em] text-[#087443]"
                    >
                        Informasi
                    </span>

                </div>

                <h2
                    class="text-3xl font-black text-[#111111]
                           sm:text-4xl"
                >
                    Berita & Kegiatan
                </h2>

            </div>

            <a
                href="#"
                class="group inline-flex items-center
                       gap-2 font-bold text-[#087443]"
            >
                Lihat Semua

                <i
                    data-lucide="arrow-right"
                    class="h-5 w-5 transition
                           group-hover:translate-x-1"
                ></i>
            </a>

        </div>


        <div
            class="mt-12 grid gap-7
                   md:grid-cols-2 lg:grid-cols-3"
        >

            @foreach ([
                [
                    'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=900&q=85',
                    'category' => 'Pendidikan',
                    'title' => 'Membangun Semangat Belajar Santri',
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1609599006353-e629aaabfeae?auto=format&fit=crop&w=900&q=85',
                    'category' => 'Kegiatan',
                    'title' => 'Kegiatan Keislaman dan Pembinaan Santri',
                ],
                [
                    'image' => 'https://images.unsplash.com/photo-1532635248-3c0d3a9e3f4f?auto=format&fit=crop&w=900&q=85',
                    'category' => 'Pesantren',
                    'title' => 'Membangun Generasi Berakhlak Mulia',
                ],
            ] as $news)

                <article
                    class="group overflow-hidden rounded-2xl
                           bg-white shadow-sm transition
                           hover:-translate-y-2 hover:shadow-xl"
                >

                    <div class="relative overflow-hidden">

                        <img
                            src="{{ $news['image'] }}"
                            alt="{{ $news['title'] }}"
                            class="h-56 w-full object-cover
                                   transition duration-500
                                   group-hover:scale-105"
                        >

                        <span
                            class="absolute left-4 top-4
                                   rounded-lg bg-[#F4C542]
                                   px-3 py-1.5 text-xs
                                   font-bold text-[#111111]"
                        >
                            {{ $news['category'] }}
                        </span>

                    </div>

                    <div class="p-6">

                        <p
                            class="text-xs text-gray-400"
                        >
                            20 Agustus 2026
                        </p>

                        <h3
                            class="mt-3 text-xl font-bold
                                   leading-7 text-[#111111]
                                   transition
                                   group-hover:text-[#087443]"
                        >
                            {{ $news['title'] }}
                        </h3>

                        <a
                            href="#"
                            class="mt-5 inline-flex
                                   items-center gap-2
                                   text-sm font-bold
                                   text-[#087443]"
                        >
                            Baca Selengkapnya

                            <i
                                data-lucide="arrow-right"
                                class="h-4 w-4"
                            ></i>
                        </a>

                    </div>

                </article>

            @endforeach

        </div>

    </div>

</section>


{{-- =========================================================
    GALERI
========================================================= --}}
<section
    id="galeri"
    class="scroll-mt-24 bg-white py-24"
>

    <div
        class="mx-auto max-w-7xl px-4
               sm:px-6 lg:px-8"
    >

        <div class="mx-auto max-w-2xl text-center">

            <div
                class="mb-4 flex items-center
                       justify-center gap-3"
            >

                <span
                    class="h-[2px] w-10 bg-[#F4C542]"
                ></span>

                <span
                    class="text-sm font-bold uppercase
                           tracking-[0.2em] text-[#087443]"
                >
                    Dokumentasi
                </span>

                <span
                    class="h-[2px] w-10 bg-[#F4C542]"
                ></span>

            </div>

            <h2
                class="text-3xl font-black text-[#111111]
                       sm:text-4xl"
            >
                Galeri Pesantren
            </h2>

        </div>


        <div
            class="mt-12 grid grid-cols-2
                   gap-4 md:grid-cols-4"
        >

            <div
                class="group overflow-hidden rounded-2xl
                       md:col-span-2 md:row-span-2"
            >

                <img
                    src="https://images.unsplash.com/photo-1609599006353-e629aaabfeae?auto=format&fit=crop&w=1000&q=85"
                    alt="Galeri Pesantren"
                    class="h-full min-h-[350px] w-full
                           object-cover transition
                           duration-500
                           group-hover:scale-105"
                >

            </div>

            <div
                class="group overflow-hidden rounded-2xl"
            >

                <img
                    src="https://images.unsplash.com/photo-1542816417-0983c9c9ad53?auto=format&fit=crop&w=700&q=85"
                    alt="Kegiatan Santri"
                    class="h-56 w-full object-cover
                           transition duration-500
                           group-hover:scale-105"
                >

            </div>

            <div
                class="group overflow-hidden rounded-2xl"
            >

                <img
                    src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=700&q=85"
                    alt="Pendidikan"
                    class="h-56 w-full object-cover
                           transition duration-500
                           group-hover:scale-105"
                >

            </div>

            <div
                class="group overflow-hidden rounded-2xl"
            >

                <img
                    src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=700&q=85"
                    alt="Kegiatan"
                    class="h-56 w-full object-cover
                           transition duration-500
                           group-hover:scale-105"
                >

            </div>

            <div
                class="group overflow-hidden rounded-2xl"
            >

                <img
                    src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=700&q=85"
                    alt="Pembelajaran"
                    class="h-56 w-full object-cover
                           transition duration-500
                           group-hover:scale-105"
                >

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    PENDAFTARAN CTA
========================================================= --}}
<section
    id="pendaftaran"
    class="scroll-mt-24 bg-[#087443] py-20"
>

    <div
        class="mx-auto max-w-5xl px-4
               text-center sm:px-6 lg:px-8"
    >

        <div
            class="mx-auto flex h-16 w-16
                   items-center justify-center
                   rounded-2xl bg-[#F4C542]"
        >

            <i
                data-lucide="graduation-cap"
                class="h-8 w-8 text-[#111111]"
            ></i>

        </div>

        <h2
            class="mt-7 text-3xl font-black text-white
                   sm:text-4xl lg:text-5xl"
        >
            Siap Menjadi Bagian dari
            <span class="text-[#F4C542]">
                Darel Arifien?
            </span>
        </h2>

        <p
            class="mx-auto mt-5 max-w-2xl
                   leading-8 text-white/75"
        >
            Bergabunglah bersama keluarga besar
            Pesantren Darel Arifien dan tumbuh bersama
            dalam lingkungan pendidikan yang Islami,
            berilmu dan berakhlak.
        </p>

        <div
            class="mt-8 flex flex-col justify-center
                   gap-4 sm:flex-row"
        >

            <a
                href="#"
                class="inline-flex items-center
                       justify-center gap-3 rounded-xl
                       bg-[#F4C542] px-8 py-4
                       font-bold text-[#111111]
                       shadow-xl transition
                       hover:bg-[#e8b82f]"
            >
                Daftar Sekarang

                <i
                    data-lucide="arrow-right"
                    class="h-5 w-5"
                ></i>
            </a>

            <a
                href="#kontak"
                class="inline-flex items-center
                       justify-center gap-3 rounded-xl
                       border border-white/30
                       px-8 py-4 font-bold text-white
                       transition hover:bg-white/10"
            >
                Hubungi Kami
            </a>

        </div>

    </div>

</section>

@endsection