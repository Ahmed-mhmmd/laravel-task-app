<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = DB::table('tasks')->get();
        $editTask = null;

        if ($request->has('edit')) {
            $editTask = DB::table('tasks')->where('id', $request->query('edit'))->first();
        }

        return view('tasks', compact('tasks', 'editTask'));
    }

    public function store(Request $request)
    {
        DB::table('tasks')->insert([
            'name' => $request->input('name')
        ]);

        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function edit($id)
    {
        return redirect('/tasks?edit=' . $id);
    }

    public function update(Request $request, $id)
    {
        DB::table('tasks')->where('id', $id)->update([
            'name' => $request->input('name'),
        ]);
        
        return redirect('/tasks')->with('success', 'Task updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('tasks')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Task deleted successfully!');
    }
}