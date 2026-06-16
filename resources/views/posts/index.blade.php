<x-layout title="Blog">

    @forelse ($posts as $post)
        <article class="bg-white border border-stone-200 rounded-lg p-8 mb-6 hover:border-red-600 transition-colors duration-200">
            <p class="font-mono text-xs text-stone-500 mb-2">{{ $post->created_at->format('M d, Y') }}</p>
            <h2 class="text-2xl font-bold mb-2">
                <a href="{{ $post->url }}" class="text-stone-900 no-underline hover:text-red-700">{{ $post->title }}</a>
            </h2>

            <p class="text-stone-500">{{ $post->excerpt }}</p>

{{-- <p class="text-stone-500">
    {{ Str::limit(strip_tags(preg_replace('/<h[1-6][^>]*>.*?<\/h[1-6]>/is', '', $post->body)), 160) }}
</p>
            <p class="text-stone-500">{{ Str::limit(strip_tags(str_replace('<', ' <', $post->body)), 160) }}</p> --}}
            {{-- <a href="{{ $post->url }}" class="inline-block mt-4 font-mono text-xs uppercase tracking-wider text-red-700 hover:text-red-900">Read article &rarr;</a> --}}
        <div class="flex justify-between items-center mt-4">
    <a href="{{ $post->url }}" class="font-mono text-xs uppercase tracking-wider text-red-700 hover:text-red-900">Read article &rarr;</a>
    <span class="flex items-center gap-1 font-mono text-xs text-stone-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        {{ $post->likeCount() }}
    </span>
</div>

        </article>
    @empty
        <p class="text-stone-500">No posts yet.</p>
    @endforelse

    <div class="flex gap-2 mt-12 font-mono text-sm">
        {{ $posts->links() }}
    </div>

</x-layout>
