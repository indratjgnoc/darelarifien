@extends('layouts.admin')

@section('title', 'Edit Foto Galeri')

@section('content')

<div class="mx-auto max-w-3xl space-y-8">

    <div>

        <a
            href="{{ route('admin.galleries.index') }}"
            class="inline-flex items-center
                   gap-2 text-sm font-semibold
                   text-gray-500
                   hover:text-[#087443]"
        >

            <i
                data-lucide="arrow-left"
                class="h-4 w-4"
            ></i>

            Kembali ke Galeri

        </a>


        <h1
            class="mt-5 text-3xl
                   font-black"
        >
            Edit Foto
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
            'admin.galleries.update',
            $gallery
        ) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf

        @method('PUT')


        {{-- INFORMATION --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="mb-6 text-lg
                       font-black"
            >
                Informasi Foto
            </h2>


            <div class="space-y-5">

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Judul Foto *
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old(
                            'title',
                            $gallery->title
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
                        Kategori
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ old(
                            'category',
                            $gallery->category
                        ) }}"
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
                        rows="5"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               leading-7
                               outline-none
                               focus:border-[#087443]"
                    >{{ old(
                        'description',
                        $gallery->description
                    ) }}</textarea>

                </div>

            </div>

        </div>


        {{-- CURRENT IMAGE --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="text-lg font-black"
            >
                Foto
            </h2>


            <img
                src="{{ asset(
                    'storage/' .
                    $gallery->image
                ) }}"
                alt="{{ $gallery->title }}"
                class="mt-5 h-64 w-full
                       rounded-2xl
                       object-cover
                       shadow-md"
            >


            <div
                class="mt-5 rounded-xl
                       border-2 border-dashed
                       border-gray-200
                       bg-gray-50 p-6"
            >

                <label
                    class="mb-3 block
                           text-sm font-semibold"
                >
                    Ganti Foto
                </label>

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
                    Kosongkan jika foto tidak
                    ingin diganti.
                </p>

            </div>

        </div>


        {{-- SETTINGS --}}

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
                        class="font-black"
                    >
                        Tampilkan di Website
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-gray-400"
                    >
                        Aktifkan untuk menampilkan
                        foto di website.
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
                                $gallery->is_active
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


            <div class="mt-6">

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
                        $gallery->sort_order
                    ) }}"
                    min="0"
                    class="w-full rounded-xl
                           border border-gray-200
                           bg-gray-50 px-4 py-3
                           outline-none
                           focus:border-[#087443]"
                >

            </div>

        </div>


        {{-- BUTTON --}}

        <div
            class="flex justify-end gap-3"
        >

            <a
                href="{{ route(
                    'admin.galleries.index'
                ) }}"
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

                Perbarui Foto

            </button>

        </div>

    </form>

</div>

@endsection