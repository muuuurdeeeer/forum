@extends('layouts/app')

@section('title','Форум')

@section('content')

    <!-- Форма добавления поста -->
    @if(\Illuminate\Support\Facades\Auth::check()) <!-- проверка на авторизацию -->
        <form class="col-6 offset-3 mt-3" method="POST" action="{{ route('post.create') }}">
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">Тема поста</label>
                <input name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Напишите что-нибудь...">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="body" class="form-label">Содержание</label>
                <textarea name="body" id="body" class="form-control" rows="3">{{ old('body') }}</textarea>
                @error('body')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary" value="1" name="sendMe">Отправить</button>
            </div>
        </form>
        <br>
    @endif

    <!-- Вывод карточек с постами -->
    @foreach($posts as $post)
            <div class="card col-6 offset-3 text-dark bg-light mb-3" >
                <div class="card-header">
                    {{ $post->user->name }}
                    @if(\Illuminate\Support\Facades\Cache::has('is_online' . $post->user->id))
                        <span class="text-success">Online</span>
                    @else
                        <span class="text-secondary">Offline</span>
                    @endif
                    <br>
                    {{ $post->user->role }}
                    <br>
                    @can('update-user-post', $post)
                        <a class="link-secondary text-decoration-none" href="{{ url('/edit_post',$post) }}">Редактировать пост</a>
                    @endcan
                </div>
                <div class="card-body">
                    <h5 class="card-title"> {{ $post->title }} </h5>
                    <p class="card-text"> {{ $post->body }} </p>
                    <p class="card-text"> {{ $post->created_at->format('d/m/Y') }} {{ $post->created_at->format('H:i') }}</p>
                    @can('delete-user-post', $post)
                        <form method="post" class="delete_form" action="{{ url('/delete_post',$post->id) }}">
                            {{ method_field('DELETE') }}
                            {{  csrf_field() }}
                            <button type="submit" class="btn btn-danger">{{ trans('Удалить пост') }}</button>
                        </form>
                    @endcan
                </div>
            </div>
    @endforeach
    {{ $posts->links() }}
@endsection
