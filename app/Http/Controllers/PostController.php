<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function show() {
        $posts = Post::orderByDesc('created_at')->paginate(5);
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

    public function edit(Post $post) {
        $post = Post::find($post->id);
        Gate::authorize('update-user-post', [$post]);
        return view('edit_post', compact('post'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
        ]);
        $post = Post::find($id);
        Gate::authorize('update-user-post', [$post]);
        Post::findOrFail($id)->update($validated);
        return redirect(route('post.show'));
    }

    public function delete($id) {
        $post = Post::find($id);
        Gate::authorize('update-user-post', [$post]);
        Post::destroy($id);
        return redirect(route('post.show'));
    }
}
