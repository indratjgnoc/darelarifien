<footer
    id="kontak"
    class="bg-[#111111] text-white"
>

    {{-- Main Footer --}}
    <div
        class="mx-auto grid max-w-7xl gap-10
               px-4 py-16 sm:px-6
               md:grid-cols-2 lg:grid-cols-4
               lg:px-8"
    >

        {{-- Brand --}}
        <div>

            <div class="mb-5 flex items-center gap-3">

                <div
                    class="flex h-12 w-12 items-center justify-center
                           rounded-xl bg-[#087443]"
                >
                    <span class="text-xl font-bold text-[#F4C542]">
                        DA
                    </span>
                </div>

                <div>
                    <h3 class="font-bold tracking-wide">
                        {{ $settings['school_name'] ?? '' }}
                    </h3>

                    <p class="text-xs text-gray-400">
                        Pesantren
                    </p>
                </div>

            </div>

            <p class="text-sm leading-7 text-gray-400">
                Pesantren {{ $settings['school_name'] ?? '' }} hadir untuk membentuk
                generasi yang berilmu, berakhlak mulia,
                mandiri dan berpegang teguh pada nilai-nilai
                Al-Qur'an dan Sunnah.
            </p>

        </div>


        {{-- Navigation --}}
        <div>

            <h3
                class="mb-5 text-lg font-bold"
            >
                Navigasi
            </h3>

            <div
                class="mb-5 h-1 w-10 rounded-full bg-[#F4C542]"
            ></div>

            <ul class="space-y-3 text-sm text-gray-400">

                <li>
                    <a
                        href="#profil"
                        class="transition hover:text-[#F4C542]"
                    >
                        Profil Pesantren
                    </a>
                </li>

                <li>
                    <a
                        href="#pendidikan"
                        class="transition hover:text-[#F4C542]"
                    >
                        Program Pendidikan
                    </a>
                </li>

                <li>
                    <a
                        href="#berita"
                        class="transition hover:text-[#F4C542]"
                    >
                        Berita
                    </a>
                </li>

                <li>
                    <a
                        href="#galeri"
                        class="transition hover:text-[#F4C542]"
                    >
                        Galeri
                    </a>
                </li>

                <li>
                    <a
                        href="#pendaftaran"
                        class="transition hover:text-[#F4C542]"
                    >
                        Pendaftaran
                    </a>
                </li>

            </ul>

        </div>


        {{-- Contact --}}
        <div>

            <h3
                class="mb-5 text-lg font-bold"
            >
                Hubungi Kami
            </h3>

            <div
                class="mb-5 h-1 w-10 rounded-full bg-[#F4C542]"
            ></div>

            <ul class="space-y-4 text-sm text-gray-400">

                <li class="flex gap-3">

                    <i
                        data-lucide="map-pin"
                        class="mt-1 h-5 w-5 shrink-0 text-[#F4C542]"
                    ></i>

                    <span>
                        Alamat Pesantren {{ $settings['school_name'] ?? '' }}
                    </span>

                </li>

                <li class="flex gap-3">

                    <i
                        data-lucide="phone"
                        class="h-5 w-5 shrink-0 text-[#F4C542]"
                    ></i>

                    <span>
                        Nomor WhatsApp Pesantren
                    </span>

                </li>

                <li class="flex gap-3">

                    <i
                        data-lucide="mail"
                        class="h-5 w-5 shrink-0 text-[#F4C542]"
                    ></i>

                    <span>
                        Email Pesantren
                    </span>

                </li>

            </ul>

        </div>


        {{-- Social --}}
        <div>

            <h3
                class="mb-5 text-lg font-bold"
            >
                Ikuti Kami
            </h3>

            <div
                class="mb-5 h-1 w-10 rounded-full bg-[#F4C542]"
            ></div>

            <p
                class="mb-5 text-sm leading-6 text-gray-400"
            >
                Dapatkan informasi terbaru mengenai
                kegiatan dan aktivitas Pesantren
                {{ $settings['school_name'] ?? '' }}.
            </p>

            <div class="flex gap-3">

                <a
                    href="#"
                    class="flex h-10 w-10 items-center
                           justify-center rounded-lg
                           bg-[#1A1A1A]
                           transition hover:bg-[#087443]"
                >
                    <i
                        data-lucide="facebook"
                        class="h-5 w-5"
                    ></i>
                </a>

                <a
                    href="#"
                    class="flex h-10 w-10 items-center
                           justify-center rounded-lg
                           bg-[#1A1A1A]
                           transition hover:bg-[#087443]"
                >
                    <i
                        data-lucide="instagram"
                        class="h-5 w-5"
                    ></i>
                </a>

                <a
                    href="#"
                    class="flex h-10 w-10 items-center
                           justify-center rounded-lg
                           bg-[#1A1A1A]
                           transition hover:bg-[#087443]"
                >
                    <i
                        data-lucide="youtube"
                        class="h-5 w-5"
                    ></i>
                </a>

            </div>

        </div>

    </div>


    {{-- Bottom --}}
    <div class="border-t border-white/10">

        <div
            class="mx-auto flex max-w-7xl flex-col
                   items-center justify-between gap-3
                   px-4 py-5 text-center text-sm
                   text-gray-500 sm:px-6
                   md:flex-row md:text-left lg:px-8"
        >

            <p>
                © {{ date('Y') }}
                Pesantren {{ $settings['school_name'] ?? '' }}.
                Semua Hak Dilindungi.
            </p>

            <p>
                Dibangun dengan
                <span class="font-semibold text-[#087443]">
                    Laravel
                </span>
            </p>

        </div>

    </div>

</footer>