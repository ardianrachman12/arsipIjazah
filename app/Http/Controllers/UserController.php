<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('page.admin.user', [
            'users' => $users
        ]);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'id_pengguna' => 'required|unique:users,id_pengguna',
            'email' => 'required|email|unique:users',
            // 'role' => 'required|in:user,admin',
            'password' => 'required|min:8',
        ]);

        // dd($validatedData);
        if (!$validatedData) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        return redirect('/users')->with('success', 'User created successfully');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'id_pengguna' => 'required|unique:users,id_pengguna,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            // 'role' => 'required',
            // 'password' => 'nullable|min:8',
        ]);

        // dd($validatedData);

        // if ($request->filled('password')) {
        //     $validatedData['password'] = bcrypt($validatedData['password']);
        // } else {
        //     unset($validatedData['password']);
        // }

        // dd($validatedData);

        $user->update($validatedData);
        return redirect('/users')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/users')->with('success', 'User deleted successfully');
    }
}
