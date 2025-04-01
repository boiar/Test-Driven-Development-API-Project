<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        $lists = TodoList::all();
        return response($lists);


    }

    public function show(Request $request, $id)
    {
        $list = TodoList::findOrFail($id);
        return response($list);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $list = TodoList::create(['name' => $request->name]);
        return response($list, 201);
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
