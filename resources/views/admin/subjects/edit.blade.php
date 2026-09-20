@extends('layouts.admin')

@section('title', 'Edit Mata Pelajaran')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <p class="mb-2 text-xs font-black uppercase tracking-[0.18em] text-[#087443]">
                SIAKAD / Akademik
            </p>

            <h1 class="text-3xl font-black tracking-tight text-gray-900">
                Edit Mata Pelajaran
            </h1>

            <p class="mt-2 text-sm leading-6 text-gray-500">
                Perbarui informasi mata pelajaran yang sudah tersimpan.
            </p>

        </div>

        <a href="{{ route('admin.subjects.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-600 shadow-sm transition hover:bg-gray-50">

            <i data-lucide="arrow-left" class="h-4 w-4"></i>

            Kembali

        </a>

    </div>


    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4">

            <p class="text-sm font-bold text-red-700">
                Periksa kembali data yang dimasukkan.
            </p>

            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('admin.subjects.update', $subject) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            <div class="lg:col-span-2">

                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                    <div class="border-b border-gray-100 px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div class="rounded-xl bg-[#062E1F] p-2.5 text-white">

                                <i data-lucide="pencil-line"
                                   class="h-4 w-4">
                                </i>

                            </div>

                            <div>

                                <h2 class="font-black text-[#062E1F]">
                                    Informasi Mata Pelajaran
                                </h2>

                                <p class="mt-0.5 text-xs text-gray-400">
                                    Perbarui informasi dasar mata pelajaran.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="space-y-6 p-6">

                        <div>

                            <label for="code"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                Kode Mata Pelajaran
                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="text"
                                id="code"
                                name="code"
                                value="{{ old('code', $subject->code) }}"
                                required
                                maxlength="50"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm uppercase outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >

                            @error('code')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label for="name"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                Nama Mata Pelajaran
                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $subject->name) }}"
                                required
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >

                            @error('name')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label for="category"
                                   class="mb-2 block text-sm font-bold text-gray-700">
                                Kategori
                            </label>

                            <input
                                type="text"
                                id="category"
                                name="category"
                                value="{{ old('category', $subject->category) }}"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >

                            @error('category')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror

                        </div>


                        <div>

                            <label for="description"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                Deskripsi

                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm leading-6 outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >{{ old('description', $subject->description) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            <div class="space-y-6">

                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                    <div class="border-b border-gray-100 px-6 py-5">

                        <h2 class="font-black text-[#062E1F]">
                            Pengaturan Akademik
                        </h2>

                    </div>


                    <div class="space-y-5 p-6">

                        <div>

                            <label for="minimum_passing_grade"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                Nilai Minimum

                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="number"
                                id="minimum_passing_grade"
                                name="minimum_passing_grade"
                                min="0"
                                max="100"
                                value="{{ old('minimum_passing_grade', $subject->minimum_passing_grade) }}"
                                required
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >

                        </div>


                        <div>

                            <label for="credit"
                                   class="mb-2 block text-sm font-bold text-gray-700">

                                SKS / Bobot

                                <span class="text-red-500">*</span>

                            </label>

                            <input
                                type="number"
                                id="credit"
                                name="credit"
                                min="1"
                                max="20"
                                value="{{ old('credit', $subject->credit) }}"
                                required
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-[#087443] focus:bg-white focus:ring-2 focus:ring-[#087443]/10"
                            >

                        </div>


                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-gray-100 bg-[#F8FAF9] p-4">

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $subject->is_active) ? 'checked' : '' }}
                                class="mt-0.5 h-4 w-4 rounded border-gray-300 text-[#087443] focus:ring-[#087443]"
                            >

                            <span>

                                <span class="block text-sm font-bold text-gray-800">
                                    Mata Pelajaran Aktif
                                </span>

                                <span class="mt-1 block text-xs leading-5 text-gray-500">
                                    Mata pelajaran tersedia untuk digunakan.
                                </span>

                            </span>

                        </label>

                    </div>

                </div>


                <div class="rounded-2xl bg-[#062E1F] p-6 text-white">

                    <div class="flex items-center gap-3">

                        <div class="rounded-xl bg-white/10 p-2.5">

                            <i data-lucide="info"
                               class="h-4 w-4">
                            </i>

                        </div>

                        <h2 class="font-bold">
                            Mata Pelajaran
                        </h2>

                    </div>

                    <p class="mt-4 text-sm leading-6 text-white/60">
                        Jika mata pelajaran sudah digunakan oleh guru, jangan mengubah kode secara sembarangan karena kode tersebut menjadi identitas mata pelajaran.
                    </p>

                </div>

            </div>

        </div>


        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a href="{{ route('admin.subjects.index') }}"
               class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-6 py-3 text-sm font-bold text-gray-600 transition hover:bg-gray-50">

                Batal

            </a>


            <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#087443] px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#062E1F]">

                <i data-lucide="save" class="h-4 w-4"></i>

                Simpan Perubahan

            </button>

        </div>

    </form>

</div>

@push('scripts')
<script>
    if (window.lucide) {
        lucide.createIcons();
    }
</script>
@endpush

@endsection