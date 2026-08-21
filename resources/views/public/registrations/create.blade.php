@extends('layouts.public')

@section('title', 'Pendaftaran Santri')

@section('content')

{{-- HERO --}}

<section class="bg-[#062E1F] py-16">

    <div class="mx-auto max-w-5xl px-5 lg:px-8">

        <p
            class="text-sm font-black uppercase
                   tracking-widest text-[#F4C542]"
        >
            Penerimaan Santri
        </p>

        <h1
            class="mt-3 text-4xl font-black
                   text-white sm:text-5xl"
        >
            Pendaftaran Santri Baru
        </h1>

        <p
            class="mt-5 max-w-2xl
                   leading-8 text-white/50"
        >
            Silakan lengkapi formulir pendaftaran
            dengan data yang benar.
        </p>

    </div>

</section>


{{-- FORM --}}

<section class="bg-[#F5F7F6] py-16">

    <div class="mx-auto max-w-5xl px-5 lg:px-8">

        @if ($errors->any())

            <div
                class="mb-6 rounded-2xl
                       border border-red-200
                       bg-red-50 p-5"
            >

                <p
                    class="font-bold
                           text-red-700"
                >
                    Mohon periksa kembali data Anda.
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
            action="{{ route('registration.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
        >

            @csrf


            {{-- DATA CALON SANTRI --}}

            <div
                class="rounded-3xl bg-white
                       p-6 shadow-sm
                       ring-1 ring-gray-100
                       sm:p-8"
            >

                <div class="mb-7">

                    <h2
                        class="text-xl
                               font-black"
                    >
                        Data Calon Santri
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-gray-400"
                    >
                        Isi sesuai dokumen identitas.
                    </p>

                </div>


                <div class="grid gap-6 md:grid-cols-2">

                    {{-- NAME --}}

                    <div class="md:col-span-2">

                        <label
                            class="mb-2 block
                                   text-sm font-bold"
                        >
                            Nama Lengkap
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="student_name"
                            value="{{ old('student_name') }}"
                            required
                            class="w-full rounded-xl
                                   border border-gray-200
                                   bg-gray-50 px-4 py-3
                                   text-sm outline-none
                                   focus:border-[#087443]
                                   focus:ring-2
                                   focus:ring-[#087443]/10"
                            placeholder="Nama lengkap calon santri"
                        >

                    </div>


                    {{-- GENDER --}}

                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-bold"
                        >
                            Jenis Kelamin
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="gender"
                            required
                            class="w-full rounded-xl
                                   border border-gray-200
                                   bg-gray-50 px-4 py-3
                                   text-sm outline-none
                                   focus:border-[#087443]"
                        >

                            <option value="">
                                Pilih jenis kelamin
                            </option>

                            <option
                                value="L"
                                @selected(
                                    old('gender') === 'L'
                                )
                            >
                                Laki-laki
                            </option>

                            <option
                                value="P"
                                @selected(
                                    old('gender') === 'P'
                                )
                            >
                                Perempuan
                            </option>

                        </select>

                    </div>


                    {{-- BIRTH PLACE --}}

                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-bold"
                        >
                            Tempat Lahir
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="birth_place"
                            value="{{ old('birth_place') }}"
                            required
                            class="w-full rounded-xl
                                   border border-gray-200
                                   bg-gray-50 px-4 py-3
                                   text-sm outline-none
                                   focus:border-[#087443]"
                            placeholder="Kabupaten/Kota"
                        >

                    </div>


                    {{-- BIRTH DATE --}}

                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-bold"
                        >
                            Tanggal Lahir
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="date"
                            name="birth_date"
                            value="{{ old('birth_date') }}"
                            required
                            class="w-full rounded-xl
                                   border border-gray-200
                                   bg-gray-50 px-4 py-3
                                   text-sm outline-none
                                   focus:border-[#087443]"
                        >

                    </div>


                    {{-- SCHOOL --}}

                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-bold"
                        >
                            Asal Sekolah
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="school_origin"
                            value="{{ old('school_origin') }}"
                            required
                            class="w-full rounded-xl
                                   border border-gray-200
                                   bg-gray-50 px-4 py-3
                                   text-sm outline-none
                                   focus:border-[#087443]"
                            placeholder="Nama sekolah sebelumnya"
                        >

                    </div>


                    {{-- ADDRESS --}}

                    <div class="md:col-span-2">

                        <label
                            class="mb-2 block
                                   text-sm font-bold"
                        >
                            Alamat
                            <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            name="address"
                            rows="4"
                            required
                            class="w-full rounded-xl
                                   border border-gray-200
                                   bg-gray-50 px-4 py-3
                                   text-sm leading-7
                                   outline-none
                                   focus:border-[#087443]"
                            placeholder="Alamat lengkap"
                        >{{ old('address') }}</textarea>

                    </div>

                </div>

            </div>


            {{-- KONTAK --}}

            <div
                class="rounded-3xl bg-white
                       p-6 shadow-sm
                       ring-1 ring-gray-100
                       sm:p-8"
            >

                <h2
                    class="text-xl font-black"
                >
                    Kontak
                </h2>


                <div
                    class="mt-7 grid gap-6
                           md:grid-cols-2"
                >

                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-bold"
                        >
                            Nomor HP Calon Santri
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            class="w-full rounded-xl
                                   border border-gray-200
                                   bg-gray-50 px-4 py-3
                                   text-sm outline-none
                                   focus:border-[#087443]"
                            placeholder="08xxxxxxxxxx"
                        >

                    </div>


                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-bold"
                        >
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full rounded-xl
                                   border border-gray-200
                                   bg-gray-50 px-4 py-3
                                   text-sm outline-none
                                   focus:border-[#087443]"
                            placeholder="email@example.com"
                        >

                    </div>

                </div>

            </div>


            {{-- ORANG TUA --}}

            <div
                class="rounded-3xl bg-white
                       p-6 shadow-sm
                       ring-1 ring-gray-100
                       sm:p-8"
            >

                <h2
                    class="text-xl font-black"
                >
                    Data Orang Tua / Wali
                </h2>


                <div
                    class="mt-7 grid gap-6
                           md:grid-cols-2"
                >

                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-bold"
                        >
                            Nama Orang Tua / Wali
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="parent_name"
                            value="{{ old('parent_name') }}"
                            required
                            class="w-full rounded-xl
                                   border border-gray-200
                                   bg-gray-50 px-4 py-3
                                   text-sm outline-none
                                   focus:border-[#087443]"
                        >

                    </div>


                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-bold"
                        >
                            Nomor HP Orang Tua
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="parent_phone"
                            value="{{ old('parent_phone') }}"
                            required
                            class="w-full rounded-xl
                                   border border-gray-200
                                   bg-gray-50 px-4 py-3
                                   text-sm outline-none
                                   focus:border-[#087443]"
                        >

                    </div>

                </div>

            </div>


            {{-- PROGRAM --}}

            <div
                class="rounded-3xl bg-white
                       p-6 shadow-sm
                       ring-1 ring-gray-100
                       sm:p-8"
            >

                <h2
                    class="text-xl font-black"
                >
                    Program Pendidikan
                </h2>


                <div class="mt-7">

                    <label
                        class="mb-2 block
                               text-sm font-bold"
                    >
                        Pilih Program
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="program"
                        required
                        class="w-full rounded-xl
                               border border-gray-200
                               bg-gray-50 px-4 py-3
                               text-sm outline-none
                               focus:border-[#087443]"
                    >

                        <option value="">
                            Pilih program pendidikan
                        </option>

                        @foreach ($programs as $program)

                            <option
                                value="{{ $program->title }}"
                                @selected(
                                    old('program') === $program->title
                                )
                            >
                                {{ $program->title }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- DOKUMEN --}}

            <div
                class="rounded-3xl bg-white
                       p-6 shadow-sm
                       ring-1 ring-gray-100
                       sm:p-8"
            >

                <h2
                    class="text-xl font-black"
                >
                    Dokumen Pendukung
                </h2>

                <p
                    class="mt-2 text-sm
                           leading-6 text-gray-400"
                >
                    Upload dokumen dalam format
                    PDF, JPG, atau PNG.
                    Maksimal 5 MB.
                </p>


                <div class="mt-6">

                    <input
                        type="file"
                        name="document"
                        accept=".pdf,.jpg,.jpeg,.png"
                        class="block w-full
                               rounded-xl
                               border border-gray-200
                               bg-gray-50
                               p-3 text-sm"
                    >

                </div>

            </div>


            {{-- SUBMIT --}}

            <div
                class="rounded-3xl
                       bg-[#062E1F]
                       p-6 sm:p-8"
            >

                <div
                    class="flex flex-col
                           gap-5
                           md:flex-row
                           md:items-center
                           md:justify-between"
                >

                    <div>

                        <p
                            class="font-bold
                                   text-white"
                        >
                            Pastikan data sudah benar
                        </p>

                        <p
                            class="mt-1 text-sm
                                   text-white/40"
                        >
                            Setelah dikirim, Anda akan
                            mendapatkan nomor pendaftaran.
                        </p>

                    </div>


                    <button
                        type="submit"
                        class="inline-flex
                               items-center
                               justify-center
                               gap-2 rounded-xl
                               bg-[#F4C542]
                               px-7 py-3
                               text-sm font-black
                               text-[#062E1F]
                               transition
                               hover:bg-white"
                    >

                        Kirim Pendaftaran

                        <i
                            data-lucide="arrow-right"
                            class="h-4 w-4"
                        ></i>

                    </button>

                </div>

            </div>

        </form>

    </div>

</section>

@endsection