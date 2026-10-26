<div class="space-y-4">
    <!-- Title Field -->
    <div>
        <label for="title" class="block text-sm font-medium mb-1">Title</label>
        <input type="text" id="title" name="title"
               value="{{ old('title', $todo->title ?? '') }}"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('title')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description Field -->
    <div>
        <label for="description" class="block text-sm font-medium mb-1">Description (optional)</label>
        <textarea id="description" name="description" rows="3"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $todo->description ?? '') }}</textarea>
        @error('description')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Attachment Field -->
    <div>
        <label for="attachment" class="block text-sm font-medium mb-1">Attachment (optional)</label>

        @isset($todo)
            @if ($todo->attachment)
                <p class="text-sm text-gray-500 mb-2">
                    Current file: {{ $todo->attachment_name }}. Choose a new file to replace it.
                </p>
            @endif
        @endisset

        <input type="file" id="attachment" name="attachment"
               class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-indigo-700 hover:file:bg-indigo-100">
        <p class="text-xs text-gray-400 mt-1">JPG, PNG or PDF, up to 2 MB.</p>

        @error('attachment')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Buttons -->
    <div class="flex gap-3">
        <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700">
            {{ $buttonText }}
        </button>
        <a href="{{ route('todos.index') }}" class="px-5 py-2 text-gray-600 hover:underline">Cancel</a>
    </div>
</div>