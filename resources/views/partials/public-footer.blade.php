<footer
    class="bg-[#041D14]
           text-white"
>

    <div
        class="mx-auto
               max-w-7xl
               px-5 py-16
               lg:px-8"
    >

        <div
            class="grid gap-10
                   md:grid-cols-2
                   lg:grid-cols-4"
        >


            {{-- BRAND --}}

            <div class="lg:col-span-2">

                <div
                    class="flex items-center gap-3"
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
                            data-lucide="landmark"
                            class="h-6 w-6"
                        ></i>

                    </div>


                    <div>

                        <p
                            class="font-black
                                   tracking-wide"
                        >
                            DAREL ARIFIEN
                        </p>

                        <p
                            class="text-xs
                                   text-[#F4C542]"
                        >
                            PESANTREN

                        </p>

                    </div>

                </div>


                <p
                    class="mt-6 max-w-lg
                           leading-7
                           text-white/50"
                >
                    Lembaga pendidikan Islam yang
                    berkomitmen membentuk generasi
                    berilmu, berakhlak dan
                    berkarakter.
                </p>


                <div
                    class="mt-6 flex gap-3"
                >

                    <a
                        href="#"
                        class="flex h-10 w-10
                               items-center
                               justify-center
                               rounded-xl
                               bg-white/5
                               text-white/60
                               transition
                               hover:bg-[#F4C542]
                               hover:text-[#062E1F]"
                    >

                        <i
                            data-lucide="instagram"
                            class="h-5 w-5"
                        ></i>

                    </a>


                    <a
                        href="#"
                        class="flex h-10 w-10
                               items-center
                               justify-center
                               rounded-xl
                               bg-white/5
                               text-white/60
                               transition
                               hover:bg-[#F4C542]
                               hover:text-[#062E1F]"
                    >

                        <i
                            data-lucide="youtube"
                            class="h-5 w-5"
                        ></i>

                    </a>

                </div>

            </div>


            {{-- NAVIGATION --}}

            <div>

                <h3
                    class="font-black"
                >
                    Navigasi
                </h3>

                <ul
                    class="mt-5 space-y-3
                           text-sm text-white/50"
                >

                    <li>
                        <a
                            href="#profil"
                            class="transition
                                   hover:text-[#F4C542]"
                        >
                            Profil
                        </a>
                    </li>

                    <li>
                        <a
                            href="#program"
                            class="transition
                                   hover:text-[#F4C542]"
                        >
                            Program Pendidikan
                        </a>
                    </li>

                    <li>
                        <a
                            href="#berita"
                            class="transition
                                   hover:text-[#F4C542]"
                        >
                            Berita
                        </a>
                    </li>

                    <li>
                        <a
                            href="#galeri"
                            class="transition
                                   hover:text-[#F4C542]"
                        >
                            Galeri
                        </a>
                    </li>

                </ul>

            </div>


            {{-- CONTACT --}}

            <div>

                <h3
                    class="font-black"
                >
                    Hubungi Kami
                </h3>

                <ul
                    class="mt-5 space-y-4
                           text-sm
                           text-white/50"
                >

                    <li class="flex gap-3">

                        <i
                            data-lucide="map-pin"
                            class="mt-0.5
                                   h-5 w-5
                                   shrink-0
                                   text-[#F4C542]"
                        ></i>

                        <span>
                            Alamat Pesantren
                        </span>

                    </li>


                    <li class="flex gap-3">

                        <i
                            data-lucide="phone"
                            class="h-5 w-5
                                   shrink-0
                                   text-[#F4C542]"
                        ></i>

                        <span>
                            Nomor Telepon
                        </span>

                    </li>


                    <li class="flex gap-3">

                        <i
                            data-lucide="mail"
                            class="h-5 w-5
                                   shrink-0
                                   text-[#F4C542]"
                        ></i>

                        <span>
                            Email Pesantren
                        </span>

                    </li>

                </ul>

            </div>

        </div>


        {{-- COPYRIGHT --}}

        <div
            class="mt-14
                   border-t border-white/10
                   pt-6"
        >

            <p
                class="text-center
                       text-xs
                       text-white/30"
            >
                © {{ date('Y') }}
                Pesantren Darel Arifien.
                All rights reserved.
            </p>

        </div>

    </div>

</footer>