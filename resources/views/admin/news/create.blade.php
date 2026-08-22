@extends('layouts.admin')

@section('title', 'Tambah Berita')

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
            Tambah Berita
        </h1>

        <p
            class="mt-2 text-sm
                   text-gray-500"
        >
            Buat berita atau informasi
            terbaru untuk website pesantren.
        </p>

    </div>


    @if ($errors->any())

        <div
            class="rounded-2xl
                   border border-red-200
                   bg-red-50 p-5"
        >

            <p
                class="font-bold
                       text-red-700"
            >
                Ada data yang perlu diperbaiki.
            </p>

            <ul
                class="mt-2 list-disc
                       space-y-1 pl-5
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
            'admin.news.store'
        ) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-7"
    >

        @csrf


        {{-- INFORMASI UTAMA --}}

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
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        placeholder="Masukkan judul berita"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50
                               px-4 py-3
                               text-sm outline-none
                               focus:border-[#087443]
                               focus:ring-2
                               focus:ring-[#087443]/10"
                    >

                </div>


                <div>

                    <label
                        class="mb-2 block
                               text-sm font-bold"
                    >
                        Kategori
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ old('category') }}"
                        required
                        placeholder="Contoh: Kegiatan, Pendidikan, Pengumuman"
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
                        <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        name="excerpt"
                        rows="3"
                        required
                        maxlength="500"
                        placeholder="Ringkasan singkat berita..."
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50
                               px-4 py-3
                               text-sm leading-7
                               outline-none
                               focus:border-[#087443]"
                    >{{ old('excerpt') }}</textarea>

                </div>


                <div>

                    <label
                        class="mb-2 block
                               text-sm font-bold"
                    >
                        Isi Berita
                        <span class="text-red-500">*</span>
                    </label>

                    <textarea
                        name="content"
                        rows="14"
                        required
                        placeholder="Tulis isi berita di sini..."
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50
                               px-4 py-3
                               text-sm leading-7
                               outline-none
                               focus:border-[#087443]"
                    >{{ old('content') }}</textarea>

                </div>

            </div>

        </div>


        {{-- MEDIA --}}

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

            <p
                class="mt-1 text-sm
                       text-gray-400"
            >
                JPG, PNG atau WEBP.
                Maksimal 5 MB.
            </p>


            <div class="mt-6">

                <input
                    type="file"
                    name="thumbnail"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="block w-full
                           rounded-xl
                           border border-gray-200
                           bg-gray-50
                           p-3 text-sm"
                >

            </div>

        </div>


        {{-- PUBLISH --}}

        <div
            class="rounded-2xl
                   bg-[#062E1F]
                   p-6 sm:p-8"
        >

            <div
                class="flex flex-col gap-6
                       sm:flex-row
                       sm:items-center
                       sm:justify-between"
            >

                <div>

                    <p
                        class="font-black
                               text-white"
                    >
                        Publikasikan berita
                    </p>

                    <p
                        class="mt-1 text-sm
                               text-white/40"
                    >
                        Berita yang dipublikasikan
                        akan tampil di website.
                    </p>

                </div>


                <label
                    class="flex cursor-pointer
                           items-center gap-3"
                >

                    <input
                        type="checkbox"
                        name="is_published"
                        value="1"
                        @checked(
                            old('is_published')
                        )
                        class="h-5 w-5
                               rounded
                               border-white/20
                               text-[#087443]
                               focus:ring-[#F4C542]"
                    >

                    <span
                        class="text-sm
                               font-bold
                               text-white"
                    >
                        Publish sekarang
                    </span>

                </label>

            </div>

        </div>


        {{-- BUTTON --}}

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
                       text-gray-600
                       hover:bg-gray-50"
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

                Simpan Berita

            </button>

        </div>

    </form>

</div>

@endsection