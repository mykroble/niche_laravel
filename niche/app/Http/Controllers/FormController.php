<?php

namespace App\Http\Controllers;
use App\Models\Name;

use Illuminate\Http\Request;

class FormController extends Controller
{
    // Show the form
    public function showForm()
    {
        return view('name-form');
    }

    // Handle the form submission and show the input name
    public function handleForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Store the name in the database
        Name::create([
            'name' => $request->input('name'),
        ]);

        // Redirect back with a success message
        return redirect()->route('name.form')->with('success', 'Name saved successfully!');
    }
}