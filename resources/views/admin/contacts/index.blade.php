@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}

    <div class="flex flex-col gap-4
                sm:flex-row
                sm:items-center
                sm:justify-between">

        <div>

            <p class="text-xs font-black uppercase
                      tracking-[0.2em]
                      text-[#087F5B]">
                Komunikasi
            </p>

            <h1 class="mt-1 text-3xl
                       font-black text-gray-900">
                Pesan Masuk
            </h1>

            <p class="mt-2 text-sm
                      text-gray-500">
                Kelola pesan yang dikirim
                melalui halaman kontak website.
            </p>

        </div>

    </div>


    {{-- SUCCESS --}}

    @if (session('success'))

        <div class="flex items-center gap-3
                    rounded-2xl
                    border border-[#087F5B]/20
                    bg-[#EAF4EF]
                    px-5 py-4
                    text-sm font-semibold
                    text-[#062E1F]">

            <i
                data-lucide="circle-check"
                class="h-5 w-5
                       text-[#087F5B]"
            ></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- TABLE --}}

    <div class="overflow-hidden
                rounded-3xl
                border border-gray-200
                bg-white
                shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="border-b
                              border-gray-100
                              bg-gray-50">

                    <tr>

                        <th class="px-6 py-4
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-500">
                            Pengirim
                        </th>

                        <th class="px-6 py-4
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-500">
                            Subjek
                        </th>

                        <th class="px-6 py-4
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-500">
                            Status
                        </th>

                        <th class="px-6 py-4
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-500">
                            Tanggal
                        </th>

                        <th class="px-6 py-4
                                   text-right
                                   text-xs font-black
                                   uppercase
                                   tracking-wider
                                   text-gray-500">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y
                              divide-gray-100">

                    @forelse ($contacts as $contact)

                        <tr
                            class="transition
                                   hover:bg-gray-50
                                   {{ !$contact->is_read
                                        ? 'bg-[#F4FBF7]'
                                        : '' }}"
                        >

                            {{-- SENDER --}}

                            <td class="px-6 py-5">

                                <div class="flex
                                            items-center
                                            gap-3">

                                    <div
                                        class="flex h-10 w-10
                                               shrink-0
                                               items-center
                                               justify-center
                                               rounded-xl
                                               bg-[#EAF4EF]
                                               text-[#087F5B]"
                                    >

                                        <i
                                            data-lucide="user"
                                            class="h-4 w-4"
                                        ></i>

                                    </div>

                                    <div>

                                        <p class="font-bold
                                                  text-gray-900">
                                            {{ $contact->name }}
                                        </p>

                                        <p class="mt-0.5
                                                  text-xs
                                                  text-gray-500">
                                            {{ $contact->email }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- SUBJECT --}}

                            <td class="px-6 py-5">

                                <p class="max-w-xs
                                          truncate
                                          font-semibold
                                          text-gray-800">

                                    {{ $contact->subject }}

                                </p>

                            </td>


                            {{-- STATUS --}}

                            <td class="px-6 py-5">

                                @if ($contact->is_read)

                                    <span
                                        class="inline-flex
                                               items-center
                                               gap-1.5
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

                                        Sudah dibaca

                                    </span>

                                @else

                                    <span
                                        class="inline-flex
                                               items-center
                                               gap-1.5
                                               rounded-full
                                               bg-[#FFF7D6]
                                               px-3 py-1
                                               text-xs
                                               font-bold
                                               text-[#8A6800]"
                                    >

                                        <span
                                            class="h-1.5 w-1.5
                                                   rounded-full
                                                   bg-[#F4C542]"
                                        ></span>

                                        Baru

                                    </span>

                                @endif

                            </td>


                            {{-- DATE --}}

                            <td class="px-6 py-5
                                       whitespace-nowrap">

                                <p class="text-sm
                                          font-semibold
                                          text-gray-700">

                                    {{ $contact->created_at
                                        ->format('d M Y') }}

                                </p>

                                <p class="mt-1 text-xs
                                          text-gray-400">

                                    {{ $contact->created_at
                                        ->format('H:i') }}

                                </p>

                            </td>


                            {{-- ACTION --}}

                            <td class="px-6 py-5">

                                <div
                                    class="flex
                                           items-center
                                           justify-end
                                           gap-2"
                                >

                                    <a
                                        href="{{ route(
                                            'admin.contacts.show',
                                            $contact
                                        ) }}"
                                        class="flex h-9 w-9
                                               items-center
                                               justify-center
                                               rounded-xl
                                               bg-[#EAF4EF]
                                               text-[#087F5B]
                                               transition
                                               hover:bg-[#087F5B]
                                               hover:text-white"
                                        title="Lihat pesan"
                                    >

                                        <i
                                            data-lucide="eye"
                                            class="h-4 w-4"
                                        ></i>

                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.contacts.destroy',
                                            $contact
                                        ) }}"
                                        onsubmit="return confirm(
                                            'Hapus pesan ini?'
                                        )"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="flex h-9 w-9
                                                   items-center
                                                   justify-center
                                                   rounded-xl
                                                   bg-red-50
                                                   text-red-500
                                                   transition
                                                   hover:bg-red-500
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
                                    data-lucide="inbox"
                                    class="mx-auto h-12 w-12
                                           text-gray-300"
                                ></i>

                                <h3
                                    class="mt-4 text-lg
                                           font-black
                                           text-gray-800"
                                >
                                    Belum ada pesan
                                </h3>

                                <p
                                    class="mt-1 text-sm
                                           text-gray-500"
                                >
                                    Pesan dari pengunjung
                                    akan muncul di sini.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        @if ($contacts->hasPages())

            <div class="border-t
                        border-gray-100
                        px-6 py-4">

                {{ $contacts->links() }}

            </div>

        @endif

    </div>

</div>

@endsection