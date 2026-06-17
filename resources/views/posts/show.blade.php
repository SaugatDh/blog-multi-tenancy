<x-layout :title="$post->title . ' — Blog'">
    <article>
        <p class="font-mono text-xs text-stone-500 mb-2">{{ $post->created_at->format('F d, Y') }}</p>
        <p class="font-mono text-xs text-stone-500 mb-2">By {{ $post->user->name }}</p>
        <h1 class="text-4xl font-bold leading-tight mb-4">{{ $post->title }}</h1>
        <x-like-button :post="$post" />
        <div class="prose prose-lg max-w-none mt-8 [&_img]:max-w-full [&_img]:h-auto [&_img]:rounded-lg">
            {!! $post->body !!}
        </div>
        <div class="mt-12 pt-6 border-t border-stone-200">
            <a href="{{ route('posts.index') }}" class="font-mono text-sm text-red-700 hover:text-red-900">&larr; Back to all posts</a>
        </div>
    </article>
</x-layout>
