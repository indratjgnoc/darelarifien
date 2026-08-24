<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | {{ $settings['school_name'] ?? '' }}</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="min-h-screen bg-[#062E1F]">

    <div class="flex min-h-screen items-center justify-center px-4">

        <div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-2xl">

            <div class="mb-8 text-center">

               <div class="mb-6 flex justify-center">

    @if (!empty($settings['logo']))

        <img
            src="{{ asset('storage/' . $settings['logo']) }}"
            alt="{{ $settings['school_name'] ?? 'Pesantren' }}"
            class="h-30 w-30 rounded-2xl
                   object-contain
                   bg-white
                   p-2
                   shadow-lg"
        >

    @else

        <div
            class="flex h-20 w-20
                   items-center justify-center
                   rounded-2xl
                   bg-[#F4C542]
                   text-[#062E1F]
                   shadow-lg"
        >

            <i
                data-lucide="landmark"
                class="h-10 w-10"
            ></i>

        </div>

    @endif

</div>

                <h1 class="mt-5 text-2xl font-black text-gray-900">
                   {{ $settings['school_name'] ?? '' }}
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Administrator Panel
                </p>

            </div>


            @if ($errors->any())

                <div class="mb-5 rounded-xl bg-red-50 p-4">

                    @foreach ($errors->all() as $error)

                        <p class="text-sm text-red-600">
                            {{ $error }}
                        </p>

                    @endforeach

                </div>

            @endif


            <form
                action="{{ route('login.process') }}"
                method="POST"
                class="space-y-5"
            >

                @csrf

                <div>

                    <label
                        for="email"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@darelarifien.sch.id"
                        required
                        autofocus
                        class="w-full rounded-xl border
                               border-gray-200 bg-gray-50
                               px-4 py-3 outline-none
                               focus:border-[#087443]"
                    >

                </div>


                <div>

                    <label
                        for="password"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                        class="w-full rounded-xl border
                               border-gray-200 bg-gray-50
                               px-4 py-3 outline-none
                               focus:border-[#087443]"
                    >

                </div>


                <button
                    type="submit"
                    class="w-full rounded-xl
                           bg-[#087443] px-5 py-3.5
                           font-bold text-white
                           transition hover:bg-[#062E1F]"
                >
                    Masuk ke Dashboard
                </button>

            </form>

        </div>

    </div>

</body>

</html>