@extends('layouts.guru')

@section('title', 'Edit Penilaian')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <div class="flex items-center gap-2 text-sm">

                <a
                    href="{{ route('guru.grades.assignments') }}"
                    class="font-semibold text-[#087443]"
                >
                    Nilai
                </a>

                <span class="text-slate-400">/</span>

                <a
                    href="{{ route('guru.grades.index', $assignment->id) }}"
                    class="font-semibold text-[#087443]"
                >
                    {{ $assignment->subject?->name ?? '-' }}
                </a>

                <span class="text-slate-400">/</span>

                <span class="text-slate-500">
                    Edit
                </span>

            </div>

            <h1 class="mt-2 text-2xl font-bold text-[#062E1F]">
                Edit Penilaian
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Perbarui nilai {{ $name }}.
            </p>

        </div>

    </div>


    <div class="rounded-2xl bg-[#062E1F] p-6 text-white">

        <div class="flex flex-wrap items-center gap-3">

            <span class="rounded-lg bg-[#F4C542]
                         px-3 py-1 text-xs font-bold text-[#062E1F]">
                {{ $assignment->schoolClass?->name ?? '-' }}
            </span>

            <span class="rounded-lg bg-white/10
                         px-3 py-1 text-xs text-emerald-100">
                {{ $assignment->academicYear?->name ?? '-' }}
            </span>

        </div>

        <h2 class="mt-3 text-xl font-bold">
            {{ $assignment->subject?->name ?? '-' }}
        </h2>

        <p class="mt-1 text-sm text-emerald-100">
            {{ $type }} — {{ $name }}
        </p>

    </div>


    @if ($errors->any())

        <div class="rounded-xl border border-red-200
                    bg-red-50 p-4 text-sm text-red-800">

            <ul class="list-disc pl-5">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <div class="overflow-hidden rounded-2xl
                border border-slate-200 bg-white shadow-sm">

        <form
            method="POST"
            action="{{ route(
                'guru.grades.assessment.update',
                [
                    'assignmentId' => $assignment->id,
                    'type' => $type,
                    'name' => $name,
                ]
            ) }}"
        >

            @csrf
            @method('PUT')

            <div class="p-6">

                <div class="grid gap-5 md:grid-cols-2">

                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Jenis Penilaian
                        </label>

                        <select
                            name="assessment_type"
                            required
                            class="w-full rounded-xl border-slate-200
                                   px-4 py-3 text-sm"
                        >

                            @foreach ([
                                'Tugas',
                                'Kuis',
                                'Praktik',
                                'UTS',
                                'UAS',
                                'Lainnya'
                            ] as $assessmentType)

                                <option
                                    value="{{ $assessmentType }}"
                                    @selected($assessmentType === $type)
                                >
                                    {{ $assessmentType }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div>

                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Penilaian
                        </label>

                        <input
                            type="text"
                            name="assessment_name"
                            value="{{ $name }}"
                            required
                            maxlength="150"
                            class="w-full rounded-xl border-slate-200
                                   px-4 py-3 text-sm"
                        >

                    </div>

                </div>


                <div class="mt-6 overflow-hidden rounded-xl border border-slate-200">

                    <div class="max-h-[520px] overflow-auto">

                        <table class="min-w-full text-sm">

                            <thead class="sticky top-0 z-10 bg-[#062E1F]">

                                <tr>

                                    <th class="px-4 py-3 text-left text-xs
                                               font-bold uppercase text-white">
                                        #
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs
                                               font-bold uppercase text-white">
                                        NIS
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs
                                               font-bold uppercase text-white">
                                        Nama Santri
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs
                                               font-bold uppercase text-white">
                                        Nilai
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-slate-100">

                                @foreach ($students as $index => $student)

                                    @php
                                        $grade = $grades->get($student->id);
                                    @endphp

                                    <tr class="hover:bg-emerald-50/40">

                                        <td class="px-4 py-3 text-slate-500">
                                            {{ $index + 1 }}
                                        </td>

                                        <td class="px-4 py-3 text-slate-600">
                                            {{ $student->nis ?? '-' }}
                                        </td>

                                        <td class="px-4 py-3 font-semibold text-[#062E1F]">
                                            {{ $student->name }}
                                        </td>

                                        <td class="w-40 px-4 py-3">

                                            <input
                                                type="number"
                                                name="scores[{{ $student->id }}]"
                                                min="0"
                                                max="100"
                                                step="0.01"
                                                value="{{ $grade?->score }}"
                                                class="w-full rounded-lg border-slate-200
                                                       px-3 py-2 text-sm font-semibold"
                                            >

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>


                <div class="mt-6">

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Catatan
                    </label>

                    <textarea
                        name="notes"
                        rows="3"
                        class="w-full rounded-xl border-slate-200
                               px-4 py-3 text-sm"
                    >{{ $grades->first()?->notes }}</textarea>

                </div>

            </div>


            <div class="flex flex-col gap-3 border-t
                        border-slate-100 bg-slate-50 p-6
                        sm:flex-row sm:justify-between">

                <a
                    href="{{ route('guru.grades.index', $assignment->id) }}"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl border border-slate-200
                           bg-white px-5 py-3 text-sm font-semibold
                           text-slate-700"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-[#087443] px-6 py-3
                           text-sm font-bold text-white
                           hover:bg-[#062E1F]"
                >

                    <i data-lucide="save" class="h-4 w-4"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection