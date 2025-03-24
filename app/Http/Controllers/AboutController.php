<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $name = 'Badran';
        $departments = [
            '1' => 'Technical',
            '2' => 'Financial',
            '3' => 'Sales',
        ];

        return view('about', compact('name', 'departments'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $departments = [
            '1' => 'Technical',
            '2' => 'Financial',
            '3' => 'Sales',
        ];

        return view('about', compact('name', 'departments'));
    }
}