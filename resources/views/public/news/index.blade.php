@extends('layouts.public')

@section('title', 'Berita')

@section('content')

<section class="bg-[#062E1F] py-20">

    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        <p
            class="text-sm font-black uppercase tracking-widest text-[#F4C542]"
        >
            Informasi
        </p>

        <h1 class="mt-3 text-4xl font-black text-white sm:text-5xl">
            Berita Pesantren
        </h1>

        <p class="mt-5 max-w-2xl leading-8 text-white/50">
            Informasi terbaru seputar kegiatan dan perkembangan
            Pesantren Darel Arifien.
        </p>

    </div>

</section>


<section class="bg-[#F5F7F6] py-20">

    <div class="mx-auto max-w-7xl px-5 lg:px-8">

        @if ($news->count())

            <div class="grid gap-7 md:grid-cols-2 lg:grid-cols-3">

                @foreach ($news as $item)

                    <article
                        class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-1 hover:shadow-xl"
                    >

                        <a href="{{ route('news.show', $item->slug) }}">

                            <div class="aspect-[16/10] overflow-hidden bg-[#062E1F]">

                                @if ($item->thumbnail)

                                    <img
                                        src="{{ asset('storage/' . $item->thumbnail) }}"
                                        alt="{{ $item->title }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                    >

                                @else

                                    <div
                                        class="flex h-full items-center justify-center"
                                    >
                                        <i
                                            data-lucide="newspaper"
                                            class="h-12 w-12 text-[#F4C542]"
                                        ></i>
                                    </div>

                                @endif

                            </div>

                        </a>


                        <div class="p-6">

                            <div class="flex items-center gap-3 text-xs">

                                <span
                                    class="rounded-full bg-[#087443]/10 px-3 py-1 font-bold text-[#087443]"
                                >
                                    {{ $item->category ?: 'Berita' }}
                                </span>

                                @if ($item->published_at)

                                    <span class="text-gray-400">
                                        {{ $item->published_at->format('d M Y') }}
                                    </span>

                                @endif

                            </div>


                            <h2
                                class="mt-4 text-xl font-black leading-7 transition group-hover:text-[#087443]"
                            >
                                <a href="{{ route('news.show', $item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </h2>


                            <p class="mt-3 line-clamp-3 text-sm leading-7 text-gray-500">
                                {{ $item->excerpt }}
                            </p>


                            <a
                                href="{{ route('news.show', $item->slug) }}"
                                class="mt-5 inline-flex items-center gap-2 text-sm font-black text-[#087443]"
                            >
                                Baca Selengkapnya

                                <i
                                    data-lucide="arrow-right"
                                    class="h-4 w-4"
                                ></i>
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>


            <div class="mt-12">
                {{ $news->links() }}
            </div>

        @else

            <div class="rounded-2xl bg-white p-12 text-center">

                <i
                    data-lucide="newspaper"
                    class="mx-auto h-12 w-12 text-gray-300"
                ></i>

                <p class="mt-5 font-semibold text-gray-500">
                    Belum ada berita.
                </p>

            </div>

        @endif

    </div>

</section>

@endsection