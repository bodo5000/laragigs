<x-layout.layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Login
            </h2>
            <p class="mb-4">Login to post gigs</p>
        </header>

        <form action="/users/authenticate" method="POST">
            @csrf

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ old('email') }}" />
                <!-- Error Example -->
                @error('email')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <div class="mb-6">
                <label for="password" class="inline-block text-lg mb-2">
                    Password
                </label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"
                    value="{{ old('password') }}" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Sign In
                </button>
            </div>

            <div class="mb-6">
                <a href="{{ route('google_auth') }}"
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black cursor-pointer flex items-center">
                    <div class="mr-2">
                        <img src="{{ asset('images/google.png') }}" alt="google_image" width="20px" height="20px"
                            class="rounded-xl">
                    </div>
                    Sign In With Google
                </a>
            </div>

            <div class="mt-6">
                <p>
                    forget your
                    <a href="{{ route('start_forgetPassword') }}" class="text-laravel">password?</a>
                </p>
            </div>

            <div class="mt-6">
                <p>
                    don't have an account?
                    <a href="/register" class="text-laravel">register</a>
                </p>
            </div>

        </form>
    </x-card>
</x-layout.layout>
