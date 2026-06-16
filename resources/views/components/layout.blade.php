<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'My Blog' }}</title>
    @vite(['resources/css/app.css'])

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
</head>
<body class="bg-stone-50 text-stone-900 leading-relaxed">

    <nav class="flex justify-between items-center max-w-3xl mx-auto py-6 px-4 border-b border-stone-200">
        <a href="{{ route('posts.index') }}" class="text-xl font-bold text-stone-900 no-underline hover:text-red-700">My Blog</a>
        <div class="flex gap-6 font-mono text-xs uppercase tracking-wider items-center">
            <a href="{{ route('posts.index') }}" class="text-stone-500 hover:text-red-700 no-underline">Blog</a>

            {{-- @auth
                <a href="{{ route('admin.posts.index') }}" class="text-stone-500 hover:text-red-700 no-underline">Admin</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-stone-500 hover:text-red-700 no-underline cursor-pointer bg-transparent border-none font-mono text-xs uppercase tracking-wider">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-stone-500 hover:text-red-700 no-underline">Login</a>
                <a href="{{ route('register') }}" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded no-underline">Register</a>
            @endauth --}}

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.posts.index') }}" class="text-stone-500 hover:text-red-700 no-underline">Admin</a>
                @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-stone-500 hover:text-red-700 no-underline cursor-pointer bg-transparent border-none font-mono text-xs uppercase tracking-wider">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-stone-500 hover:text-red-700 no-underline">Login</a>
                    <a href="{{ route('register') }}" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded no-underline">Register</a>
                @endauth

        </div>
    </nav>


    <main class="max-w-3xl mx-auto py-12 px-4">

        @if (session('success'))
            <div id="flash-success" class="bg-green-100 text-green-800 border border-green-200 rounded px-4 py-3 mb-6 font-mono text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div id="flash-error" class="bg-red-100 text-red-800 border border-red-200 rounded px-4 py-3 mb-6 font-mono text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}

    </main>
<script>
    if (document.getElementById('editor')) {
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Write your post...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'indent': '-1' }, { 'indent': '+1' }],
                    [{ 'align': [] }],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });
        // Custom image upload handler
        quill.getModule('toolbar').addHandler('image', function () {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = function () {
                var file = input.files[0];
                var formData = new FormData();
                formData.append('image', file);

                fetch('/admin/images/upload', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    var range = quill.getSelection();
                    quill.insertEmbed(range.index, 'image', data.url);
                });
            };
        });

        // Custom link handler (works without selecting text)
        quill.getModule('toolbar').addHandler('link', function () {
            var range = quill.getSelection();
            var url = prompt('Enter URL:');
            if (!url) return;

            if (range && range.length > 0) {
                quill.format('link', url);
            } else {
                quill.insertText(range.index, url, 'link', url);
            }
        });
        // Sync to the FORM THAT CONTAINS the editor, not just any form
        document.getElementById('editor').closest('form').addEventListener('submit', function() {
            document.querySelector('#body').value = quill.root.innerHTML;
        });
    }

    setTimeout(() => {
        var success = document.getElementById('flash-success');
        var error = document.getElementById('flash-error');
        if (success) {
            success.style.opacity = '0';
            setTimeout(() => success.remove(), 500);
        }
        if (error) {
            error.style.opacity = '0';
            setTimeout(() => error.remove(), 500);
        }
    }, 3000);
</script>



</body>
</html>
