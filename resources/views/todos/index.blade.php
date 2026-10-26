@extends('layouts.app')

@section('title', 'All Todos')

@section('content')
    <div class="space-y-3">
        @forelse ($todos as $todo)
            <div class="bg-white rounded-xl shadow-sm p-4 flex items-start justify-between gap-4">
                <div class="flex items-start gap-3">
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="mt-1 w-5 h-5 rounded border-2 flex items-center justify-center
                                       {{ $todo->is_completed ? 'bg-green-500 border-green-500 text-white' : 'border-gray-300' }}">
                            @if ($todo->is_completed) &#10003; @endif
                        </button>
                    </form>

                    <div>
                        <h2 class="font-semibold {{ $todo->is_completed ? 'line-through text-gray-400' : '' }}">
                            {{ $todo->title }}
                        </h2>
                        @if ($todo->description)
                            <p class="text-sm text-gray-500 mt-1">{{ $todo->description }}</p>
                        @endif

                        {{-- ✅ এখানে attachment কোডটি লিখবেন --}}
                        @if ($todo->attachment)
                            @php($isImage = in_array(strtolower(pathinfo($todo->attachment, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png']))

                            @if ($isImage)
                                <a href="{{ asset('storage/' . $todo->attachment) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $todo->attachment) }}"
                                         alt="{{ $todo->attachment_name }}"
                                         class="mt-2 h-24 rounded-lg border border-gray-200 object-cover">
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $todo->attachment) }}" target="_blank"
                                   class="inline-block mt-2 text-sm text-indigo-600 hover:underline">
                                    Download {{ $todo->attachment_name }}
                                </a>
                            @endif
                        @endif
                        {{-- ✅ attachment কোড শেষ --}}

                    </div>
                </div>

                <div class="flex gap-3 text-sm shrink-0">
                    <a href="{{ route('todos.edit', $todo) }}" class="text-indigo-600 hover:underline">Edit</a>

                    <form action="{{ route('todos.destroy', $todo) }}" method="POST"
                          onsubmit="return confirm('Delete this todo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 py-12">No todos yet. Add your first one!</p>
        @endforelse
    </div>
@endsection