@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')

<div class="mx-auto max-w-5xl space-y-7">

    <div>

        <a
            href="{{ route(
                'admin.news.index'
            ) }}"
            class="inline-flex
                   items-center gap-2
                   text-sm font-bold
                   text-[#087443]"
        >

            <i
                data-lucide="arrow-left"
                class="h-4 w-4"
            ></i>

            Kembali ke Berita

        </a>


        <h1
            class="mt-4 text-3xl
                   font-black"
        >
            Edit Berita
        </h1>

    </div>


    @if ($errors->any())

        <div
            class="rounded-2xl
                   border border-red-200
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
        class="space-y-7"
    >

        @csrf

        @method('PUT')


        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100
                   sm:p-8"
        >

            <h2
                class="text-xl font-black"
            >
                Informasi Berita
            </h2>


            <div class="mt-7 space-y-6">

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-bold"
                    >
                        Judul Berita
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
                               bg-gray-50
                               px-4 py-3
                               text-sm outline-none
                               focus:border-[#087443]"
                    >

                </div>


                <div>

                    <label
                        class="mb-2 block
                               text-sm font-bold"
                    >
                        Kategori
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
                               bg-gray-50
                               px-4 py-3
                               text-sm outline-none
                               focus:border-[#087443]"
                    >

                </div>


                <div>

                    <label
                        class="mb-2 block
                               text-sm font-bold"
                    >
                        Ringkasan
                    </label>

                    <textarea
                        name="excerpt"
                        rows="3"
                        required
                        maxlength="500"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50
                               px-4 py-3
                               text-sm leading-7
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
                               text-sm font-bold"
                    >
                        Isi Berita
                    </label>

                    <textarea
                        name="content"
                        rows="14"
                        required
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50
                               px-4 py-3
                               text-sm leading-7
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
                   ring-1 ring-gray-100
                   sm:p-8"
        >

            <h2
                class="text-xl font-black"
            >
                Thumbnail
            </h2>


            @if ($news->thumbnail)

                <img
                    src="{{ asset(
                        'storage/' .
                        $news->thumbnail
                    ) }}"
                    alt="{{ $news->title }}"
                    class="mt-5 h-48 w-full
                           rounded-2xl
                           object-cover
                           sm:w-80"
                >

            @endif


            <input
                type="file"
                name="thumbnail"
                accept=".jpg,.jpeg,.png,.webp"
                class="mt-5 block w-full
                       rounded-xl
                       border border-gray-200
                       bg-gray-50
                       p-3 text-sm"
            >

        </div>


        {{-- PUBLISH --}}

        <div
            class="rounded-2xl
                   bg-[#062E1F]
                   p-6 sm:p-8"
        >

            <label
                class="flex cursor-pointer
                       items-center gap-3"
            >

                <input
                    type="checkbox"
                    name="is_published"
                    value="1"
                    @checked(
                        old(
                            'is_published',
                            $news->is_published
                        )
                    )
                    class="h-5 w-5 rounded
                           text-[#087443]
                           focus:ring-[#F4C542]"
                >

                <span
                    class="text-sm font-bold
                           text-white"
                >
                    Publikasikan berita
                </span>

            </label>

        </div>


        <div
            class="flex justify-end gap-3"
        >

            <a
                href="{{ route(
                    'admin.news.index'
                ) }}"
                class="rounded-xl
                       border border-gray-200
                       px-6 py-3
                       text-sm font-bold
                       text-gray-600"
            >
                Batal
            </a>


            <button
                type="submit"
                class="inline-flex
                       items-center gap-2
                       rounded-xl
                       bg-[#087443]
                       px-7 py-3
                       text-sm font-black
                       text-white
                       hover:bg-[#062E1F]"
            >

                <i
                    data-lucide="save"
                    class="h-4 w-4"
                ></i>

                Simpan Perubahan

            </button>

        </div>

    </form>

</div>

@endsection