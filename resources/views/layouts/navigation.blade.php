<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link"  href="{{ '/' }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ 'posts' }}">Форум</a>
                </li>

                @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ 'profile' }}">Профиль</a>
                    </li>
                        @can('view-admin-panel')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ 'admin-panel' }}">Административная панель</a>
                            </li>
                        @endcan
                    <li class="nav-item">
                        <a class="nav-link" href="{{ 'logout' }}">Выход</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ 'login' }}">Вход</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ 'registration' }}">Регистрация</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
