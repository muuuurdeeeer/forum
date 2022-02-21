@extends('layouts/app')

@section('title','Профиль')

@section('content')

@foreach($posts as $post)
    <div class="card col-6 offset-3 text-dark bg-light mb-3" >
        <div class="card-header">
            {{ $post->user->name }}
        </div>
        <div class="card-body">
            <h5 class="card-title"> {{ $post->title }} </h5>
            <p class="card-text"> {{ $post->body }} </p>
            <p class="card-text"> {{ $post->created_at->format('d/m/Y') }} {{ $post->created_at->format('H:i') }}</p>
        </div>

        <div class="card-footer bg-light">
            <a class="link-secondary text-decoration-none" href="{{ url('/edit_post',$post) }}">Редактировать пост</a>
            <form method="post" class="delete_form" action="{{ url('/delete_post',$post->id) }}">
                {{ method_field('DELETE') }}
                {{  csrf_field() }}
                <button type="submit" class="btn btn-danger">{{ trans('Удалить пост') }}</button>
            </form>
        </div>
    </div>
@endforeach

@endsection
