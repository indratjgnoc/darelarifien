@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

    {{-- HEADER --}}

    <div class="flex items-center gap-4">

        <a
            href="{{ route('admin.contacts.index') }}"
            class="flex h-10 w-10
                   items-center justify-center
                   rounded-xl
                   border border-gray-200
                   bg-white
                   text-gray-600
                   transition
                   hover:bg-gray-50"
        >

            <i
                data-lucide="arrow-left"
                class="h-5 w-5"
            ></i>

        </a>

        <div>

            <p
                class="text-xs font-black
                       uppercase
                       tracking-[0.2em]
                       text-[#087F5B]"
            >
                Pesan Masuk
            </p>

            <h1
                class="mt-1 text-2xl
                       font-black
                       text-gray-900"
            >
                Detail Pesan
            </h1>

        </div>

    </div>


    {{-- MESSAGE --}}

    <div
        class="overflow-hidden
               rounded-3xl
               border border-gray-200
               bg-white
               shadow-sm"
    >

        {{-- TOP --}}

        <div
            class="border-b border-gray-100
                   bg-[#062E1F]
                   px-7 py-7
                   text-white"
        >

            <div
                class="flex flex-col
                       gap-5
                       md:flex-row
                       md:items-center
                       md:justify-between"
            >

                <div>

                    <p
                        class="text-xs
                               font-bold
                               uppercase
                               tracking-widest
                               text-white/40"
                    >
                        Subjek
                    </p>

                    <h2
                        class="mt-2 text-2xl
                               font-black"
                    >
                        {{ $contact->subject }}
                    </h2>

                </div>

                <div
                    class="text-sm
                           text-white/50"
                >

                    {{ $contact->created_at
                        ->format('d F Y, H:i') }}

                </div>

            </div>

        </div>


        {{-- SENDER --}}

        <div
            class="grid gap-6
                   border-b
                   border-gray-100
                   px-7 py-7
                   md:grid-cols-3"
        >

            <div>

                <p
                    class="text-xs font-bold
                           uppercase
                           tracking-wider
                           text-gray-400"
                >
                    Nama
                </p>

                <p
                    class="mt-2 font-bold
                           text-gray-900"
                >
                    {{ $contact->name }}
                </p>

            </div>


            <div>

                <p
                    class="text-xs font-bold
                           uppercase
                           tracking-wider
                           text-gray-400"
                >
                    Email
                </p>

                <a
                    href="mailto:{{ $contact->email }}"
                    class="mt-2 block
                           font-semibold
                           text-[#087F5B]"
                >
                    {{ $contact->email }}
                </a>

            </div>


            <div>

                <p
                    class="text-xs font-bold
                           uppercase
                           tracking-wider
                           text-gray-400"
                >
                    Telepon
                </p>

                <p
                    class="mt-2 font-semibold
                           text-gray-700"
                >
                    {{ $contact->phone ?: '-' }}
                </p>

            </div>

        </div>


        {{-- MESSAGE BODY --}}

        <div class="px-7 py-8">

            <p
                class="text-xs font-bold
                       uppercase
                       tracking-wider
                       text-gray-400"
            >
                Isi Pesan
            </p>

            <div
                class="mt-5 rounded-2xl
                       bg-gray-50
                       p-6"
            >

                <p
                    class="whitespace-pre-line
                           text-sm
                           leading-7
                           text-gray-700"
                >
                    {{ $contact->message }}
                </p>

            </div>

        </div>


        {{-- ACTION --}}

        <div
            class="flex flex-wrap
                   gap-3
                   border-t
                   border-gray-100
                   px-7 py-5"
        >

            <a
                href="mailto:{{ $contact->email }}"
                class="inline-flex
                       items-center gap-2
                       rounded-xl
                       bg-[#087F5B]
                       px-5 py-3
                       text-sm font-black
                       text-white
                       transition
                       hover:bg-[#062E1F]"
            >

                <i
                    data-lucide="mail"
                    class="h-4 w-4"
                ></i>

                Balas Email

            </a>


            @if ($contact->phone)

                <a
                    href="tel:{{ $contact->phone }}"
                    class="inline-flex
                           items-center gap-2
                           rounded-xl
                           border border-gray-200
                           bg-white
                           px-5 py-3
                           text-sm font-bold
                           text-gray-700
                           transition
                           hover:bg-gray-50"
                >

                    <i
                        data-lucide="phone"
                        class="h-4 w-4"
                    ></i>

                    Hubungi

                </a>

            @endif


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
                    class="inline-flex
                           items-center gap-2
                           rounded-xl
                           bg-red-50
                           px-5 py-3
                           text-sm font-bold
                           text-red-500
                           transition
                           hover:bg-red-500
                           hover:text-white"
                >

                    <i
                        data-lucide="trash-2"
                        class="h-4 w-4"
                    ></i>

                    Hapus

                </button>

            </form>

        </div>

    </div>

</div>

@endsection