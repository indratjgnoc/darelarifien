<header
    x-data="{ open: false, scrolled: false }"
    x-init="
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 20
        })
    "
    :class="scrolled
        ? 'bg-white/95 shadow-lg'
        : 'bg-white'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>

    {{-- Top Bar --}}
    <div class="bg-[#04532F] text-white">
        <div
            class="mx-auto flex max-w-7xl items-center justify-between
                   px-4 py-2 text-sm sm:px-6 lg:px-8"
        >

            <div class="hidden items-center gap-5 md:flex">

                <span class="flex items-center gap-2">
                    <i data-lucide="phone" class="h-4 w-4 text-[#F4C542]"></i>
                    Informasi Pesantren
                </span>

                <span class="flex items-center gap-2">
                    <i data-lucide="mail" class="h-4 w-4 text-[#F4C542]"></i>
                    info@darelarifien.sch.id
                </span>

            </div>

            <div class="flex items-center gap-4 md:ml-auto">

                <a
                    href="#"
                    class="transition hover:text-[#F4C542]"
                >
                    <i data-lucide="facebook" class="h-4 w-4"></i>
                </a>

                <a
                    href="#"
                    class="transition hover:text-[#F4C542]"
                >
                    <i data-lucide="instagram" class="h-4 w-4"></i>
                </a>

                <a
                    href="#"
                    class="transition hover:text-[#F4C542]"
                >
                    <i data-lucide="youtube" class="h-4 w-4"></i>
                </a>

            </div>

        </div>
    </div>


    {{-- Main Navbar --}}
    <nav class="border-b border-gray-100">

        <div
            class="mx-auto flex max-w-7xl items-center justify-between
                   px-4 py-4 sm:px-6 lg:px-8"
        >

            {{-- Logo --}}
            <a
                href="{{ url('/') }}"
                class="group flex items-center gap-3"
            >

                {{-- Logo Placeholder --}}
                <div
                    class="flex h-12 w-12 items-center justify-center
                           rounded-xl bg-[#087443] shadow-md
                           transition group-hover:bg-[#04532F]"
                >
                    <span
                        class="text-xl font-bold text-[#F4C542]"
                    >
                        DA
                    </span>
                </div>

                <div>
                    <h1
                        class="text-lg font-extrabold leading-tight
                               tracking-wide text-[#04532F]"
                    >
                        {{ $settings['school_name'] ?? '' }}
                    </h1>

                    <p
                        class="text-[10px] font-semibold uppercase
                               tracking-[0.2em] text-gray-500"
                    >
                        Pesantren
                    </p>
                </div>

            </a>


            {{-- Desktop Menu --}}
            <div class="hidden items-center gap-7 lg:flex">

                <a
                    href="{{ url('/') }}"
                    class="font-semibold text-[#087443]
                           transition hover:text-[#04532F]"
                >
                    Beranda
                </a>

                <a
                    href="#profil"
                    class="font-medium text-gray-700
                           transition hover:text-[#087443]"
                >
                    Profil
                </a>

                <a
                    href="#pendidikan"
                    class="font-medium text-gray-700
                           transition hover:text-[#087443]"
                >
                    Pendidikan
                </a>

                <a
                    href="#berita"
                    class="font-medium text-gray-700
                           transition hover:text-[#087443]"
                >
                    Informasi
                </a>

                <a
                    href="#galeri"
                    class="font-medium text-gray-700
                           transition hover:text-[#087443]"
                >
                    Galeri
                </a>

                <a
                    href="#kontak"
                    class="font-medium text-gray-700
                           transition hover:text-[#087443]"
                >
                    Kontak
                </a>

            </div>


            {{-- CTA --}}
            <a
                href="#pendaftaran"
                class="hidden items-center gap-2 rounded-lg
                       bg-[#F4C542] px-5 py-3 text-sm
                       font-bold text-[#111111]
                       shadow-md transition
                       hover:bg-[#C99B20]
                       lg:flex"
            >
                <i data-lucide="file-pen-line" class="h-4 w-4"></i>

                Pendaftaran
            </a>


            {{-- Mobile Button --}}
            <button
                @click="open = !open"
                class="rounded-lg p-2 text-[#04532F]
                       hover:bg-[#EAF7F0] lg:hidden"
            >
                <i
                    x-show="!open"
                    data-lucide="menu"
                    class="h-6 w-6"
                ></i>

                <i
                    x-show="open"
                    data-lucide="x"
                    class="h-6 w-6"
                ></i>
            </button>

        </div>


        {{-- Mobile Menu --}}
        <div
            x-show="open"
            x-transition
            class="border-t border-gray-100 bg-white lg:hidden"
        >

            <div class="space-y-1 px-4 py-4">

                <a
                    href="{{ url('/') }}"
                    class="block rounded-lg bg-[#EAF7F0]
                           px-4 py-3 font-semibold text-[#087443]"
                >
                    Beranda
                </a>

                <a
                    href="#profil"
                    @click="open = false"
                    class="block rounded-lg px-4 py-3
                           font-medium text-gray-700
                           hover:bg-[#EAF7F0]"
                >
                    Profil
                </a>

                <a
                    href="#pendidikan"
                    @click="open = false"
                    class="block rounded-lg px-4 py-3
                           font-medium text-gray-700
                           hover:bg-[#EAF7F0]"
                >
                    Pendidikan
                </a>

                <a
                    href="#berita"
                    @click="open = false"
                    class="block rounded-lg px-4 py-3
                           font-medium text-gray-700
                           hover:bg-[#EAF7F0]"
                >
                    Informasi
                </a>

                <a
                    href="#galeri"
                    @click="open = false"
                    class="block rounded-lg px-4 py-3
                           font-medium text-gray-700
                           hover:bg-[#EAF7F0]"
                >
                    Galeri
                </a>

                <a
                    href="#kontak"
                    @click="open = false"
                    class="block rounded-lg px-4 py-3
                           font-medium text-gray-700
                           hover:bg-[#EAF7F0]"
                >
                    Kontak
                </a>

                <a
                    href="#pendaftaran"
                    @click="open = false"
                    class="mt-3 flex items-center justify-center
                           gap-2 rounded-lg bg-[#F4C542]
                           px-4 py-3 font-bold text-[#111111]"
                >
                    <i
                        data-lucide="file-pen-line"
                        class="h-4 w-4"
                    ></i>

                    Pendaftaran
                </a>

            </div>

        </div>

    </nav>

</header>