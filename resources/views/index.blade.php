@extends('layouts/app')

@section('title','Главная')

@section('content')

<main>
    <div class="container py-4">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Добро пожаловать на форум, {{ $name }} </h1>
                <p class="col-md-8 fs-4">Здесь вы можете писать всё, о чем вы думаете</p>
            </div>
        </div>

        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-80 p-5 text-white bg-dark rounded-3">
                    <h2>Для того, чтобы делать посты, вам нужно зарегистрироваться</h2>
                    <p>При регистрации, от вас не потребуется ничего, кроме вашей почты</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Расскажите друзьям</h2>
                    <p>О нашем сайте</p>
                </div>
            </div>
        </div>

        <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2022
        </footer>
    </div>
</main>

@endsection
