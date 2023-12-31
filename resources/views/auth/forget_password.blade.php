<x-layout.layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Forget Password
            </h2>
            <p class="mb-4">type Your Email</p>
        </header>

        <form action="{{ route('forgetPassword') }}" method="POST">
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
                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Send
                </button>
            </div>

        </form>
    </x-card>
</x-layout.layout>
