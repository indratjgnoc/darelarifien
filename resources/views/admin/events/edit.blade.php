@extends('layouts.admin')

@section('title', 'Edit Agenda')

@section('content')

<div class="mx-auto max-w-4xl space-y-8">

    <div>

        <a
            href="{{ route('admin.events.index') }}"
            class="inline-flex items-center
                   gap-2 text-sm font-semibold
                   text-gray-500
                   hover:text-[#087443]"
        >

            <i
                data-lucide="arrow-left"
                class="h-4 w-4"
            ></i>

            Kembali ke Agenda

        </a>

        <h1
            class="mt-5 text-3xl
                   font-black"
        >
            Edit Agenda
        </h1>

        <p class="mt-2 text-gray-500">
            Perbarui informasi agenda.
        </p>

    </div>


    @if ($errors->any())

        <div
            class="rounded-xl border
                   border-red-200
                   bg-red-50 p-5"
        >

            <ul
                class="list-disc pl-5
                       text-sm text-red-600"
            >

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route(
            'admin.events.update',
            $event
        ) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf

        @method('PUT')


        {{-- BASIC --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="mb-6 text-lg
                       font-black"
            >
                Informasi Agenda
            </h2>


            <div class="space-y-5">

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Nama Agenda *
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old(
                            'title',
                            $event->title
                        ) }}"
                        required
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        rows="7"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               leading-7
                               outline-none
                               focus:border-[#087443]"
                    >{{ old(
                        'description',
                        $event->description
                    ) }}</textarea>

                </div>


                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Lokasi
                    </label>

                    <input
                        type="text"
                        name="location"
                        value="{{ old(
                            'location',
                            $event->location
                        ) }}"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>

            </div>

        </div>


        {{-- DATE --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="mb-6 text-lg
                       font-black"
            >
                Waktu Pelaksanaan
            </h2>


            <div
                class="grid gap-5
                       md:grid-cols-2"
            >

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Mulai *
                    </label>

                    <input
                        type="datetime-local"
                        name="start_at"
                        value="{{ old(
                            'start_at',
                            optional(
                                $event->start_at
                            )->format(
                                'Y-m-d\TH:i'
                            )
                        ) }}"
                        required
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Selesai
                    </label>

                    <input
                        type="datetime-local"
                        name="end_at"
                        value="{{ old(
                            'end_at',
                            optional(
                                $event->end_at
                            )->format(
                                'Y-m-d\TH:i'
                            )
                        ) }}"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>

            </div>

        </div>


        {{-- IMAGE --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="text-lg font-black"
            >
                Poster / Foto Agenda
            </h2>


            @if ($event->image)

                <div class="mt-5">

                    <p
                        class="mb-3 text-sm
                               font-semibold
                               text-gray-600"
                    >
                        Foto Saat Ini
                    </p>

                    <img
                        src="{{ asset(
                            'storage/' . $event->image
                        ) }}"
                        alt="{{ $event->title }}"
                        class="h-52 w-full
                               max-w-md
                               rounded-2xl
                               object-cover
                               shadow-md"
                    >

                </div>

            @endif


            <div
                class="mt-5 rounded-xl
                       border-2 border-dashed
                       border-gray-200
                       bg-gray-50 p-6"
            >

                <input
                    type="file"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="block w-full
                           text-sm"
                >

                <p
                    class="mt-2 text-xs
                           text-gray-400"
                >
                    Kosongkan jika tidak ingin
                    mengganti gambar.
                </p>

            </div>

        </div>


        {{-- PUBLISH --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <div
                class="flex items-center
                       justify-between"
            >

                <div>

                    <h2
                        class="text-lg
                               font-black"
                    >
                        Publikasikan
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-gray-400"
                    >
                        Tampilkan agenda pada
                        website.
                    </p>

                </div>


                <label
                    class="relative inline-flex
                           cursor-pointer
                           items-center"
                >

                    <input
                        type="checkbox"
                        name="is_published"
                        value="1"
                        class="peer sr-only"
                        @checked(
                            old(
                                'is_published',
                                $event->is_published
                            )
                        )
                    >

                    <div
                        class="h-7 w-12
                               rounded-full
                               bg-gray-200
                               after:absolute
                               after:left-[3px]
                               after:top-[3px]
                               after:h-5
                               after:w-5
                               after:rounded-full
                               after:bg-white
                               after:transition-all
                               peer-checked:bg-[#087443]
                               peer-checked:after:translate-x-5"
                    ></div>

                </label>

            </div>

        </div>


        {{-- BUTTON --}}

        <div
            class="flex justify-end gap-3"
        >

            <a
                href="{{ route('admin.events.index') }}"
                class="rounded-xl
                       bg-gray-100 px-6 py-3
                       font-bold text-gray-600
                       hover:bg-gray-200"
            >
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex items-center
                       gap-2 rounded-xl
                       bg-[#087443]
                       px-6 py-3
                       font-bold text-white
                       shadow-lg
                       hover:bg-[#062E1F]"
            >

                <i
                    data-lucide="save"
                    class="h-5 w-5"
                ></i>

                Perbarui Agenda

            </button>

        </div>

    </form>

</div>

@endsection