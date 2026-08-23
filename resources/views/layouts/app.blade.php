<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="@yield(
            'description',
            'Website Resmi Pesantren {{ $settings['school_name'] ?? '' }}'
        )">

    <title>
        @yield('title', 'Pesantren {{ $settings['school_name'] ?? '' }}')
    </title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>


<body
    class="min-h-screen
           bg-[#F5F7F6]
           text-gray-900
           antialiased">


    {{-- NAVBAR --}}

    <header
        class="sticky top-0 z-50
               border-b border-white/10
               bg-[#062E1F]/95
               shadow-lg
               backdrop-blur-xl">

        <div
            class="mx-auto
                   flex h-20
                   max-w-7xl
                   items-center
                   justify-between
                   px-6
                   sm:px-10
                   lg:px-16">

            {{-- LOGO --}}

            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3">

                <div
                    class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-[#F4C542]
                           shadow-lg">

                    <span
                        class="text-lg
                               font-black
                               text-[#062E1F]">
                        DA
                    </span>

                </div>


                <div>

                    <p
                        class="text-sm
                               font-black
                               leading-none
                               text-white">
                        {{ $settings['school_name'] ?? '' }}
                    </p>

                    <p
                        class="mt-1
                               text-[10px]
                               font-bold
                               uppercase
                               tracking-[0.18em]
                               text-white/40">
                        Pesantren
                    </p>

                </div>

            </a>


            {{-- DESKTOP NAVIGATION --}}

            <nav
                class="hidden
                       items-center
                       gap-1
                       lg:flex">

                <a
                    href="{{ route('home') }}"
                    class="rounded-xl px-4 py-2.5
                           text-sm font-bold
                           text-white/70
                           transition
                           hover:bg-white/5
                           hover:text-white">
                    Beranda
                </a>


                <a
                    href="{{ route('profile') }}"
                    class="rounded-xl px-4 py-2.5
                           text-sm font-bold
                           text-white/70
                           transition
                           hover:bg-white/5
                           hover:text-white">
                    Profil
                </a>


                <a
                    href="{{ route('programs.index') }}"
                    class="rounded-xl px-4 py-2.5
                           text-sm font-bold
                           text-white/70
                           transition
                           hover:bg-white/5
                           hover:text-white">
                    Program
                </a>


                <a
                    href="{{ route('teachers.index') }}"
                    class="rounded-xl px-4 py-2
           text-sm font-semibold
           text-white/80
           transition
           hover:bg-white/10
           hover:text-white">
                    Pengasuh
                </a>


                <a
                    href="{{ route('news.index') }}"
                    class="rounded-xl px-4 py-2.5
                           text-sm font-bold
                           text-white/70
                           transition
                           hover:bg-white/5
                           hover:text-white">
                    Berita
                </a>


                <a
                    href="{{ route('contact') }}"
                    class="rounded-xl px-4 py-2.5
                           text-sm font-bold
                           text-white/70
                           transition
                           hover:bg-white/5
                           hover:text-white">
                    Kontak
                </a>

            </nav>


            {{-- CTA --}}

            <a
                href="{{ route(
                    'registration.create'
                ) }}"
                class="hidden
                       items-center
                       gap-2
                       rounded-xl
                       bg-[#F4C542]
                       px-5 py-3
                       text-sm
                       font-black
                       text-[#062E1F]
                       transition
                       hover:-translate-y-0.5
                       hover:bg-[#FFD85C]
                       sm:flex">

                Daftar Sekarang

                <i
                    data-lucide="arrow-up-right"
                    class="h-4 w-4"></i>

            </a>


            {{-- MOBILE BUTTON --}}

            <button
                type="button"
                id="mobile-menu-button"
                class="flex h-11 w-11
                       items-center
                       justify-center
                       rounded-xl
                       text-white
                       hover:bg-white/5
                       lg:hidden">

                <i
                    data-lucide="menu"
                    class="h-6 w-6"></i>

            </button>

        </div>

        {{-- MOBILE MENU --}}

        <div
            id="mobile-menu"
            class="hidden
           border-t
           border-white/10
           bg-[#062E1F]
           lg:hidden">

            <nav
                class="flex
               flex-col
               gap-1
               px-6
               py-4">

                <a
                    href="{{ route('home') }}"
                    class="rounded-xl
                   px-4 py-3
                   text-sm
                   font-bold
                   text-white/70
                   transition
                   hover:bg-white/5
                   hover:text-white">
                    Beranda
                </a>


                <a
                    href="{{ route('profile') }}"
                    class="rounded-xl
                   px-4 py-3
                   text-sm
                   font-bold
                   text-white/70
                   transition
                   hover:bg-white/5
                   hover:text-white">
                    Profil
                </a>


                <a
                    href="{{ route('programs.index') }}"
                    class="rounded-xl
                   px-4 py-3
                   text-sm
                   font-bold
                   text-white/70
                   transition
                   hover:bg-white/5
                   hover:text-white">
                    Program
                </a>


                <a
                    href="{{ route('teachers.index') }}"
                    class="rounded-xl
                   px-4 py-3
                   text-sm
                   font-bold
                   text-white/70
                   transition
                   hover:bg-white/5
                   hover:text-white">
                    Pengasuh
                </a>


                <a
                    href="{{ route('news.index') }}"
                    class="rounded-xl
                   px-4 py-3
                   text-sm
                   font-bold
                   text-white/70
                   transition
                   hover:bg-white/5
                   hover:text-white">
                    Berita
                </a>


                <a
                    href="{{ route('contact') }}"
                    class="rounded-xl
                   px-4 py-3
                   text-sm
                   font-bold
                   text-white/70
                   transition
                   hover:bg-white/5
                   hover:text-white">
                    Kontak
                </a>


                <a
                    href="{{ route('registration.create') }}"
                    class="mt-3
                   flex
                   items-center
                   justify-center
                   gap-2
                   rounded-xl
                   bg-[#F4C542]
                   px-4 py-3
                   text-sm
                   font-black
                   text-[#062E1F]
                   transition
                   hover:bg-[#FFD85C]">

                    Daftar Sekarang

                    <i
                        data-lucide="arrow-up-right"
                        class="h-4 w-4"></i>

                </a>

            </nav>

        </div>

        {{-- CONTENT --}}

        <main>

            @yield('content')

        </main>


        {{-- FOOTER --}}

        <footer
            id="kontak"
            class="bg-[#041F15]
               text-white">

            <div
                class="mx-auto
                   max-w-7xl
                   px-6 py-14
                   sm:px-10
                   lg:px-16">

                <div
                    class="grid gap-10
                       md:grid-cols-2
                       lg:grid-cols-4">

                    {{-- BRAND --}}

                    <div
                        class="lg:col-span-2">

                        <div
                            class="flex items-center gap-3">

                            <div
                                class="flex h-11 w-11
                                   items-center
                                   justify-center
                                   rounded-xl
                                   bg-[#F4C542]">

                                <span
                                    class="font-black
                                       text-[#062E1F]">
                                    DA
                                </span>

                            </div>


                            <div>

                                <p
                                    class="font-black">
                                    {{ $settings['school_name'] ?? '' }}
                                </p>

                                <p
                                    class="text-xs
                                       text-white/40">
                                    Pesantren
                                </p>

                            </div>

                        </div>


                        <p
                            class="mt-6
                               max-w-md
                               text-sm
                               leading-7
                               text-white/50">
                            Membentuk generasi yang
                            berilmu, berakhlak,
                            mandiri dan mampu
                            memberikan manfaat
                            bagi masyarakat.
                        </p>

                    </div>


                    {{-- CONTACT --}}

                    <div>

                        <h3
                            class="text-sm
                               font-black
                               text-[#F4C542]">
                            Kontak
                        </h3>


                        <div
                            class="mt-5
                               space-y-4
                               text-sm
                               text-white/50">

                            <div
                                class="flex gap-3">

                                <i
                                    data-lucide="map-pin"
                                    class="mt-0.5
                                       h-5 w-5
                                       shrink-0
                                       text-[#F4C542]"></i>

                                <span>
                                    Alamat Pesantren : {{ $settings['address'] ?? '' }}
                                </span>

                            </div>


                            <div
                                class="flex gap-3">

                                <i
                                    data-lucide="phone"
                                    class="h-5 w-5
                                       shrink-0
                                       text-[#F4C542]"></i>

                                <span>
                                    Nomor Telepon : {{ $settings['phone'] ?? '' }}
                                </span>

                            </div>


                            <div
                                class="flex gap-3">

                                <i
                                    data-lucide="mail"
                                    class="h-5 w-5
                                       shrink-0
                                       text-[#F4C542]"></i>

                                <span>
                                    Email : {{ $settings['email'] ?? '' }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                <div
                    class="mt-12
                       border-t
                       border-white/10
                       pt-6">

                    <p
                        class="text-center
                           text-xs
                           text-white/30">
                        © {{ date('Y') }}
                        Pesantren {{ $settings['school_name'] ?? '' }}.
                        All rights reserved.
                    </p>

                </div>

            </div>

        </footer>


        {{-- MOBILE MENU SCRIPT --}}

        <script>
            document
                .getElementById('mobile-menu-button')
                ?.addEventListener(
                    'click',
                    function() {

                        const menu =
                            document.getElementById(
                                'mobile-menu'
                            );

                        menu.classList.toggle(
                            'hidden'
                        );

                    }
                );
        </script>

</body>

</html>