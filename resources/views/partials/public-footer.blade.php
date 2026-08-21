<footer class="bg-[#041D14] text-white">

    <div class="mx-auto max-w-7xl px-5 py-8 lg:px-8">

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">

            {{-- BRAND --}}
            <div class="lg:col-span-2">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center
                               rounded-lg bg-[#F4C542] text-[#062E1F]"
                    >
                        <i
                            data-lucide="landmark"
                            class="h-5 w-5"
                        ></i>
                    </div>

                    <div>
                        <p class="font-black tracking-wide">
                            {{ $settings['school_name'] ?? '' }}
                        </p>

                        <p class="text-xs text-[#F4C542]">
                            PESANTREN
                        </p>
                    </div>

                </div>

                <p class="mt-3 max-w-lg text-sm leading-6 text-white/50">
                    Lembaga pendidikan Islam yang berkomitmen membentuk
                    generasi berilmu, berakhlak dan berkarakter.
                </p>


                {{-- SOCIAL MEDIA --}}
                <div class="mt-4 flex gap-2">

                    {{-- INSTAGRAM --}}
                    <a
                        href="https://www.instagram.com/daarelarifiin?igsi=bmE5ZTlwdTU1cG1j"
                        aria-label="Instagram"
                        class="flex h-9 w-9 items-center justify-center
                               rounded-lg bg-white/5 text-white/60
                               transition hover:bg-[#F4C542]
                               hover:text-[#062E1F]"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4"
                        >
                            <rect
                                width="20"
                                height="20"
                                x="2"
                                y="2"
                                rx="5"
                            />
                            <circle
                                cx="12"
                                cy="12"
                                r="4"
                            />
                            <circle
                                cx="17.5"
                                cy="6.5"
                                r="1"
                                fill="currentColor"
                                stroke="none"
                            />
                        </svg>
                    </a>


                    {{-- YOUTUBE --}}
                    <a
                        href="#"
                        aria-label="YouTube"
                        class="flex h-9 w-9 items-center justify-center
                               rounded-lg bg-white/5 text-white/60
                               transition hover:bg-[#F4C542]
                               hover:text-[#062E1F]"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="h-4 w-4"
                        >
                            <path
                                d="M23.5 6.2a3 3 0 0 0-2.1-2.1
                                C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6
                                A3 3 0 0 0 .5 6.2 31.7 31.7 0 0 0 0
                                12a31.7 31.7 0 0 0 .5 5.8 3 3 0 0 0
                                2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6
                                a3 3 0 0 0 2.1-2.1A31.7 31.7 0 0 0 24
                                12a31.7 31.7 0 0 0-.5-5.8Z"
                            />
                            <path
                                d="m9.75 15.5 5.5-3.5-5.5-3.5v7Z"
                                fill="#041D14"
                            />
                        </svg>
                    </a>

                    {{-- FACEBOOK --}}
<a
    href="https://www.facebook.com/pontren.daar.el.arifiin?mibextid=rS40aB7S9Ucbxw6v"
    aria-label="Facebook"
    class="flex h-9 w-9 items-center justify-center
           rounded-lg bg-white/5 text-white/60
           transition hover:bg-[#F4C542]
           hover:text-[#062E1F]"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor"
        class="h-4 w-4"
    >
        <path
            d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07
            C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41
            c0-3.03 1.79-4.72 4.56-4.72 1.32 0 2.7.24 2.7.24v2.98
            h-1.52c-1.5 0-1.97.94-1.97 1.9v2.28h3.35l-.54 3.49H13.9V24
            C19.61 23.1 24 18.1 24 12.07Z"
        />
    </svg>
</a>


{{-- TIKTOK --}}
<a
    href="#"
    aria-label="TikTok"
    class="flex h-9 w-9 items-center justify-center
           rounded-lg bg-white/5 text-white/60
           transition hover:bg-[#F4C542]
           hover:text-[#062E1F]"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor"
        class="h-4 w-4"
    >
        <path
            d="M19.59 6.69a4.83 4.83 0 0 1-4.77-4.47V2h-3.86v13.67
            a2.91 2.91 0 1 1-2-2.76v-3.93a6.8 6.8 0 1 0 5.86 6.72V8.37
            a8.68 8.68 0 0 0 5.12 1.68V6.69h-.35Z"
        />
    </svg>
</a>

                </div>

            </div>


            {{-- CONTACT --}}
            <div>

                <h3 class="font-black">
                    Hubungi Kami
                </h3>

                <ul class="mt-3 space-y-2.5 text-sm text-white/50">

                    <li class="flex gap-3">

                        <i
                            data-lucide="map-pin"
                            class="mt-0.5 h-4 w-4 shrink-0
                                   text-[#F4C542]"
                        ></i>

                        <span>
                        Simatorkis
                        </span>

                    </li>


                    <li class="flex gap-3">

                        <i
                            data-lucide="phone"
                            class="h-4 w-4 shrink-0
                                   text-[#F4C542]"
                        ></i>

                        <span>
                            082274356886
                        </span>

                    </li>


                    <li class="flex gap-3">

                        <i
                            data-lucide="mail"
                            class="h-4 w-4 shrink-0
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
        <div class="mt-8 border-t border-white/10 pt-4">

            <p class="text-center text-xs text-white/30">
                © {{ date('Y') }}
                {{ $settings['school_name'] ?? '' }}
                Hak cipta dilindungi.
            </p>

        </div>

    </div>

</footer>