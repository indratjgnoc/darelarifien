@extends('layouts.admin')

@section('title', 'Edit Program')

@section('content')

<div class="mx-auto max-w-4xl space-y-8">

    <div>

        <a
            href="{{ route('admin.programs.index') }}"
            class="inline-flex items-center
                   gap-2 text-sm font-semibold
                   text-gray-500
                   hover:text-[#087443]"
        >

            <i
                data-lucide="arrow-left"
                class="h-4 w-4"
            ></i>

            Kembali ke Program

        </a>

        <h1
            class="mt-5 text-3xl
                   font-black"
        >
            Edit Program Pendidikan
        </h1>

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
            'admin.programs.update',
            $program
        ) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf

        @method('PUT')


        {{-- INFORMASI --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="mb-6 text-lg
                       font-black"
            >
                Informasi Program
            </h2>


            <div class="space-y-5">

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Nama Program *
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old(
                            'title',
                            $program->title
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
                        Icon
                    </label>

                    <input
                        type="text"
                        name="icon"
                        value="{{ old(
                            'icon',
                            $program->icon
                        ) }}"
                        placeholder="book-open"
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
                        Deskripsi *
                    </label>

                    <textarea
                        name="description"
                        rows="7"
                        required
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >{{ old(
                        'description',
                        $program->description
                    ) }}</textarea>

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
                class="mb-5 text-lg
                       font-black"
            >
                Gambar Program
            </h2>


            @if ($program->image)

                <div class="mb-5">

                    <img
                        src="{{ asset(
                            'storage/' . $program->image
                        ) }}"
                        alt="{{ $program->title }}"
                        class="h-48 w-full
                               rounded-xl
                               object-cover
                               md:w-80"
                    >

                </div>

            @endif


            <input
                type="file"
                name="image"
                accept=".jpg,.jpeg,.png,.webp"
                class="block w-full
                       rounded-xl border
                       border-gray-200
                       bg-gray-50 p-3
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


        {{-- DISPLAY --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="mb-6 text-lg
                       font-black"
            >
                Pengaturan Tampilan
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
                        Urutan Tampilan
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old(
                            'sort_order',
                            $program->sort_order
                        ) }}"
                        min="0"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                <div
                    class="flex items-center
                           justify-between
                           rounded-xl
                           bg-gray-50 p-4"
                >

                    <div>

                        <p class="font-bold">
                            Program Aktif
                        </p>

                        <p
                            class="mt-1 text-xs
                                   text-gray-400"
                        >
                            Tampilkan di website.
                        </p>

                    </div>


                    <label
                        class="relative inline-flex
                               cursor-pointer
                               items-center"
                    >

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            class="peer sr-only"
                            @checked(
                                old(
                                    'is_active',
                                    $program->is_active
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

        </div>


        {{-- BUTTON --}}

        <div
            class="flex justify-end gap-3"
        >

            <a
                href="{{ route('admin.programs.index') }}"
                class="rounded-xl
                       bg-gray-100 px-6 py-3
                       font-bold text-gray-600"
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

                Perbarui Program

            </button>

        </div>

    </form>

</div>

@endsection