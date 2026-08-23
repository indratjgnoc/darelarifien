@extends('layouts.admin')

@section('title', 'Galeri')

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
                Media Management
            </p>

            <h1
                class="mt-1 text-3xl
                       font-black text-[#111111]"
            >
                Galeri
            </h1>

            <p class="mt-2 text-gray-500">
                Kelola dokumentasi kegiatan
                Pesantren {{ $settings['school_name'] ?? '' }}.
            </p>

        </div>


        <a
            href="{{ route('admin.galleries.create') }}"
            class="inline-flex items-center
                   justify-center gap-2
                   rounded-xl
                   bg-[#087443]
                   px-5 py-3
                   font-bold text-white
                   shadow-lg
                   transition
                   hover:bg-[#062E1F]"
        >

            <i
                data-lucide="image-plus"
                class="h-5 w-5"
            ></i>

            Tambah Foto

        </a>

    </div>


    {{-- SUCCESS --}}

    @if (session('success'))

        <div
            class="flex items-center gap-3
                   rounded-xl
                   border border-green-200
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


    {{-- GALLERY GRID --}}

    @if ($galleries->count())

        <div
            class="grid grid-cols-1
                   gap-6
                   sm:grid-cols-2
                   xl:grid-cols-3
                   2xl:grid-cols-4"
        >

            @foreach ($galleries as $gallery)

                <div
                    class="group overflow-hidden
                           rounded-2xl
                           bg-white
                           shadow-sm
                           ring-1 ring-gray-100
                           transition
                           hover:-translate-y-1
                           hover:shadow-xl"
                >

                    {{-- IMAGE --}}

                    <div
                        class="relative aspect-[4/3]
                               overflow-hidden
                               bg-[#062E1F]"
                    >

                        <img
                            src="{{ asset(
                                'storage/' .
                                $gallery->image
                            ) }}"
                            alt="{{ $gallery->title }}"
                            class="h-full w-full
                                   object-cover
                                   transition
                                   duration-500
                                   group-hover:scale-110"
                        >


                        {{-- OVERLAY --}}

                        <div
                            class="absolute inset-0
                                   flex items-end
                                   bg-gradient-to-t
                                   from-black/70
                                   via-black/10
                                   to-transparent
                                   opacity-0
                                   transition
                                   group-hover:opacity-100"
                        >

                            <div
                                class="flex w-full
                                       items-center
                                       justify-between
                                       p-4"
                            >

                                <span
                                    class="text-xs
                                           font-semibold
                                           text-white"
                                >
                                    {{ $gallery->category
                                        ?: 'Umum' }}
                                </span>


                                <div
                                    class="flex gap-2"
                                >

                                    <a
                                        href="{{ asset(
                                            'storage/' .
                                            $gallery->image
                                        ) }}"
                                        target="_blank"
                                        class="rounded-lg
                                               bg-white/20
                                               p-2
                                               text-white
                                               backdrop-blur
                                               hover:bg-white
                                               hover:text-[#087443]"
                                    >

                                        <i
                                            data-lucide="eye"
                                            class="h-4 w-4"
                                        ></i>

                                    </a>


                                    <a
                                        href="{{ route(
                                            'admin.galleries.edit',
                                            $gallery
                                        ) }}"
                                        class="rounded-lg
                                               bg-white/20
                                               p-2
                                               text-white
                                               backdrop-blur
                                               hover:bg-white
                                               hover:text-[#087443]"
                                    >

                                        <i
                                            data-lucide="pencil"
                                            class="h-4 w-4"
                                        ></i>

                                    </a>

                                </div>

                            </div>

                        </div>


                        {{-- STATUS --}}

                        <div
                            class="absolute right-3
                                   top-3"
                        >

                            @if ($gallery->is_active)

                                <span
                                    class="rounded-full
                                           bg-[#087443]
                                           px-3 py-1
                                           text-[10px]
                                           font-bold
                                           text-white
                                           shadow"
                                >
                                    AKTIF
                                </span>

                            @else

                                <span
                                    class="rounded-full
                                           bg-black/60
                                           px-3 py-1
                                           text-[10px]
                                           font-bold
                                           text-white
                                           backdrop-blur"
                                >
                                    NONAKTIF
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- INFO --}}

                    <div class="p-5">

                        <div
                            class="flex items-start
                                   justify-between
                                   gap-3"
                        >

                            <div class="min-w-0">

                                <h2
                                    class="truncate
                                           text-base
                                           font-black
                                           text-gray-900
                                           group-hover:text-[#087443]"
                                >
                                    {{ $gallery->title }}
                                </h2>

                                @if ($gallery->category)

                                    <p
                                        class="mt-1 text-xs
                                               font-semibold
                                               text-[#087443]"
                                    >
                                        {{ $gallery->category }}
                                    </p>

                                @endif

                            </div>


                            <span
                                class="shrink-0
                                       rounded-lg
                                       bg-[#F4C542]/20
                                       px-2 py-1
                                       text-xs
                                       font-bold
                                       text-[#8A6800]"
                            >
                                #{{ $gallery->sort_order }}
                            </span>

                        </div>


                        @if ($gallery->description)

                            <p
                                class="mt-3 line-clamp-2
                                       text-sm
                                       leading-6
                                       text-gray-500"
                            >
                                {{ $gallery->description }}
                            </p>

                        @endif


                        <div
                            class="mt-4 flex
                                   items-center
                                   justify-between
                                   border-t
                                   border-gray-100
                                   pt-4"
                        >

                            <span
                                class="text-xs
                                       text-gray-400"
                            >
                                {{ $gallery->created_at
                                    ->format('d M Y') }}
                            </span>


                            <form
                                action="{{ route(
                                    'admin.galleries.destroy',
                                    $gallery
                                ) }}"
                                method="POST"
                                onsubmit="return confirm(
                                    'Yakin ingin menghapus foto ini?'
                                )"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="rounded-lg
                                           p-2
                                           text-red-400
                                           transition
                                           hover:bg-red-50
                                           hover:text-red-600"
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

            @endforeach

        </div>


        {{-- PAGINATION --}}

        @if ($galleries->hasPages())

            <div>
                {{ $galleries->links() }}
            </div>

        @endif

    @else

        <div
            class="rounded-2xl
                   bg-white px-6 py-16
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
                    data-lucide="images"
                    class="h-8 w-8"
                ></i>

            </div>


            <h3
                class="mt-4 text-lg
                       font-black"
            >
                Galeri Masih Kosong
            </h3>


            <p
                class="mt-2 text-sm
                       text-gray-400"
            >
                Mulai tambahkan dokumentasi
                kegiatan pesantren.
            </p>


            <a
                href="{{ route(
                    'admin.galleries.create'
                ) }}"
                class="mt-6 inline-flex
                       items-center gap-2
                       rounded-xl
                       bg-[#087443]
                       px-5 py-3
                       text-sm font-bold
                       text-white
                       hover:bg-[#062E1F]"
            >

                <i
                    data-lucide="image-plus"
                    class="h-4 w-4"
                ></i>

                Tambah Foto

            </a>

        </div>

    @endif

</div>

@endsection