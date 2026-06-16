<x-layout title="Register">

    <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-bold mb-8">Create Account</h1>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="name" class="block font-mono text-xs uppercase tracking-wider text-stone-500 mb-2">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="w-full px-4 py-3 border border-stone-200 rounded bg-white focus:outline-none focus:border-red-700" required autofocus>
                @error('name')
                    <p class="text-red-700 font-mono text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block font-mono text-xs uppercase tracking-wider text-stone-500 mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="w-full px-4 py-3 border border-stone-200 rounded bg-white focus:outline-none focus:border-red-700" required>
                @error('email')
                    <p class="text-red-700 font-mono text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block font-mono text-xs uppercase tracking-wider text-stone-500 mb-2">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-4 py-3 border border-stone-200 rounded bg-white focus:outline-none focus:border-red-700" required>
                @error('password')
                    <p class="text-red-700 font-mono text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block font-mono text-xs uppercase tracking-wider text-stone-500 mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="w-full px-4 py-3 border border-stone-200 rounded bg-white focus:outline-none focus:border-red-700" required>
            </div>

            <div class="flex gap-4 items-center">
                <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-6 py-2 rounded font-mono text-xs uppercase tracking-wider transition-colors">Register</button>
                <a href="{{ route('login') }}" class="text-stone-500 hover:text-red-700 font-mono text-xs">Already have an account? Login</a>
            </div>
        </form>
    </div>

</x-layout>
