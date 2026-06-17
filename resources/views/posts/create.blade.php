<x-layout title="New Post">
    <h1 class="text-2xl font-bold mb-8">New Post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="title" class="block font-mono text-xs uppercase tracking-wider text-stone-500 mb-2">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                   class="w-full px-4 py-3 border border-stone-200 rounded bg-white focus:outline-none focus:border-red-700" required>
            @error('title')
                <p class="text-red-700 font-mono text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block font-mono text-xs uppercase tracking-wider text-stone-500 mb-2">Excerpt</label>
            <textarea name="excerpt" rows="3" class="w-full border border-stone-200 rounded px-4 py-3 text-stone-900 focus:outline-none focus:border-red-700">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        </div>
        <div class="mb-6">
            <label class="block font-mono text-xs uppercase tracking-wider text-stone-500 mb-2">Content</label>
            <div id="editor" style="height: 300px; background: white;">{!! old('body') !!}</div>
            <textarea id="body" name="body" class="hidden" >{{ old('body') }}</textarea>
            @error('body')
                <p class="text-red-700 font-mono text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="published" value="1" {{ old('published') ? 'checked' : '' }}>
                <span class="text-sm">Publish immediately</span>
            </label>
        </div>
        <div class="flex gap-4">
            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-6 py-2 rounded font-mono text-xs uppercase tracking-wider transition-colors">Publish</button>
            <a href="{{ route('posts.index') }}" class="border border-red-700 text-red-700 hover:bg-red-700 hover:text-white px-6 py-2 rounded font-mono text-xs uppercase tracking-wider no-underline transition-colors">Cancel</a>
        </div>
    </form>
</x-layout>
