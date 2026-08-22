@extends('layouts.admin')

@section('title', 'Berita')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}

    <div
        class="flex flex-col gap-5
               sm:flex-row
               sm:items-end
               sm:justify-between"
    >

        <div>

            <p
                class="text-xs font-black
                       uppercase
                       tracking-[0.2em]
                       text-[#087443]"
            >
                Manajemen Konten
            </p>

            <h1
                class="mt-2 text-3xl
                       font-black"
            >
                Berita
            </h1>

            <p
                class="mt-2 text-sm
                       text-gray-500"
            >
                Kelola informasi dan berita
                Pesantren Darel Arifien.
            </p>

        </div>


        <a
            href="{{ route(
                'admin.news.create'
            ) }}"
            class="inline-flex
                   items-center
                   justify-center
                   gap-2 rounded-xl
                   bg-[#087443]
                   px-5 py-3
                   text-sm font-black
                   text-white
                   transition
                   hover:bg-[#062E1F]"
        >

            <i
                data-lucide="plus"
                class="h-4 w-4"
            ></i>

            Tambah Berita

        </a>

    </div>


    {{-- SUCCESS --}}

    @if (session('success'))

        <div
            class="flex items-center gap-3
                   rounded-2xl
                   border border-green-200
                   bg-green-50
                   px-5 py-4
                   text-sm font-bold
                   text-green-700"
        >

            <i
                data-lucide="check-circle"
                class="h-5 w-5"
            ></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- STATISTICS --}}

    <div
        class="grid gap-5
               sm:grid-cols-3"
    >

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <p
                class="text-xs font-bold
                       uppercase
                       tracking-wider
                       text-gray-400"
            >
                Total Berita
            </p>

            <p
                class="mt-3 text-3xl
                       font-black"
            >
                {{ $statistics['total'] }}
            </p>

        </div>


        <div
            class="rounded-2xl bg-[#062E1F]
                   p-6 shadow-sm"
        >

            <p
                class="text-xs font-bold
                       uppercase
                       tracking-wider
                       text-white/40"
            >
                Published
            </p>

            <p
                class="mt-3 text-3xl
                       font-black
                       text-[#F4C542]"
            >
                {{ $statistics['published'] }}
            </p>

        </div>


        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <p
                class="text-xs font-bold
                       uppercase
                       tracking-wider
                       text-gray-400"
            >
                Draft
            </p>

            <p
                class="mt-3 text-3xl
                       font-black
                       text-gray-500"
            >
                {{ $statistics['draft'] }}
            </p>

        </div>

    </div>


    {{-- FILTER --}}

    <div
        class="rounded-2xl bg-white
               p-5 shadow-sm
               ring-1 ring-gray-100"
    >

        <form
            method="GET"
            action="{{ route(
                'admin.news.index'
            ) }}"
            class="grid gap-4
                   md:grid-cols-[1fr_200px_auto]"
        >

            <div class="relative">

                <i
                    data-lucide="search"
                    class="absolute left-4 top-1/2
                           h-5 w-5
                           -translate-y-1/2
                           text-gray-400"
                ></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari judul atau kategori..."
                    class="w-full rounded-xl
                           border border-gray-200
                           bg-gray-50
                           py-3 pl-11 pr-4
                           text-sm outline-none
                           focus:border-[#087443]"
                >

            </div>


            <select
                name="status"
                class="rounded-xl
                       border border-gray-200
                       bg-gray-50
                       px-4 py-3
                       text-sm outline-none
                       focus:border-[#087443]"
            >

                <option value="">
                    Semua Status
                </option>

                <option
                    value="published"
                    @selected(
                        request('status')
                        === 'published'
                    )
                >
                    Published
                </option>

                <option
                    value="draft"
                    @selected(
                        request('status')
                        === 'draft'
                    )
                >
                    Draft
                </option>

            </select>


            <button
                type="submit"
                class="rounded-xl
                       bg-[#087443]
                       px-6 py-3
                       text-sm font-black
                       text-white
                       hover:bg-[#062E1F]"
            >
                Filter
            </button>

        </form>

    </div>


    {{-- TABLE --}}

    <div
        class="overflow-hidden
               rounded-2xl bg-white
               shadow-sm
               ring-1 ring-gray-100"
    >

        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px]">

                <thead
                    class="border-b
                           border-gray-100
                           bg-gray-50"
                >

                    <tr>

                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Berita
                        </th>

                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Kategori
                        </th>

                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Penulis
                        </th>

                        <th
                            class="px-6 py-4
                                   text-left
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Status
                        </th>

                        <th
                            class="px-6 py-4
                                   text-right
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
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

                            {{-- BERITA --}}

                            <td class="px-6 py-5">

                                <div
                                    class="flex
                                           items-center
                                           gap-4"
                                >

                                    @if ($item->thumbnail)

                                        <img
                                            src="{{ asset(
                                                'storage/' .
                                                $item->thumbnail
                                            ) }}"
                                            alt="{{ $item->title }}"
                                            class="h-14 w-20
                                                   shrink-0
                                                   rounded-xl
                                                   object-cover"
                                        >

                                    @else

                                        <div
                                            class="flex h-14
                                                   w-20
                                                   shrink-0
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-[#087443]/10"
                                        >

                                            <i
                                                data-lucide="newspaper"
                                                class="h-6 w-6
                                                       text-[#087443]"
                                            ></i>

                                        </div>

                                    @endif


                                    <div class="min-w-0">

                                        <p
                                            class="max-w-[350px]
                                                   truncate
                                                   font-bold"
                                        >
                                            {{ $item->title }}
                                        </p>

                                        <p
                                            class="mt-1
                                                   text-xs
                                                   text-gray-400"
                                        >
                                            {{
                                                $item->published_at
                                                    ?->format(
                                                        'd M Y'
                                                    )
                                                ?? '-'
                                            }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- CATEGORY --}}

                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full
                                           bg-gray-100
                                           px-3 py-1
                                           text-xs
                                           font-bold
                                           text-gray-600"
                                >
                                    {{ $item->category }}
                                </span>

                            </td>


                            {{-- AUTHOR --}}

                            <td
                                class="px-6 py-5
                                       text-sm
                                       text-gray-600"
                            >
                                {{
                                    $item->user?->name
                                    ?? 'Admin'
                                }}
                            </td>


                            {{-- STATUS --}}

                            <td class="px-6 py-5">

                                @if ($item->is_published)

                                    <span
                                        class="inline-flex
                                               rounded-full
                                               bg-green-50
                                               px-3 py-1
                                               text-xs
                                               font-black
                                               text-[#087443]"
                                    >
                                        Published
                                    </span>

                                @else

                                    <span
                                        class="inline-flex
                                               rounded-full
                                               bg-gray-100
                                               px-3 py-1
                                               text-xs
                                               font-black
                                               text-gray-500"
                                    >
                                        Draft
                                    </span>

                                @endif

                            </td>


                            {{-- ACTION --}}

                            <td class="px-6 py-5">

                                <div
                                    class="flex
                                           justify-end
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
                                               hover:bg-[#087443]
                                               hover:text-white"
                                        title="Edit"
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
                                        onsubmit="
                                            return confirm(
                                                'Yakin ingin menghapus berita ini?'
                                            )
                                        "
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
                                                   text-red-600
                                                   hover:bg-red-600
                                                   hover:text-white"
                                            title="Hapus"
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

                                <i
                                    data-lucide="newspaper"
                                    class="mx-auto h-9 w-9
                                           text-gray-300"
                                ></i>

                                <p
                                    class="mt-4
                                           font-bold"
                                >
                                    Belum ada berita
                                </p>

                                <p
                                    class="mt-1 text-sm
                                           text-gray-400"
                                >
                                    Mulai tambahkan
                                    berita pesantren.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


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