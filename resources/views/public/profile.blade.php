@extends('layouts.public')

@section('title', 'Profil Pesantren')

@section('content')

{{-- HERO --}}

<section class="bg-[#062E1F] py-20">

    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        <p
            class="text-sm font-black uppercase
                   tracking-widest text-[#F4C542]"
        >
            Tentang Kami
        </p>

        <h1
            class="mt-3 text-4xl font-black
                   text-white sm:text-5xl"
        >
           {{ $settings['school_name'] ?? '' }}
        </h1>

        <p
            class="mt-5 max-w-2xl
                   text-base leading-8
                   text-white/50"
        >
            Mengenal lebih dekat
            pesantren dan pendidikan
            yang kami kembangkan.
        </p>

    </div>

</section>


{{-- DESKRIPSI --}}

<section class="bg-white py-20">

    <div class="mx-auto max-w-5xl px-5 lg:px-8">

        <div
            class="rounded-3xl
                   bg-[#F5F7F6]
                   p-8 sm:p-12"
        >

            <div
                class="flex h-14 w-14
                       items-center justify-center
                       rounded-2xl
                       bg-[#087443]
                       text-white"
            >

                <i
                    data-lucide="landmark"
                    class="h-7 w-7"
                ></i>

            </div>


            <h2
                class="mt-7 text-3xl
                       font-black"
            >
                Tentang Pesantren
            </h2>


            <p
                class="mt-6 text-base
                       leading-8 text-gray-600"
            >
                {{ $settings['school_description'] ?? '' }}
            </p>

        </div>

    </div>

</section>


{{-- VISI MISI --}}

<section class="bg-[#F5F7F6] py-20">

    <div
        class="mx-auto max-w-7xl
               px-5 lg:px-8"
    >

        <div
            class="grid gap-7
                   lg:grid-cols-2"
        >

            {{-- VISI --}}

            <div
                class="rounded-3xl
                       bg-[#062E1F]
                       p-8 sm:p-10"
            >

                <div
                    class="flex h-14 w-14
                           items-center justify-center
                           rounded-2xl
                           bg-[#F4C542]
                           text-[#062E1F]"
                >

                    <i
                        data-lucide="eye"
                        class="h-7 w-7"
                    ></i>

                </div>


                <h2
                    class="mt-7 text-2xl
                           font-black text-white"
                >
                    Visi
                </h2>


                <p
                    class="mt-5 text-base
                           leading-8 text-white/60"
                >
                    {{ $settings['vision'] ?? 'Visi pesantren belum diatur.' }}
                </p>

            </div>


            {{-- MISI --}}

            <div
                class="rounded-3xl
                       bg-white p-8 sm:p-10
                       shadow-sm
                       ring-1 ring-gray-100"
            >

                <div
                    class="flex h-14 w-14
                           items-center justify-center
                           rounded-2xl
                           bg-[#087443]
                           text-white"
                >

                    <i
                        data-lucide="target"
                        class="h-7 w-7"
                    ></i>

                </div>


                <h2
                    class="mt-7 text-2xl
                           font-black"
                >
                    Misi
                </h2>


                <div
                    class="mt-5 text-base
                           leading-8 text-gray-600"
                >
                    {!! nl2br(
                        e($settings[
                            'mission'
                        ] ?? 'Misi pesantren belum diatur.')
                    ) !!}
                </div>

            </div>

        </div>

    </div>

</section>


{{-- KONTAK --}}

<section class="bg-white py-20">

    <div class="mx-auto max-w-5xl px-5 lg:px-8">

        <div
            class="rounded-3xl
                   bg-[#087443]
                   p-8 sm:p-10"
        >

            <h2
                class="text-2xl
                       font-black text-white"
            >
                Informasi Pesantren
            </h2>


            <div
                class="mt-8 grid gap-6
                       md:grid-cols-2"
            >

                <div class="flex gap-4">

                    <i
                        data-lucide="map-pin"
                        class="h-6 w-6
                               shrink-0
                               text-[#F4C542]"
                    ></i>

                    <div>

                        <p
                            class="text-xs
                                   font-bold uppercase
                                   tracking-widest
                                   text-white/40"
                        >
                            Alamat
                        </p>

                        <p
                            class="mt-2 text-sm
                                   leading-6
                                   text-white/80"
                        >
                           {{ $settings['address'] ?? '' }}
                        </p>

                    </div>

                </div>


                <div class="flex gap-4">

                    <i
                        data-lucide="phone"
                        class="h-6 w-6
                               shrink-0
                               text-[#F4C542]"
                    ></i>

                    <div>

                        <p
                            class="text-xs
                                   font-bold uppercase
                                   tracking-widest
                                   text-white/40"
                        >
                            Telepon
                        </p>

                        <p
                            class="mt-2 text-sm
                                   text-white/80"
                        >
                            {{ $settings['phone'] ?? '' }}
                        </p>

                    </div>

                </div>


                <div class="flex gap-4">

                    <i
                        data-lucide="mail"
                        class="h-6 w-6
                               shrink-0
                               text-[#F4C542]"
                    ></i>

                    <div>

                        <p
                            class="text-xs
                                   font-bold uppercase
                                   tracking-widest
                                   text-white/40"
                        >
                            Email
                        </p>

                        <p
                            class="mt-2 text-sm
                                   text-white/80"
                        >
                            {{ $settings['email'] ?? '' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection