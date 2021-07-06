<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'USR')->get();
        $tasks = Task::all();
        return view('admin.task', compact('tasks', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];

        Task::create($data);
        return redirect()->back()->with('status', 'Task added');
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            "name" => "required|string",
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];

        $task->update($data);
        return redirect()->back()->with('status', 'Task updated');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back()->with('status', 'Task deleted');
    }

    public function assign(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            "assign" => "required",
        ]);

        $data = [
            'assigned_to' => $request->assign,
        ];

        $task->update($data);
        return redirect()->back()->with('status', 'Task assigned');
    }
}
