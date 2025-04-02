<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoListController extends Controller
{
    public function index()
    {
        $lists = TodoList::where('user_id', Auth::id())->get();
        return response($lists);


    }

    public function show(Request $request, $id)
    {
        $list = TodoList::findOrFail($id);
        return response($list);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a single record with user_id
        $list = Auth::user()->todo_lists()->create([
           'name' => $validated['name'],
        ]);

        return response()->json($list, 201);
    }

    public function update(Request $request, $id)
    {

        $list = TodoList::findOrFail($id);
        $list->update($request->all());
        return response()->json(['message' => 'Updated', 'data' => $list], 200);
    }

    public function destroy(Request $request, $id)
    {
        TodoList::find($id)->delete();
        return response(200);
    }
}
