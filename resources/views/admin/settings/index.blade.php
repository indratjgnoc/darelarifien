@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')

<div class="mx-auto max-w-6xl space-y-8">

    {{-- HEADER --}}

    <div>

        <p
            class="text-sm font-semibold
                   uppercase tracking-wider
                   text-[#087443]"
        >
            Website Configuration
        </p>

        <h1
            class="mt-1 text-3xl font-black
                   text-[#111111]"
        >
            Pengaturan Website
        </h1>

        <p class="mt-2 text-gray-500">
            Kelola identitas dan informasi resmi
            Pesantren Darel Arifien.
        </p>

    </div>


    {{-- SUCCESS MESSAGE --}}

    @if (session('success'))

        <div
            class="flex items-center gap-3
                   rounded-xl border
                   border-green-200
                   bg-green-50 px-5 py-4"
        >

            <i
                data-lucide="circle-check"
                class="h-5 w-5 text-[#087443]"
            ></i>

            <p
                class="text-sm font-semibold
                       text-[#087443]"
            >
                {{ session('success') }}
            </p>

        </div>

    @endif


    {{-- VALIDATION ERROR --}}

    @if ($errors->any())

        <div
            class="rounded-xl border
                   border-red-200
                   bg-red-50 px-5 py-4"
        >

            <p
                class="mb-2 font-bold text-red-700"
            >
                Terdapat kesalahan:
            </p>

            <ul class="list-disc pl-5 text-sm text-red-600">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.settings.update') }}"
        method="POST"
        class="space-y-6"
    >

        @csrf

        @method('PUT')


        {{-- IDENTITAS --}}

        <div
            class="overflow-hidden
                   rounded-2xl bg-white
                   shadow-sm ring-1
                   ring-gray-100"
        >

            <div
                class="border-b border-gray-100
                       px-6 py-5"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10
                               items-center justify-center
                               rounded-xl
                               bg-[#087443]/10
                               text-[#087443]"
                    >

                        <i
                            data-lucide="school"
                            class="h-5 w-5"
                        ></i>

                    </div>

                    <div>

                        <h2 class="font-black">
                            Identitas Pesantren
                        </h2>

                        <p
                            class="mt-1 text-xs
                                   text-gray-400"
                        >
                            Informasi utama website
                        </p>

                    </div>

                </div>

            </div>


            <div
                class="grid gap-6 p-6
                       md:grid-cols-2"
            >

                {{-- Nama --}}

                <div class="md:col-span-2">

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Nama Pesantren
                    </label>

                    <input
                        type="text"
                        name="site_name"
                        value="{{ $settings['site_name'] ?? '' }}"
                        placeholder="Pesantren Darel Arifien"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                {{-- Nama Singkat --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Nama Singkat
                    </label>

                    <input
                        type="text"
                        name="site_short_name"
                        value="{{ $settings['site_short_name'] ?? '' }}"
                        placeholder="Darel Arifien"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                {{-- Tahun --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Tahun Berdiri
                    </label>

                    <input
                        type="number"
                        name="founded_year"
                        value="{{ $settings['founded_year'] ?? '' }}"
                        placeholder="2000"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                {{-- Deskripsi --}}

                <div class="md:col-span-2">

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Deskripsi Pesantren
                    </label>

                    <textarea
                        name="site_description"
                        rows="5"
                        placeholder="Tuliskan deskripsi singkat pesantren..."
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >{{ $settings['site_description'] ?? '' }}</textarea>

                </div>

            </div>

        </div>


        {{-- KONTAK --}}

        <div
            class="overflow-hidden
                   rounded-2xl bg-white
                   shadow-sm ring-1
                   ring-gray-100"
        >

            <div
                class="border-b border-gray-100
                       px-6 py-5"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10
                               items-center justify-center
                               rounded-xl
                               bg-[#F4C542]/20
                               text-[#9A7500]"
                    >

                        <i
                            data-lucide="phone"
                            class="h-5 w-5"
                        ></i>

                    </div>

                    <div>

                        <h2 class="font-black">
                            Informasi Kontak
                        </h2>

                        <p
                            class="mt-1 text-xs
                                   text-gray-400"
                        >
                            Informasi yang dapat dihubungi
                        </p>

                    </div>

                </div>

            </div>


            <div
                class="grid gap-6 p-6
                       md:grid-cols-2"
            >

                {{-- Email --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ $settings['email'] ?? '' }}"
                        placeholder="info@darelarifien.sch.id"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                {{-- Telepon --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ $settings['phone'] ?? '' }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                {{-- WhatsApp --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        WhatsApp
                    </label>

                    <input
                        type="text"
                        name="whatsapp"
                        value="{{ $settings['whatsapp'] ?? '' }}"
                        placeholder="628xxxxxxxxxx"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                {{-- Website --}}

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Website
                    </label>

                    <input
                        type="url"
                        name="website"
                        value="{{ $settings['website'] ?? '' }}"
                        placeholder="https://..."
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>


                {{-- Alamat --}}

                <div class="md:col-span-2">

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Alamat
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        placeholder="Alamat lengkap pesantren..."
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >{{ $settings['address'] ?? '' }}</textarea>

                </div>

            </div>

        </div>


        {{-- SOSIAL MEDIA --}}

        <div
            class="overflow-hidden
                   rounded-2xl bg-white
                   shadow-sm ring-1
                   ring-gray-100"
        >

            <div
                class="border-b border-gray-100
                       px-6 py-5"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10
                               items-center justify-center
                               rounded-xl
                               bg-black/5"
                    >

                        <i
                            data-lucide="share-2"
                            class="h-5 w-5"
                        ></i>

                    </div>

                    <div>

                        <h2 class="font-black">
                            Sosial Media
                        </h2>

                        <p
                            class="mt-1 text-xs
                                   text-gray-400"
                        >
                            Tautan media sosial pesantren
                        </p>

                    </div>

                </div>

            </div>


            <div
                class="grid gap-6 p-6
                       md:grid-cols-3"
            >

                <div>

                    <label
                        class="mb-2 block
                               text-sm font-semibold"
                    >
                        Facebook
                    </label>

                    <input
                        type="text"
                        name="facebook"
                        value="{{ $settings['facebook'] ?? '' }}"
                        placeholder="URL Facebook"
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
                        Instagram
                    </label>

                    <input
                        type="text"
                        name="instagram"
                        value="{{ $settings['instagram'] ?? '' }}"
                        placeholder="URL Instagram"
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
                        YouTube
                    </label>

                    <input
                        type="text"
                        name="youtube"
                        value="{{ $settings['youtube'] ?? '' }}"
                        placeholder="URL YouTube"
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               outline-none
                               focus:border-[#087443]"
                    >

                </div>

            </div>

        </div>


        {{-- SAVE --}}

        <div
            class="flex justify-end"
        >

            <button
                type="submit"
                class="inline-flex items-center
                       gap-2 rounded-xl
                       bg-[#087443]
                       px-6 py-3.5
                       font-bold text-white
                       shadow-lg
                       transition
                       hover:bg-[#062E1F]"
            >

                <i
                    data-lucide="save"
                    class="h-5 w-5"
                ></i>

                Simpan Pengaturan

            </button>

        </div>

    </form>

</div>

@endsection