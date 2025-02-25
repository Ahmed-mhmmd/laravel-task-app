<?php

use Carbon\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use function Laravel\Prompts\table;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/about',function(): Factory|View{
// $name = 'Badran';

// $departments = [
//     '1' => 'Tichnical',
//     '2' => 'Financial',
//     '3' => 'Sales',
// ];

//     // return view('about', ['name' => $name]);
//    // return view(view:'about')->with(key: 'name', value: $name);
//   return view (view: 'about', data: compact(var_name: 'name', var_names:'departments'));
// });


// Route::post(uri: '/about', action: function(): Factory|View{
//     $name = $_POST['name'];
//     $departments = [
//         '1' => 'Tichnical',
//         '2' => 'Financial',
//         '3' => 'Sales',
//     ];
//     return view(view: 'about', data: compact(var_name: 'name'));
// });
Route::get('/about', function (): Factory|View {
    $name = 'Badran';
    $departments = [
        '1' => 'Technical',
        '2' => 'Financial',
        '3' => 'Sales',
    ];

    return view('about', compact('name', 'departments'));
});

Route::post('/about', function (): Factory|View {
    $name = $_POST['name'];
    $departments = [
        '1' => 'Technical',
        '2' => 'Financial',
        '3' => 'Sales',
    ];

    return view('about', compact('name', 'departments'));
});


// Display Tasks
Route::get('/tasks', function (Request $request) {
    $tasks = DB::table('tasks')->get();
    $editTask = null;

    if ($request->has('edit')) {
        $editTask = DB::table('tasks')->where('id', $request->query('edit'))->first();
    }

    return view('tasks', compact('tasks', 'editTask'));
});

// Create Task
Route::post('create', function (Request $request) {
    $task_name = $request->input('name');

    DB::table('tasks')->insert([
        'name' => $task_name
    ]);

    return redirect()->back();
});


// Edit task (pass task ID to the form)
Route::get('/tasks/edit/{id}', function ($id) {
    return redirect('/tasks?edit=' . $id);
});

// Update task
Route::post('/update/{id}', function (Request $request, $id) {
    DB::table('tasks')->where('id', $id)->update([
        'name' => $request->input('name'),
    ]);
    return redirect('/tasks')->with('success', 'Task updated successfully!');
});

// Delete Task
Route::post('/delete/{id}', function ($id) {
    DB::table('tasks')->where('id', $id)->delete();
    return redirect()->back();
});


// Display Users
Route::get('/users', function (Request $request) {
    $users = DB::table('users')->get();
    $editUser = null;

    if ($request->has('edit')) {
        $editUser = DB::table('users')->where('id', $request->query('edit'))->first();
    }

    return view('users', compact('users', 'editUser'));
});

// Create User
Route::post('/create', function (Request $request) {
    DB::table('users')->insert([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
    ]);

    return redirect()->back();
});

// Edit User (Redirects to the edit form)
Route::get('/users/edit/{id}', function ($id) {
    return redirect('/users?edit=' . $id);
});

// Update User
Route::post('/update/{id}', function (Request $request, $id) {
    $updateData = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
    ];

    if ($request->filled('password')) { // Update password only if provided
        $updateData['password'] = $request->input('password');
    }

    DB::table('users')->where('id', $id)->update($updateData);
    return redirect('/users')->with('success', 'User updated successfully!');
});

// Delete User
Route::post('/delete/{id}', function ($id) {
    DB::table('users')->where('id', $id)->delete();
    return redirect()->back();
});
