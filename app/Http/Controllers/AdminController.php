<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show() {
        //$users = collect(User::all())->toArray();
        $users = User::all();
        return view('admin-panel', compact('users'));
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required',
        ]);

        if($request->only('role')){
            $validated = $request->only('role') + $validated;
        }

        $user = User::create($validated);

        if($user){
            return redirect(route('admin.show'));
        }

        return redirect(route('admin.show'))->withErrors([
            'При добалвении пользователя произошла ошибка'
        ]);
    }

    public function update($id) {

        // Логика изменения пользователя

        return redirect(route('admin.show'));
    }

    public function delete($id) {
       User::destroy($id);
       return redirect(route('admin.show'));
    }
}
