@extends('layouts.app')

@section('title', 'Pendaftaran Belum Dibuka')

@section('content')

<section
    class="relative flex min-h-[70vh]
           items-center justify-center
           overflow-hidden
           bg-[#062E1F]"
>

    {{-- Decorative Circle --}}

    <div
        class="absolute -left-32 -top-32
               h-80 w-80
               rounded-full
               bg-[#087F5B]/30
               blur-3xl"
    ></div>

    <div
        class="absolute -bottom-32 -right-32
               h-80 w-80
               rounded-full
               bg-[#F4C542]/10
               blur-3xl"
    ></div>


    <div
        class="relative mx-auto
               max-w-2xl
               px-6 py-20
               text-center"
    >

        {{-- ICON --}}

        <div
            class="mx-auto flex h-24 w-24
                   items-center justify-center
                   rounded-3xl
                   bg-[#F4C542]
                   text-[#062E1F]
                   shadow-2xl"
        >

            <i
                data-lucide="graduation-cap"
                class="h-12 w-12"
            ></i>

        </div>


        {{-- LABEL --}}

        <p
            class="mt-8 text-xs
                   font-black uppercase
                   tracking-[0.3em]
                   text-[#F4C542]"
        >
            Penerimaan Santri Baru
        </p>


        {{-- TITLE --}}

        <h1
            class="mt-4 text-4xl
                   font-black
                   leading-tight
                   text-white
                   md:text-5xl"
        >
            Penerimaan Siswa Baru
            <span class="text-[#F4C542]">
                Belum Dibuka
            </span>
        </h1>


        {{-- DESCRIPTION --}}

        <p
            class="mx-auto mt-6
                   max-w-xl
                   text-base
                   leading-7
                   text-white/65
                   md:text-lg"
        >
            Mohon maaf, saat ini penerimaan
            siswa baru di Pesantren {{ $settings['school_name'] ?? '' }}
            belum dibuka.
        </p>

        <p
            class="mx-auto mt-3
                   max-w-xl
                   text-sm
                   leading-6
                   text-white/45"
        >
            Silakan pantau website resmi kami
            untuk mendapatkan informasi mengenai
            jadwal penerimaan siswa baru.
        </p>


        {{-- BUTTON --}}

        <div
            class="mt-8 flex
                   flex-col
                   justify-center
                   gap-3
                   sm:flex-row"
        >

            <a
                href="{{ route('home') }}"
                class="inline-flex
                       items-center
                       justify-center
                       gap-2
                       rounded-xl
                       bg-[#F4C542]
                       px-6 py-3.5
                       text-sm
                       font-black
                       text-[#062E1F]
                       transition
                       hover:-translate-y-0.5
                       hover:bg-[#FFD95A]"
            >

                <i
                    data-lucide="house"
                    class="h-4 w-4"
                ></i>

                Kembali ke Beranda

            </a>


            <a
                href="{{ route('profile') }}"
                class="inline-flex
                       items-center
                       justify-center
                       gap-2
                       rounded-xl
                       border
                       border-white/15
                       px-6 py-3.5
                       text-sm
                       font-bold
                       text-white
                       transition
                       hover:bg-white/10"
            >

                <i
                    data-lucide="school"
                    class="h-4 w-4"
                ></i>

                Tentang Pesantren

            </a>

        </div>

    </div>

</section>

@endsection