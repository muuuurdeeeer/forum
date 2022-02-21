@extends('layouts/app')

@section('title','Профиль')

@section('content')

    <h2>Список ваших постов</h2>

@foreach($posts as $post)
    <div class="card col-6 offset-3 text-dark bg-light mb-3" >
        <div class="card-header">
            {{\App\Models\Post::find($post->id)->user->name }}
            @if(\Illuminate\Support\Facades\Cache::has('is_online' . \App\Models\Post::find($post->id)->user->id))
                <span class="text-success">Online</span>
            @else
                <span class="text-secondary">Offline</span>
            @endif
            <br>
            {{\App\Models\Post::find($post->id)->user->role }}
        </div>
        <div class="card-body">
            <h5 class="card-title"> {{ $post->title }} </h5>
            <p class="card-text"> {{ $post->body }} </p>
            <p class="card-text"> {{ $post->created_at->format('d/m/Y') }} {{ $post->created_at->format('H:i:s') }}</p>
        </div>

        <div class="card-footer bg-light">
            <form method="post" class="delete_form" action="{{ url('/delete_post',$post->id) }}">
                {{ method_field('DELETE') }}
                {{  csrf_field() }}
                <button type="submit" class="btn btn-danger">{{ trans('Удалить пост') }}</button>
            </form>
        </div>
    </div>
@endforeach

@endsection
