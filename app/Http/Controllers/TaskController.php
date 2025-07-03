<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function returnTaskView()
    {
        return view('task');
    }

    public function returnAllTasks()
    {
        return Task::all();
    }

    public function createTask(Request $request)
    {
        $data = $request->validate(Task::rules());
        $task = Task::create($data);
        return response()->json(['success' => true, 'task' => $task]);
    }

    public function updateTask(Request $request, Task $task)
    {
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();
        return response()->json(['success' => true, 'task' => $task]);
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        return response()->json(['success' => true]);
    }

    public function returnTask(Task $task)
    {
        return $task;
    }

    public function updateStatus(Request $request, Task $task)
    {
        $task->status = $request->status;
        $task->save();
    }
}
