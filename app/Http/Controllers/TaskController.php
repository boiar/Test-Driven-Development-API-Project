<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request, $id)
    {
        $tasks = Task::all();
        return response($tasks);
    }

    public function show(Request $request, $id)
    {
        $list = Task::findOrFail($id);
        return response($list);
    }

    public function store(Request $request)
    {
        $request->validate([
           'todo_list_id' => 'required',
           'title' => 'required',
        ]);

        $list = Task::create(['todo_list_id' => $request->todo_list_id, 'title' => $request->title]);
        return response($list, 201);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
           'title' => 'required',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json(['message' => 'Updated', 'data' => $task], 200);
    }



    public function changeStatus(Request $request, $id)
    {

        $request->validate([
           'status' => 'required',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json(['message' => 'Updated', 'data' => $task], 200);
    }



    public function destroy(Request $request, $id)
    {
        Task::find($id)->delete();
        return response(200);
    }
}
