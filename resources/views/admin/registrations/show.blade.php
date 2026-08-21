@extends('layouts.admin')

@section('title', 'Detail Pendaftaran')

@section('content')

<div class="space-y-7">

    {{-- HEADER --}}

    <div
        class="flex flex-col gap-4
               sm:flex-row
               sm:items-center
               sm:justify-between"
    >

        <div>

            <a
                href="{{ route(
                    'admin.registrations.index'
                ) }}"
                class="inline-flex
                       items-center gap-2
                       text-sm font-bold
                       text-[#087443]
                       hover:text-[#062E1F]"
            >

                <i
                    data-lucide="arrow-left"
                    class="h-4 w-4"
                ></i>

                Kembali ke Pendaftaran

            </a>


            <h1
                class="mt-4 text-3xl
                       font-black"
            >
                Detail Pendaftaran
            </h1>

        </div>


        <span
            class="inline-flex w-fit
                   rounded-full
                   bg-[#087443]
                   px-4 py-2
                   text-xs font-black
                   text-white"
        >
            {{ $registration->registration_number }}
        </span>

    </div>


    {{-- ALERT --}}

    @if (session('success'))

        <div
            class="flex items-center gap-3
                   rounded-2xl
                   border border-green-200
                   bg-green-50 px-5 py-4
                   text-sm font-semibold
                   text-green-700"
        >

            <i
                data-lucide="check-circle"
                class="h-5 w-5"
            ></i>

            {{ session('success') }}

        </div>

    @endif


    <div
        class="grid gap-7
               xl:grid-cols-[1fr_360px]"
    >

        {{-- DATA --}}

        <div class="space-y-7">

            {{-- DATA SANTRI --}}

            <div
                class="rounded-2xl bg-white
                       p-6 shadow-sm
                       ring-1 ring-gray-100
                       sm:p-8"
            >

                <h2
                    class="text-xl font-black"
                >
                    Data Calon Santri
                </h2>


                <div
                    class="mt-7 grid gap-x-8
                           gap-y-6
                           sm:grid-cols-2"
                >

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Nama Lengkap
                        </p>

                        <p
                            class="mt-2
                                   font-bold"
                        >
                            {{ $registration->student_name }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Jenis Kelamin
                        </p>

                        <p
                            class="mt-2
                                   font-bold"
                        >
                            {{
                                $registration->gender === 'L'
                                ? 'Laki-laki'
                                : 'Perempuan'
                            }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Tempat Lahir
                        </p>

                        <p
                            class="mt-2
                                   font-bold"
                        >
                            {{ $registration->birth_place }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Tanggal Lahir
                        </p>

                        <p
                            class="mt-2
                                   font-bold"
                        >
                            {{
                                $registration
                                    ->birth_date
                                    ?->format('d F Y')
                            }}
                        </p>

                    </div>


                    <div class="sm:col-span-2">

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Alamat
                        </p>

                        <p
                            class="mt-2
                                   leading-7
                                   text-gray-600"
                        >
                            {{ $registration->address }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Asal Sekolah
                        </p>

                        <p
                            class="mt-2 font-bold"
                        >
                            {{ $registration->school_origin }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Program
                        </p>

                        <p
                            class="mt-2 font-bold
                                   text-[#087443]"
                        >
                            {{ $registration->program }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- KONTAK --}}

            <div
                class="rounded-2xl bg-white
                       p-6 shadow-sm
                       ring-1 ring-gray-100
                       sm:p-8"
            >

                <h2
                    class="text-xl font-black"
                >
                    Kontak & Orang Tua
                </h2>


                <div
                    class="mt-7 grid gap-6
                           sm:grid-cols-2"
                >

                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Nomor HP
                        </p>

                        <p
                            class="mt-2 font-bold"
                        >
                            {{ $registration->phone }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Email
                        </p>

                        <p
                            class="mt-2 font-bold"
                        >
                            {{ $registration->email ?: '-' }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            Orang Tua / Wali
                        </p>

                        <p
                            class="mt-2 font-bold"
                        >
                            {{ $registration->parent_name }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="text-xs font-bold
                                   uppercase
                                   tracking-wider
                                   text-gray-400"
                        >
                            HP Orang Tua
                        </p>

                        <p
                            class="mt-2 font-bold"
                        >
                            {{ $registration->parent_phone }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- DOKUMEN --}}

            @if ($registration->document)

                <div
                    class="rounded-2xl bg-white
                           p-6 shadow-sm
                           ring-1 ring-gray-100
                           sm:p-8"
                >

                    <div
                        class="flex flex-col
                               gap-4 sm:flex-row
                               sm:items-center
                               sm:justify-between"
                    >

                        <div>

                            <h2
                                class="text-xl
                                       font-black"
                            >
                                Dokumen
                            </h2>

                            <p
                                class="mt-1 text-sm
                                       text-gray-400"
                            >
                                Dokumen yang diunggah
                                oleh calon santri.
                            </p>

                        </div>


                        <a
                            href="{{
                                route(
                                    'admin.registrations.document',
                                    $registration
                                )
                            }}"
                            class="inline-flex
                                   items-center
                                   justify-center
                                   gap-2 rounded-xl
                                   bg-[#F4C542]
                                   px-5 py-3
                                   text-sm font-black
                                   text-[#062E1F]
                                   hover:bg-[#087443]
                                   hover:text-white"
                        >

                            <i
                                data-lucide="download"
                                class="h-4 w-4"
                            ></i>

                            Download

                        </a>

                    </div>

                </div>

            @endif

        </div>


        {{-- SIDEBAR STATUS --}}

        <div class="space-y-7">

            <div
                class="rounded-2xl
                       bg-[#062E1F]
                       p-6 shadow-sm"
            >

                <p
                    class="text-xs font-bold
                           uppercase
                           tracking-widest
                           text-white/40"
                >
                    Status Pendaftaran
                </p>


                <form
                    action="{{
                        route(
                            'admin.registrations.update',
                            $registration
                        )
                    }}"
                    method="POST"
                    class="mt-6 space-y-5"
                >

                    @csrf

                    @method('PUT')


                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-bold
                                   text-white"
                        >
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full rounded-xl
                                   border-0
                                   bg-white/10
                                   px-4 py-3
                                   text-sm text-white
                                   outline-none
                                   focus:ring-2
                                   focus:ring-[#F4C542]"
                        >

                            <option
                                value="pending"
                                class="text-gray-900"
                                @selected(
                                    $registration->status
                                    === 'pending'
                                )
                            >
                                Pending
                            </option>

                            <option
                                value="processed"
                                class="text-gray-900"
                                @selected(
                                    $registration->status
                                    === 'processed'
                                )
                            >
                                Diproses
                            </option>

                            <option
                                value="accepted"
                                class="text-gray-900"
                                @selected(
                                    $registration->status
                                    === 'accepted'
                                )
                            >
                                Diterima
                            </option>

                            <option
                                value="rejected"
                                class="text-gray-900"
                                @selected(
                                    $registration->status
                                    === 'rejected'
                                )
                            >
                                Ditolak
                            </option>

                        </select>

                    </div>


                    <div>

                        <label
                            class="mb-2 block
                                   text-sm font-bold
                                   text-white"
                        >
                            Catatan Admin
                        </label>

                        <textarea
                            name="notes"
                            rows="5"
                            class="w-full rounded-xl
                                   border-0
                                   bg-white/10
                                   px-4 py-3
                                   text-sm text-white
                                   outline-none
                                   placeholder:text-white/30
                                   focus:ring-2
                                   focus:ring-[#F4C542]"
                            placeholder="Tambahkan catatan..."
                        >{{ old(
                            'notes',
                            $registration->notes
                        ) }}</textarea>

                    </div>


                    <button
                        type="submit"
                        class="w-full rounded-xl
                               bg-[#F4C542]
                               px-5 py-3
                               text-sm font-black
                               text-[#062E1F]
                               transition
                               hover:bg-white"
                    >
                        Simpan Perubahan
                    </button>

                </form>

            </div>


            {{-- HAPUS --}}

            <div
                class="rounded-2xl bg-white
                       p-6 shadow-sm
                       ring-1 ring-red-100"
            >

                <p
                    class="text-sm font-black
                           text-red-600"
                >
                    Hapus Pendaftaran
                </p>

                <p
                    class="mt-2 text-xs
                           leading-5 text-gray-400"
                >
                    Data yang dihapus tidak dapat
                    dikembalikan.
                </p>


                <form
                    action="{{
                        route(
                            'admin.registrations.destroy',
                            $registration
                        )
                    }}"
                    method="POST"
                    class="mt-5"
                    onsubmit="
                        return confirm(
                            'Yakin ingin menghapus pendaftaran ini?'
                        )
                    "
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="w-full rounded-xl
                               border border-red-200
                               px-5 py-3
                               text-sm font-black
                               text-red-600
                               transition
                               hover:bg-red-50"
                    >
                        Hapus Data
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection