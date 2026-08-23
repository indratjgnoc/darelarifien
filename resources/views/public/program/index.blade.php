@extends('layouts.app')

@section('title', 'Program Pesantren')

@section('content')

    {{-- HERO --}}

    <section
        class="relative overflow-hidden
               bg-[#062E1F]"
    >

        <div
            class="absolute inset-0
                   opacity-10"
        >
            <div
                class="absolute -right-20 -top-20
                       h-72 w-72
                       rounded-full
                       bg-[#F4C542]
                       blur-3xl"
            ></div>
        </div>


        <div
            class="relative mx-auto
                   max-w-7xl
                   px-5 py-20
                   lg:px-8"
        >

            <p
                class="text-xs
                       font-black
                       uppercase
                       tracking-[0.25em]
                       text-[#F4C542]"
            >
                Pendidikan & Pembinaan
            </p>


            <h1
                class="mt-4
                       max-w-3xl
                       text-4xl
                       font-black
                       leading-tight
                       text-white
                       sm:text-5xl"
            >
                Program Pesantren
            </h1>


            <p
                class="mt-5
                       max-w-2xl
                       text-base
                       leading-7
                       text-white/60"
            >
                Beragam program pendidikan dan pembinaan
                yang dirancang untuk membentuk generasi
                berilmu, berakhlak, dan berdaya saing.
            </p>

        </div>

    </section>


    {{-- PROGRAM LIST --}}

    <section
        class="bg-[#F5F7F6]"
    >

        <div
            class="mx-auto max-w-7xl
                   px-5 py-16
                   lg:px-8"
        >

            @if ($programs->count())

                <div
                    class="grid gap-6
                           md:grid-cols-2
                           lg:grid-cols-3"
                >

                    @foreach ($programs as $program)

                        <a
                            href="{{ route(
                                'program.show',
                                $program
                            ) }}"
                            class="group overflow-hidden
                                   rounded-3xl
                                   border
                                   border-gray-200
                                   bg-white
                                   shadow-sm
                                   transition
                                   duration-300
                                   hover:-translate-y-1
                                   hover:border-[#F4C542]
                                   hover:shadow-xl"
                        >

                            {{-- IMAGE --}}

                            <div
                                class="relative h-52
                                       overflow-hidden
                                       bg-[#062E1F]"
                            >

                                @if ($program->image)

                                    <img
                                        src="{{ asset(
                                            'storage/' .
                                            $program->image
                                        ) }}"
                                        alt="{{ $program->title }}"
                                        class="h-full w-full
                                               object-cover
                                               transition
                                               duration-500
                                               group-hover:scale-105"
                                    >

                                    <div
                                        class="absolute inset-0
                                               bg-[#062E1F]/30"
                                    ></div>

                                @else

                                    <div
                                        class="flex h-full
                                               items-center
                                               justify-center"
                                    >

                                        <i
                                            data-lucide="book-open"
                                            class="h-14 w-14
                                                   text-[#F4C542]"
                                        ></i>

                                    </div>

                                @endif

                            </div>


                            {{-- CONTENT --}}

                            <div class="p-7">

                                <div
                                    class="mb-5 flex
                                           h-11 w-11
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#EAF4EF]
                                           text-[#062E1F]"
                                >

                                    <i
                                        data-lucide="{{ $program->icon ?: 'book-open' }}"
                                        class="h-5 w-5"
                                    ></i>

                                </div>


                                <h2
                                    class="text-xl
                                           font-black
                                           text-gray-900
                                           transition
                                           group-hover:text-[#087F5B]"
                                >
                                    {{ $program->title }}
                                </h2>


                                @if ($program->description)

                                    <p
                                        class="mt-3
                                               line-clamp-3
                                               text-sm
                                               leading-6
                                               text-gray-500"
                                    >
                                        {{ $program->description }}
                                    </p>

                                @endif


                                <div
                                    class="mt-6
                                           flex items-center
                                           gap-2
                                           text-sm
                                           font-black
                                           text-[#087F5B]"
                                >

                                    Selengkapnya

                                    <i
                                        data-lucide="arrow-right"
                                        class="h-4 w-4
                                               transition
                                               group-hover:translate-x-1"
                                    ></i>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            @else

                <div
                    class="rounded-3xl
                           border border-gray-200
                           bg-white
                           px-6 py-16
                           text-center"
                >

                    <i
                        data-lucide="book-open"
                        class="mx-auto h-12 w-12
                               text-gray-300"
                    ></i>

                    <h2
                        class="mt-5
                               text-xl
                               font-black
                               text-gray-800"
                    >
                        Program belum tersedia
                    </h2>

                    <p
                        class="mt-2
                               text-sm
                               text-gray-500"
                    >
                        Informasi program pesantren
                        akan segera diperbarui.
                    </p>

                </div>

            @endif

        </div>

    </section>

@endsection