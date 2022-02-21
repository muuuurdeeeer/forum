<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        if(!Auth::check()) {
            $validated = $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required',
            ]);
        } else {
            return redirect(route('user.profile'));
        }
        $user = User::create($validated);

        if($user){
            return redirect(route('user.login'));
        }

        return redirect(route('user.registration'))->withErrors([
            'При регистрации произошла ошибка'
        ]);
    }

    public function login(Request $request) {
        if(Auth::check()){
            return redirect(route('profile'));
        }

        $fields = $request->only('email', 'password');

        if(Auth::attempt($fields)){
            return redirect('/');
        }

        return redirect(route('user.login'))->withErrors([
            'Не удалось войти'
        ]);
    }
}
