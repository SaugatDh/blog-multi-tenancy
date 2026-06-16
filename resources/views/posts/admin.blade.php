<x-layout title="Admin — Posts">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold">All Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded font-mono text-xs uppercase tracking-wider no-underline">+ New Post</a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th class="text-left py-3 px-4 border-b border-stone-200 font-mono text-xs uppercase tracking-wider text-stone-500">Title</th>
                <th class="text-left py-3 px-4 border-b border-stone-200 font-mono text-xs uppercase tracking-wider text-stone-500">Status</th>
                <th class="text-left py-3 px-4 border-b border-stone-200 font-mono text-xs uppercase tracking-wider text-stone-500">Created</th>
                <th class="text-left py-3 px-4 border-b border-stone-200 font-mono text-xs uppercase tracking-wider text-stone-500">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr class="border-b border-stone-200">
                    <td class="py-3 px-4">
                        <a href="{{ $post->url }}" target="_blank" class="text-red-700 hover:text-red-900 no-underline">{{ $post->title }}</a>
                    </td>
                    <td class="py-3 px-4">
                        @if ($post->published)
                            <span class="inline-block px-2 py-0.5 rounded-full font-mono text-[0.65rem] uppercase bg-green-100 text-green-800">Published</span>
                        @else
                            <span class="inline-block px-2 py-0.5 rounded-full font-mono text-[0.65rem] uppercase bg-yellow-100 text-yellow-800">Draft</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 font-mono text-xs text-stone-500">{{ $post->created_at->format('M d, Y') }}</td>
                    <td class="py-3 px-4">
                        <div class="flex gap-2 items-center">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="border border-red-700 text-red-700 hover:bg-red-700 hover:text-white px-3 py-1 rounded font-mono text-xs uppercase no-underline transition-colors">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-900 hover:bg-red-950 text-white px-3 py-1 rounded font-mono text-xs uppercase transition-colors">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-8 text-stone-500">
                        No posts yet. <a href="{{ route('posts.create') }}" class="text-red-700">Create your first one!</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="flex gap-2 mt-12 font-mono text-sm">
        {{ $posts->links() }}
    </div>

</x-layout>
