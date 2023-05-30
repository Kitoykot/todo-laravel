<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{route('main')}}"><span class="largeN">To</span><span class="largeS">Do</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <div class="search_link nav-link">Поиск</div>
                            <div class="hide_search_link nav-link">Скрыть</div>
                        </li>

                        <form id="search" class="form-inline my-2 my-lg-0" method="GET" action="/common-tasks">
                            <input class="form-control mr-sm-2" type="search" placeholder="По названию или тегам" name="q">
                            <button id="button_search" class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
                        </form>

                        <li class="common-link my-link nav-item">
                            <a class="nav-link" href="{{route('common-tasks')}}">Общие задания</a>
                        </li>
                    
                    
                        <li class="my-link nav-item">
                            <a class="nav-link" href="{{route('my-tasks')}}">Мои задания</a>
                        </li>
                    </ul>
                @endauth
                
                @guest
                    <a class="nav-link" href="{{route('register')}}">Регистрация</a>
                    <a class="nav-link" href="{{route('login')}}">Войти</a>
                @endguest

                @auth
                    <a class="nav-item">{{Auth::user()->name}}</a>

                    <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>  
                @endauth
            </div>
        </div>
    </nav> 
</header>