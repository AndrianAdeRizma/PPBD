<x-guest-layout>
    <div class="w-full max-w-lg p-10 space-y-6 shadow-md rounded-lg bg-white">
        <div class="text-center">
            <h2 class="text-3xl font-bold">Sign In</h2>
            <p class="mt-2 text-sm">
                Selamat datang, silakan login terlebih dahulu.
            </p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        @if ($errors->any())
        <div
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
            role="alert"
        >
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">
                <x-input-error
                    :messages="$errors->get('error')"
                    class="text-sm"
                />
            </span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg
                    class="fill-current h-6 w-6 text-red-500"
                    role="button"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <title>Close</title>
                    <path
                        d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"
                    />
                </svg>
            </span>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="email" value="Email" class="" />
                <div class="relative mt-1">
                    <div
                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                    >
                        <svg
                            class="w-5 h-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z"
                            />
                            <path
                                d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"
                            />
                        </svg>
                    </div>
                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="example@email.com"
                        class="block w-full pl-10 py-3 bg-slate-200/50 text-bold border-slate-600 focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
            </div>

            <div>
                <x-input-label for="password" value="Password" class="" />
                <div class="relative mt-1">
                    <div
                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                    >
                        <svg
                            class="w-5 h-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="block w-full pl-10 py-3 bg-slate-200/50 text-bold border-slate-600 focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="w-4 h-4 text-indigo-600 bg-slate-700 border-slate-600 rounded focus:ring-indigo-600"
                        name="remember"
                    />
                    <span class="ml-2 text-sm">{{ __("Ingat saya") }}</span>
                </label>

                @if (Route::has('password.request'))
                <a
                    class="text-sm text-indigo-400 hover:text-indigo-300 rounded-md font-medium"
                    href="{{ route('password.request') }}"
                >
                    {{ __("Lupa password?") }}
                </a>
                @endif
            </div>

            <div>
                <x-primary-button
                    class="w-full justify-center py-3 text-sm font-semibold"
                >
                    {{ __("Sign In") }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
