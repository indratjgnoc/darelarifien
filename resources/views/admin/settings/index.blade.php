@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')

    <div class="max-w-5xl">

        {{-- HEADER --}}

        <div class="mb-8">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-12 w-12
                       items-center justify-center
                       rounded-2xl
                       bg-[#087443]/10
                       text-[#087443]">

                    <i data-lucide="settings" class="h-6 w-6"></i>

                </div>

                <div>

                    <h1 class="text-2xl font-black
                           text-gray-900">
                        Pengaturan Website
                    </h1>

                    <p class="mt-1 text-sm
                           text-gray-500">
                        Kelola informasi utama
                        Pesantren {{ $settings['school_name'] ?? '' }}.
                    </p>

                </div>

            </div>

        </div>


        {{-- SUCCESS --}}

        @if (session('success'))
            <div
                class="mb-6 flex items-center
                   gap-3 rounded-2xl
                   border border-green-200
                   bg-green-50
                   px-5 py-4
                   text-sm font-semibold
                   text-green-700">

                <i data-lucide="check-circle" class="h-5 w-5"></i>

                {{ session('success') }}

            </div>
        @endif


        {{-- ERROR --}}

        @if ($errors->any())

            <div
                class="mb-6 rounded-2xl
                   border border-red-200
                   bg-red-50 p-5
                   text-sm text-red-700">

                <p class="font-bold">
                    Terdapat kesalahan:
                </p>

                <ul class="mt-2 list-disc pl-5">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">

            @csrf
            @method('PUT')


            {{-- ================================= --}}
            {{-- IDENTITAS --}}
            {{-- ================================= --}}

            <div class="rounded-3xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100">

                <div class="mb-6">

                    <h2 class="text-lg font-black">
                        Identitas Pesantren
                    </h2>

                    <p class="mt-1 text-sm
                           text-gray-400">
                        Informasi dasar yang ditampilkan
                        di website.
                    </p>

                </div>


                <div class="grid gap-6 md:grid-cols-2">

                    {{-- NAME --}}

                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm
                               font-bold text-gray-700">
                            Nama Pesantren
                        </label>

                        <input type="text" name="school_name"
                            value="{{ old('school_name', $settings['school_name'] ?? '') }}"
                            class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm outline-none
                               transition
                               focus:border-[#087443]
                               focus:ring-2
                               focus:ring-[#087443]/10"
                            placeholder="Pesantren Darel Arifien">

                    </div>


                    {{-- SHORT NAME --}}

                    <div>

                        <label class="mb-2 block text-sm
                               font-bold text-gray-700">
                            Nama Singkat
                        </label>

                        <input type="text" name="school_short_name"
                            value="{{ old('school_short_name', $settings['school_short_name'] ?? '') }}"
                            class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm outline-none
                               transition
                               focus:border-[#087443]
                               focus:ring-2
                               focus:ring-[#087443]/10"
                            placeholder="Darel Arifien">

                    </div>


                    {{-- LOGO PESANTREN --}}

                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-bold text-gray-700">
                            Logo Pesantren
                        </label>

                        <div class="flex flex-col gap-5 md:flex-row md:items-center">

                            {{-- PREVIEW LOGO --}}
                            <div
                                class="flex h-28 w-28 shrink-0
                   items-center justify-center
                   overflow-hidden
                   rounded-2xl
                   border border-gray-200
                   bg-gray-50">

                                @if (!empty($settings['logo']))
                                    <img src="{{ asset('storage/' . $settings['logo']) }}"
                                        alt="Logo {{ $settings['school_name'] ?? 'Pesantren' }}"
                                        class="h-full w-full object-contain p-3">
                                @else
                                    <div class="text-center text-gray-400">

                                        <i data-lucide="image" class="mx-auto h-8 w-8"></i>

                                        <p class="mt-1 text-[10px] font-semibold">
                                            Belum ada logo
                                        </p>

                                    </div>
                                @endif

                            </div>


                            {{-- UPLOAD --}}
                            <div class="flex-1">

                                <input type="file" name="logo" accept="image/png,image/jpeg,image/jpg,image/webp"
                                    class="block w-full rounded-xl
                       border border-gray-200
                       bg-gray-50
                       px-4 py-3
                       text-sm
                       file:mr-4
                       file:rounded-lg
                       file:border-0
                       file:bg-[#087443]
                       file:px-4
                       file:py-2
                       file:text-sm
                       file:font-bold
                       file:text-white
                       hover:file:bg-[#062E1F]">

                                <p class="mt-2 text-xs text-gray-400">
                                    Format: PNG, JPG, JPEG atau WEBP.
                                    Maksimal 2 MB.
                                </p>

                                @error('logo')
                                    <p class="mt-2 text-xs font-semibold text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>

                    {{-- EMAIL --}}

                    <div>

                        <label class="mb-2 block text-sm
                               font-bold text-gray-700">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}"
                            class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm outline-none
                               transition
                               focus:border-[#087443]
                               focus:ring-2
                               focus:ring-[#087443]/10"
                            placeholder="info@darelarifien.sch.id">

                    </div>


                    {{-- PHONE --}}

                    <div>

                        <label class="mb-2 block text-sm
                               font-bold text-gray-700">
                            Nomor Telepon
                        </label>

                        <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}"
                            class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm outline-none
                               transition
                               focus:border-[#087443]
                               focus:ring-2
                               focus:ring-[#087443]/10"
                            placeholder="08xxxxxxxxxx">

                    </div>


                    {{-- WHATSAPP --}}

                    <div>

                        <label class="mb-2 block text-sm
                               font-bold text-gray-700">
                            WhatsApp
                        </label>

                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}"
                            class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm outline-none
                               transition
                               focus:border-[#087443]
                               focus:ring-2
                               focus:ring-[#087443]/10"
                            placeholder="628xxxxxxxxxx">

                    </div>

                </div>

            </div>


            {{-- ================================= --}}
            {{-- DESKRIPSI --}}
            {{-- ================================= --}}

            <div class="rounded-3xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100">

                <h2 class="text-lg font-black">
                    Tentang Pesantren
                </h2>

                <p class="mt-1 text-sm
                       text-gray-400">
                    Deskripsi singkat yang akan
                    digunakan pada website.
                </p>


                <textarea name="school_description" rows="5"
                    class="mt-6 w-full
                       rounded-xl
                       border border-gray-200
                       bg-gray-50 px-4 py-3
                       text-sm leading-7
                       outline-none
                       transition
                       focus:border-[#087443]
                       focus:ring-2
                       focus:ring-[#087443]/10"
                    placeholder="Tuliskan deskripsi pesantren...">{{ old('school_description', $settings['school_description'] ?? '') }}</textarea>

            </div>


            {{-- ================================= --}}
            {{-- ALAMAT --}}
            {{-- ================================= --}}

            <div class="rounded-3xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100">

                <h2 class="text-lg font-black">
                    Informasi Kontak
                </h2>


                <div class="mt-6">

                    <label class="mb-2 block text-sm
                           font-bold text-gray-700">
                        Alamat
                    </label>

                    <textarea name="address" rows="4"
                        class="w-full rounded-xl
                           border border-gray-200
                           bg-gray-50 px-4 py-3
                           text-sm leading-7
                           outline-none transition
                           focus:border-[#087443]
                           focus:ring-2
                           focus:ring-[#087443]/10"
                        placeholder="Alamat lengkap pesantren...">{{ old('address', $settings['address'] ?? '') }}</textarea>

                </div>

            </div>


            {{-- ================================= --}}
            {{-- VISI MISI --}}
            {{-- ================================= --}}

            <div class="rounded-3xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100">

                <h2 class="text-lg font-black">
                    Visi & Misi
                </h2>


                <div class="mt-6 space-y-6">

                    <div>

                        <label class="mb-2 block text-sm
                               font-bold text-gray-700">
                            Visi
                        </label>

                        <textarea name="vision" rows="4"
                            class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm leading-7
                               outline-none transition
                               focus:border-[#087443]
                               focus:ring-2
                               focus:ring-[#087443]/10">{{ old('vision', $settings['vision'] ?? '') }}</textarea>

                    </div>


                    <div>

                        <label class="mb-2 block text-sm
                               font-bold text-gray-700">
                            Misi
                        </label>

                        <textarea name="mission" rows="6"
                            class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm leading-7
                               outline-none transition
                               focus:border-[#087443]
                               focus:ring-2
                               focus:ring-[#087443]/10">{{ old('mission', $settings['mission'] ?? '') }}</textarea>

                    </div>

                </div>

            </div>


            {{-- ================================= --}}
            {{-- SOCIAL MEDIA --}}
            {{-- ================================= --}}

            <div class="rounded-3xl bg-white
                   p-6 shadow-sm
                   ring-1 ring-gray-100">

                <h2 class="text-lg font-black">
                    Media Sosial
                </h2>

                <div class="mt-6 grid gap-6
                       md:grid-cols-3">

                    <div>

                        <label class="mb-2 block text-sm
                               font-bold">
                            Facebook
                        </label>

                        <input type="text" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}"
                            class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm outline-none
                               focus:border-[#087443]"
                            placeholder="https://facebook.com/...">

                    </div>


                    <div>

                        <label class="mb-2 block text-sm
                               font-bold">
                            Instagram
                        </label>

                        <input type="text" name="instagram"
                            value="{{ old('instagram', $settings['instagram'] ?? '') }}"
                            class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm outline-none
                               focus:border-[#087443]"
                            placeholder="https://instagram.com/...">

                    </div>


                    <div>

                        <label class="mb-2 block text-sm
                               font-bold">
                            YouTube
                        </label>

                        <input type="text" name="youtube" value="{{ old('youtube', $settings['youtube'] ?? '') }}"
                            class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm outline-none
                               focus:border-[#087443]"
                            placeholder="https://youtube.com/...">

                    </div>

                </div>

            </div>


            {{-- SAVE --}}

            <div class="flex justify-end">

                <button type="submit"
                    class="inline-flex
                       items-center gap-2
                       rounded-xl
                       bg-[#087443]
                       px-6 py-3
                       text-sm font-black
                       text-white
                       shadow-lg
                       shadow-[#087443]/20
                       transition
                       hover:bg-[#062E1F]">

                    <i data-lucide="save" class="h-4 w-4"></i>

                    Simpan Pengaturan

                </button>

            </div>

            {{-- STATUS PENDAFTARAN --}}

            <div class="rounded-2xl
           border border-gray-200
           bg-white
           p-6">

                <div
                    class="flex flex-col
               gap-5
               md:flex-row
               md:items-center
               md:justify-between">

                    <div>

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-11 w-11
                           items-center
                           justify-center
                           rounded-xl
                           bg-[#EAF4EF]
                           text-[#087F5B]">

                                <i data-lucide="graduation-cap" class="h-5 w-5"></i>

                            </div>

                            <div>

                                <h3 class="font-black
                               text-gray-900">
                                    Penerimaan Siswa Baru
                                </h3>

                                <p class="mt-1 text-sm
                               text-gray-500">
                                    Atur apakah pendaftaran siswa
                                    baru sedang dibuka.
                                </p>

                            </div>

                        </div>

                    </div>


                    <label class="inline-flex
                   cursor-pointer
                   items-center">

                        <input type="checkbox" name="registration_open" value="1" class="peer sr-only"
                            {{ ($settings['registration_open'] ?? '0') == '1' ? 'checked' : '' }}>

                        <div
                            class="relative h-7 w-12
                       rounded-full
                       bg-gray-300
                       transition
                       peer-checked:bg-[#087F5B]
                       after:absolute
                       after:left-[3px]
                       after:top-[3px]
                       after:h-[22px]
                       after:w-[22px]
                       after:rounded-full
                       after:bg-white
                       after:shadow
                       after:transition-all
                       peer-checked:after:translate-x-5">
                        </div>

                    </label>

                </div>

            </div>

        </form>

    </div>

@endsection
