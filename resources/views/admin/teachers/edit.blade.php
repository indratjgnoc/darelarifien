@extends('layouts.admin')

@section('title', 'Edit Pengajar')

@section('content')

<div class="mx-auto max-w-4xl space-y-8">

    {{-- HEADER --}}

    <div>

        <a
            href="{{ route('admin.teachers.index') }}"
            class="inline-flex items-center
                   gap-2 text-sm font-semibold
                   text-gray-500
                   hover:text-[#087443]"
        >

            <i
                data-lucide="arrow-left"
                class="h-4 w-4"
            ></i>

            Kembali ke Pengajar

        </a>

        <h1
            class="mt-5 text-3xl
                   font-black"
        >
            Edit Pengajar
        </h1>

        <p class="mt-2 text-gray-500">
            Perbarui informasi pengajar.
        </p>

    </div>


    {{-- VALIDATION --}}

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
            'admin.teachers.update',
            $teacher
        ) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf

        @method('PUT')


        {{-- DATA --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="mb-6 text-lg
                       font-black"
            >
                Informasi Pengajar
            </h2>


            <div class="space-y-5">

                {{-- NAME --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Nama Lengkap *
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old(
                            'name',
                            $teacher->name
                        ) }}"
                        required
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                {{-- POSITION --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Jabatan / Posisi *
                    </label>

                    <input
                        type="text"
                        name="position"
                        value="{{ old(
                            'position',
                            $teacher->position
                        ) }}"
                        required
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                {{-- EDUCATION --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Pendidikan
                    </label>

                    <input
                        type="text"
                        name="education"
                        value="{{ old(
                            'education',
                            $teacher->education
                        ) }}"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                {{-- BIO --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Biografi Singkat
                    </label>

                    <textarea
                        name="bio"
                        rows="6"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >{{ old(
                        'bio',
                        $teacher->bio
                    ) }}</textarea>

                </div>

            </div>

        </div>


        {{-- PHOTO --}}

        <div
            class="rounded-2xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100"
        >

            <h2
                class="text-lg font-black"
            >
                Foto Pengajar
            </h2>


            @if ($teacher->photo)

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
                            'storage/' . $teacher->photo
                        ) }}"
                        alt="{{ $teacher->name }}"
                        class="h-64 w-48
                               rounded-2xl
                               object-cover
                               object-top
                               shadow-md"
                    >

                </div>

            @else

                <div
                    class="mt-5 flex h-48 w-40
                           items-center
                           justify-center
                           rounded-2xl
                           bg-[#062E1F]"
                >

                    <i
                        data-lucide="user"
                        class="h-12 w-12
                               text-[#F4C542]"
                    ></i>

                </div>

            @endif


            <div
                class="mt-5 rounded-xl
                       border-2 border-dashed
                       border-gray-200
                       bg-gray-50 p-5"
            >

                <input
                    type="file"
                    name="photo"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="block w-full
                           text-sm"
                >

                <p
                    class="mt-2 text-xs
                           text-gray-400"
                >
                    Kosongkan jika tidak ingin
                    mengganti foto.
                </p>

            </div>

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
                            $teacher->sort_order
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
                            Pengajar Aktif
                        </p>

                        <p
                            class="mt-1 text-xs
                                   text-gray-400"
                        >
                            Tampilkan pada website.
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
                                    $teacher->is_active
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
                href="{{ route('admin.teachers.index') }}"
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

                Perbarui Pengajar

            </button>

        </div>

    </form>

</div>

@endsection