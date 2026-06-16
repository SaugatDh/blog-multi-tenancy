<x-layout title="Page Not Found">

    <div class="text-center py-24">
        <h1 class="text-9xl font-bold text-stone-200">404</h1>
        <p class="text-2xl text-stone-600 mt-4 mb-8">This page doesn't exist.</p>
        <a href="{{ route('posts.index') }}" class="bg-red-700 hover:bg-red-800 text-white px-6 py-3 rounded font-mono text-xs uppercase tracking-wider no-underline transition-colors">Back to Blog</a>
    </div>

</x-layout>
