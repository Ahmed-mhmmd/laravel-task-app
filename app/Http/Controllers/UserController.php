<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')->get();
        $editUser = null;

        if ($request->has('edit')) {
            $editUser = DB::table('users')->where('id', $request->query('edit'))->first();
        }

        return view('users', compact('users', 'editUser'));
    }

    public function store(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return redirect()->back();
    }

    public function edit($id)
    {
        return redirect('/users?edit=' . $id);
    }

    public function update(Request $request, $id)
    {
        $updateData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = $request->input('password');
        }

        DB::table('users')->where('id', $id)->update($updateData);
        return redirect('/users')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->back();
    }
}