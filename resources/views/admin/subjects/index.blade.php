@extends('layouts.admin')

@section('title', 'Mata Pelajaran')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

        <div>
            <p class="mb-2 text-xs font-black uppercase tracking-[0.18em] text-[#087443]">
                SIAKAD / Akademik
            </p>

            <h1 class="text-3xl font-black tracking-tight text-gray-900">
                Mata Pelajaran
            </h1>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-gray-500">
                Kelola daftar mata pelajaran yang digunakan dalam proses pembelajaran pesantren.
            </p>
        </div>

        <a href="{{ route('admin.subjects.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#062E1F]">

            <i data-lucide="plus" class="h-4 w-4"></i>

            Tambah Mata Pelajaran

        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-4">

            <i data-lucide="circle-check"
               class="h-5 w-5 text-[#087443]">
            </i>

            <p class="text-sm font-semibold text-[#087443]">
                {{ session('success') }}
            </p>

        </div>

    @endif


    {{-- ERROR --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4">

            <div class="flex items-start gap-3">

                <i data-lucide="circle-alert"
                   class="mt-0.5 h-5 w-5 text-red-500">
                </i>

                <div>

                    <p class="text-sm font-bold text-red-700">
                        Terjadi kesalahan
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- SEARCH / FILTER --}}
    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

        <form method="GET"
              action="{{ route('admin.subjects.index') }}">

            <div class="flex flex-col gap-4 md:flex-row md:items-end">

                <div class="flex-1">

                    <label for="search"
                           class="mb-2 block text-sm font-bold text-gray-700">

                        Cari Mata Pelajaran

                    </label>

                    <div class="relative">

                        <i data-lucide="search"
                           class="absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400">
                        </i>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari berdasarkan kode atau nama..."
                            class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 pl-11 pr-4 text-sm outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                        >

                    </div>

                </div>


                <div class="flex gap-2">

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#062E1F]">

                        <i data-lucide="search" class="h-4 w-4"></i>

                        Cari

                    </button>


                    @if(request('search'))

                        <a href="{{ route('admin.subjects.index') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-gray-100 px-4 py-3 text-sm font-bold text-gray-600 transition hover:bg-gray-200">

                            Reset

                        </a>

                    @endif

                </div>

            </div>

        </form>

    </div>


    {{-- LIST --}}
    <div class="space-y-4">

        @forelse($subjects as $subject)

            <div class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 transition hover:shadow-lg">

                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                    {{-- LEFT --}}
                    <div class="min-w-0 flex-1">

                        <div class="flex flex-wrap items-center gap-2">

                            {{-- CODE --}}
                            <span class="inline-flex items-center rounded-full bg-[#062E1F] px-3 py-1 text-xs font-bold text-white">
                                {{ $subject->code }}
                            </span>


                            {{-- STATUS --}}
                            @if($subject->is_active)

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-bold text-[#087443]">

                                    <span class="h-1.5 w-1.5 rounded-full bg-[#087443]"></span>

                                    Aktif

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-500">

                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>

                                    Nonaktif

                                </span>

                            @endif


                            @if($subject->category)

                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-500">
                                    {{ $subject->category }}
                                </span>

                            @endif

                        </div>


                        <h2 class="mt-3 text-xl font-black text-gray-900 transition group-hover:text-[#087443]">
                            {{ $subject->name }}
                        </h2>


                        <div class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-gray-500">

                            <span class="inline-flex items-center gap-2">

                                <i data-lucide="graduation-cap"
                                   class="h-4 w-4 text-[#087443]">
                                </i>

                                {{ $subject->credit }} SKS

                            </span>


                            <span class="inline-flex items-center gap-2">

                                <i data-lucide="target"
                                   class="h-4 w-4 text-[#087443]">
                                </i>

                                Nilai minimum {{ $subject->minimum_passing_grade }}

                            </span>

                        </div>

                    </div>


                    {{-- ACTION --}}
                    <div class="flex shrink-0 items-center gap-2 border-t border-gray-100 pt-4 lg:border-0 lg:pt-0">

                        <a href="{{ route('admin.subjects.edit', $subject) }}"
                           class="inline-flex items-center gap-2 rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-bold text-gray-600 transition hover:bg-[#087443] hover:text-white">

                            <i data-lucide="pencil" class="h-4 w-4"></i>

                            Edit

                        </a>


                        <form action="{{ route('admin.subjects.destroy', $subject) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-red-50 p-2.5 text-red-500 transition hover:bg-red-500 hover:text-white">

                                <i data-lucide="trash-2" class="h-4 w-4"></i>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm ring-1 ring-gray-100">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#F3F7F4] text-[#087443]">

                    <i data-lucide="book-open"
                       class="h-7 w-7">
                    </i>

                </div>

                <h3 class="mt-5 text-lg font-black text-gray-900">
                    Belum Ada Mata Pelajaran
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-400">
                    Tambahkan mata pelajaran pertama untuk digunakan dalam sistem akademik.
                </p>

                <a href="{{ route('admin.subjects.create') }}"
                   class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#087443] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#062E1F]">

                    <i data-lucide="plus" class="h-4 w-4"></i>

                    Tambah Mata Pelajaran

                </a>

            </div>

        @endforelse

    </div>


    {{-- PAGINATION --}}
    @if($subjects->hasPages())

        <div>
            {{ $subjects->links() }}
        </div>

    @endif

</div>

@push('scripts')
<script>
    if (window.lucide) {
        lucide.createIcons();
    }
</script>
@endpush

@endsection