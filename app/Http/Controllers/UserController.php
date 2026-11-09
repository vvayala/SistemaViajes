<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return view('user.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:user,email,' . $user->user_id . ',user_id',
        ]);

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'telephone' => $request->telephone,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('user.show', $user->user_id)
            ->with('success', 'Perfil actualizado correctamente.');
    }


}
