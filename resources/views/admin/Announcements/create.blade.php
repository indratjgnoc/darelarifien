@extends('layouts.admin')

@section('title', 'Buat Pengumuman')

@section('content')

<div class="mx-auto max-w-4xl space-y-8">

    {{-- HEADER --}}

    <div>

        <a
            href="{{ route('admin.announcements.index') }}"
            class="inline-flex items-center
                   gap-2 text-sm font-semibold
                   text-gray-500
                   hover:text-[#087443]"
        >

            <i
                data-lucide="arrow-left"
                class="h-4 w-4"
            ></i>

            Kembali ke Pengumuman

        </a>


        <h1
            class="mt-5 text-3xl
                   font-black"
        >
            Buat Pengumuman
        </h1>


        <p class="mt-2 text-gray-500">
            Publikasikan informasi resmi
            Pesantren {{ $settings['school_name'] ?? '' }}.
        </p>

    </div>


    {{-- ERROR --}}

    @if ($errors->any())

        <div
            class="rounded-xl
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
            'admin.announcements.store'
        ) }}"
        method="POST"
        class="space-y-6"
    >

        @csrf


        {{-- CONTENT --}}

        <div
            class="rounded-2xl
                   bg-white p-6
                   shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="mb-6 text-lg
                       font-black"
            >
                Isi Pengumuman
            </h2>


            <div class="space-y-5">

                {{-- TITLE --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Judul Pengumuman *
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        placeholder="Contoh: Libur Akhir Semester"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               transition
                               focus:border-[#087443]
                               focus:ring-2
                               focus:ring-[#087443]/10"
                    >

                </div>


                {{-- CONTENT --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Isi Pengumuman *
                    </label>

                    <textarea
                        name="content"
                        rows="10"
                        required
                        placeholder="Tuliskan isi pengumuman..."
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               leading-7
                               outline-none
                               transition
                               focus:border-[#087443]
                               focus:ring-2
                               focus:ring-[#087443]/10"
                    >{{ old('content') }}</textarea>

                    <p
                        class="mt-2 text-xs
                               text-gray-400"
                    >
                        Untuk saat ini gunakan teks
                        biasa. Editor teks kaya dapat
                        kita tambahkan pada tahap
                        penyempurnaan.
                    </p>

                </div>

            </div>

        </div>


        {{-- PUBLICATION --}}

        <div
            class="rounded-2xl
                   bg-white p-6
                   shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="mb-6 text-lg
                       font-black"
            >
                Publikasi
            </h2>


            <div
                class="grid gap-5
                       md:grid-cols-2"
            >

                {{-- DATE --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Tanggal Publikasi
                    </label>

                    <input
                        type="datetime-local"
                        name="published_at"
                        value="{{ old(
                            'published_at'
                        ) }}"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                    <p
                        class="mt-2 text-xs
                               text-gray-400"
                    >
                        Kosongkan jika belum
                        menentukan tanggal.
                    </p>

                </div>


                {{-- STATUS --}}

                <div
                    class="flex items-center
                           justify-between
                           rounded-xl
                           bg-gray-50 p-4"
                >

                    <div>

                        <p class="font-bold">
                            Publikasikan
                        </p>

                        <p
                            class="mt-1 text-xs
                                   text-gray-400"
                        >
                            Tampilkan pengumuman
                            pada website.
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
                                    true
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
                href="{{ route(
                    'admin.announcements.index'
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
                    data-lucide="send"
                    class="h-5 w-5"
                ></i>

                Simpan Pengumuman

            </button>

        </div>

    </form>

</div>

@endsection