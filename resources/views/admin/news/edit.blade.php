@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')

<div class="mx-auto max-w-5xl space-y-8">

    <div>

        <a
            href="{{ route('admin.news.index') }}"
            class="inline-flex items-center
                   gap-2 text-sm font-semibold
                   text-gray-500
                   hover:text-[#087443]"
        >

            <i
                data-lucide="arrow-left"
                class="h-4 w-4"
            ></i>

            Kembali ke Berita

        </a>

        <h1
            class="mt-5 text-3xl
                   font-black"
        >
            Edit Berita
        </h1>

        <p class="mt-2 text-gray-500">
            Perbarui informasi berita.
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
            'admin.news.update',
            $news
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
                Informasi Berita
            </h2>


            <div class="space-y-5">

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Judul Berita *
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old(
                            'title',
                            $news->title
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
                        Kategori *
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ old(
                            'category',
                            $news->category
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
                        Ringkasan
                    </label>

                    <textarea
                        name="excerpt"
                        rows="3"
                        maxlength="500"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >{{ old(
                        'excerpt',
                        $news->excerpt
                    ) }}</textarea>

                </div>


                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Isi Berita *
                    </label>

                    <textarea
                        name="content"
                        rows="12"
                        required
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >{{ old(
                        'content',
                        $news->content
                    ) }}</textarea>

                </div>

            </div>

        </div>


        {{-- THUMBNAIL --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="mb-5 text-lg
                       font-black"
            >
                Thumbnail
            </h2>


            @if ($news->thumbnail)

                <div class="mb-5">

                    <img
                        src="{{ asset(
                            'storage/' . $news->thumbnail
                        ) }}"
                        alt="{{ $news->title }}"
                        class="h-48 w-full
                               rounded-xl
                               object-cover
                               md:w-80"
                    >

                </div>

            @endif


            <input
                type="file"
                name="thumbnail"
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
                mengganti thumbnail.
            </p>

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

                    <h2 class="font-black">
                        Status Publikasi
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-gray-400"
                    >
                        Aktifkan untuk menampilkan
                        berita di website.
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
                                $news->is_published
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
                href="{{ route('admin.news.index') }}"
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

                Perbarui Berita

            </button>

        </div>

    </form>

</div>

@endsection