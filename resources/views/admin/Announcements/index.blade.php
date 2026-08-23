@extends('layouts.admin')

@section('title', 'Pengumuman')

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
                Pengumuman
            </h1>

            <p class="mt-2 text-gray-500">
                Kelola informasi dan pengumuman
                resmi Pesantren {{ $settings['school_name'] ?? '' }}.
            </p>

        </div>


        <a
            href="{{ route('admin.announcements.create') }}"
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
                data-lucide="plus"
                class="h-5 w-5"
            ></i>

            Buat Pengumuman

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
                class="h-5 w-5
                       text-[#087443]"
            ></i>

            <p
                class="text-sm font-semibold
                       text-[#087443]"
            >
                {{ session('success') }}
            </p>

        </div>

    @endif


    {{-- LIST --}}

    <div class="space-y-4">

        @forelse ($announcements as $announcement)

            <div
                class="group rounded-2xl
                       bg-white p-6
                       shadow-sm
                       ring-1 ring-gray-100
                       transition
                       hover:shadow-lg"
            >

                <div
                    class="flex flex-col
                           gap-5
                           lg:flex-row
                           lg:items-center
                           lg:justify-between"
                >

                    {{-- LEFT --}}

                    <div class="min-w-0 flex-1">

                        <div
                            class="flex flex-wrap
                                   items-center gap-2"
                        >

                            @if ($announcement->is_published)

                                <span
                                    class="inline-flex
                                           items-center gap-1.5
                                           rounded-full
                                           bg-green-50
                                           px-3 py-1
                                           text-xs
                                           font-bold
                                           text-[#087443]"
                                >

                                    <span
                                        class="h-1.5 w-1.5
                                               rounded-full
                                               bg-green-500"
                                    ></span>

                                    Dipublikasikan

                                </span>

                            @else

                                <span
                                    class="inline-flex
                                           items-center gap-1.5
                                           rounded-full
                                           bg-gray-100
                                           px-3 py-1
                                           text-xs
                                           font-bold
                                           text-gray-500"
                                >

                                    <span
                                        class="h-1.5 w-1.5
                                               rounded-full
                                               bg-gray-400"
                                    ></span>

                                    Draft

                                </span>

                            @endif


                            @if ($announcement->published_at)

                                <span
                                    class="text-xs
                                           font-medium
                                           text-gray-400"
                                >

                                    {{ $announcement
                                        ->published_at
                                        ->format('d M Y H:i') }}

                                </span>

                            @endif

                        </div>


                        <h2
                            class="mt-3 text-xl
                                   font-black
                                   text-gray-900
                                   transition
                                   group-hover:text-[#087443]"
                        >
                            {{ $announcement->title }}
                        </h2>


                        <p
                            class="mt-2 line-clamp-2
                                   text-sm leading-6
                                   text-gray-500"
                        >
                            {{ Str::limit(
                                strip_tags(
                                    $announcement->content
                                ),
                                180
                            ) }}
                        </p>

                    </div>


                    {{-- ACTION --}}

                    <div
                        class="flex shrink-0
                               items-center gap-2
                               border-t
                               border-gray-100
                               pt-4
                               lg:border-0
                               lg:pt-0"
                    >

                        <a
                            href="{{ route(
                                'admin.announcements.edit',
                                $announcement
                            ) }}"
                            class="inline-flex
                                   items-center gap-2
                                   rounded-xl
                                   bg-gray-100
                                   px-4 py-2.5
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
                                'admin.announcements.destroy',
                                $announcement
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Yakin ingin menghapus pengumuman ini?'
                            )"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-red-50
                                       p-2.5
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
                        data-lucide="megaphone"
                        class="h-8 w-8"
                    ></i>

                </div>


                <h3
                    class="mt-4 text-lg
                           font-black"
                >
                    Belum Ada Pengumuman
                </h3>


                <p
                    class="mt-2 text-sm
                           text-gray-400"
                >
                    Buat pengumuman pertama
                    untuk ditampilkan kepada
                    pengguna website.
                </p>


                <a
                    href="{{ route(
                        'admin.announcements.create'
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
                        data-lucide="plus"
                        class="h-4 w-4"
                    ></i>

                    Buat Pengumuman

                </a>

            </div>

        @endforelse

    </div>


    {{-- PAGINATION --}}

    @if ($announcements->hasPages())

        <div>
            {{ $announcements->links() }}
        </div>

    @endif

</div>

@endsection