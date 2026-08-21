<header
    class="sticky top-0 z-50
           border-b border-white/10
           bg-[#062E1F]/95
           shadow-lg
           backdrop-blur-xl"
>

    <div
        class="mx-auto flex h-20
               max-w-7xl
               items-center
               justify-between
               px-5 lg:px-8"
    >


        {{-- LOGO --}}

        <a
            href="{{ route('home') }}"
            class="flex items-center gap-3"
        >

            <div
                class="flex h-11 w-11
                       items-center
                       justify-center
                       rounded-xl
                       bg-[#F4C542]
                       text-[#062E1F]"
            >

                <i
                    data-lucide="landmark"
                    class="h-6 w-6"
                ></i>

            </div>


            <div>

                <p
                    class="text-sm
                           font-black
                           tracking-wide
                           text-white"
                >
                    {{ $settings['school_name'] ?? '' }}
                </p>

                <p
                    class="text-[10px]
                           font-semibold
                           uppercase
                           tracking-[0.2em]
                           text-[#F4C542]"
                >
                    Pesantren
                </p>

            </div>

        </a>


        {{-- DESKTOP NAVIGATION --}}

        <nav
            class="hidden items-center
                   gap-1 lg:flex"
        >

            <a
                href="{{ route('home') }}"
                class="rounded-xl px-4 py-2
                       text-sm font-semibold
                       text-white/80
                       transition
                       hover:bg-white/10
                       hover:text-white"
            >
                Beranda
            </a>


            <a href="{{ route('profile') }}">
                Profil
            </a>

            <a href="{{ route('news.index') }}">
                Berita
            </a>

<a
    href="{{ route('events.index') }}"
    class="rounded-xl px-4 py-2
           text-sm font-semibold
           text-white/80
           transition
           hover:bg-white/10
           hover:text-white"
>
    Agenda
</a>

            <a href="{{ route('gallery.index') }}">
                Galeri
            </a>

        </nav>


        {{-- CTA --}}

        <a
    href="{{ route('registration.create') }}"
            class="hidden items-center
                   gap-2 rounded-xl
                   bg-[#F4C542]
                   px-5 py-3
                   text-sm font-black
                   text-[#062E1F]
                   shadow-lg
                   transition
                   hover:-translate-y-0.5
                   hover:bg-[#FFD95A]
                   lg:flex"
        >

            <i
                data-lucide="arrow-up-right"
                class="h-4 w-4"
            ></i>

            Pendaftaran

        </a>


        {{-- MOBILE BUTTON --}}

        <button
            type="button"
            class="rounded-xl
                   p-2 text-white
                   hover:bg-white/10
                   lg:hidden"
        >

            <i
                data-lucide="menu"
                class="h-6 w-6"
            ></i>

        </button>

    </div>

</header>