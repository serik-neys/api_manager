<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
  
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', "unique:users"],
            'password' => ['required', 'string', 'min:8']
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'password' => $request->password
        ]);

        Auth::login($user);

        return redirect('/workspace');

    }

}
