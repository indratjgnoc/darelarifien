@extends('layouts.app')

@section('title', $news->title)

@section('content')

<section class="bg-[#062E1F] py-16">

    <div class="mx-auto max-w-4xl px-5 lg:px-8">

        <a
            href="{{ route('news.index') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-white/60 transition hover:text-[#F4C542]"
        >
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Kembali ke Berita
        </a>


        <div class="mt-10">

            @if ($news->category)

                <span
                    class="inline-flex rounded-full bg-[#F4C542] px-4 py-2 text-xs font-black text-[#062E1F]"
                >
                    {{ $news->category }}
                </span>

            @endif


            <h1
                class="mt-6 text-4xl font-black leading-tight text-white sm:text-5xl"
            >
                {{ $news->title }}
            </h1>


            @if ($news->published_at)

                <div class="mt-6 flex items-center gap-2 text-sm text-white/40">

                    <i data-lucide="calendar" class="h-4 w-4"></i>

                    {{ $news->published_at->format('d F Y') }}

                </div>

            @endif

        </div>

    </div>

</section>


<article class="bg-white py-16">

    <div class="mx-auto max-w-4xl px-5 lg:px-8">

        @if ($news->thumbnail)

            <div class="overflow-hidden rounded-3xl">

                <img
                    src="{{ asset('storage/' . $news->thumbnail) }}"
                    alt="{{ $news->title }}"
                    class="w-full object-cover"
                >

            </div>

        @endif


        @if ($news->excerpt)

            <p
                class="mt-10 text-xl font-semibold leading-8 text-gray-600"
            >
                {{ $news->excerpt }}
            </p>

        @endif


        <div
            class="mt-10 text-base leading-8 text-gray-700"
        >
            {!! nl2br(e($news->content)) !!}
        </div>

    </div>

</article>

@endsection