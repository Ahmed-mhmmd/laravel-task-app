<?php

use Carbon\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\table;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about',function(): Factory|View{
$name = 'Badran';

$departments = [
    '1' => 'Tichnical',
    '2' => 'Financial',
    '3' => 'Sales',
];

    // return view('about', ['name' => $name]);
   // return view(view:'about')->with(key: 'name', value: $name);
  return view (view: 'about', data: compact(var_name: 'name', var_names:'departments'));
});


Route::post(uri: '/about', action: function(): Factory|View{
    $name = $_POST['name'];
    $departments = [
        '1' => 'Tichnical',
        '2' => 'Financial',
        '3' => 'Sales',
    ];
    return view(view: 'about', data: compact(var_name: 'name'));
});

Route::get(uri: 'tasks', action: function(): Factory|View{
    return view('tasks');
});
Route::post(uri:'create', action: function(): string{
    $task_name = $_POST['name'];
    DB::table(table: 'tasks')->insert(values: ['name' => $task_name]);
    return view('tasks');
});
