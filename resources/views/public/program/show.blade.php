@extends('layouts.public')

@section('title', $program->title)

@section('content')

<section class="bg-[#062E1F] py-20">

    <div class="mx-auto max-w-5xl px-5 lg:px-8">

        <a
            href="{{ route('home') }}#program"
            class="inline-flex items-center gap-2 text-sm font-semibold text-white/60 transition hover:text-[#F4C542]"
        >
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Kembali ke Program
        </a>

        <div class="mt-10">

            <div
                class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#F4C542] text-[#062E1F]"
            >
                <i
                    data-lucide="{{ $program->icon ?: 'book-open' }}"
                    class="h-8 w-8"
                ></i>
            </div>

            <h1
                class="mt-7 text-4xl font-black text-white sm:text-5xl"
            >
                {{ $program->title }}
            </h1>

            <p class="mt-5 max-w-3xl text-lg leading-8 text-white/60">
                {{ $program->description }}
            </p>

        </div>

    </div>

</section>


<section class="bg-white py-20">

    <div class="mx-auto max-w-5xl px-5 lg:px-8">

        <div class="prose prose-lg max-w-none">
            {!! nl2br(e($program->description)) !!}
        </div>

    </div>

</section>

@endsection