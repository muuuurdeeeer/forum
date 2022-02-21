<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function show() {
        //$posts = collect(Post::all()->toArray());
        //$posts = collect(Post::paginate(3)->toArray());

        $posts = Post::paginate(3);
        //dd($posts);

        return view('forum', compact('posts'));
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
        ]);

        $user_id = array('user_id' => Auth::id());
        $validated = $user_id + $validated; // добавляем поле с id пользователя
        $post = Post::create($validated);

        if($post){
            return redirect(route('post.show'));
        }

        return redirect(route('post.show'))->withErrors([
            'При добавлении поста произошла ошибка'
        ]);
    }

    public function udpate($id) {

        // логика редактирования

        return redirect(route('post.show'));
    }

    public function delete($id) {
        Post::destroy($id);
        return redirect(route('post.show'));
    }
}