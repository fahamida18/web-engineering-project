<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::latest()->get();

        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $data['attachment'] = $file->store('attachments', 'public');
        $data['attachment_name'] = $file->getClientOriginalName();
    }

    Todo::create($data);

    return redirect()->route('todos.index')->with('success', 'Todo added.');
}

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

   public function update(Request $request, Todo $todo)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    if ($request->hasFile('attachment')) {
        if ($todo->attachment) {
            Storage::disk('public')->delete($todo->attachment);
        }

        $file = $request->file('attachment');
        $data['attachment'] = $file->store('attachments', 'public');
        $data['attachment_name'] = $file->getClientOriginalName();
    }

    $todo->update($data);

    return redirect()->route('todos.index')->with('success', 'Todo updated.');
}

    public function toggle(Todo $todo)
    {
        $todo->update(['is_completed' => ! $todo->is_completed]);

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
{
    if ($todo->attachment) {
        Storage::disk('public')->delete($todo->attachment);
    }

    $todo->delete();

    return redirect()->route('todos.index')->with('success', 'Todo deleted.');
}
}