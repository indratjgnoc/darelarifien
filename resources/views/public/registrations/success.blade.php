@extends('layouts.public')

@section('title', 'Pendaftaran Berhasil')

@section('content')

<section
    class="flex min-h-[70vh]
           items-center
           bg-[#F5F7F6] py-20"
>

    <div
        class="mx-auto w-full
               max-w-2xl px-5"
    >

        <div
            class="rounded-3xl bg-white
                   p-8 text-center
                   shadow-xl
                   ring-1 ring-gray-100
                   sm:p-12"
        >

            <div
                class="mx-auto flex h-20 w-20
                       items-center justify-center
                       rounded-full
                       bg-[#087443]
                       text-white"
            >

                <i
                    data-lucide="check"
                    class="h-10 w-10"
                ></i>

            </div>


            <p
                class="mt-7 text-sm
                       font-black uppercase
                       tracking-widest
                       text-[#087443]"
            >
                Pendaftaran Berhasil
            </p>


            <h1
                class="mt-3 text-3xl
                       font-black"
            >
                Terima Kasih,
                {{ $registration->student_name }}
            </h1>


            <p
                class="mt-4 leading-7
                       text-gray-500"
            >
                Data pendaftaran Anda telah
                berhasil kami terima.
            </p>


            <div
                class="mt-8 rounded-2xl
                       bg-[#062E1F]
                       p-6"
            >

                <p
                    class="text-xs font-bold
                           uppercase tracking-widest
                           text-white/40"
                >
                    Nomor Pendaftaran
                </p>


                <p
                    class="mt-3 text-3xl
                           font-black
                           tracking-wider
                           text-[#F4C542]"
                >
                    {{ $registration->registration_number }}
                </p>


                <p
                    class="mt-3 text-xs
                           text-white/40"
                >
                    Simpan nomor ini untuk
                    keperluan pengecekan
                    pendaftaran.
                </p>

            </div>


            <div
                class="mt-8 flex flex-col
                       gap-3 sm:flex-row
                       sm:justify-center"
            >

                <a
                    href="{{ route('home') }}"
                    class="inline-flex
                           items-center
                           justify-center
                           gap-2 rounded-xl
                           bg-[#087443]
                           px-6 py-3
                           text-sm font-black
                           text-white
                           hover:bg-[#062E1F]"
                >

                    <i
                        data-lucide="home"
                        class="h-4 w-4"
                    ></i>

                    Kembali ke Beranda

                </a>


                <a
                    href="{{ route(
                        'registration.create'
                    ) }}"
                    class="inline-flex
                           items-center
                           justify-center
                           gap-2 rounded-xl
                           border border-gray-200
                           px-6 py-3
                           text-sm font-black
                           text-gray-700
                           hover:bg-gray-50"
                >
                    Pendaftaran Baru
                </a>

            </div>

        </div>

    </div>

</section>

@endsection