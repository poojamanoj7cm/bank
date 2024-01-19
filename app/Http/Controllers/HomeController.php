<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Test;

class HomeController extends Controller
{
    public function index()
    {
        return view('home',['user'=>auth()->user()]);
    }
    // public function index()
    // {
    //     return view('test');
    // }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        
        Test::create([
            'name' => $request->input('name'),
        ]);

        // Set a flash message
        session()->flash('success', 'Record inserted successfully.');

        return redirect()->route('test.index');
    }
}
