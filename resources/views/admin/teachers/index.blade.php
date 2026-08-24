@extends('layouts.admin')

@section('title', 'Ustadz & Ustadzah')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <div
        class="flex flex-col gap-4
               sm:flex-row
               sm:items-center
               sm:justify-between"
    >

        <div>

            <p
                class="text-sm font-semibold
                       uppercase tracking-wider
                       text-[#087443]"
            >
                Content Management
            </p>

            <h1
                class="mt-1 text-3xl
                       font-black text-[#111111]"
            >
                Ustadz & Ustadzah
            </h1>

            <p class="mt-2 text-gray-500">
                Kelola data pengajar dan tenaga
                pendidik Pesantren {{ $settings['school_name'] ?? '' }}..
            </p>

        </div>


        <a
            href="{{ route('admin.teachers.create') }}"
            class="inline-flex items-center
                   justify-center gap-2
                   rounded-xl bg-[#087443]
                   px-5 py-3
                   font-bold text-white
                   shadow-lg
                   transition
                   hover:bg-[#062E1F]"
        >

            <i
                data-lucide="user-plus"
                class="h-5 w-5"
            ></i>

            Tambah Pengajar

        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}

    @if (session('success'))

        <div
            class="flex items-center gap-3
                   rounded-xl border
                   border-green-200
                   bg-green-50 px-5 py-4"
        >

            <i
                data-lucide="circle-check"
                class="h-5 w-5 text-[#087443]"
            ></i>

            <p
                class="text-sm font-semibold
                       text-[#087443]"
            >
                {{ session('success') }}
            </p>

        </div>

    @endif


    {{-- TEACHER GRID --}}

    <div
        class="grid gap-6
               sm:grid-cols-2
               xl:grid-cols-3
               2xl:grid-cols-4"
    >

        @forelse ($teachers as $teacher)

            <div
                class="group overflow-hidden
                       rounded-2xl bg-white
                       shadow-sm ring-1
                       ring-gray-100
                       transition duration-300
                       hover:-translate-y-1
                       hover:shadow-xl"
            >

                {{-- PHOTO --}}

                <div
                    class="relative h-64
                           overflow-hidden
                           bg-[#062E1F]"
                >

                    @if ($teacher->photo)

                        <img
                            src="{{ asset(
                                'storage/' . $teacher->photo
                            ) }}"
                            alt="{{ $teacher->name }}"
                            class="h-full w-full
                                   object-cover
                                   object-top
                                   transition
                                   duration-500
                                   group-hover:scale-105"
                        >

                    @else

                        <div
                            class="flex h-full
                                   items-center
                                   justify-center"
                        >

                            <div
                                class="flex h-24 w-24
                                       items-center
                                       justify-center
                                       rounded-full
                                       bg-[#F4C542]
                                       text-[#062E1F]"
                            >

                                <i
                                    data-lucide="user"
                                    class="h-12 w-12"
                                ></i>

                            </div>

                        </div>

                    @endif


                    {{-- STATUS --}}

                    <div
                        class="absolute right-4
                               top-4"
                    >

                        @if ($teacher->is_active)

                            <span
                                class="inline-flex
                                       items-center gap-1
                                       rounded-full
                                       bg-green-500
                                       px-3 py-1
                                       text-xs font-bold
                                       text-white shadow"
                            >

                                <span
                                    class="h-1.5 w-1.5
                                           rounded-full
                                           bg-white"
                                ></span>

                                Aktif

                            </span>

                        @else

                            <span
                                class="rounded-full
                                       bg-gray-600
                                       px-3 py-1
                                       text-xs font-bold
                                       text-white shadow"
                            >
                                Nonaktif
                            </span>

                        @endif

                    </div>


                    {{-- SORT ORDER --}}

                    <div
                        class="absolute bottom-4
                               left-4"
                    >

                        <span
                            class="rounded-lg
                                   bg-black/60
                                   px-3 py-1.5
                                   text-xs font-bold
                                   text-white
                                   backdrop-blur"
                        >
                            Urutan #{{ $teacher->sort_order }}
                        </span>

                    </div>

                </div>


                {{-- CONTENT --}}

                <div class="p-5">

                    <h2
                        class="text-lg
                               font-black
                               text-gray-900"
                    >
                        {{ $teacher->name }}
                    </h2>


                    <div
                        class="mt-2 flex items-center
                               gap-2 text-sm
                               font-semibold
                               text-[#087443]"
                    >

                        <i
                            data-lucide="badge"
                            class="h-4 w-4"
                        ></i>

                        <span>
                            {{ $teacher->position }}
                        </span>

                    </div>


                    @if ($teacher->education)

                        <div
                            class="mt-3 flex items-start
                                   gap-2 text-sm
                                   text-gray-500"
                        >

                            <i
                                data-lucide="graduation-cap"
                                class="mt-0.5 h-4 w-4
                                       shrink-0"
                            ></i>

                            <span>
                                {{ $teacher->education }}
                            </span>

                        </div>

                    @endif


                    @if ($teacher->bio)

                        <p
                            class="mt-4 line-clamp-3
                                   text-sm leading-6
                                   text-gray-500"
                        >
                            {{ $teacher->bio }}
                        </p>

                    @endif


                    {{-- ACTION --}}

                    <div
                        class="mt-5 flex gap-2
                               border-t
                               border-gray-100
                               pt-4"
                    >

                        <a
                            href="{{ route(
                                'admin.teachers.edit',
                                $teacher
                            ) }}"
                            class="flex flex-1
                                   items-center
                                   justify-center
                                   gap-2
                                   rounded-xl
                                   bg-gray-100
                                   py-2.5
                                   text-sm font-bold
                                   text-gray-600
                                   transition
                                   hover:bg-[#087443]
                                   hover:text-white"
                        >

                            <i
                                data-lucide="pencil"
                                class="h-4 w-4"
                            ></i>

                            Edit

                        </a>


                        <form
                            action="{{ route(
                                'admin.teachers.destroy',
                                $teacher
                            ) }}"
                            method="POST"
                            onsubmit="return confirm(
                                'Yakin ingin menghapus data pengajar ini?'
                            )"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="flex h-full
                                       items-center
                                       justify-center
                                       rounded-xl
                                       bg-red-50 px-4
                                       text-red-500
                                       transition
                                       hover:bg-red-500
                                       hover:text-white"
                            >

                                <i
                                    data-lucide="trash-2"
                                    class="h-4 w-4"
                                ></i>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div
                class="sm:col-span-2
                       xl:col-span-3
                       2xl:col-span-4
                       rounded-2xl bg-white
                       px-6 py-16
                       text-center
                       shadow-sm
                       ring-1 ring-gray-100"
            >

                <div
                    class="mx-auto flex h-16 w-16
                           items-center
                           justify-center
                           rounded-2xl
                           bg-[#087443]/10
                           text-[#087443]"
                >

                    <i
                        data-lucide="users-round"
                        class="h-8 w-8"
                    ></i>

                </div>

                <h3
                    class="mt-4 text-lg
                           font-black"
                >
                    Belum Ada Data Pengajar
                </h3>

                <p
                    class="mt-2 text-sm
                           text-gray-400"
                >
                    Tambahkan data ustadz atau
                    ustadzah pertama.
                </p>

                <a
                    href="{{ route(
                        'admin.teachers.create'
                    ) }}"
                    class="mt-6 inline-flex
                           items-center gap-2
                           rounded-xl
                           bg-[#087443]
                           px-5 py-3
                           text-sm font-bold
                           text-white
                           hover:bg-[#062E1F]"
                >

                    <i
                        data-lucide="plus"
                        class="h-4 w-4"
                    ></i>

                    Tambah Pengajar

                </a>

            </div>

        @endforelse

    </div>


    {{-- PAGINATION --}}

    @if ($teachers->hasPages())

        <div>
            {{ $teachers->links() }}
        </div>

    @endif

</div>

@endsection