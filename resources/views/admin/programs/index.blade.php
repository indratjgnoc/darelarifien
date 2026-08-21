@extends('layouts.admin')

@section('title', 'Program Pendidikan')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}

    <div
        class="flex flex-col gap-4
               sm:flex-row
               sm:items-center
               sm:justify-between"
    >

        <div>

            <p
                class="text-sm font-semibold
                       uppercase tracking-wider
                       text-[#087443]"
            >
                Content Management
            </p>

            <h1
                class="mt-1 text-3xl
                       font-black text-[#111111]"
            >
                Program Pendidikan
            </h1>

            <p class="mt-2 text-gray-500">
                Kelola program pendidikan
                yang tersedia di pesantren.
            </p>

        </div>


        <a
            href="{{ route('admin.programs.create') }}"
            class="inline-flex items-center
                   justify-center gap-2
                   rounded-xl bg-[#087443]
                   px-5 py-3
                   font-bold text-white
                   shadow-lg
                   transition
                   hover:bg-[#062E1F]"
        >

            <i
                data-lucide="plus"
                class="h-5 w-5"
            ></i>

            Tambah Program

        </a>

    </div>


    {{-- SUCCESS --}}

    @if (session('success'))

        <div
            class="flex items-center gap-3
                   rounded-xl border
                   border-green-200
                   bg-green-50 px-5 py-4"
        >

            <i
                data-lucide="circle-check"
                class="h-5 w-5 text-[#087443]"
            ></i>

            <p
                class="text-sm font-semibold
                       text-[#087443]"
            >
                {{ session('success') }}
            </p>

        </div>

    @endif


    {{-- PROGRAM GRID --}}

    <div
        class="grid gap-6
               md:grid-cols-2
               xl:grid-cols-3"
    >

        @forelse ($programs as $program)

            <div
                class="group overflow-hidden
                       rounded-2xl bg-white
                       shadow-sm ring-1
                       ring-gray-100
                       transition
                       hover:-translate-y-1
                       hover:shadow-xl"
            >

                {{-- IMAGE --}}

                <div
                    class="relative h-48
                           overflow-hidden
                           bg-[#062E1F]"
                >

                    @if ($program->image)

                        <img
                            src="{{ asset(
                                'storage/' . $program->image
                            ) }}"
                            alt="{{ $program->title }}"
                            class="h-full w-full
                                   object-cover
                                   transition
                                   duration-500
                                   group-hover:scale-105"
                        >

                    @else

                        <div
                            class="flex h-full
                                   items-center
                                   justify-center"
                        >

                            <div
                                class="flex h-16 w-16
                                       items-center
                                       justify-center
                                       rounded-2xl
                                       bg-[#F4C542]
                                       text-[#062E1F]"
                            >

                                <i
                                    data-lucide="graduation-cap"
                                    class="h-8 w-8"
                                ></i>

                            </div>

                        </div>

                    @endif


                    {{-- STATUS --}}

                    <div
                        class="absolute right-4
                               top-4"
                    >

                        @if ($program->is_active)

                            <span
                                class="rounded-full
                                       bg-green-500
                                       px-3 py-1
                                       text-xs font-bold
                                       text-white
                                       shadow"
                            >
                                Aktif
                            </span>

                        @else

                            <span
                                class="rounded-full
                                       bg-gray-500
                                       px-3 py-1
                                       text-xs font-bold
                                       text-white
                                       shadow"
                            >
                                Nonaktif
                            </span>

                        @endif

                    </div>

                </div>


                {{-- CONTENT --}}

                <div class="p-5">

                    <div
                        class="mb-3 flex
                               items-start
                               justify-between gap-3"
                    >

                        <h2
                            class="text-lg
                                   font-black
                                   text-gray-900"
                        >
                            {{ $program->title }}
                        </h2>

                        <span
                            class="shrink-0
                                   rounded-lg
                                   bg-[#F4C542]/20
                                   px-2 py-1
                                   text-xs font-bold
                                   text-[#806100]"
                        >
                            #{{ $program->sort_order }}
                        </span>

                    </div>


                    <p
                        class="line-clamp-3
                               text-sm leading-6
                               text-gray-500"
                    >
                        {{ $program->description }}
                    </p>


                    {{-- ACTION --}}

                    <div
                        class="mt-5 flex gap-2
                               border-t
                               border-gray-100
                               pt-4"
                    >

                        <a
                            href="{{ route(
                                'admin.programs.edit',
                                $program
                            ) }}"
                            class="flex flex-1
                                   items-center
                                   justify-center
                                   gap-2
                                   rounded-xl
                                   bg-gray-100
                                   py-2.5
                                   text-sm font-bold
                                   text-gray-600
                                   transition
                                   hover:bg-[#087443]
                                   hover:text-white"
                        >

                            <i
                                data-lucide="pencil"
                                class="h-4 w-4"
                            ></i>

                            Edit

                        </a>


                        <form
                            action="{{ route(
                                'admin.programs.destroy',
                                $program
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Yakin ingin menghapus program ini?'
                            )"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="flex h-full
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-red-50 px-4
                                       text-red-500
                                       transition
                                       hover:bg-red-500
                                       hover:text-white"
                            >

                                <i
                                    data-lucide="trash-2"
                                    class="h-4 w-4"
                                ></i>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div
                class="md:col-span-2
                       xl:col-span-3
                       rounded-2xl bg-white
                       px-6 py-16
                       text-center
                       shadow-sm
                       ring-1 ring-gray-100"
            >

                <div
                    class="mx-auto flex h-16 w-16
                           items-center
                           justify-center
                           rounded-2xl
                           bg-[#087443]/10
                           text-[#087443]"
                >

                    <i
                        data-lucide="graduation-cap"
                        class="h-8 w-8"
                    ></i>

                </div>

                <h3
                    class="mt-4 font-black"
                >
                    Belum Ada Program
                </h3>

                <p
                    class="mt-2 text-sm
                           text-gray-400"
                >
                    Tambahkan program pendidikan
                    pertama pesantren.
                </p>

            </div>

        @endforelse

    </div>


    {{-- PAGINATION --}}

    @if ($programs->hasPages())

        <div>
            {{ $programs->links() }}
        </div>

    @endif

</div>

@endsection