<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Todo App')</title>
       <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen text-gray-800">
    <nav class="bg-indigo-600 text-white">
        <div class="max-w-2xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('todos.index') }}" class="text-xl font-bold">My Todos</a>
            <a href="{{ route('todos.create') }}"
               class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-50">
                + New Todo
            </a>
        </div>
    </nav>

    <main class="max-w-2xl mx-auto px-4 py-8">
    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>