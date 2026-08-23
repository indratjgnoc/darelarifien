@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
@if (session('success'))

<div
    class="mx-auto max-w-7xl
               px-5 pt-8 lg:px-8">

    <div
        class="flex items-start gap-3
                   rounded-2xl
                   border border-[#087F5B]/20
                   bg-[#EAF4EF]
                   px-5 py-4
                   text-sm text-[#062E1F]">

        <i
            data-lucide="circle-check"
            class="mt-0.5 h-5 w-5
                       shrink-0 text-[#087F5B]"></i>

        <p class="font-semibold">
            {{ session('success') }}
        </p>

    </div>

</div>

@endif

{{-- HERO --}}
<section class="relative overflow-hidden bg-[#062E1F]">

    <div
        class="absolute -right-24 -top-24
                   h-80 w-80 rounded-full
                   bg-[#F4C542]/20 blur-3xl"></div>

    <div
        class="relative mx-auto max-w-7xl
                   px-5 py-20 lg:px-8">

        <p
            class="text-xs font-black uppercase
                       tracking-[0.25em]
                       text-[#F4C542]">
            Hubungi Kami
        </p>

        <h1
            class="mt-4 text-4xl font-black
                       leading-tight text-white
                       sm:text-5xl">
            Kontak Pesantren
        </h1>

        <p
            class="mt-5 max-w-2xl
                       text-base leading-7
                       text-white/60">
            Silakan hubungi kami untuk mendapatkan
            informasi mengenai pesantren, program
            pendidikan, pendaftaran, dan berbagai
            informasi lainnya.
        </p>

    </div>

</section>


{{-- CONTACT --}}
<section class="bg-[#F5F7F6]">

    <div
        class="mx-auto max-w-7xl
                   px-5 py-16 lg:px-8">

        <div
            class="grid gap-8
                       lg:grid-cols-5">

            {{-- INFORMATION --}}
            <div class="lg:col-span-2">

                <div
                    class="rounded-3xl
                               bg-[#062E1F]
                               p-8
                               text-white
                               shadow-xl">

                    <p
                        class="text-xs font-black
                                   uppercase
                                   tracking-[0.2em]
                                   text-[#F4C542]">
                        Informasi
                    </p>

                    <h2
                        class="mt-3 text-2xl
                                   font-black">
                        Mari Terhubung
                    </h2>

                    <p
                        class="mt-4 text-sm
                                   leading-6
                                   text-white/60">
                        Untuk pertanyaan, informasi
                        pendaftaran, maupun kebutuhan
                        lainnya, silakan menghubungi
                        kami melalui kontak berikut.
                    </p>


                    {{-- ADDRESS --}}

                    @if (!empty($settings['address'] ?? null))

                    <div
                        class="mt-8 flex gap-4">

                        <div
                            class="flex h-11 w-11
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#F4C542]
                                           text-[#062E1F]">

                            <i
                                data-lucide="map-pin"
                                class="h-5 w-5"></i>

                        </div>

                        <div>

                            <p
                                class="text-xs
                                               font-bold
                                               uppercase
                                               tracking-wider
                                               text-white/40">
                                Alamat
                            </p>

                            <p
                                class="mt-1 text-sm
                                               leading-6
                                               text-white/80">
                                {{ $settings['address'] }}
                            </p>

                        </div>

                    </div>

                    @endif


                    {{-- PHONE --}}

                    @if (!empty($settings['phone'] ?? null))

                    <div
                        class="mt-6 flex gap-4">

                        <div
                            class="flex h-11 w-11
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#F4C542]
                                           text-[#062E1F]">

                            <i
                                data-lucide="phone"
                                class="h-5 w-5"></i>

                        </div>

                        <div>

                            <p
                                class="text-xs
                                               font-bold
                                               uppercase
                                               tracking-wider
                                               text-white/40">
                                Telepon
                            </p>

                            <a
                                href="tel:{{ $settings['phone'] }}"
                                class="mt-1 block
                                               text-sm
                                               text-white/80
                                               transition
                                               hover:text-[#F4C542]">
                                {{ $settings['phone'] }}
                            </a>

                        </div>

                    </div>

                    @endif


                    {{-- EMAIL --}}

                    @if (!empty($settings['email'] ?? null))

                    <div
                        class="mt-6 flex gap-4">

                        <div
                            class="flex h-11 w-11
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#F4C542]
                                           text-[#062E1F]">

                            <i
                                data-lucide="mail"
                                class="h-5 w-5"></i>

                        </div>

                        <div>

                            <p
                                class="text-xs
                                               font-bold
                                               uppercase
                                               tracking-wider
                                               text-white/40">
                                Email
                            </p>

                            <a
                                href="mailto:{{ $settings['email'] }}"
                                class="mt-1 block
                                               text-sm
                                               break-all
                                               text-white/80
                                               transition
                                               hover:text-[#F4C542]">
                                {{ $settings['email'] }}
                            </a>

                        </div>

                    </div>

                    @endif


                    {{-- WHATSAPP --}}

                    @if (!empty($settings['whatsapp'] ?? null))

                    @php
                    $whatsapp = preg_replace(
                    '/[^0-9]/',
                    '',
                    $settings['whatsapp']
                    );

                    if (str_starts_with($whatsapp, '0')) {
                    $whatsapp = '62' . substr($whatsapp, 1);
                    }
                    @endphp

                    <div
                        class="mt-6 flex gap-4">

                        <div
                            class="flex h-11 w-11
                                           shrink-0
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-[#F4C542]
                                           text-[#062E1F]">

                            <i
                                data-lucide="message-circle"
                                class="h-5 w-5"></i>

                        </div>

                        <div>

                            <p
                                class="text-xs
                                               font-bold
                                               uppercase
                                               tracking-wider
                                               text-white/40">
                                WhatsApp
                            </p>

                            <a
                                href="https://wa.me/{{ $whatsapp }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-1 block
                                               text-sm
                                               text-white/80
                                               transition
                                               hover:text-[#F4C542]">
                                Hubungi melalui WhatsApp
                            </a>

                        </div>

                    </div>

                    @endif

                </div>

            </div>


            {{-- FORM --}}
            <div
                class="lg:col-span-3">

                <div
                    class="rounded-3xl
                               border
                               border-gray-200
                               bg-white
                               p-8
                               shadow-sm
                               lg:p-10">

                    <div class="mb-8">

                        <p
                            class="text-xs font-black
                                       uppercase
                                       tracking-[0.2em]
                                       text-[#087F5B]">
                            Pesan
                        </p>

                        <h2
                            class="mt-2 text-2xl
                                       font-black
                                       text-gray-900">
                            Kirim Pesan
                        </h2>

                        <p
                            class="mt-2 text-sm
                                       text-gray-500">
                            Isi formulir berikut dan
                            sampaikan pesan Anda kepada
                            pihak pesantren.
                        </p>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('contact.store') }}"
                        class="space-y-6">

                        @csrf


                        {{-- NAME --}}

                        <div>

                            <label
                                class="mb-2 block
                                           text-sm
                                           font-bold
                                           text-gray-700">
                                Nama
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="w-full rounded-xl
                                           border border-gray-200
                                           px-4 py-3
                                           text-sm
                                           outline-none
                                           transition
                                           focus:border-[#087F5B]
                                           focus:ring-2
                                           focus:ring-[#087F5B]/10"
                                placeholder="Nama lengkap">

                            @error('name')

                            <p
                                class="mt-1 text-xs
                                               text-red-500">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                        <div
                            class="grid gap-6
                                       md:grid-cols-2">

                            {{-- EMAIL --}}

                            <div>

                                <label
                                    class="mb-2 block
                                               text-sm
                                               font-bold
                                               text-gray-700">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    class="w-full rounded-xl
                                               border border-gray-200
                                               px-4 py-3
                                               text-sm
                                               outline-none
                                               transition
                                               focus:border-[#087F5B]
                                               focus:ring-2
                                               focus:ring-[#087F5B]/10"
                                    placeholder="nama@email.com">

                                @error('email')

                                <p
                                    class="mt-1 text-xs
                                                   text-red-500">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>


                            {{-- PHONE --}}

                            <div>

                                <label
                                    class="mb-2 block
                                               text-sm
                                               font-bold
                                               text-gray-700">
                                    No. Telepon
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="w-full rounded-xl
                                               border border-gray-200
                                               px-4 py-3
                                               text-sm
                                               outline-none
                                               transition
                                               focus:border-[#087F5B]
                                               focus:ring-2
                                               focus:ring-[#087F5B]/10"
                                    placeholder="08xxxxxxxxxx">

                            </div>

                        </div>


                        {{-- SUBJECT --}}

                        <div>

                            <label
                                class="mb-2 block
                                           text-sm
                                           font-bold
                                           text-gray-700">
                                Subjek
                            </label>

                            <input
                                type="text"
                                name="subject"
                                value="{{ old('subject') }}"
                                required
                                class="w-full rounded-xl
                                           border border-gray-200
                                           px-4 py-3
                                           text-sm
                                           outline-none
                                           transition
                                           focus:border-[#087F5B]
                                           focus:ring-2
                                           focus:ring-[#087F5B]/10"
                                placeholder="Subjek pesan">

                            @error('subject')

                            <p
                                class="mt-1 text-xs
                                               text-red-500">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                        {{-- MESSAGE --}}

                        <div>

                            <label
                                class="mb-2 block
                                           text-sm
                                           font-bold
                                           text-gray-700">
                                Pesan
                            </label>

                            <textarea
                                name="message"
                                rows="6"
                                required
                                class="w-full resize-none
                                           rounded-xl
                                           border border-gray-200
                                           px-4 py-3
                                           text-sm
                                           outline-none
                                           transition
                                           focus:border-[#087F5B]
                                           focus:ring-2
                                           focus:ring-[#087F5B]/10"
                                placeholder="Tuliskan pesan Anda...">{{ old('message') }}</textarea>

                            @error('message')

                            <p
                                class="mt-1 text-xs
                                               text-red-500">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                        {{-- BUTTON --}}

                        <button
                            type="submit"
                            class="inline-flex
                                       items-center
                                       justify-center
                                       gap-2
                                       rounded-xl
                                       bg-[#087F5B]
                                       px-6 py-3.5
                                       text-sm
                                       font-black
                                       text-white
                                       shadow-lg
                                       transition
                                       hover:-translate-y-0.5
                                       hover:bg-[#062E1F]">

                            <i
                                data-lucide="send"
                                class="h-4 w-4"></i>

                            Kirim Pesan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection