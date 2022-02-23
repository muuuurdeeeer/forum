<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $name = 'гость';
    if(User::find(Auth::id())) {
        $collect = collect(User::find(Auth::id())->toArray());
        $name = $collect['name'];
    }
    return view('index', ['name' => $name]);
})->name('/');

// админ панель / пользователи
Route::name('admin.')->group(function () {
    Route::get('/admin-panel', [AdminController::class, 'show'])
        ->middleware('can:view-admin-panel') //посредник с отображением панели в навигации
        ->middleware('auth')
        ->name('show');
    Route::get('/edit_user/{user}', [AdminController::class, 'edit'])->name('edit');
    Route::get('/recovery_user/{id}', [AdminController::class, 'recovery'])->name('recovery');
    Route::post('/create_user', [AdminController::class, 'create'])->name('create');
    Route::patch('/update_user/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/delete_user/{id}', [AdminController::class, 'delete'])->name('delete');
});


// посты
Route::name('post.')->group(function (){
    Route::get('/posts', [PostController::class, 'show'])->name('show');
    Route::get('/edit_post/{post}', [PostController::class, 'edit'])->name('edit');
    Route::post('/create_post', [PostController::class, 'create'])->name('create');
    Route::patch('/update_post/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('/delete_post/{id}', [PostController::class, 'delete'])->name('delete');
});

Route::name('user.')->group(function (){
    Route::get('/login', function (){
        if(Auth::check()){
            return view('profile');
        }
        return view('auth.login');
    })->name('login');

    Route::get('/registration', function (){
        if(Auth::check()){
            return view('profile');
        }
        return view('auth.registration');
    })->name('registration');

    Route::get('/logout', function (){
        Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::get('/profile', function (){
        if(Auth::check()){
            $posts = User::find(Auth::id())->posts;
            return view('profile', ['posts' => $posts]);
        }
        return view('auth.login');
    })->name('profile');

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/registration', [AuthController::class, 'register']);
});










