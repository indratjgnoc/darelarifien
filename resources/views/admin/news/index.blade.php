@extends('layouts.admin')

@section('title', 'Berita')

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
                Berita
            </h1>

            <p class="mt-2 text-gray-500">
                Kelola berita dan informasi
                terbaru pesantren.
            </p>

        </div>

        <a
            href="{{ route('admin.news.create') }}"
            class="inline-flex items-center
                   justify-center gap-2
                   rounded-xl bg-[#087443]
                   px-5 py-3
                   font-bold text-white
                   shadow-lg transition
                   hover:bg-[#062E1F]"
        >

            <i
                data-lucide="plus"
                class="h-5 w-5"
            ></i>

            Tambah Berita

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


    {{-- TABLE --}}

    <div
        class="overflow-hidden
               rounded-2xl bg-white
               shadow-sm ring-1
               ring-gray-100"
    >

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead
                    class="border-b
                           border-gray-100
                           bg-gray-50"
                >

                    <tr>

                        <th
                            class="px-6 py-4
                                   text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-500"
                        >
                            Berita
                        </th>

                        <th
                            class="px-6 py-4
                                   text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-500"
                        >
                            Kategori
                        </th>

                        <th
                            class="px-6 py-4
                                   text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-500"
                        >
                            Status
                        </th>

                        <th
                            class="px-6 py-4
                                   text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-500"
                        >
                            Tanggal
                        </th>

                        <th
                            class="px-6 py-4 text-right
                                   text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-500"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody
                    class="divide-y
                           divide-gray-100"
                >

                    @forelse ($news as $item)

                        <tr
                            class="transition
                                   hover:bg-gray-50"
                        >

                            {{-- NEWS --}}

                            <td class="px-6 py-4">

                                <div
                                    class="flex items-center
                                           gap-4"
                                >

                                    @if ($item->thumbnail)

                                        <img
                                            src="{{ asset('storage/' . $item->thumbnail) }}"
                                            alt="{{ $item->title }}"
                                            class="h-14 w-20
                                                   rounded-lg
                                                   object-cover"
                                        >

                                    @else

                                        <div
                                            class="flex h-14 w-20
                                                   items-center
                                                   justify-center
                                                   rounded-lg
                                                   bg-[#087443]/10
                                                   text-[#087443]"
                                        >

                                            <i
                                                data-lucide="newspaper"
                                                class="h-6 w-6"
                                            ></i>

                                        </div>

                                    @endif


                                    <div
                                        class="max-w-md"
                                    >

                                        <p
                                            class="font-bold
                                                   text-gray-900"
                                        >
                                            {{ $item->title }}
                                        </p>

                                        <p
                                            class="mt-1 truncate
                                                   text-xs
                                                   text-gray-400"
                                        >
                                            {{ $item->excerpt }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- CATEGORY --}}

                            <td class="px-6 py-4">

                                <span
                                    class="rounded-full
                                           bg-[#F4C542]/20
                                           px-3 py-1
                                           text-xs font-bold
                                           text-[#806100]"
                                >
                                    {{ $item->category }}
                                </span>

                            </td>


                            {{-- STATUS --}}

                            <td class="px-6 py-4">

                                @if ($item->is_published)

                                    <span
                                        class="inline-flex
                                               items-center gap-1.5
                                               rounded-full
                                               bg-green-50
                                               px-3 py-1
                                               text-xs font-bold
                                               text-green-700"
                                    >

                                        <span
                                            class="h-1.5 w-1.5
                                                   rounded-full
                                                   bg-green-500"
                                        ></span>

                                        Published

                                    </span>

                                @else

                                    <span
                                        class="inline-flex
                                               items-center gap-1.5
                                               rounded-full
                                               bg-gray-100
                                               px-3 py-1
                                               text-xs font-bold
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

                            </td>


                            {{-- DATE --}}

                            <td
                                class="whitespace-nowrap
                                       px-6 py-4
                                       text-sm text-gray-500"
                            >

                                {{ $item->created_at->format('d M Y') }}

                            </td>


                            {{-- ACTION --}}

                            <td class="px-6 py-4">

                                <div
                                    class="flex justify-end
                                           gap-2"
                                >

                                    <a
                                        href="{{ route(
                                            'admin.news.edit',
                                            $item
                                        ) }}"
                                        class="flex h-9 w-9
                                               items-center
                                               justify-center
                                               rounded-lg
                                               bg-gray-100
                                               text-gray-600
                                               transition
                                               hover:bg-[#087443]
                                               hover:text-white"
                                    >

                                        <i
                                            data-lucide="pencil"
                                            class="h-4 w-4"
                                        ></i>

                                    </a>


                                    <form
                                        action="{{ route(
                                            'admin.news.destroy',
                                            $item
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Yakin ingin menghapus berita ini?'
                                        )"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="flex h-9 w-9
                                                   items-center
                                                   justify-center
                                                   rounded-lg
                                                   bg-red-50
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

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-16
                                       text-center"
                            >

                                <div
                                    class="mx-auto
                                           max-w-sm"
                                >

                                    <div
                                        class="mx-auto flex
                                               h-16 w-16
                                               items-center
                                               justify-center
                                               rounded-2xl
                                               bg-[#087443]/10
                                               text-[#087443]"
                                    >

                                        <i
                                            data-lucide="newspaper"
                                            class="h-8 w-8"
                                        ></i>

                                    </div>

                                    <h3
                                        class="mt-4
                                               font-black"
                                    >
                                        Belum Ada Berita
                                    </h3>

                                    <p
                                        class="mt-2 text-sm
                                               text-gray-400"
                                    >
                                        Mulai tambahkan berita
                                        pesantren.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        @if ($news->hasPages())

            <div
                class="border-t
                       border-gray-100
                       px-6 py-4"
            >
                {{ $news->links() }}
            </div>

        @endif

    </div>

</div>

@endsection